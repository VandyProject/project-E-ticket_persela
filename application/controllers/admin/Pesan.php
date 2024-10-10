<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('waktu', null);
    var $column_search = array('waktu');
    var $order = array('status' => 'DESC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/pesan/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_pesan', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = waktu_lalu($l['waktu']);
            $row[] = $l['nama'].' | '.$l['email'];
            if($l['status']=='new'){
               $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_pesan'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>'; 
            }else{
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_pesan'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id_pesan'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_pesan')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_pesan')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    

    function edit($id) {
        $r = $this->crud->read('ms_pesan', ['id_pesan' => $id])[0];
        $up = array(
            'id_pesan' => $id,
            'waktu' => $r['waktu'],
            'nama' => $r['nama'],
            'email' => $r['email'],
            'pesan' => $r['pesan'],
            'status' => 'done'
        );
        $this->crud->update('ms_pesan', ['id_pesan' => $id], $up);
        $data = $this->crud->read('ms_pesan', ['id_pesan' => $id])[0];
        echo json_encode($data);
    }

    

    function hapus($id) {
        $this->crud->delete('ms_pesan', ['id_pesan' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
