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
<!-- 
        <div id="loading">
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
            <?php 
            foreach ($jadwal as $k) { ?>
            <section class="bg-slider-option">
                <div class="slider-option slider-two">
                    <div id="slider" class="carousel slide wow fadeInDown" data-ride="carousel">
                        
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">

                            
                                <?php $k1 = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $k['kompetisi_match']])[0] ?>
                                     <?php $k2 = $this->crud->read('ms_klub', ['id_klub' => $k['nama_tuan_match']])[0] ?>
    <?php $k3 = $this->crud->read('ms_klub', ['id_klub' => $k['nama_tamu_match']])[0] ?>

                                <div class="item active">
                                    <div class="slider-item">
                                        <img src="<?= base_url() ?>banner/<?= $k['banner_match'] ?>" alt="<?= $k2['nama_klub'] ?> VS <?= $k3['nama_klub'] ?>">
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
                                                            <p><?= tanggal($k['tanggal_match'], true) ?> | <?= substr($k['pukul_match'],0,5) ?> WIB</p>
                                                            
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
    
                            <!-- .items -->
                        </div>
                        
                    </div>
                </div>
                <!-- .slider-option -->
            </section>



            <section class="bg-recent-project">
                <div class="container">
                    <div class="row">
                        <div class="recent-project">
                            <div class="section-header">
                                <h2><?= $k2['nama_klub'] ?> <?= $k['skor_tuan_match'] ?> VS <?= $k['skor_tamu_match'] ?> <?= $k3['nama_klub'] ?></h2>
                                <p>Laskar Joko Tingkir</p>
                            </div>
                            <div class="portfolio-items">
                                
                                <?php $tribun = $this->crud->read('ms_tribun', ['id_match' => $k['id_match']]); ?>
                                
                                    <?php foreach ($tribun as $t) { ?>
                                        <?php if ($t['id_match'] == $k['id_match']) { ?>
                                            <?php
                                            $kuot = $t['kuota_tribun'];
                                            $this->db->select('SUM(jumlah) as tot');
                                            $this->db->where('id_tribun', $t['id_tribun']);
                                            $this->db->where('status !=', 'baru');
                                            $this->db->where('status !=', 'pending');
                                            $this->db->where('status !=', 'cancel');
                                            $this->db->where('status !=', 'delete');
                                            $this->db->from('ms_penonton');
                                            $terjual = $this->db->get()->row()->tot;
                                            $sisa = $kuot - $terjual;
                                            if ($terjual != 0 || $kuot != 0) {
                                                $psn = $terjual / $kuot * 100;
                                            } else {
                                                $psn = 0;
                                            }
                                            ?>
            <?php if ($kuot > 0) { ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12 item <?= $k['tanggal_match'] ?>" data-category="alkali">
                                                    <div class="item-inner">
                                                        <div class="portfolio-img">
                                                            <img src="<?= base_url() ?>config/<?= bannertribun($t['kelas_tribun']) ?>" alt="recent-project-img-6">
                                                            <ul class="project-link-option">
                                                                <li class="project-link"><img src="<?= base_url() ?>logo/<?= klub($k['nama_tuan_match'], 'logo_klub') ?>" width="50px" /></li>
                                                                <li class="project-link"><p style="color: white">VS</p></li>
                                                                <li class="project-link"><img src="<?= base_url() ?>logo/<?= klub($k['nama_tamu_match'], 'logo_klub') ?>" width="50px" /></li>
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

                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:<?= $psn ?>%">
                                                                </div>
                                                                <!-- .progress-bar -->
                                                            </div>
                                                            <!-- .progress -->
                                                            <div class="price-title">
                                                                <div class="price-left">
                                                                    <h5>Terjual:<span><?= $terjual ?></span></h5>
                                                                </div>
                                                                <!-- .price-left -->
                                                                <div class="price-right">
                                                                    <h5>Total:<span><?= rupiah($t['harga_tribun']*$terjual) ?></span></h5>
                                                                </div>
                                                                <!-- .price-left -->
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- .latest-port-content -->
                                                    </div>
                                                    <!-- .item-inner -->
                                                </div>
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
            <?php } ?>



<?php $this->load->view('sponsor'); ?>

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
