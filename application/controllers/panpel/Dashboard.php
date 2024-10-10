<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    function index(){
        $this->load->view('template/template', [
            'content' => $this->load->view('panpel/dashboard', '', true)
        ]);
    }
}
