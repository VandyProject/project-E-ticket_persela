<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Klub extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('nama_klub', null);
    var $column_search = array('nama_klub');
    var $order = array('nama_klub' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/klub/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_klub', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['nama_klub'];
            $row[] = '<img class="img-fluid" src="'. base_url() .'logo/'. $l['logo_klub'] .'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_klub'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id_klub'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_klub')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_klub')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function form() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/klub/form', '', true)
        ]);
    }

    function save() {
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logo_' . $this->input->post('nama_klub') . time();

        $this->upload->initialize($brt);
        if ($_FILES['logo_klub']['name'] == '' || !$this->upload->do_upload('logo_klub')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['logo_klub'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'logo/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 200;
            $config['height'] = 214;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['id_klub'] = '';
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->create('ms_klub', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_klub', ['id_klub' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_klub', ['id_klub' => $this->input->post('id_klub')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logo_' . $this->input->post('nama_klub'). time();

        $this->upload->initialize($brt);
        if ($_FILES['logo_klub']['name'] == '' || !$this->upload->do_upload('logo_klub')) {
            echo $this->upload->display_errors();
        } else {
            unlink('logo/' . $r[0]['logo_klub']);
            $_POST['logo_klub'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'logo/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 200;
            $config['height'] = 214;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $this->crud->update('ms_klub', ['id_klub' => $this->input->post('id_klub')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_klub', ['id_klub' => $id]);
        unlink('logo/' . $r[0]['logo_klub']);
        $this->crud->delete('ms_klub', ['id_klub' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
