<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library("Pdf");
         $this->load->library('m_pdf');
         $this->load->library('zend');
    }
    var $column_order = array('tanggal_match','status_match','kompetisi_match','nama_tuan_match','skor_tuan_match','nama_tamu_match','stadion_match');
    var $column_search = array('tanggal_match','status_match','kompetisi_match','nama_tuan_match','skor_tuan_match','nama_tamu_match','stadion_match');
    var $order = array('tanggal_match' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/jadwal/list', [
                'kompetisi' => $this->crud->read('ms_kompetisi'),
                'klub' => $this->crud->read('ms_klub')
            ], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_match',$this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $k1 = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $l['kompetisi_match']])[0];
            $k2 = $this->crud->read('ms_klub', ['id_klub' => $l['nama_tuan_match']])[0];
            $k3 = $this->crud->read('ms_klub', ['id_klub' => $l['nama_tamu_match']])[0];
            $tgl = tanggal($l['tanggal_match'],TRUE);
            $clw = '';
            $clh = '';
            if($l['tanggal_match'] < date('Y-m-d')){
                $clw = 'text-danger';
            }else {
                $clw = '';
            }
            $no++;
            $row = array();
            $row[] = '<div class="'.$clw.'">'.$tgl.' '.substr($l['pukul_match'],0,5).' WIB</div>';
            $row[] = '<div class="'.$clw.'">'.$l['status_match'].'('.$l['type'].')</div>';
            $row[] = '<div class="'.$clw.'">'.$k1['nama_kompetisi'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$k2['nama_klub'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$l['skor_tuan_match']. ' - ' .$l['skor_tamu_match'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$k3['nama_klub'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$l['stadion_match'].'</div>';
            if($l['status']=='close'){
                if($l['tanggal_match'] < date('Y-m-d')){
                    $btnopen = '';
                }else {
                    $btnopen = '<a class="text-warning pen" href="" rel="'. $l['id_match'].' " title="Open Eticbat"><i class="icofont icofont-2x icofont-lock"></i></a>';
                }
            }else{
                if($l['tanggal_match'] < date('Y-m-d')){
                    $btnopen = '';
                }else {
                    $btnopen = '<a class="text-success kuot" href="javascript:void(0)" rel="'.  base_url().'admin/jadwal/tiket/'.$l['id_match'].'" title="Kuota dan Harga Tiket"><i class="icofont icofont-2x icofont-price"></i></a>';
                }
            }
            $btnedit = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_match'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>';
            $btnhapus = '<a class="text-danger del" href="" rel="'. $l['id_match'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            $row[] = $btnopen.$btnedit.$btnhapus;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_match')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_match')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function form() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/jadwal/form', [
                'kompetisi' => $this->crud->read('ms_kompetisi'),
                'klub' => $this->crud->read('ms_klub')
                    ], true)
        ]);
    }

    function save() {
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './banner/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'banner_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner_match']['name'] == '' || !$this->upload->do_upload('banner_match')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['banner_match'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'banner/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1920;
            $config['height'] = 800;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['slug'] = strtolower(str_replace('-', '_', $this->input->post('tanggal_match'))).'_'.strtolower(str_replace(' ', '_', klub($this->input->post('nama_tuan_match'),'nama_klub'))).'_vs_'.strtolower(str_replace(' ', '_', klub($this->input->post('nama_tamu_match'),'nama_klub')));
            $_POST['id_match'] = '';
            $_POST['status'] = 'close';
            $this->crud->create('ms_match', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
         $data = $this->crud->read('ms_match', ['id_match' => $id])[0];
         echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_match', ['id_match' => $this->input->post('id_match')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './banner/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'banner_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner_match']['name'] == '' || !$this->upload->do_upload('banner_match')) {
            echo $this->upload->display_errors();
        } else {
            unlink('banner/' . $r[0]['banner_match']);
            $_POST['banner_match'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'banner/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1920;
            $config['height'] = 800;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $_POST['slug'] = strtolower(str_replace('-', '_', $this->input->post('tanggal_match'))).'_'.strtolower(str_replace(' ', '_', klub($this->input->post('nama_tuan_match'),'nama_klub'))).'_vs_'.strtolower(str_replace(' ', '_', klub($this->input->post('nama_tamu_match'),'nama_klub')));
            $this->crud->update('ms_match', ['id_match' => $this->input->post('id_match')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_match', ['id_match' => $id]);
        unlink('banner/' . $r[0]['banner_match']);
        $this->crud->delete('ms_match', ['id_match' => $id]);
        $this->crud->delete('ms_tribun', ['id_match' => $id]);
        echo json_encode(array("status" => TRUE));
    }
    function tiket($id){
         
         if ($this->input->is_ajax_request()) {

            $dt['data'] = $this->crud->read('ms_tribun',['id_match' => $id]);
            $dt['pertandingan'] = $this->crud->read('ms_match',['id_match' => $id]);

            $this->load->view('admin/jadwal/form', $dt);
        }
    }
    function open($id){
        $barat = array(
            'id_tribun' => 'b'.time(),
            'kelas_tribun' => 'Barat',
            'harga_tribun' => 0,
            'kuota_tribun' => 0,
            'id_match' => $id,
            'created' => date('Y-m-d H:i:s')
        );
        $timur = array(
            'id_tribun' => 't'.time(),
            'kelas_tribun' => 'Timur',
            'harga_tribun' => 0,
            'kuota_tribun' => 0,
            'id_match' => $id,
            'created' => date('Y-m-d H:i:s')
        );
        $selatan = array(
            'id_tribun' => 's'.time(),
            'kelas_tribun' => 'Selatan',
            'harga_tribun' => 0,
            'kuota_tribun' => 0,
            'id_match' => $id,
            'created' => date('Y-m-d H:i:s')
        );
        $utara = array(
            'id_tribun' => 'u'.time(),
            'kelas_tribun' => 'Utara',
            'harga_tribun' => 0,
            'kuota_tribun' => 0,
            'id_match' => $id,
            'created' => date('Y-m-d H:i:s')
        );
        $this->crud->create('ms_tribun', $barat);
        $this->crud->create('ms_tribun', $timur);
        $this->crud->create('ms_tribun', $selatan);
        $this->crud->create('ms_tribun', $utara);
        $this->db->query("UPDATE `ms_match` SET `status` = 'open' WHERE `id_match` = '$id'");
        echo json_encode(array("status" => TRUE));
    }
    function uptribun(){
        $id = $this->input->post('id');
        $barat = $this->input->post('kelas_Barat');
        $timur = $this->input->post('kelas_Timur');
        $selatan = $this->input->post('kelas_Selatan');
        $utara = $this->input->post('kelas_Utara');
        $hbarat = $this->input->post('harga_Barat');
        $htimur = $this->input->post('harga_Timur');
        $hselatan = $this->input->post('harga_Selatan');
        $hutara = $this->input->post('harga_Utara');
        $this->db->query("UPDATE `ms_tribun` SET `harga_tribun` = '$hbarat',`kuota_tribun` = '$barat' WHERE `id_match` = '$id' and `kelas_tribun` = 'Barat'");
        $this->db->query("UPDATE `ms_tribun` SET `harga_tribun` = '$htimur',`kuota_tribun` = '$timur' WHERE `id_match` = '$id' and `kelas_tribun` = 'Timur'");
        $this->db->query("UPDATE `ms_tribun` SET `harga_tribun` = '$hselatan',`kuota_tribun` = '$selatan' WHERE `id_match` = '$id' and `kelas_tribun` = 'Selatan'");
        $this->db->query("UPDATE `ms_tribun` SET `harga_tribun` = '$hutara',`kuota_tribun` = '$utara' WHERE `id_match` = '$id' and `kelas_tribun` = 'Utara'");
        echo json_encode(array("status" => TRUE));
    }
    
    function generate($id){
        $r = $this->db->where([
                    'id_match' => $id
                ])->get('ms_ticket')->row_array();
        if (count($r) <= 0) {
        include "application/libraries/phpqrcode/qrlib.php";
        $r = $this->crud->read('ms_match', ['id_match' => $id])[0];
        $t = $this->crud->read('ms_tribun', ['id_match' => $r['id_match']]);
        foreach ($t as $tmp){
            for ($i=0; $i < $tmp['kuota_tribun']; $i++){
            
               $this->zend->load('Zend/Barcode');
            $barcode = $this->rand(8);
            $barcodeOptions = array('text' => $barcode);
            $rendererOptions = array();
            $imageResource = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->draw();
            $imageName = $barcode.'.jpg';
            $imagePath = 'barcode/';
            imagejpeg($imageResource,$imagePath.$imageName);

		$namafile = $barcode.".png";
//		$file_tiket=$id.".pdf";
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
        $tempdir = "barcode/"; 
        $logo = isset($_GET['logo']) ? $_GET['logo'] : 'logo.png';
        QRCode::png($barcode,$tempdir.$namafile,$quality,$ukuran,$padding);

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
        

            $data = array(
                'id_tiket' => $barcode,
                'id_match' => $r['id_match'],
                'id_tribun' => $tmp['id_tribun'],
                'status' => 'notused'
            );
            $this->crud->create('ms_ticket', $data);
            }
        }
        $sumber = $this->load->view('tiket',[
                    'master' => $this->db->where('id_match',$r['id_match'])->order_by('id_tribun','ASC')->get('ms_ticket')->result_array()
                ],TRUE);
        $html = $sumber;
        $pdfFilePath = 'Tiket_'.time().'.pdf';
        $pdf = $this->m_pdf->load();
//        $pdf = new mPDF('utf-8',[310,470]); 
        $pdf = new mPDF('utf-8','A4','','',0,0,10,10,6,3);
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "D");
        exit();
        }else {
            $sumber = $this->load->view('tiket',[
                'master' => $this->db->where('id_match',$r['id_match'])->order_by('id_tribun','ASC')->get('ms_ticket')->result_array()
            ],TRUE);
    $html = $sumber;
    $pdfFilePath = 'Tiket_'.time().'.pdf';
    $pdf = $this->m_pdf->load();
//        $pdf = new mPDF('utf-8',[310,470]); 
    $pdf = new mPDF('utf-8','A4','','',0,0,10,10,6,3);
    $pdf->AddPage('P');
    $pdf->WriteHTML($html);
    $pdf->Output($pdfFilePath, "D");
    exit();
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
