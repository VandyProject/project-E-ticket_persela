<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

    function index() {
        updata();
        $this->load->view('konfirmasi', [
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }

    function cek() {
        $r = $this->db->where([
                    'kode' => $this->input->post('kode'),
                    'email' => $this->input->post('email')
                ])->where('waktu LIKE', $this->input->post('tgl').'%')->get('ms_penonton')->row_array();
        if (count($r) <= 0) {
            $this->session->set_userdata('id_penonton', '');
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Gagal!</strong> Data tidak ditemukan</p>
                                  </div>
                                </div>');
            redirect('konfirmasi');
        } else {
            $this->session->set_userdata('id_penonton', $r['id_penonton']);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Data tersedia</p>
                                  </div>
                                </div>');
            redirect('konfirmasi/upload');
        }
    }

    function upload() {
        $this->load->view('form_upload', [
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }

    function proses() {
        $error = 0;
        $tmp_id = $this->session->userdata('id_penonton');
        $p = $this->db->where([
                'id_penonton' => $tmp_id,
            ])->get('ms_penonton')->row_array();
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './resi/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = time();



        $this->upload->initialize($brt);
        if ($_FILES['resi']['name'] == '' || !$this->upload->do_upload('resi')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['resi'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'resi/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        $data = array(
            'id_penonton' => $p['id_penonton'],
            'kode' => $p['kode'],
            'nama' => $p['nama'],
            'email' => $p['email'],
            'no_hp' => $p['no_hp'],
            'waktu' => $p['waktu'],
            'jumlah' => $p['jumlah'],
            'id_tribun' => $p['id_tribun'],
            'status' => 'pending',
            'nama_norek' => $this->input->post('nama_norek'),
            'bank' => $this->input->post('bank'),
            'norek' => $this->input->post('norek'),
            'nominal' => (tribun(penonton($tmp_id, 'id_tribun'),'harga_tribun'))*(penonton($tmp_id, 'jumlah')),
            'resi' => $_POST['resi'],
            'waktu_upload' => date('Y-m-d H:i:s'),
            'waktu_verifed' => '',
            'tiket' => '',
            'admin' => ''
        );

        if ($error == 0) {
            $this->crud->update('ms_penonton', ['id_penonton' => $p['id_penonton']], $data);
            $this->session->unset_userdata('id_penonton');
            $this->load->library('email');
        
            $htmlContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns:v="urn:schemas-microsoft-com:vml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
        <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
        <!--[if !mso]><!-- -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
        <!-- <![endif]-->
    
        <title>Eticbat | Electronic Ticketing Persibat</title>
    
        <style type="text/css">
            body {
                width: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt: 0px;
                mso-margin-bottom-alt: 0px;
                mso-padding-alt: 0px 0px 0px 0px;
            }
            
            p,
            h1,
            h2,
            h3,
            h4 {
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            span.preheader {
                display: none;
                font-size: 1px;
            }
            
            html {
                width: 100%;
            }
            
            table {
                font-size: 14px;
                border: 0;
            }
            /* ----------- responsivity ----------- */
            
            @media only screen and (max-width: 640px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 20px !important;
                }
                .main-section-header {
                    font-size: 28px !important;
                }
                .show {
                    display: block !important;
                }
                .hide {
                    display: none !important;
                }
                .align-center {
                    text-align: center !important;
                }
                .no-bg {
                    background: none !important;
                }
                /*----- main image -------*/
                .main-image img {
                    width: 440px !important;
                    height: auto !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 440px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 440px !important;
                }
                .container580 {
                    width: 400px !important;
                }
                .main-button {
                    width: 220px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 320px !important;
                    height: auto !important;
                }
                .team-img img {
                    width: 100% !important;
                    height: auto !important;
                }
            }
            
            @media only screen and (max-width: 479px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 18px !important;
                }
                .main-section-header {
                    font-size: 26px !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 280px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 280px !important;
                }
                .container590 {
                    width: 280px !important;
                }
                .container580 {
                    width: 260px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 280px !important;
                    height: auto !important;
                }
            }
        </style>
        <!-- [if gte mso 9]><style type=”text/css”>
            body {
            font-family: arial, sans-serif!important;
            }
            </style>
        <![endif]-->
    </head>
    
    
    <body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <!-- pre-header -->
        <table style="display:none!important;">
            <tr>
                <td>
                    <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                        Notifikasi
                    </div>
                </td>
            </tr>
        </table>
        <!-- pre-header end -->
        <!-- header -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
    
                                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                                    <tr>
                                        <td align="center" height="70" style="height:70px;">
                                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px; background-color:red;" src="https://eticbat.functionwebdevelop.com/assets/admin/images/persibat-admin.png" alt="" /></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                    </table>
                </td>
            </tr>
        </table>
        <!-- end header -->
    
        <!-- big image section -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                        <tr>
    
                            <td align="center" class="section-img">
                                <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://eticbat.functionwebdevelop.com/assets/main/images/home02/about-greenforet-img.png" style="display: block; width: 590px;" width="300" border="0" alt="" /></a>
    
    
    
    
                            </td>
                        </tr>
                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
    
    
                                <div style="line-height: 35px">
    
                                    Eticbat <span style="color: red;">Notifikasi</span>
    
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
                                <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                    <tr>
                                        <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
                                <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                    <tr>
                                        <td align="center" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
    
    
                                            <div style="line-height: 24px">
    
                                                Data pembayaran baru telah masuk, mohon untuk dikonfirmasi.
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                    </table>
    
                </td>
            </tr>
    
        </table>
        <!-- end section -->
    
        <!-- contact section -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
            <tr class="hide">
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">
    
                        <tr>
                            <td>
                                <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
                                    <tr>
                                        <!-- logo -->
                                        <td align="left">
                                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px; background-color:red;" src="https://eticbat.functionwebdevelop.com/assets/admin/images/persibat-admin.png" alt="" /></a>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                                    </tr>
    
                                    <tr>
                                        <td align="left" style="color: #888888; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 23px;" class="text_color">
                                            <div style="color: #333333; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
    
                                                Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: "Hind Siliguri", Calibri, Sans-serif; font-weight: 400;">admin@persibat.com</a>
    
                                            </div>
                                        </td>
                                    </tr>
    
                                </table>
    
                                <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                    </tr>
                                </table>
    
                                <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
                                    <tr>
                                        <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                    </tr>
    
    
    
                                    <tr>
                                        <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                    </tr>
    
                                    <tr>
                                        <td>
                                            <table border="0" align="right" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>
                                                        <a href="https://www.facebook.com/mdbootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <a href="https://twitter.com/MDBootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <a href="https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
    
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    
            <tr>
                <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
            </tr>
    
        </table>
        <!-- end section -->
    
        <!-- footer ====== -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">
    
            <tr>
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td align="center">
    
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td>
                                <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
                                            <div style="line-height: 24px;">
    
                                                <span style="color: #333333;">PERSIBAT BATANG</span>
    
                                            </div>
                                        </td>
                                    </tr>
                                </table>
    
                                <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                    </tr>
                                </table>
    
                                <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
    
                                </table>
                            </td>
                        </tr>
    
                    </table>
                </td>
            </tr>
    
            <tr>
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
    
        </table>
        <!-- end footer ====== -->
    
    </body>
    
    </html>';
           $usr = $this->crud->read('ms_user',['hak_akses' => 'Admin']);
            $config['mailtype'] = 'html';
            foreach($usr as $ad){
            $this->email->initialize($config);
            $this->email->to($ad['email']);
            $this->email->from('functionwebdevelop@gmail.com','Official Team Electronic Ticketing Persibat');
            $this->email->subject('Notifikasi E-Ticbat');
            $this->email->message($htmlContent);
            $this->email->attach('');
            $this->email->send();
            }
            $htmlContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns:v="urn:schemas-microsoft-com:vml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
        <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
        <!--[if !mso]><!-- -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
        <!-- <![endif]-->
    
        <title>Eticbat | Electronic Ticketing Persibat</title>
    
        <style type="text/css">
            body {
                width: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt: 0px;
                mso-margin-bottom-alt: 0px;
                mso-padding-alt: 0px 0px 0px 0px;
            }
            
            p,
            h1,
            h2,
            h3,
            h4 {
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            span.preheader {
                display: none;
                font-size: 1px;
            }
            
            html {
                width: 100%;
            }
            
            table {
                font-size: 14px;
                border: 0;
            }
            /* ----------- responsivity ----------- */
            
            @media only screen and (max-width: 640px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 20px !important;
                }
                .main-section-header {
                    font-size: 28px !important;
                }
                .show {
                    display: block !important;
                }
                .hide {
                    display: none !important;
                }
                .align-center {
                    text-align: center !important;
                }
                .no-bg {
                    background: none !important;
                }
                /*----- main image -------*/
                .main-image img {
                    width: 440px !important;
                    height: auto !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 440px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 440px !important;
                }
                .container580 {
                    width: 400px !important;
                }
                .main-button {
                    width: 220px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 320px !important;
                    height: auto !important;
                }
                .team-img img {
                    width: 100% !important;
                    height: auto !important;
                }
            }
            
            @media only screen and (max-width: 479px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 18px !important;
                }
                .main-section-header {
                    font-size: 26px !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 280px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 280px !important;
                }
                .container590 {
                    width: 280px !important;
                }
                .container580 {
                    width: 260px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 280px !important;
                    height: auto !important;
                }
            }
        </style>
        <!-- [if gte mso 9]><style type=”text/css”>
            body {
            font-family: arial, sans-serif!important;
            }
            </style>
        <![endif]-->
    </head>
    
    
    <body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <!-- pre-header -->
        <table style="display:none!important;">
            <tr>
                <td>
                    <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                        Konfirmasi
                    </div>
                </td>
            </tr>
        </table>
        <!-- pre-header end -->
        <!-- header -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
    
                                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                                    <tr>
                                        <td align="center" height="70" style="height:70px;">
                                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px; background-color:red;" src="https://eticbat.functionwebdevelop.com/assets/admin/images/persibat-admin.png" alt="" /></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                    </table>
                </td>
            </tr>
        </table>
        <!-- end header -->
    
        <!-- big image section -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                        <tr>
    
                            <td align="center" class="section-img">
                                <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://eticbat.functionwebdevelop.com/assets/main/images/home02/about-greenforet-img.png" style="display: block; width: 590px;" width="300" border="0" alt="" /></a>
    
    
    
    
                            </td>
                        </tr>
                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
    
    
                                <div style="line-height: 35px">
    
                                    Eticbat <span style="color: red;">Konfirmasi Pembayaran</span>
    
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
                                <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                    <tr>
                                        <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
                                <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                    <tr>
                                        <td align="center" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
    
    
                                            <div style="line-height: 24px">
    
                                                Pembayaran Tiket Anda Berhasil, kami akan segera mengirim tiket melalui Email ini.
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                    </table>
    
                </td>
            </tr>
    
        </table>
        <!-- end section -->
    
        <!-- contact section -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
            <tr class="hide">
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">
    
                        <tr>
                            <td>
                                <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
                                    <tr>
                                        <!-- logo -->
                                        <td align="left">
                                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px; background-color:red;" src="https://eticbat.functionwebdevelop.com/assets/admin/images/persibat-admin.png" alt="" /></a>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                                    </tr>
    
                                    <tr>
                                        <td align="left" style="color: #888888; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 23px;" class="text_color">
                                            <div style="color: #333333; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
    
                                                Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: "Hind Siliguri", Calibri, Sans-serif; font-weight: 400;">admin@persibat.com</a>
    
                                            </div>
                                        </td>
                                    </tr>
    
                                </table>
    
                                <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                    </tr>
                                </table>
    
                                <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
                                    <tr>
                                        <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                    </tr>
    
    
    
                                    <tr>
                                        <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                    </tr>
    
                                    <tr>
                                        <td>
                                            <table border="0" align="right" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>
                                                        <a href="https://www.facebook.com/mdbootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <a href="https://twitter.com/MDBootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <a href="https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
    
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    
            <tr>
                <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
            </tr>
    
        </table>
        <!-- end section -->
    
        <!-- footer ====== -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">
    
            <tr>
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
    
            <tr>
                <td align="center">
    
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td>
                                <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
                                            <div style="line-height: 24px;">
    
                                                <span style="color: #333333;">PERSIBAT BATANG</span>
    
                                            </div>
                                        </td>
                                    </tr>
                                </table>
    
                                <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                    <tr>
                                        <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                    </tr>
                                </table>
    
                                <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
    
                                    
    
                                </table>
                            </td>
                        </tr>
    
                    </table>
                </td>
            </tr>
    
            <tr>
                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
    
        </table>
        <!-- end footer ====== -->
    
    </body>
    
    </html>';
           
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($p['email']);
            $this->email->from('functionwebdevelop@gmail.com','Official Team Electronic Ticketing Persibat');
            $this->email->subject('Konfirmasi Pembayaran Sukses');
            $this->email->message($htmlContent);
            $this->email->attach('');
            $this->email->send();
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Bukti berhasil di upload</p>
                                  </div>
                                </div>');
            redirect('konfirmasi');
        }
    }

    function order() {

        $this->crud->create('ms_penonton', $this->input->post());
        $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Data Berhasil di simpan</p>
                                  </div>
                                </div>');
        redirect('http://localhost' . $this->session->userdata('url_order'));
    }

}
