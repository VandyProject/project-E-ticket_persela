<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Result extends CI_Controller{
    
    function index(){
        $this->load->view('result',[
            'jadwal' => $this->crud->read('ms_match',['tanggal_match <' => date('Y-m-d')],'tanggal_match DESC'),
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }
}