<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembatalan extends CI_Controller {

    function index() {
        $this->load->view('pembatalan', [
            'pertandingan' => $this->crud->read('ms_match',['tanggal_match >=' => date('Y-m-d'), 'status' => 'Open'],'tanggal_match ASC'),
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }

    function cek() {
        $r = $this->db->where([
                    'id_match' => $this->input->post('pertandingan'),
                    'kelas_tribun' => $this->input->post('tribun')
                ])->get('ms_tribun')->row_array();
        if (count($r) <= 0) {
            $this->session->set_userdata('id_penonton', '');
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Gagal!</strong> Data tidak ditemukan</p>
                                  </div>
                                </div>');
            redirect('pembatalan');
        } else {
            $t = $this->db->where([
                    'id_tribun' => $r['id_tribun'],
                    'email' => $this->input->post('email')
                ])->where("(status='pending' OR status='sukses')")->get('ms_penonton')->row_array();
            if (count($t) <= 0) {
            $this->session->set_userdata('id_penonton', '');
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Gagal!</strong> Data tidak ditemukan</p>
                                  </div>
                                </div>');
            redirect('pembatalan');
            }else{
                $this->session->set_userdata('id_penonton', $t['id_penonton']);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Silahkan Lanjutkan Prosedur Pembatalan</p>
                                  </div>
                                </div>');
            redirect('pembatalan/konfirmasi');
            }
        }
    }

    function konfirmasi() {
        $this->load->view('pembatalan_konfrim', [
            'sponsor' => $this->crud->read('ms_sponsor')
        ]);
    }

    function proses() {
        $error = 0;
        $tmp_id = $this->session->userdata('id_penonton');
        $p = $this->db->where([
                'id_penonton' => $tmp_id,
            ])->get('ms_penonton')->row_array();
        
        $data = array(
            'id_penonton' => $p['id_penonton'],
            'kode' => $p['kode'],
            'nama' => $p['nama'],
            'email' => $p['email'],
            'no_hp' => $p['no_hp'],
            'waktu' => $p['waktu'],
            'jumlah' => $p['jumlah'],
            'id_tribun' => $p['id_tribun'],
            'status' => 'cancel',
            'nama_norek' => $p['nama_norek'],
            'bank' => $p['bank'],
            'norek' => $p['norek'],
            'nominal' => $p['nominal'],
            'resi' => $p['resi'],
            'waktu_upload' => $p['waktu_upload'],
            'waktu_verifed' => $p['waktu_verifed'],
            'tiket' => $p['tiket'],
            'admin' => ''
        );

        if ($error == 0) {
            $this->crud->update('ms_penonton', ['id_penonton' => $p['id_penonton']], $data);
            $this->session->unset_userdata('id_penonton');
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                  <span class="fa fa-check fa-2x"></span></div>
                                  <div class="col-md-10 col-sm-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p><strong>Berhasil!</strong> Pengajuan Pembatalan Berhasil</p>
                                  </div>
                                </div>');
            redirect('pembatalan');
        }
    }

    

}
