<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembatalan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('waktu', null);
    var $column_search = array('waktu');
    var $order = array('waktu' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/pembatalan/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');
        
        $list = $this->crud->getfind_data('ms_penonton', $this->column_order, $this->column_search, $this->order, 'status', 'cancel');
        $data = array();
        $no = $_POST['start'];
        $n=0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = tanggal(substr($l['waktu'],0,10),true).' '.substr($l['waktu'],11,8);
            $row[] = $l['nama'].' ('.$l['email'].' - '.$l['no_hp'].')';
            $row[] = klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tuan_match'), 'nama_klub').' VS '. klub(match(tribun($l['id_tribun'], 'id_match'), 'nama_tamu_match'), 'nama_klub');
            $row[] = 'Tribun ' .tribun($l['id_tribun'], 'kelas_tribun').' @'.rupiah(tribun($l['id_tribun'], 'harga_tribun')).' x '.$l['jumlah'].' Pcs = <b>'.rupiah(tribun($l['id_tribun'], 'harga_tribun') * $l['jumlah']).'</b>';
            $row[] = '<a class="text-success" href="javascript:void(0)" title="Bukti" onclick="bukti(' . "'" . $l['id_penonton'] . "'" . ')"><i class="icofont icofont-2x icofont-ui-v-card"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('status', 'cancel')->from('ms_penonton')->count_all_results(),
            "recordsFiltered" => $this->db->where('status', 'cancel')->get('ms_penonton')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    function edit($id) {
        $data = $this->crud->read('ms_penonton', ['id_penonton' => $id])[0];
        echo json_encode($data);
    }
    
    function kirim(){
        $id = $this->input->post('id_penonton');
        $t = $this->crud->read('ms_penonton', ['id_penonton' => $id])[0];
        $data = array(
            'id_penonton' => $t['id_penonton'],
            'kode' => $t['kode'],
            'nama' => $t['nama'],
            'email' => $t['email'],
            'no_hp' => $t['no_hp'],
            'waktu' => $t['waktu'],
            'jumlah' => $t['jumlah'],
            'id_tribun' => $t['id_tribun'],
            'status' => 'delete',
            'nama_norek' => $t['nama_norek'],
            'bank' => $t['bank'],
            'norek' => $t['norek'],
            'nominal' => $t['nominal'],
            'resi' => $t['jumlah'],
            'batas_upload' => date('Y-m-d H:i:s', time()+(60*60*6));,
            'waktu_upload' => $t['waktu_upload'],
            'waktu_verifed' => date('Y-m-d H:i:s'),
            'tiket' => $t['tiket'],
            'admin' => ''
        );
        $this->crud->update('ms_penonton', ['id_penonton' => $id], $data);
        echo json_encode(array("status" => TRUE));
        
    }



}
