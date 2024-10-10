<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('username');
    var $column_search = array('username');
    var $order = array('username' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/user/list', [
            ], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');
        
        $list = $this->crud->getfind_data('ms_user', $this->column_order, $this->column_search, $this->order, 'hak_akses', 'Panpel');
        $data = array();
        $no = $_POST['start'];
        $n=0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['username'];
            $row[] = $l['nama_user'].' ('.$l['jenis_kelamin'].')';
            $row[] = $l['email'];
            $row[] = $l['no_hp'];
            $row[] = $l['tgl_lahir'];
            $row[] = $l['alamat'];
            $row[] = '<img class="img-fluid" src="'. base_url() .'foto/'. $l['foto'] .'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_user'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id_user'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('hak_akses', 'Panpel')->from('ms_user')->count_all_results(),
            "recordsFiltered" => $this->db->where('hak_akses', 'Panpel')->get('ms_user')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function save() {
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './foto/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'profile_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['foto']['name'] == '' || !$this->upload->do_upload('foto')) {
            echo $this->upload->display_errors();
        } else {
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
            $_POST['id_user'] = '';
            $_POST['password'] = md5(substr($this->input->post('tgl_lahir'),8,2).substr($this->input->post('tgl_lahir'),5,2).substr($this->input->post('tgl_lahir'),0,4));
            $_POST['hak_akses'] = 'Panpel';
            $this->crud->create('ms_user', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
         $data = $this->crud->read('ms_user', ['id_user' => $id])[0];
         echo json_encode($data);
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
            $this->crud->update('ms_user', ['id_user' => $this->input->post('id_user')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_user', ['id_user' => $id]);
        unlink('foto/' . $r[0]['foto']);
        $this->crud->delete('ms_user', ['id_user' => $id]);
        echo json_encode(array("status" => TRUE));
    }
    
}
