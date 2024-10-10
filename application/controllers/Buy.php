<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller {

    

    function ticket($slug, $tribun=null) {
        $this->db->where('slug', $slug);
        $tmp = $this->db->get('ms_match')->row_array();
        if (count($tmp) <= 0) {
            $this->load->view('notfound/umum');
        } else {
            $id_match = $tmp['id_match'];
            $this->db->where('id_match', $id_match);
            $this->db->where('kelas_tribun', $tribun);
            $stm = $this->db->get('ms_tribun')->row_array();
            if (count($stm) <= 0) {
                $this->load->view('notfound/umum');
            } else {
                $this->load->view('order', [
                    'data' => $this->crud->read('ms_tribun', ['id_match' => $id_match, 'kelas_tribun' => $tribun])[0],
                    'match' => $this->crud->read('ms_match', ['id_match' => $id_match])[0],
                    'sponsor' => $this->crud->read('ms_sponsor')
                ]);
            }
        }
    }

    function idklub($nama) {
        $this->db->where('nama_klub', $nama);
        $data = $this->db->get('ms_klub')->row();
        if(count($data)<=0){
            return '';
        }else{
            return $data->id_klub;
        }
        
    }
    function order(){
        $r = $this->db->where([
            'email' => $this->input->post('email'),
            'id_tribun' => $this->input->post('id_tribun')
        ])->get('ms_penonton')->row_array();
        if (count($r) > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-times fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Maaf!</strong> Email sudah terdaftar. Untuk mencegah peredaran calo maka pembelian tiket kami batasi </p>
                                  </div>
                                </div>');
            redirect(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") .'://'. $_SERVER['HTTP_HOST'] . $this->session->userdata('url_order'));
        }else{
        $bts = date('Y-m-d H:i:s', time()+(60*60*6));
        $kd = $this->rand(6);
        $wkt = date('Y-m-d H:i:s');
        $data = array(
            'id_penonton' => '',
            'kode' => $kd,
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'waktu' => $wkt,
            'jumlah' => $this->input->post('jumlah'),
            'id_tribun' => $this->input->post('id_tribun'),
            'status' => 'baru',
            'nama_norek' => '',
            'bank' => '',
            'norek' => '',
            'nominal' => '',
            'resi' => '',
            'batas_upload' => $bts,
            'waktu_upload' => '',
            'waktu_verifed' => '',
            'tiket' => '',
            'admin' => '',
            'panpel' =>''
        );
        $this->crud->create('ms_penonton', $data);
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
                    Pendaftaran
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

                                Eticbat <span style="color: red;">Pendaftaran</span>

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

                                        <table>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>'.$this->input->post('nama').'</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>'.$this->input->post('email').'</td>
                                            </tr>
                                            <tr>
                                                <td>No. HP</td>
                                                <td>:</td>
                                                <td>'.$this->input->post('no_hp').'</td>
                                            </tr>
                                            <tr>
                                                <td>Pertandingan</td>
                                                <td>:</td>
                                                <td>'.klub(match(tribun($this->input->post('id_tribun'),'id_match'),'nama_tuan_match'),'nama_klub').' VS '.klub(match(tribun($this->input->post('id_tribun'),'id_match'),'nama_tamu_match'),'nama_klub').'</td>
                                            </tr>
                                            <tr>
                                                <td>Tribun</td>
                                                <td>:</td>
                                                <td>'.tribun($this->input->post('id_tribun'),'kelas_tribun').'</td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>'.rupiah(tribun($this->input->post('id_tribun'),'harga_tribun')).'</td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Beli</td>
                                                <td>:</td>
                                                <td>'.$this->input->post('jumlah').'</td>
                                            </tr>
                                            <tr>
                                                <td>Total Pembayar</td>
                                                <td>:</td>
                                                <td>'.rupiah($this->input->post('jumlah')*tribun($this->input->post('id_tribun'),'harga_tribun')).'</td>
                                            </tr>
                                            <tr>
                                                <td>Pemesanan</td>
                                                <td>:</td>
                                                <td>'.tanggal(substr($wkt,0,10),True).'WIB</td>
                                            </tr>
                                            <tr>
                                                <td>Batas Konfirmasi</td>
                                                <td>:</td>
                                                <td>'.tanggal(substr($bts,0,10),True).' '.substr($bts,11,8).'WIB</td>
                                            </tr>
                                            <tr>
                                                <td>Kode Keamanan</td>
                                                <td>:</td>
                                                <td>'.$kd.'</td>
                                            </tr>
                                        </table>    

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
        $this->email->to($this->input->post('email'));
        $this->email->from('functionwebdevelop@gmail.com','Official Team Electronic Ticketing Persibat');
        $this->email->subject('Pendaftaran Eticbat');
        $this->email->message($htmlContent);
        $this->email->attach('');
        $this->email->send();
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Silahkan konfirmasi pembayaran, cek Email Anda untuk Kode Keamanan. Batas Konfirmasi '. $bts.'</p>
                                  </div>
                                </div>');
            redirect('konfirmasi');
    }
    }
    function rand($lecngth){
            $str = "";
            $char = array_merge(range('a', 'z'), range('0', '9'));
            $max = count($char)-1;
            for ($i=0; $i < $lecngth; $i++){
                $rans = mt_rand(0, $max);
                $str .= $char[$rans];
            }
            return $str;
        }

}
