<?php
date_default_timezone_set('Asia/Jakarta');
function klub($id, $tmp) {
    $CI = & get_instance();
    $db = $CI->crud->read('ms_klub', ['id_klub' => $id])[0];
    return $db[$tmp];
}
function match($id, $tmp) {
    $CI = & get_instance();
    $db = $CI->crud->read('ms_match', ['id_match' => $id])[0];
    return $db[$tmp];
}
function tribun($id, $tmp) {
    $CI = & get_instance();
    $db = $CI->crud->read('ms_tribun', ['id_tribun' => $id])[0];
    return $db[$tmp];
}
function kompetisi($id, $tmp) {
    $CI = & get_instance();
    $db = $CI->crud->read('ms_kompetisi', ['id_kompetisi' => $id])[0];
    return $db[$tmp];
}
function penonton($id, $tmp) {
    $CI = & get_instance();
    $db = $CI->crud->read('ms_penonton', ['id_penonton' => $id])[0];
    return $db[$tmp];
}

function updata(){
    $CI = & get_instance();
    $CI->crud->delete('ms_penonton', ['status' => 'baru','batas_upload <' => date('Y-m-d H:i:s')]);
    $CI->crud->delete('ms_penonton', ['status' => 'delete','batas_upload <' => date('Y-m-d H:i:s')]);
}

function bannertribun($tribun) {

    $CI = & get_instance();
    $db = $CI->crud->read('ms_config', ['id_config' => 1])[0];
    return $db['banner_' . strtolower($tribun)];
}

function rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ",", ".") . ',-';
}

function waktu_lalu($time){
    $selisih = time() - strtotime($time);
    $detik = $selisih;
    $menit = round($selisih / 60);
    $jam = round($selisih / 3600);
    $hari = round($selisih / 86400);
    $minggu = round($selisih / 604800);
    $bulan = round($selisih / 2419200);
    $tahun = round($selisih / 29030400);
    if ($detik <= 60){
        $waktu = $detik.' detik yang lalu';
    } else if ($menit <= 60){
        $waktu = $menit.' menit yang lalu';
    } else if ($jam <= 24){
        $waktu = $jam.' jam yang lalu';
    } else if ($hari <= 7){
        $waktu = $hari.' hari yang lalu';
    } else if ($minggu <= 4){
        $waktu = $minggu.' minggu yang lalu';
    } else if ($bulan <= 12){
        $waktu = $bulan.' bulan yang lalu';
    } else {
        $waktu = $tahun.' tahun yang lalu';
    }

    return $waktu;
}

function tanggal($tanggal, $cetak_hari = false) {
    $hari = array(1 => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}
