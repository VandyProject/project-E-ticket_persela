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
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/flexslider.css" media="all" />

        <!-- own style css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/rtl.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/responsive.css" media="all" />

    </head>

    <body>






        <div class="box-layout">


            

            <!-- Start About Greenforest Section -->
            <section class="bg-about-greenforest">
                <div class="container">
                <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div>
                            <div class="row">
                                <div class="text-center">
                                <h3 style="color : black">LAPORAN PENDAPATAN</h3>
                                <h2 style="color : black"><?= strtoupper(klub($master['nama_tuan_match'],'nama_klub')) ?> VS <?= strtoupper(klub($master['nama_tamu_match'],'nama_klub')) ?></h2>
                                <h4 style="color : black"><?= tanggal($master['tanggal_match'], true) ?> | <?= $master['pukul_match'] ?> WIB | <?= $master['stadion_match'] ?></h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Tribun</th>
                                        <th>Kuota</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    <?php $tribun = $this->crud->read('ms_tribun',['id_match' => $master['id_match']]) ?>
                                    <?php $total=0; foreach($tribun as $t) { 
                                        $this->db->where('id_tribun', $t['id_tribun']);
                                        $this->db->where('status', 'used');
                                        $this->db->from('ms_ticket');
                                        $tic = $this->db->get()->num_rows();
                                        ?>
                                    <tr>
                                        <td><?= $t['kelas_tribun'] ?></td>
                                        <td><?= number_format($t['kuota_tribun'], 0, ",", ".") ?></td>
                                        <td><?= rupiah($t['harga_tribun']) ?></td>
                                        <td><?php
                                        $this->db->select('SUM(jumlah) as tot');
                                        $this->db->where('id_tribun', $t['id_tribun']);
                                        $this->db->where('status', 'done');
                                        $this->db->from('ms_penonton');
                                        $d = $this->db->get()->row()->tot;
                                        $this->db->select('SUM(jumlah) as tot');
                                        $this->db->where('id_tribun', $t['id_tribun']);
                                        $this->db->where('status', 'sukses');
                                        $this->db->from('ms_penonton');
                                        $s = $this->db->get()->row()->tot;
                                        if($master['type']=="O"){
                                            $ts=$d+$s;
                                        }else if($master['type']=="S"){
                                            if(($d+$s)>=$tic){
                                                $ts=$d+$s;
                                            }else {
                                                $ts=$tic-($d+$s)+($d+$s);
                                            }
                                        }
                                        echo number_format($ts, 0, ',', '.');
                                        ?></td>
                                        <td><?= rupiah($ts*$t['harga_tribun']) ?></td>
                                    </tr>
                                    
                                    <?php $total=$total+($ts*$t['harga_tribun']); } ?>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th><?= rupiah($total) ?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- .about-greenforest -->
                    </div>
                    <!-- .row -->
                    <div class="col-md-2"></div>
                </div>
                <!-- .container -->
            </section>




            


            



        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/main/js/custom.js"></script>



    </body>
</html>
