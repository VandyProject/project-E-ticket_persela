<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library("Pdf");
        $this->load->library('m_pdf');
        $this->load->library('zend');
    }

    var $column_order = array('waktu', null);
    var $column_search = array('waktu');
    var $order = array('waktu' => 'ASC');

    function index() {
        $this->baru();
        /* $this->load->view('template/template', [
            'content' => $this->load->view('admin/order/list', [], true)
        ]); */
    }

    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_penonton', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        $n = 0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['waktu'];
            $row[] = strtoupper($l['status']);
            $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';
            $row[] = klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub') . ' VS ' . klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub');
            $row[] = 'Tribun ' . tribun($l['id_tribun'], 'kelas_tribun') . ' @' . rupiah(tribun($l['id_tribun'], 'harga_tribun')) . ' x ' . $l['jumlah'] . ' Pcs = <b>' . rupiah(tribun($l['id_tribun'], 'harga_tribun') * $l['jumlah']) . '</b>';
            $row[] = $l['bank'] . ' (' . $l['norek'] . ' An. ' . $l['nama_norek'] . ')';
            $row[] = rupiah($l['nominal']);
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_penonton'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="' . $l['id_penonton'] . ' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_penonton')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_penonton')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    var $ncolumn_order = array('waktu', null);
    var $ncolumn_search = array('waktu');
    var $norder = array('waktu' => 'ASC');

    function baru() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/order/baru', [], true)
        ]);
    }

    var $pcolumn_order = array('waktu_upload', null);
    var $pcolumn_search = array('waktu_upload');
    var $porder = array('waktu_upload' => 'ASC');

    function pending() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/order/pending', [], true)
        ]);
    }

    function sukses() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/order/sukses', [], true)
        ]);
    }

    public function listfinddatabaru() {
        $this->load->helper('url');

        $list = $this->crud->getfind_data('ms_penonton', $this->ncolumn_order, $this->ncolumn_search, $this->norder, 'status', 'baru');
        $data = array();
        $no = $_POST['start'];
        $n = 0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = tanggal(substr($l['waktu'], 0, 10), true) . ' ' . substr($l['waktu'], 11, 8);
            $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';
            $row[] = klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub') . ' VS ' . klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub');
            $row[] = 'Tribun ' . tribun($l['id_tribun'], 'kelas_tribun') . ' @' . rupiah(tribun($l['id_tribun'], 'harga_tribun')) . ' x ' . $l['jumlah'] . ' Pcs = <b>' . rupiah(tribun($l['id_tribun'], 'harga_tribun') * $l['jumlah']) . '</b>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('status', 'baru')->from('ms_penonton')->count_all_results(),
            "recordsFiltered" => $this->db->where('status', 'baru')->get('ms_penonton')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function listfinddatapending() {
        $this->load->helper('url');

        $list = $this->crud->getfind_data('ms_penonton', $this->pcolumn_order, $this->pcolumn_search, $this->porder, 'status', 'pending');
        $data = array();
        $no = $_POST['start'];
        $n = 0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = tanggal(substr($l['waktu_upload'], 0, 10), true) . ' ' . substr($l['waktu_upload'], 11, 8);
            $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';
            $row[] = klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub') . ' VS ' . klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub');
            $row[] = 'Tribun ' . tribun($l['id_tribun'], 'kelas_tribun') . ' @' . rupiah(tribun($l['id_tribun'], 'harga_tribun')) . ' x ' . $l['jumlah'] . ' Pcs = <b>' . rupiah(tribun($l['id_tribun'], 'harga_tribun') * $l['jumlah']) . '</b>';
            $row[] = $l['bank'] . ' (' . $l['norek'] . ' An. ' . $l['nama_norek'] . ')';
            $row[] = rupiah($l['nominal']);
            $row[] = '<a class="text-success" href="javascript:void(0)" title="Bukti" onclick="bukti(' . "'" . $l['id_penonton'] . "'" . ')"><i class="icofont icofont-2x icofont-ui-v-card"></i></a>
            <a class="text-danger del" href="" rel="' . $l['id_penonton'] . ' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('status', 'pending')->from('ms_penonton')->count_all_results(),
            "recordsFiltered" => $this->db->where('status', 'pending')->get('ms_penonton')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function listfinddatasukses() {
        $this->load->helper('url');

        $list = $this->crud->getfind_data('ms_penonton', $this->ncolumn_order, $this->ncolumn_search, $this->order, 'status', 'sukses');
        $data = array();
        $no = $_POST['start'];
        $n = 0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['waktu_verifed'];
            $row[] = '<a class="text-primary text-center" target="_BLANK" href="'. site_url() .'tiket/'. $l['tiket'] .'" title="Print">Tiket</a>';
            $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';
            $row[] = klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub') . ' VS ' . klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub');
            $row[] = 'Tribun ' . tribun($l['id_tribun'], 'kelas_tribun') . ' @' . rupiah(tribun($l['id_tribun'], 'harga_tribun')) . ' x ' . $l['jumlah'] . ' Pcs = <b>' . rupiah(tribun($l['id_tribun'], 'harga_tribun') * $l['jumlah']) . '</b>';
            $row[] = $l['bank'] . ' (' . $l['norek'] . ' An. ' . $l['nama_norek'] . ')';
            $row[] = rupiah($l['nominal']);
            $row[] = '<a class="text-danger del" href="" rel="' . $l['id_penonton'] . ' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('status', 'sukses')->from('ms_penonton')->count_all_results(),
            "recordsFiltered" => $this->db->where('status', 'sukses')->get('ms_penonton')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function edit($id) {
        $data = $this->crud->read('ms_penonton', ['id_penonton' => $id])[0];
        echo json_encode($data);
    }

    function hapus($id) {
        $r = $this->crud->read('ms_penonton', ['id_penonton' => $id]);
        unlink('resi/' . $r[0]['resi']);
        $this->crud->delete('ms_penonton', ['id_penonton' => $id]);
        echo json_encode(array("status" => TRUE));
    }
    
    function hapusall($id) {
        $r = $this->crud->read('ms_penonton', ['id_penonton' => $id]);
        unlink('resi/' . $r[0]['resi']);
        unlink('booking/' . $r[0]['kode'].'.jpg');
        unlink('booking/' . $r[0]['kode'].'.png');
        unlink('tiket/' . $r[0]['tiket']);
        $this->crud->delete('ms_penonton', ['id_penonton' => $id]);
        echo json_encode(array("status" => TRUE));
    }

    function kirim() {
        $id = $this->input->post('id_penonton');
        include "application/libraries/phpqrcode/qrlib.php";
        $this->zend->load('Zend/Barcode');
        $barcode = $this->rand(25);
        $barcodeOptions = array('text' => $barcode);
        $rendererOptions = array();
        $imageResource = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->draw();
        $imageName = $barcode . '.jpg';
        $imagePath = 'booking/';
        imagejpeg($imageResource, $imagePath . $imageName);

        $namafile = $barcode . ".png";
        $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
        $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
        $padding = 0;
        $tempdir = "booking/";
        $logo = isset($_GET['logo']) ? $_GET['logo'] : 'logo.png';
        QRCode::png($barcode, $tempdir . $namafile, $quality, $ukuran, $padding);

        $QR = imagecreatefrompng($tempdir . $namafile);
        if ($logo !== FALSE) {
            $logopng = imagecreatefrompng($logo);
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logopng);
            $logo_height = imagesy($logopng);

            list($newwidth, $newheight) = getimagesize($logo);
            $out = imagecreatetruecolor($QR_width, $QR_width);
            imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
            imagecopyresampled($out, $logopng, $QR_width / 2.65, $QR_height / 2.65, 0, 0, $QR_width / 4, $QR_height / 4, $newwidth, $newheight);
        }
        imagepng($out, $tempdir . $namafile);
        imagedestroy($out);
        $spon = $this->crud->read('ms_sponsor');
        $gp ='';
        foreach($spon as $spn){
            $gp .='<td><img  src="logo/' . $spn["logo_sponsor"] . '" width="100"></td>';
        }
        $t = $this->crud->read('ms_penonton', ['id_penonton' => $id])[0];

        $tp = match(tribun($t['id_tribun'], 'id_match'), 'type');
        $type='';
        if($tp=='O'){
            $type ='Pintu Masuk';
        }else {
            $type ='Loket';
        }

        $nama = $t['nama'];
        $jumlahtiket = $t['jumlah'];
        $kategori = tribun($t['id_tribun'], 'kelas_tribun');
        $order = tanggal($t['tanggal'], true);
        $jam = $t['jam'];

        $harga = tribun($t['id_tribun'], 'harga_tribun');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Persibat');
        $pdf->SetTitle('ETICBAT');
        $pdf->SetSubject('Tiket Persibat');
        $pdf->SetKeywords('Tiket, Persibat, Batang');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFillColor(220, 255, 220);
        $pdf->SetFont('dejavusans', 'BI', 10);
        $pdf->AddPage();
        $html = '
		            <table border="1" bordercolor="#F1F1F1"  cellpadding="10";>
                                <tr>
    <td bgcolor="" colspan="3" align="center" ><h1>' . strtoupper(match(tribun($t['id_tribun'], 'id_match'), 'status_match')) . '</h1><h3>' . kompetisi(match(tribun($t['id_tribun'], 'id_match'), 'kompetisi_match'), 'nama_kompetisi') . ' ' . date('Y') . '</h3></td>
                                    <td align="center"><img src="logo/' . kompetisi(match(tribun($t['id_tribun'], 'id_match'), 'kompetisi_match'), 'logo_kompetisi') . '" alt="" width="70px"></td>
                                </tr>
                                <tr>
                                    <td align="center" ><img src="logo/' . klub(match(tribun($t['id_tribun'], 'id_match'), 'nama_tuan_match'), 'logo_klub') . '" alt="" width="70px"></td>
                                    <td align="center"  colspan="2"><h3>' . klub(match(tribun($t['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub') . '</h3><h1>VS</h1><h3>' . klub(match(tribun($t['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub') . '</h3></td>
                                    <td align="center"><img src="logo/' . klub(match(tribun($t['id_tribun'], 'id_match'), 'nama_tamu_match'), 'logo_klub') . '" alt="" width="70px"></td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="4">' . tanggal(match(tribun($t['id_tribun'], 'id_match'), 'tanggal_match'), true) . ' <br/>Kick Off ' . substr(match(tribun($t['id_tribun'], 'id_match'), 'pukul_match'),0,5) . ' WIB<br/>@ ' . match(tribun($t['id_tribun'], 'id_match'), 'stadion_match') . '<br/>' . $nama . ' - ' . $kategori . ' ('.$jumlahtiket.' Tiket)</td> 
                                </tr>
                                <tr>
                                    <td align="center"  colspan="3">Dikirim pada : <br>' . tanggal(date('Y-m-d'),TRUE) . '<br>' . date('H:i:s') . ' WIB</td>
                                    <td rowspan="2" align="center"><img src="booking/' . $barcode . '.png" width="100"></td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="3"><img src="booking/' . $barcode . '.jpg" width="500"></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                    Ketentuan Penggunaan :<br/>
                                    1. Simpan tiket Digital, jangan sampai orang lain tahu kode tiket Anda.<br/>
                                    2. Bawa tiket ini saat akan menonton pertandingan.<br/>
                                    3. Tiket boleh dicetak ataupun tidak.<br/>
                                    4. Lokasi Scan tiket di '.$type.'.
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><table><tr>'.$gp.'</tr></table>
                                    </td>
                                </tr>
                            </table>'
        ;
        $pdf->writeHTML($html, true, false, true, false, '');
        $filelocation = FCPATH . "/tiket";

        $filename = 'Tiket_' . $kategori . '_' . $barcode . '.pdf';
        $fileNL = $filelocation . "/" . $filename;

        $pdf->Output($fileNL, 'F');

        $data = array(
            'id_penonton' => $t['id_penonton'],
            'kode' => $barcode,
            'nama' => $t['nama'],
            'email' => $t['email'],
            'no_hp' => $t['no_hp'],
            'waktu' => $t['waktu'],
            'jumlah' => $t['jumlah'],
            'id_tribun' => $t['id_tribun'],
            'status' => 'sukses',
            'nama_norek' => $t['nama_norek'],
            'bank' => $t['bank'],
            'norek' => $t['norek'],
            'nominal' => $t['nominal'],
            'resi' => $t['resi'],
            'waktu_upload' => $t['waktu_upload'],
            'waktu_verifed' => date('Y-m-d H:i:s'),
            'tiket' => $filename,
            'admin' => $this->session->userdata('id_user')
        );
        $this->crud->update('ms_penonton', ['id_penonton' => $id], $data);
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
                    Ticket Persibat Batang
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

                                Eticbat <span style="color: red;">Sukses</span>

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

                                            Berikut kami lampirkan Ticket Pertandingan Persibat Batang.
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
                                        <a href="'.base_url().'tiket/'.$filename.'" style="color: #ffffff; text-decoration: none;">DOWNLOAD TICKET</a>
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
        $this->email->to($t['email']);
        $this->email->from('functionwebdevelop@gmail.com','Official Team Electronic Ticketing Persibat');
        $this->email->subject('Tikcet Electronic Persibat Batang');
        $this->email->message($htmlContent);
        $this->email->attach(base_url().'tiket/'.$filename);
        $this->email->send();
        echo json_encode(array("status" => TRUE));
    }

    function rand($lecngth) {
        $str = "";
        $char = array_merge(range('a', 'z'), range('0', '9'));
        $max = count($char) - 1;
        for ($i = 0; $i < $lecngth; $i++) {
            $rans = mt_rand(0, $max);
            $str .= $char[$rans];
        }
        return $str;
    }

}
