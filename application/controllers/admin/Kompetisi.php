<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi extends CI_Controller {
    
    var $column_order = array('nama_kompetisi', null);
    var $column_search = array('nama_kompetisi');
    var $order = array('nama_kompetisi' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/kompetisi/list', [
                'data' => $this->crud->read('ms_kompetisi')
                    ], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_kompetisi', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['nama_kompetisi'];
            $row[] = '<img class="img-fluid" src="'. base_url() .'logo/'. $l['logo_kompetisi'] .'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_kompetisi'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id_kompetisi'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_kompetisi')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_kompetisi')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function form() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/kompetisi/form', '', true)
        ]);
    }

    function save() {
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logomatch_' . $this->input->post('nama_kompetisi') . time();

        $this->upload->initialize($brt);
        if ($_FILES['logo_kompetisi']['name'] == '' || !$this->upload->do_upload('logo_kompetisi')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['logo_kompetisi'] = $this->upload->data('file_name');
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
            $_POST['id_kompetisi'] = '';
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->create('ms_kompetisi', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $this->input->post('id_kompetisi')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logomatch_' . $this->input->post('nama_kompetisi'). time();

        $this->upload->initialize($brt);
        if ($_FILES['logo_kompetisi']['name'] == '' || !$this->upload->do_upload('logo_kompetisi')) {
            echo $this->upload->display_errors();
        } else {
            unlink('logo/' . $r[0]['logo_kompetisi']);
            $_POST['logo_kompetisi'] = $this->upload->data('file_name');
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
            $this->crud->update('ms_kompetisi', ['id_kompetisi' => $this->input->post('id_kompetisi')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $id]);
        unlink('logo/' . $r[0]['logo_kompetisi']);
        $this->crud->delete('ms_kompetisi', ['id_kompetisi' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
