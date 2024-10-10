<?php 
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
if ($this->session->userdata('id_penonton') == '') {
    redirect('konfirmasi');
}
?>
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
        
        <link href="<?= base_url() ?>assets/admin/css/bootstrap-material-datetimepicker.css" type="text/css" rel="stylesheet" media="screen,projection">
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/moment-with-locales.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                                <h2>Upload Resi</h2>
                                <h4>Butki Pembayaran Tiket Pertandingan</h4>
                                <h5><?= klub(match(tribun(penonton($this->session->userdata('id_penonton'), 'id_tribun'),'id_match'),'nama_tuan_match'),'nama_klub') ?> VS <?= klub(match(tribun(penonton($this->session->userdata('id_penonton'), 'id_tribun'),'id_match'),'nama_tamu_match'),'nama_klub') ?></h5>
                                <p>Mohon data diisi dengan benar</p>
                            </div>
                            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                            <div>
                                <form enctype="multipart/form-data" class="contact-form" method="POST" action="<?= site_url() ?>konfirmasi/proses">
                                    
                                    <div class="form-group">
                                        <label>Nama Pemilik Rekening</label>
                                        <input type="text" name="nama_norek" class="form-control" placeholder="Nama Pemilik Rekening"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <select name="bank" class="form-control">
                                            <option value="" selected disabled default>Bank</option>
                                            <option value="BRI">BRI</option>
                                            <option value="BNI">BNI</option>
                                            <option value="BCA">BCA</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bank Jateng">Bank Jateng</option>
                                            <option value="BTN">BTN</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No Rekening Pengirim</label>
                                        <input type="number" name="norek" class="form-control" placeholder="No Rekening Pengirim"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nominal</label>
                                        <input disabled type="number" name="nominal" class="form-control" value ="<?= (tribun(penonton($this->session->userdata('id_penonton'), 'id_tribun'),'harga_tribun'))*(penonton($this->session->userdata('id_penonton'), 'jumlah')) ?>" placeholder="Nominal"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Bukti Pembayaran</label>
                                        <input type="file" name="resi" class="form-control"/>
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
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/bootstrap-material-datetimepicker.js"></script>
        
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
        
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/bootstrap-material-datetimepicker.js"></script>


<script type="text/javascript">
        


        $(document).ready(function()
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
                    }).on('change', function(e, date)
            {
                $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });

            $('#min-date').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});

    //			$.material.init()
        });
        </script>
    </body>
</html>
