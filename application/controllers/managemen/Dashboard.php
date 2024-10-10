<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    function index(){
        $this->load->view('template/template', [
            'content' => $this->load->view('managemen/dashboard', [
                'master' => $this->crud->read('ms_match',['tanggal_match >=' => date('Y-m-d'),'status >=' => 'open']),
                'panpel' => $this->crud->read('ms_user',['hak_akses' => 'Panpel'])
            ], true)
        ]);
    }
}
