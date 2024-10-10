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

           


            <section class="bg-recent-project">
                <div class="container">
                    <div class="row">
                        <div class="recent-project">
                            
                            
                            <div class="section-header">
                                <h2>Form Pemesanan</h2>
                                <h4>Tiket Pertandingan <?= klub($match['nama_tuan_match'],'nama_klub') ?> VS <?= klub($match['nama_tamu_match'],'nama_klub') ?></h4>
                                <h3>Tribun <?= $data['kelas_tribun'] ?></h3>
                                <p>Mohon data diisi dengan benar</p>
                            </div>
                            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                            <div>
                                <form class="contact-form" method="POST" action="<?= site_url() ?>buy/order">
                                    <input type="hidden" name="id_tribun" class="form-control" value="<?= $data['id_tribun'] ?>"/>
                                    <?php $this->session->set_userdata('url_order', $_SERVER['REQUEST_URI']); ?>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"/>
                                    </div>
                                    <div class="form-group">
                                        <label>E-Mail Aktif</label>
                                        <input type="email" name="email" class="form-control" placeholder="E-Mail Aktif"/>
                                    </div>
                                    <div class="form-group">
                                        <label>No.HP Aktif</label>
                                        <input type="number" name="no_hp" class="form-control" placeholder="No.HP Aktif"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Tiket</label>
                                        <select name="jumlah" class="form-control">
                                            <option value="" selected disabled default>Jumlah Tiket</option>
                                            <option value="1">1 => Satu</option>
                                            <option value="2">2 => Dua</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-primary" >Reset</button>
                                        <button type="submit" class="btn btn-danger" >Kirim</button>
                                    </div>
                                </form>
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
