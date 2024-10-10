<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends CI_Controller {

    function index() {
        $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0];
        if ($this->session->userdata('username') != '' && $this->session->userdata('akses') == 'Panpel' && $j['tanggal_match'] == date('Y-m-d')) {
            $this->load->view('panpel/scan/loket');
        }else {
        redirect('login');
        }
    }
    
    function cek(){
        $cek = $this->db->where([
                    'kode' => $this->input->post('id')
                ])->get('ms_penonton')->row_array();
        $kode = $cek['kode'];
        $panpel = $this->session->userdata('id_user');
        $t = $this->db->where([
                    'id_tribun' => $cek['id_tribun']
                ])->get('ms_tribun')->row_array();
        if (count($cek) <= 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong><h1>Mohon maaf, :(</h1></strong><br/>Data yang ada masukan tidak ditemukan<br/><h2></h2></p>
                                  </div>
                                </div>');
            redirect('panpel/loket'); 
        }
        else{
            if($cek['status']=='sukses'){
                $this->db->query("UPDATE `ms_penonton` SET `status` = 'done', `panpel` = '$panpel'  WHERE `kode` = '$kode'");
                $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong><h1>Terima Kasih, :) '.$t['kelas_tribun'].'</h1></strong><br/>Selamat menikmati pertandingan<br/><h2></h2></p>
                                  </div>
                                </div>');
            redirect('panpel/loket'); 
            }else if($cek['status']=='done'){
                $this->session->set_flashdata('message', '<div class="alert alert-info col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong><h1>Terpakai</h1></strong><br/>kode hanya berlaku satu kali.<br/><h2></h2></p>
                                  </div>
                                </div>');
            redirect('panpel/loket'); 
            }
        }
    }
     
}
