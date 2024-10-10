<?php
                            date_default_timezone_set('Asia/Jakarta');
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $tanggal = date("Ymd");
                            $waktu = time();
                            $bln = date("m");
                            $tgl = date("d");
                            $blan = date("Y-m");
                            $thn = date("Y");
                            $tglk = $tgl - 1;

                            $s = $this->db->query("SELECT * FROM views WHERE ip='$ip' AND tanggal='$tanggal'");

                            if (($s->num_rows()) == 0) {
                                $this->db->query("INSERT INTO views(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
                            } else {
                                $this->db->query("UPDATE views SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
                            }
                            ?>
<header class="header-style-2">
    <div class="bg-header-top">
        <div class="container">
            <div class="row">
                <div class="header-top">
                    <ul class="h-contact">
                        <li><i class="flaticon-time-left"></i> Onlie : Setaip Hari : 6 - 12 Malam</li>
                        <li><i class="flaticon-vibrating-phone"></i> Phone : +62 858 0605 0060</li>
                        <li><i class="flaticon-placeholder"></i> Address : kedungpring kab.lamongan</li>
                    </ul>
                    <div class="donate-option">
                       
                    </div>
                    <!-- .donate-option -->
                </div>
                <!-- .header-top -->
            </div>
            <!-- .header-top -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-header-top -->

    <!-- Start Menu -->
    <div class="bg-main-menu menu-scroll">
        <div class="container">
            <div class="row">
                <div class="main-menu">
                    <a class="show-res-logo" href="<?= site_url() ?>"><img src="<?= base_url() ?>assets/main/images/home01/logoo.png" alt="logo" class="img-responsive" /></a>
                    <nav class="navbar">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?= site_url() ?>""><img src="<?= base_url() ?>assets/main/images/home01/logoo.png" alt="logo" class="img-responsive" /></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= site_url() ?>">Home</a></li>
                                <li><a href="<?= site_url() ?>result">Hasil Pertandingan</a></li>
                                <li><a href="<?= site_url() ?>konfirmasi">Konfirmasi</a></li>
                                <li><a href="<?= site_url() ?>pembatalan">Pembatalan</a></li>
                                
                            </ul>
                            <!-- .header-search-box -->
                        </div>
                        <!-- .navbar-collapse -->
                    </nav>
                </div>
                <!-- .main-menu -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-main-menu -->
</header>