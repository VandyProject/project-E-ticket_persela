<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="theme-color" content="#d4000e">
        <meta name="msapplication-navbutton-color" content="#d4000e">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#d4000e">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-TIC | Persela Lamongan</title>
        <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/main/images/persibat.png" /> -->
        <!-- Plugin css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/font-awesome.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/fonts/flaticon.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/animate.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/swiper.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/lightcase.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/jquery.nstSlider.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/flexslider.css" media="all" />

        <!-- own style css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/rtl.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/responsive.css" media="all" />

    </head>

    <body>




        <!-- Start Pre-Loader-->

        <!-- <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div> -->


        <div class="box-layout">

            <!-- End Pre-Loader -->

            <?php $this->load->view('header'); ?>

            <!-- Start Slider Section -->


            <section class="bg-slider-option">
                <div class="slider-option slider-two">
                    <div id="slider" class="carousel slide wow fadeInDown" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php $nok = 0;
                            foreach ($jadwal as $k) {
                                ?>
                                <li data-target="#slider" data-slide-to="<?= $nok ?>" class="<?php if ($nok == 0) {
                                echo 'active';
                            } ?>"></li>
    <?php $nok++;
} ?>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">

                            <?php $nokk = 0;
                            foreach ($jadwal as $kk) {
                                ?>
                                <?php $k1 = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $kk['kompetisi_match']])[0] ?>
                                     <?php $k2 = $this->crud->read('ms_klub', ['id_klub' => $kk['nama_tuan_match']])[0] ?>
    <?php $k3 = $this->crud->read('ms_klub', ['id_klub' => $kk['nama_tamu_match']])[0] ?>

                                <div class="item <?php
    if ($nokk == 0) {
        echo 'active';
    }
    ?>">
                                    <div class="slider-item">
                                        <img src="<?= base_url() ?>banner/<?= $kk['banner_match'] ?>" alt="<?= $k2['nama_klub'] ?> VS <?= $k3['nama_klub'] ?>">
                                        <div class="slider-content-area">
                                            <div class="container">
                                                <div class="row">

                                                    <!-- .col-md-6 -->
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <div class="slider-content col-md-3 col-sm-3 col-xs-3">
                                                            <img class="img-responsive" src="<?= base_url() ?>logo/<?= $k2['logo_klub'] ?>" />
                                                        </div>
                                                        <div class="slider-content col-md-6 col-sm-6 col-xs-6">
                                                            <h3><?= $k1['nama_kompetisi'] ?> <?= date('Y') ?></h3>
                                                            <h2><?= $k2['nama_klub'] ?> VS <?= $k3['nama_klub'] ?></h2>
                                                            <p><?= tanggal($kk['tanggal_match'], true) ?> | <?= substr($kk['pukul_match'],0,5) ?> WIB</p>
                                                            
                                                            <!-- .slider-btn -->
                                                        </div>
                                                        <div class="slider-content col-md-3 col-sm-3 col-xs-3">
                                                            <img class="img-responsive" src="<?= base_url() ?>logo/<?= $k3['logo_klub'] ?>" />
                                                        </div>
                                                        <!-- .carousel-caption -->
                                                    </div>
                                                    <!-- .col-md-6 -->
                                                </div>
                                                <!-- .row -->
                                            </div>
                                            <!-- .container -->
                                        </div>
                                    </div>
                                </div>
    <?php $nokk++;
}
?>
                            <!-- .items -->



                            <!-- .items -->
                        </div>
                        <!-- .carosoul-inner -->
                        <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                        </a>
                        <a class="right carousel-control" href="#slider" role="button" data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <!-- .slider-option -->
            </section>

            <!-- End Slider Section -->


            <!-- Start About Greenforest Section -->
            <section class="bg-about-greenforest">
                <div class="container">
                    <div class="row">
                        <div class="about-greenforest">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="about-greenforest-content">
                                        <h2>E-Tic</h2>
                                        <p><span>Electronic Ticketing Persibat, selangkah lebih maju dengan Digitalisasi</span></p>
                                        <p>E-Tic atau Electronic Ticketing Persibat adalah sebuah sistem yang berfungsi untuk menjual Ticket persela secara Online, Melakukan perhitungan penonton secara sistem dan juga sebagai Wujud Transparansi Persibat untuk Masyarakat Kabupaten lamongan.</p>
                                    </div>
                                    <!-- .about-greenforest-content -->
                                </div>
                                <!-- .col-md-8 -->
                                <div class="col-md-4">
                                    <div class="about-greenforest-img">
                                        <img src="<?= base_url() ?>assets/main/images/home02/Informasi-pembelian-Tiket-Persela-Lamongan-vs-Deltras-FC-Liga-2-Lokasi.jpg" alt="about-greenforet-img" class="img-responsive" />
                                    </div>
                                    <!-- .about-greenforest-img -->
                                </div>
                                <!-- .col-md-4 -->
                            </div>
                        </div>
                        <!-- .about-greenforest -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>





            <section class="bg-recent-project">
                <div class="container">
                    <div class="row">
                        <div class="recent-project">
                            <div class="section-header">
                                <h2>Tiket Pertandingan</h2>
                                <p>Laskar Joko Tingkir</p>
                            </div>
                            <!-- .section-header -->

                            <div id="filters" class="button-group ">
                                <button class="button is-checked" data-filter="*">Semua</button>
                                <?php foreach ($open as $tr) { ?>
                                    <button class="button" data-filter=".<?= $tr['tanggal_match'] ?>"><?= klub($tr['nama_tuan_match'], 'nama_klub') ?> VS <?= klub($tr['nama_tamu_match'], 'nama_klub') ?></button>
                                <?php } ?>
                            </div>
                            <div class="portfolio-items">
                                <?php foreach ($jadwal as $tp) { ?>
                                    <?php foreach ($tribun as $t) { ?>
                                        <?php if ($t['id_match'] == $tp['id_match']) { ?>
                                            <?php
                                            $kuot = $t['kuota_tribun'];
                                            $this->db->select('SUM(jumlah) as tot');
                                            $this->db->where('id_tribun', $t['id_tribun']);
                                            $this->db->where('status !=', 'baru');
                                            $this->db->from('ms_penonton');
                                            $terjual = $this->db->get()->row()->tot;
                                            $sisa = $kuot - $terjual;
                                            if ($terjual != 0 || $kuot != 0) {
                                                $psn = $terjual / $kuot * 100;
                                            } else {
                                                $psn = 0;
                                            }
                                            ?>
            <?php if ($sisa > 0) { ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12 item <?= $t['tanggal_match'] ?>" data-category="alkali">
                                                    <div class="item-inner">
                                                        <div class="portfolio-img">
                                                            <img src="<?= base_url() ?>config/<?= bannertribun($t['kelas_tribun']) ?>" alt="recent-project-img-6">
                                                            <ul class="project-link-option">
                                                                <li class="project-link"><img src="<?= base_url() ?>logo/<?= klub($t['nama_tuan_match'], 'logo_klub') ?>" width="50px" /></li>
                                                                <li class="project-link"><p style="color: white">VS</p></li>
                                                                <li class="project-link"><img src="<?= base_url() ?>logo/<?= klub($t['nama_tamu_match'], 'logo_klub') ?>" width="50px" /></li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.portfolio-img -->
                                                        <div class="cause-content">
                                                            <div class="price-title">
                                                                <div class="price-left">
                                                                    <h5>Tribun:<span><?= $t['kelas_tribun'] ?></span></h5>
                                                                </div>
                                                                <!-- .price-left -->
                                                                <div class="price-right">
                                                                    <h5>Harga:<span><?= rupiah($t['harga_tribun']) ?></span></h5>
                                                                </div>
                                                                <!-- .price-left -->
                                                            </div>
                                                            <!-- .price-title -->

                                                            <div class="progress" title="<?= $sisa ?>Tiket Tersedia">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped"  role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:<?= $psn ?>%">
                                                                </div>
                                                                <!-- .progress-bar -->
                                                            </div>
                                                            <!-- .progress -->
                                                            <h4><a><?= klub($t['nama_tuan_match'], 'nama_klub') ?> VS <?= klub($t['nama_tamu_match'], 'nama_klub') ?></a></h4>
                                                            <p><?= tanggal($t['tanggal_match']) ?> | <?= substr($t['pukul_match'],0,5) ?> WIB | @ <?= $t['stadion_match'] ?></p>
                                                            <a href="<?= site_url() ?>buy/ticket/<?= $t['slug'] ?>/<?= $t['kelas_tribun'] ?>" class="btn btn-default">Beli Tiket</a>
                                                        </div>
                                                        <!-- .latest-port-content -->
                                                    </div>
                                                    <!-- .item-inner -->
                                                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>





                                <!-- .items -->
                            </div>
                            <!-- .isotope-items -->
                        </div>
                        <!-- .recent-project -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>


            <!-- End Recent Project Section -->


            <!-- Start Count Section -->

            <section class="bg-count1-section">
                <div class="count-overlay">
                    <div class="container">
                        <div class="row">
                            <div class="count-option">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="count-items">
                                            <i class="flaticon-time-left"></i>
                                            <span class="counter">
<?php
$this->db->from('ms_match');
$this->db->where('tanggal_match <', date('Y-m-d'));
$query = $this->db->get();
$rowcount = $query->num_rows();
echo number_format($rowcount, 0, ',', '.');
?>
                                            </span>
                                            <h4>PERTANDINGAN</h4>
                                        </div>
                                        <!-- .count-items -->
                                    </div>
                                    <!-- .col-md-3 -->
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="count-items">
                                            <i class="flaticon-rocket-launch"></i>
                                            <span class="counter">
                                            <?php
                $this->db->select('SUM(jumlah) as tot');
                $this->db->where('status', 'done');
                $this->db->or_where('status', 'sukses');
                $this->db->from('ms_penonton');
                $t = $this->db->get()->row()->tot;
                echo number_format($t, 0, ',', '.');
                ?>
                                            </span>
                                            <h4>TICKET ONLINE</h4>
                                        </div>
                                        <!-- .count-items -->
                                    </div>
                                    <!-- .col-md-3 -->
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="count-items">
                                            <i class="flaticon-man"></i>
                                            <span class="counter">
                                            <?php
$this->db->from('ms_penonton');
$this->db->group_by('email');
$query = $this->db->get();
$rowcount = $query->num_rows();
echo number_format($rowcount, 0, ',', '.');
?>
                                            </span>
                                            <h4>MEMBER</h4>
                                        </div>
                                        <!-- .count-items -->
                                    </div>
                                    <!-- .col-md-3 -->
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="count-items">
                                            <i class="flaticon-people"></i>
                                            <span class="counter"><?php
                                        $this->db->from('views');
                                        $query = $this->db->get();
                                        $rowcount = $query->num_rows();
                                        echo number_format($rowcount,0,',','.');
                                        ?></span>
                                            <h4>PENGUNJUNG</h4>
                                        </div>
                                        <!-- .count-items -->
                                    </div>
                                    <!-- .col-md-3 -->
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .count-section -->
                        </div>
                        <!-- .row -->
                    </div>
                    <!-- .container -->
                </div>
            </section>

            <!-- End Count Section -->



            <!-- Start Service Style2 Section -->


            <section class="bg-servicesstyle2-section">
                <div class="container">
                    <div class="row">
                        <div class="our-services-option">
                            <div class="section-header">
                                <h2>Prosedur</h2>
                                <p>Ikuti langkah yang telah kami tentukan, apabila terdapat pemalsuan bersiaplah untuk berurusan dengan pihak berwajib.</p>
                            </div>
                            <!-- .section-header -->
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-desktop" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a>Kunjungi Web</a></h4>
                                                <p>Kunjungi website Resmi Ticketing Online persela lamongan di www.etic-persela-lamongan.com </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-shopping-bag" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a>Beli</a></h4>
                                                <p>Pilih Tiket yang anda inginkan kemudian beli dan isi data dengan lengkap, gunakanlah email yang aktif </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-cc-visa" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a href="service_single.html">Bayar</a></h4>
                                                <p>Bayar ticket melalui Bank, ATM, Mobile Banking, Atau Transfer Tunai ke Rekening PT. Persibat Batang Indonesia </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-cloud-upload" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a href="service_single.html">Konfirmasi</a></h4>
                                                <p>Konfirmasi pembayaran dengan bukti pembayaran, gunakan kode keamanan yang kami kirimkan. </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-barcode" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a href="service_single.html">Scan Ticket</a></h4>
                                                <p>Scan Tiket Anda di lokasi yang telah di tentukan pada Tiket Anda, tiket hanya berlaku untuk 1 kali scan. </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="our-services-box">
                                        <div class="our-services-items">
                                            <i class="fa fa-futbol-o" style="color: #d4000e; font-size: 40px;"></i>
                                            <div class="our-services-content">
                                                <h4><a href="service_single.html">Enjoy :)</a></h4>
                                                <p>Selamat menyaksikan, terima kasih telah membeli tiket, karena kontribusi Anda sangat berarti untuk kemajuan Team. </p>
                                            </div>
                                            <!-- .our-services-content -->
                                        </div>
                                        <!-- .our-services-items -->
                                    </div>
                                    <!-- .our-services-box -->
                                </div>
                                <!-- .col-md-4 -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .our-services-option -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>

<?php $this->load->view('sponsor'); ?>


            <!-- End Sponsors Section -->


            <!-- Start Footer Section -->
<?php $this->load->view('footer'); ?>


            <div class="scroll-img"><i class="fa fa-angle-up" aria-hidden="true"></i></div>

        </div>


        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery.counterup.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/swiper.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/lightcase.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery.nstSlider.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery.flexslider.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/custom.map.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/plugins.isotope.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/custom.isotope.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/custom.js"></script>



    </body>
</html>
