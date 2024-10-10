<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Ticket extends CI_Controller{
    
    function detail(){
        $this->load->view('home',[
            'jadwal' => $this->crud->read('ms_match',['tanggal_match >=' => date('Y-m-d')])
        ]);
    }
}
