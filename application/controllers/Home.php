<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
    
    function index(){
        $this->load->view('home',[
            'jadwal' => $this->crud->read('ms_match',['tanggal_match >=' => date('Y-m-d')],'tanggal_match ASC'),
            'open' => $this->crud->read('ms_match',['tanggal_match >=' => date('Y-m-d'), 'status' => 'open'],'tanggal_match ASC'),
            'tribun' => $this->db->select('*')->from('ms_tribun')->join('ms_match', 'ms_match.id_match = ms_tribun.id_match')->get()->result_array(),
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }
    function kirimpesan(){
        $_POST['waktu'] = date('Y-m-d H:i:s');
        $_POST['status'] = 'new';
        $this->crud->create('ms_pesan', $this->input->post());
        redirect(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") .'://'. $_SERVER['HTTP_HOST'] . $this->session->userdata('url_psn'));
    }

    function notfound(){
        $this->load->view('notfound/umum');
    }
    
    
}