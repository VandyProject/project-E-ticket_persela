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
            'content' => $this->load->view('managemen/jadwal/list', [
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
            if($l['tanggal_match'] > date('Y-m-d')){
                $clw = 'text-danger';
                $clh = '';
            }else {
                $clw = '';
                $clh = '<a class="text-primary" href="'.site_url().'managemen/jadwal/cetak/'.$l['id_match'].'" title="Cetak" ><i class="icofont icofont-2x icofont-printer"></i></a>';
            }
            $no++;
            $row = array();
            $row[] = '<div class="'.$clw.'">'.$tgl.' '.$l['pukul_match'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$l['status_match'].'('.$l['type'].')</div>';
            $row[] = '<div class="'.$clw.'">'.$k1['nama_kompetisi'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$k2['nama_klub'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$l['skor_tuan_match']. ' - ' .$l['skor_tamu_match'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$k3['nama_klub'].'</div>';
            $row[] = '<div class="'.$clw.'">'.$l['stadion_match'].'</div>';
            $row[] = $clh;

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

    function cetak($id){
        $sumber = $this->load->view('managemen/laporan/list',[
            'master' => $this->crud->read('ms_match',['id_match' => $id])[0]
        ],True);
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
