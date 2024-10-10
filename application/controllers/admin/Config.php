<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Config extends CI_Controller{
     function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    var $column_order = array('id_config', null);
    var $column_search = array('id_config');
    var $order = array('id_config' => 'ASC');
    
    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/config/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_config', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['banner_barat'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['tiket_barat'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['banner_timur'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['tiket_timur'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['banner_selatan'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['tiket_selatan'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['banner_utara'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'config/'. $l['tiket_utara'] .'" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_config')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_config')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function edit() {
        $data = $this->crud->read('ms_config', ['id_config' => 1])[0];
         echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_config', ['id_config' => 1]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $this->banner('banner_barat', $r[0]['banner_barat']);
        $this->banner('banner_timur', $r[0]['banner_timur']);
        $this->banner('banner_selatan', $r[0]['banner_selatan']);
        $this->banner('banner_utara', $r[0]['banner_utara']);
        
        $this->tiket('tiket_barat', $r[0]['tiket_barat']);
        $this->tiket('tiket_timur', $r[0]['tiket_timur']);
        $this->tiket('tiket_selatan', $r[0]['tiket_selatan']);
        $this->tiket('tiket_utara', $r[0]['tiket_utara']);

        if ($error == 0) {
            $this->crud->update('ms_config', ['id_config' => $this->input->post('id_config')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }
    
    function banner($banner,$file){
        $brt['upload_path'] = './config/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = $banner. time();

        $this->upload->initialize($brt);
        if ($_FILES[$banner]['name'] == '' || !$this->upload->do_upload($banner)) {
            echo $this->upload->display_errors();
        } else {
            unlink('config/' . $file);
            $_POST[$banner] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'config/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 370;
            $config['height'] = 280;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
    }
    function tiket($banner,$file){
        $brt['upload_path'] = './config/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = $banner.time();

        $this->upload->initialize($brt);
        if ($_FILES[$banner]['name'] == '' || !$this->upload->do_upload($banner)) {
            echo $this->upload->display_errors();
        } else {
            unlink('config/' . $file);
            $_POST[$banner] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'config/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 823;
            $config['height'] = 81;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
    }

    
}
