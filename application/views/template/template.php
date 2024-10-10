<?php
date_default_timezone_set('Asia/Jakarta');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
if ($this->session->userdata('username') == '') {
    redirect('login');
} else if ($this->session->userdata('akses') != ucwords($this->uri->segment(1))) {
    redirect('login');
}
?>
<!DOCTYPE html>
<script type="text/javascript">
    function showTime() {

        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();

        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;


        if (curr_hour == 0) {
            curr_hour = 24;
        }
        if (curr_hour > 24) {
            curr_hour = curr_hour - 24;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " WIB";
        document.getElementById('tgl').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
</script>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <title>E-Tic | persela lamongan</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="theme-color" content="#d4000e">
        <meta name="msapplication-navbutton-color" content="#d4000e">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#d4000e">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="Phoenixcoded" />
        <!-- Favicon icon -->
        <!-- <link rel="icon" href="<?= base_url() ?>assets/admin/images/logooo.png" type="image/x-icon" sizes="32x32"> -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/bower_components/bootstrap/css/bootstrap.min.css">
        <link href="<?= base_url() ?>assets/admin/css/bootstrap-material-datetimepicker.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datatables/datatables.css" />-->
        <link rel="stylesheet" href="<?= base_url() ?>assets/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/icon/feather/css/feather.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/pages/data-table/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/sweetalert/sweetalert.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/css/widget.css">
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/icon/themify-icons/themify-icons.css">-->
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/icon/icofont/css/icofont.css">
        <!-- Font Awesome -->
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/files/assets/icon/font-awesome/css/font-awesome.min.css">-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script type="text/javascript" src="<?= base_url() ?>assets/files/bower_components/jquery/js/jquery.min.js"></script>

        <!--mater ialize js-->
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/bootstrap-material-datetimepicker.js"></script>
        <!--<script type="text/javascript" src="<?= base_url() ?>assets/datatables/datatables.min.js"></script>-->
        <!-- Required Jquery -->
        <script type="text/javascript" src="<?= base_url() ?>assets/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/bower_components/popper.js/js/popper.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
        <!-- waves js -->
        <script src="<?= base_url() ?>assets/files/assets/pages/waves/js/waves.min.js"></script>
        <!-- jquery slimscroll js -->
        <script type="text/javascript" src="<?= base_url() ?>assets/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
        <!-- Float Chart js -->
        <script src="<?= base_url() ?>assets/files/assets/pages/chart/float/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/chart/float/jquery.flot.categories.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/chart/float/curvedLines.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
        <!-- amchart js -->
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/jszip.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!--<script src="<?= base_url() ?>assets/files/assets/pages/data-table/extensions/responsive/js/responsive-custom.js"></script>-->

        <script src="<?= base_url() ?>assets/files/assets/pages/widget/amchart/amcharts.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/widget/amchart/serial.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/widget/amchart/light.js"></script>
        <!-- Custom js -->
        <script src="<?= base_url() ?>assets/files/assets/js/pcoded.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/js/vertical/vertical-layout.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/assets/pages/dashboard/custom-dashboard.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/assets/js/script.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/assets/js/analytics.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/files/assets/pages/dashboard/ecommerce-dashboard.min.js"></script>
    </head>

    <body>
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <!-- [ Pre-loader ] end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <!-- [ Header ] start -->
                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                                <i class="feather icon-toggle-right"></i>
                            </a>
                            <a href="index.html">
                                <img class="img-fluid" src="<?= base_url() ?>assets/admin/images/logoo.png" alt="Persela lamongan" />
                            </a>
                            <a class="mobile-options waves-effect waves-light">
                                <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                        <i class="full-screen feather icon-maximize"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="<?= base_url() ?>foto/<?= $this->session->userdata('foto') ?>" class="img-radius" alt="User-Profile-Image">
                                            <span><?= $this->session->userdata('username') ?></span>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                            <li>
                                                <a class="prof" href="javascript:void(0)" rel="<?= site_url() ?>login/profil/<?= $this->session->userdata('id_user') ?>">
                                                    <i class="feather icon-user"></i> Profil
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pass" href="javascript:void(0)" rel="<?= site_url() ?>login/setpassword/<?= $this->session->userdata('id_user') ?>">
                                                    <i class="feather icon-settings"></i> Ubah Password
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= site_url() ?>login/logout">
                                                    <i class="feather icon-log-out"></i> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <!-- [ navigation menu ] start -->
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="">
                                    <div class="main-menu-header">
                                        <img class="img-menu-user img-radius" src="<?= base_url() ?>foto/<?= $this->session->userdata('foto') ?>" alt="User-Profile-Image">
                                        <div class="user-details">
                                            <p id="more-details"><?= $this->session->userdata('username') ?><i class="feather icon-chevron-down m-l-10"></i></p>
                                        </div>
                                    </div>
                                    <div class="main-menu-content">
                                        <ul>
                                            <li class="more-details">
                                                <a class="prof" href="javascript:void(0)" rel="<?= site_url() ?>login/profil/<?= $this->session->userdata('id_user') ?>">
                                                    <i class="feather icon-user"></i>Profil
                                                </a>
                                                <a class="pass" href="javascript:void(0)" rel="<?= site_url() ?>login/setpassword/<?= $this->session->userdata('id_user') ?>">
                                                    <i class="feather icon-settings"></i>Ubah Password
                                                </a>
                                                <a href="<?= site_url() ?>login/logout">
                                                    <i class="feather icon-log-out"></i>Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="user-details">
                                        <ul class="pcoded-navigation-label">
                                            <li id="tgl"></li>
                                            <li id="clock"></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('akses') == 'Admin') { ?>
                                    <div class="pcoded-navigation-label">Administrator</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'dashboard') {
                                        echo 'active';
                                    } ?>">
                                            <a href="<?= site_url() ?>admin/dashboard" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-home"></i>
                                                </span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu <?php if ($this->uri->segment(2) == 'order') {
                                        echo 'active';
                                    } ?>">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-layers"></i>
                                                </span>
                                                <span class="pcoded-mtext">Penonton</span>
                                                <span class="pcoded-badge label label-success">
                                                    <?php
                                                    $this->db->from('ms_penonton');
                                                    $this->db->where('status', 'baru');
                                                    $n = $this->db->get();
                                                    $rowcount1 = $n->num_rows();

                                                    $this->db->from('ms_penonton');
                                                    $this->db->where('status', 'pending');
                                                    $m = $this->db->get();
                                                    $rowcount2 = $m->num_rows();

                                                    echo number_format(($rowcount1 + $rowcount2), 0, ',', '.');
                                                    ?>
                                                </span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="<?= site_url() ?>admin/order/baru" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Baru</span>
                                                        <span class="pcoded-badge label label-info">
                                                            <?php
                                                            $this->db->from('ms_penonton');
                                                            $this->db->where('status', 'baru');
                                                            $query = $this->db->get();
                                                            $rowcount = $query->num_rows();
                                                            echo number_format($rowcount, 0, ',', '.');
                                                            ?>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="<?= site_url() ?>admin/order/pending" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Pending</span>
                                                        <span class="pcoded-badge label label-warning">
                                                            <?php
                                                            $this->db->from('ms_penonton');
                                                            $this->db->where('status', 'pending');
                                                            $query = $this->db->get();
                                                            $rowcount = $query->num_rows();
                                                            echo number_format($rowcount, 0, ',', '.');
                                                            ?>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="<?= site_url() ?>admin/order/sukses" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Sukses</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'pembatalan') {
                                                                echo 'active';
                                                            } ?>">
                                            <a href="<?= site_url() ?>admin/pembatalan" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-info"></i>
                                                </span>
                                                <span class="pcoded-mtext">Pembatalan</span>
                                                <span class="pcoded-badge label label-danger">
                                                    <?php
                                                    $this->db->from('ms_penonton');
                                                    $this->db->where('status', 'cancel');
                                                    $query = $this->db->get();
                                                    $rowcount = $query->num_rows();
                                                    echo number_format($rowcount, 0, ',', '.');
                                                    ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'pesan') {
                                                        echo 'active';
                                                    } ?>">
                                            <a href="<?= site_url() ?>admin/pesan" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-mail"></i>
                                                </span>
                                                <span class="pcoded-mtext">Pesan</span>
                                                <span class="pcoded-badge label label-info">
    <?php
    $this->db->from('ms_pesan');
    $this->db->where('status', 'new');
    $query = $this->db->get();
    $rowcount = $query->num_rows();
    echo number_format($rowcount, 0, ',', '.');
    ?>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigation-label">Database</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'jadwal') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/jadwal" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-calendar"></i>
                                                </span>
                                                <span class="pcoded-mtext">Jadwal</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="pcoded-navigation-label">Master</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'kompetisi') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/kompetisi" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-flag"></i>
                                                </span>
                                                <span class="pcoded-mtext">Kompetisi</span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'klub') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/klub" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-tag"></i>
                                                </span>
                                                <span class="pcoded-mtext">Klub</span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'sponsor') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/sponsor" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-credit-card"></i>
                                                </span>
                                                <span class="pcoded-mtext">Sponsor</span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'user') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/user" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-users"></i>
                                                </span>
                                                <span class="pcoded-mtext">User</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="pcoded-navigation-label">Setting</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'config') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>admin/config" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-settings"></i>
                                                </span>
                                                <span class="pcoded-mtext">Konfigurasi</span>
                                            </a>
                                        </li>
                                    </ul>
<?php } else if ($this->session->userdata('akses') == 'Managemen') { ?>
                                    <div class="pcoded-navigation-label">Managemen</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'dashboard') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>managemen/dashboard" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-home"></i>
                                                </span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'jadwal') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>managemen/jadwal" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-calendar"></i>
                                                </span>
                                                <span class="pcoded-mtext">Jadwal</span>
                                            </a>
                                        </li>
                                        <li class="<?php if ($this->uri->segment(2) == 'user') {
        echo 'active';
    } ?>">
                                            <a href="<?= site_url() ?>managemen/user" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-users"></i>
                                                </span>
                                                <span class="pcoded-mtext">User</span>
                                            </a>
                                        </li>
                                    </ul>
                                                <?php } else if ($this->session->userdata('akses') == 'Panpel') { ?>
                                    <div class="pcoded-navigation-label">Panpel</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="<?php if ($this->uri->segment(2) == 'dashboard') {
                                                    echo 'active';
                                                } ?>">
                                            <a href="<?= site_url() ?>admin/dashboard" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-home"></i>
                                                </span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                        <?php $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0]; ?>
                                        <?php if($j['tanggal_match'] == date('Y-m-d')) { ?>
                                        <li class="pcoded-hasmenu <?php if ($this->uri->segment(2) == 'scan') {
                                                    echo 'active';
                                                } ?>">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-layers"></i>
                                                </span>
                                                <span class="pcoded-mtext">Scan</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                
                                                <?php if($j['type']=='O') { ?>
                                                <li class="">
                                                    <a href="<?= site_url() ?>panpel/scan" target="_BLANK" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Scan Tiket</span>
                                                    </a>
                                                </li>
                                                <?php } else { ?>
                                                <li class="">
                                                    <a href="<?= site_url() ?>panpel/loket" target="_BLANK" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Loket</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="<?= site_url() ?>panpel/gate" target="_BLANK" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Gate</span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>

<?php } ?>

                            </div>
                        </nav>
                        <!-- [ navigation menu ] end -->
                        <div class="pcoded-content">
                            <!-- [ breadcrumb ] start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="page-header-title">
                                                <h4 class="m-b-10">Dashboard</h4>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="<?= site_url() ?>/login">
                                                        <i class="feather icon-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?= site_url() ?><?= $this->uri->segment(1); ?>/<?= $this->uri->segment(2); ?>"><?= ucfirst($this->uri->segment(2)); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <!-- [ page content ] start -->
                                            <div class="row">

<?= $content ?>   

                                            </div>
                                            <!-- [ page content ] end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!--<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JKzDzTsXZH2cC%2bwphG9gCKPRd00hhu%2fGrQTTlABiJwZaFErPMnJHyFjmcWYsrdZlDznhv1eUipXzbwl%2fHLdvdNecukf2WD0Z%2bzoAZ8Zr%2fhyIPShXk6DMxcTK8iex9bEMn%2fOy35bawS9BQh3ARYKIspNcRDydw62D6OMzShCuJRlmcled8rVyY97hodVXWWAU42qB%2baKZITaj3WZEhAT%2f3gPZhd2MTEJ0%2fjgreE8ni7tEpOUotTUKreSnsnLRi%2bnlQxAchy3ZMYe3%2fUjFhULlYoSea6ipZ3QrFSD%2bYphi3HXKlUJCRn90M4F%2bJifCkZYFZJF2MP8mNbKqExrJzlLpscFDG7tz8%2bEqToL6WoCif8mwth6mrQoUPbLfEFTY20xsFY7w2PXOdgj8PCgobIa0cP2qxyLomIq7nxvgMqn4Ak1DMkVC6xX1EyuLd0X4JKC80zR5dibMSJMUDexhbARlM1CFKBVYGHTF%2bYikMiVX8cq6%2bU9lX1AI1vw%2fzY4%2fQ5yIqa8KCjFzwnsiNcBPoP96zQk9OCXS9cyqtFZW3tKyL%2bQ" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>-->
        <script type="text/javascript">
            $(document).on('click', '.del', function () {
                var href = $(this).attr('rel');
                swal({
                    title: "Anda yakin?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Saya yakin!",
                    closeOnConfirm: false
                },
                        function () {
                            swal({
                                title: "Terhapus!",
                                text: "Data yang Anda maksud telah berhasil dihapus.",
                                type: "success"
                            },
                                    function () {
                                        deletedata(href);
                                    });
                        });

                return false;
            });


            $(document).ready(function ()
            {
                $('#date').bootstrapMaterialDatePicker
                        ({
                            time: false,
                            clearButton: true
                        });

                $('#time').bootstrapMaterialDatePicker
                        ({
                            date: false,
                            shortTime: false,
                            format: 'HH:mm'
                        });

                $('#date-format').bootstrapMaterialDatePicker
                        ({
                            format: 'Y-M-D HH:mm'
                        });
                $('#date-fr').bootstrapMaterialDatePicker
                        ({
                            format: 'DD/MM/YYYY HH:mm',
                            lang: 'fr',
                            weekStart: 1,
                            cancelText: 'ANNULER',
                            nowButton: true,
                            switchOnClick: true
                        });

                $('#date-end').bootstrapMaterialDatePicker
                        ({
                            weekStart: 0, format: 'DD/MM/YYYY HH:mm'
                        });
                $('#date-start').bootstrapMaterialDatePicker
                        ({
                            weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime: true
                        }).on('change', function (e, date)
                {
                    $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
                });

                $('#min-date').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});

                //			$.material.init()
            });


            $(document).on('click', '.prof', function () {
                var href = $(this).attr('rel');
                var CaptionHeader = 'Profile ';
                $('.modal-dialog').removeClass('modal-sm');
                $('.modal-dialog').addClass('modal-lg');
                $('#amdjudul').html(CaptionHeader);
                $('#amdisi').load(href);
                $('#amdfooter').html('<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button><button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="upprofile()">Update</button>');
                $('#admmodal').modal('show');
            });

            $(document).on('click', '.pass', function () {
                var href = $(this).attr('rel');
                var CaptionHeader = 'Ubah Password ';
                $('.modal-dialog').removeClass('modal-sm');
                $('.modal-dialog').addClass('modal-lg');
                $('#amdjudul').html(CaptionHeader);
                $('#amdisi').load(href);
                $('#amdfooter').html('<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button><button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="uppassword()">Update</button>');
                $('#admmodal').modal('show');
            });

            function upprofile()
            {
                $('#btnSave').text('Menyimpan...'); //change button text
                $('#btnSave').attr('disabled', true); //set button disable 
                var url = "<?php echo site_url('login/update') ?>";

                // ajax adding data to database

                var formData = new FormData($('#formuser')[0]);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data)
                    {

                        if (data.status) //if success close modal and reload ajax table
                        {
                            $('#admmodal').modal('hide');
                            window.location.reload();
                        } else
                        {
                            for (var i = 0; i < data.inputerror.length; i++)
                            {
                                $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 

                    }
                });
            }

            function uppassword()
            {
                $('#btnSave').text('Menyimpan...'); //change button text
                $('#btnSave').attr('disabled', true); //set button disable 
                var url = "<?php echo site_url('login/uppassword') ?>";

                // ajax adding data to database

                var formData = new FormData($('#formuser')[0]);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data)
                    {

                        if (data.status) //if success close modal and reload ajax table
                        {
                            $('#admmodal').modal('hide');
                            window.location.reload();
                        } else
                        {
                            for (var i = 0; i < data.inputerror.length; i++)
                            {
                                $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 

                    }
                });
            }
        </script>

        <div class="modal fade" id="admmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="amdjudul"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="amdisi">

                    </div>
                    <div class="modal-footer" id="amdfooter"></div>
                </div>
            </div>
        </div>

        <script>
            $('#admmodal').on('hide.bs.modal', function () {
                setTimeout(function () {
                    $('#amdjudul, #amdisi, #amdfooter').html('');
                }, 500);
            });
        </script>
</html>
