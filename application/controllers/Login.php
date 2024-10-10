<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function index() {
		updata();
        if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Admin') {
            redirect('admin/dashboard');
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Managemen') {
            redirect('managemen/dashboard');
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Panpel') {
            redirect('panpel/dashboard');
        }
        $this->load->view('login');
    }

    function validasi() {
        $r = $this->db->where([
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password'))
                ])->get('ms_user')->row_array();
        if (count($r) <= 0) {
            $this->session->set_flashdata('message', '<script type="text/javascript">
        
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast("<span>Username Tidak Tidak Terdaftar</span>", 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast("<span>Ulangi lagi</span>", 3000);
        }, 5500);
    });
    
    </script>');
            redirect('login');
        } else {
            $this->session->set_userdata('id_user', $r['id_user']);
            $this->session->set_userdata('username', $r['username']);
            $this->session->set_userdata('nama', $r['nama_user']);
            $this->session->set_userdata('tgl', $r['tgl_lahir']);
            $this->session->set_userdata('jk', $r['jenis_kelamin']);
            $this->session->set_userdata('alamat', $r['alamat']);
            $this->session->set_userdata('no_hp', $r['no_hp']);
            $this->session->set_userdata('email', $r['email']);
            $this->session->set_userdata('foto', $r['foto']);
            $this->session->set_userdata('akses', $r['hak_akses']);
            $akses = $r['hak_akses'];
            if ($akses == 'Admin') {
                redirect('admin/dashboard');
            } else if ($akses == 'Managemen') {
                redirect('managemen/dashboard');
            } else if ($akses == 'Panpel') {
                redirect('panpel/dashboard');
            } else {
                redirect('login');
            }
        }
    }

    function logout() {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('tgl');
        $this->session->unset_userdata('jk');
        $this->session->unset_userdata('alamat');
        $this->session->unset_userdata('no_hp');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('akses');
        redirect('login');
    }

    function profil($id) {

        if ($this->input->is_ajax_request()) {

            $dt['adm'] = $this->crud->read('ms_user', ['id_user' => $id]);

            $this->load->view('template/profile', $dt);
        }
    }

    function setpassword($id) {

        if ($this->input->is_ajax_request()) {

            $dt['adm'] = $this->crud->read('ms_user', ['id_user' => $id]);

            $this->load->view('template/password', $dt);
        }
    }
    function uppassword(){
        $this->_validate($this->input->post('id_user'));
        $p = md5($this->input->post('baru'));
        $idu = $this->input->post('id_user');
        $this->db->query("UPDATE `ms_user` SET `password` = '$p' WHERE `id_user` = '$idu'");
        echo json_encode(array("status" => TRUE));
    }
    function _validate($id) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $r = $this->db->where([
            'id_user' => $id
        ])->get('ms_user')->row_array();

        if ($this->input->post('lama') == '') {
            $data['inputerror'][] = 'lama';
            $data['error_string'][] = 'Password Lama wajib diisi';
            $data['status'] = FALSE;
        }

        if (md5($this->input->post('lama')) != $r['password']) {
            $data['inputerror'][] = 'lama';
            $data['error_string'][] = 'Password Lama salah';
            $data['status'] = FALSE;
        }

        if ($this->input->post('baru') == '') {
            $data['inputerror'][] = 'baru';
            $data['error_string'][] = 'Password Baru wajib diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('konfirmasi') == '') {
            $data['inputerror'][] = 'konfirmasi';
            $data['error_string'][] = 'Konfirmasi wajib diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('konfirmasi') != $this->input->post('baru')) {
            $data['inputerror'][] = 'konfirmasi';
            $data['error_string'][] = 'Konfirmasi Password Salah';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_user', ['id_user' => $this->input->post('id_user')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './foto/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'profile_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['foto']['name'] == '' || !$this->upload->do_upload('foto')) {
            echo $this->upload->display_errors();
        } else {
            unlink('foto/' . $r[0]['foto']);
            $_POST['foto'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'foto/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 100;
            $config['height'] = 100;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $this->session->unset_userdata('id_user');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('jk');
            $this->session->unset_userdata('alamat');
            $this->session->unset_userdata('no_hp');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('foto');
            $this->session->unset_userdata('akses');
            $this->crud->update('ms_user', ['id_user' => $this->input->post('id_user')], $this->input->post());
            $r = $this->db->where([
                        'id_user' => $this->input->post('id_user')
                    ])->get('ms_user')->row_array();
            $this->session->set_userdata('id_user', $r['id_user']);
            $this->session->set_userdata('username', $r['username']);
            $this->session->set_userdata('nama', $r['nama_user']);
            $this->session->set_userdata('tgl', $r['tgl_lahir']);
            $this->session->set_userdata('jk', $r['jenis_kelamin']);
            $this->session->set_userdata('alamat', $r['alamat']);
            $this->session->set_userdata('no_hp', $r['no_hp']);
            $this->session->set_userdata('email', $r['email']);
            $this->session->set_userdata('foto', $r['foto']);
            $this->session->set_userdata('akses', $r['hak_akses']);
            echo json_encode(array("status" => TRUE));
        }
    }

    function lupapassword() {
        if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Admin') {
            redirect('admin/dashboard');
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Managemen') {
            redirect('managemen/dashboard');
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Panpel') {
            redirect('panpel/dashboard');
        }
        $this->load->view('lupapassword');
    }

    function kirimreset() {
        $r = $this->db->where([
                    'email' => $this->input->post('email')
                ])->get('ms_user')->row_array();
        if (count($r) <= 0) {
            $this->session->set_flashdata('message', '<script type="text/javascript">
        
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast("<span>Email Tidak Terdaftar</span>", 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast("<span>Ulangi lagi</span>", 3000);
        }, 5500);
    });
    
    </script>');
            redirect('login/lupapassword');
        }else{
            $pass = date('YmdHis', time()+(60*5)).$this->uuid->v4();
            $_POST['password'] = $pass;
            $this->crud->update('ms_user', ['email' => $this->input->post('email')], $this->input->post());
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
                    Reset Akun E-Ticbat
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

                                Eticbat <span style="color: red;">Reset Password</span>

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

                                            Anda yakin ingin Reset Password? jika yakin silahkan klik tombol dibawah.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="red" style="">

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="center" style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 26px;">


                                        <div style="line-height: 26px;">
                                            <a href="'.site_url().'login/reset/'.$pass.'" style="color: #ffffff; text-decoration: none;">RESET</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
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

                                            <span style="color: #333333;">Material Design for Bootstrap</span>

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

                                <tr>
                                    <td align="center">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <a style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;" href="{{UnsubscribeURL}}">UNSUBSCRIBE</a>
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
        $this->email->subject('Reset Password');
        $this->email->message($htmlContent);
        $this->email->attach('');
        $this->email->send();
        
        $this->session->set_flashdata('msg', '<script type="text/javascript">
        
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast("<span>Berhasil</span>", 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast("<span>Silahkan Cek Email</span>", 3000);
        }, 5500);
    });
    
    </script>');
            $this->load->view('kirimsukses');
    }
    }
    
    
    function reset($link=''){
        $r = $this->db->where([
                    'password' => $link
                ])->get('ms_user')->row_array();
        if (count($r) <= 0) {
            $this->load->view('notfound/reset');
        }else{
            if(substr($r['password'], 0,14).' '.date('YmdHis') >= date('YmdHis')){
                $this->load->view('reset');
            }else{
                $this->session->set_flashdata('message', '<script type="text/javascript">
        
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast("<span>Waktu Reset Password Habis</span>", 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast("<span>Silahkan Ulangi</span>", 3000);
        }, 5500);
    });
    
    </script>');
            redirect('login/lupapassword');
            }
        }
    }
    
    function resetvalidasi(){
        if($this->input->post('p1') == $this->input->post('p2')){
             $r = $this->db->where([
                    'password' => $this->input->post('link')
                ])->get('ms_user')->row_array();
             $id = $r['id_user'];
            $pass = md5($this->input->post('p1'));
            $this->db->query("UPDATE `ms_user` SET `password` = '$pass' WHERE `id_user` = '$id'");
            $this->load->view('ubahsukses');
        }else {
            $this->session->set_flashdata('message', '<script type="text/javascript">
        
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast("<span>Konfirmasi Password Tidak Cocok</span>", 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast("<span>Silahkan Ulangi</span>", 3000);
        }, 5500);
    });
    
    </script>');
           redirect('login/reset/'.$this->input->post('link')); 
        }
    }

}
