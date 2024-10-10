<?php $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0]; ?>
<?php if($j['tanggal_match'] == date('Y-m-d')) { ?>
<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-block">
            <h3>
                <?php
                $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0];
                $b = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Barat'])[0];
                if($j['type']=="O"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $b['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $barat = $this->db->get()->row()->tot;
                    echo number_format($barat, 0, ',', '.');
                }else if($j['type']=="S"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $b['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $barat = $this->db->get()->row()->tot;
                    $this->db->where('id_tribun', $b['id_tribun']);
                    $this->db->where('status', 'used');
                    $this->db->from('ms_ticket'); 
                    $qbarat = $this->db->get()->num_rows();
                    echo number_format($barat, 0, ',', '.').'/'.number_format($qbarat, 0, ',', '.');
                }
                ?>
            </h3>
            <p class="text-muted">Tribun <?= $b['kelas_tribun'] ?></p>
            <div id="seo-anlytics1" style="height:50px"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-block">
            <h3>
                <?php
                $t = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Timur'])[0];
                if($j['type']=="O"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $timur = $this->db->get()->row()->tot;
                    echo number_format($timur, 0, ',', '.');
                }else if($j['type']=="S"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $timur = $this->db->get()->row()->tot;
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status', 'used');
                    $this->db->from('ms_ticket'); 
                    $qtimur = $this->db->get()->num_rows();
                    echo number_format($timur, 0, ',', '.').'/'.number_format($qtimur, 0, ',', '.');
                }
                ?>
            </h3>
            <p class="text-muted">Tribun <?= $t['kelas_tribun'] ?></p>
            <div id="seo-anlytics2" style="height:50px"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-block">
            <h3>
                <?php
                $s = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Selatan'])[0];
                if($j['type']=="O"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $s['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $selatan = $this->db->get()->row()->tot;
                    echo number_format($selatan, 0, ',', '.');
                }else if($j['type']=="S"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $s['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $selatan = $this->db->get()->row()->tot;
                    $this->db->where('id_tribun', $s['id_tribun']);
                    $this->db->where('status', 'used');
                    $this->db->from('ms_ticket'); 
                    $qselatan = $this->db->get()->num_rows();
                    echo number_format($selatan, 0, ',', '.').'/'.number_format($qselatan, 0, ',', '.');
                }
                ?>
            </h3>
            <p class="text-muted">Tribun <?= $s['kelas_tribun'] ?></p>
            <div id="seo-anlytics3" style="height:50px"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-block">
            <h3>
                <?php
                $u = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Utara'])[0];
                if($j['type']=="O"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $u['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $utara = $this->db->get()->row()->tot;
                    echo number_format($utara, 0, ',', '.');
                }else if($j['type']=="S"){
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $u['id_tribun']);
                    $this->db->where('status', 'done');
                    $this->db->from('ms_penonton');
                    $utara = $this->db->get()->row()->tot;
                    $this->db->where('id_tribun', $u['id_tribun']);
                    $this->db->where('status', 'used');
                    $this->db->from('ms_ticket'); 
                    $qutara = $this->db->get()->num_rows();
                    echo number_format($utara, 0, ',', '.').'/'.number_format($qutara, 0, ',', '.');
                }
                ?>
            </h3>
            <p class="text-muted">Tribun <?= $u['kelas_tribun'] ?></p>
            <div id="seo-anlytics4" style="height:50px"></div>
        </div>
    </div>
</div>
<?php } ?>
<!-- seo analytics end -->

<!-- Latest Order start -->
<div class="col-lg-4 col-md-12">
    <div class="card o-hidden">
        <div class="card-block bg-c-green p-b-0">
            <div class="row text-white m-b-20">
                <div class="col-auto">
                    <?php $am = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0]; 
                    $pn = $this->crud->read('ms_tribun', ['id_match' => $am['id_match']]);
                    $tm=0;
                    foreach ($pn as $pn1) {
                        $ptn = $this->crud->read('ms_penonton', ['id_tribun' => $pn1['id_tribun'],'status' => 'sukses']);
                        foreach ($ptn as $ptn1) {
                            $tm=$tm+($ptn1['jumlah']*$pn1['harga_tribun']);
                        }
                        $ptn2 = $this->crud->read('ms_penonton', ['id_tribun' => $pn1['id_tribun'],'status' => 'done']);
                        foreach ($ptn2 as $ptn3) {
                            $tm=$tm+($ptn3['jumlah']*$pn1['harga_tribun']);
                        }
                    }
                    ?>
                    <h4 class="m-b-5"><?= rupiah($tm) ?></h4>
                    <h6><?= klub(match($am['id_match'],'nama_tuan_match'),'nama_klub') ?> VS <?= klub(match($am['id_match'],'nama_tamu_match'),'nama_klub') ?></h6>
                </div>
                <div class="col text-right">
                    <h6><?= tanggal(date('Y-m-d'),true) ?></h6>
                </div>
            </div>
            <div id="sec-ecommerce-chart-line" style="height:60px"></div>
            <div class="row justify-content-center m-t-20">
                <div class="col-8">
                    <div id="sec-ecommerce-chart-bar" style="height:100px"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?php 
            $bln = date("m");
            $tgl = date("d");
            $thn = date("Y");
            $tglk = $tgl - 1;

            if ($tglk == '1' | $tglk == '2' | $tglk == '3' | $tglk == '4' | $tglk == '5' | $tglk == '6' | $tglk == '7' | $tglk == '8' | $tglk == '9') {
                $kemarin = "'$thn-$bln-0$tglk'";
            } else {
                $kemarin = "'$thn-$bln-$tglk'";
            }
            $blan = date("Y-m");
                 $tanggal = date("Y-m-d");
                 $this->db->from('ms_penonton');
                 $this->db->where('status','sukses');
                 $this->db->or_where('status','done');
                 $query = $this->db->get();
                 $ro = $query->result_array();
                 $tmh=0;
                 $tmk=0;
                 $tmb=0;
                 $tmt=0;
                 foreach ($ro as $ro1) {
                     if(substr($ro1['waktu_verifed'],0,10) == $tanggal){
                     $tmh=$tmh+($ro1['jumlah']*tribun($ro1['id_tribun'],'harga_tribun'));
                        }
                     if(substr($ro1['waktu_verifed'],0,10) == $kemarin){
                        $tmk=$tmk+($ro1['jumlah']*tribun($ro1['id_tribun'],'harga_tribun'));
                        }
                     if(substr($ro1['waktu_verifed'],0,7) == $blan){
                        $tmb=$tmb+($ro1['jumlah']*tribun($ro1['id_tribun'],'harga_tribun'));
                        }
                        $tmt=$tmt+($ro1['jumlah']*tribun($ro1['id_tribun'],'harga_tribun'));
                 }
            ?>
            <h4><?= rupiah($tmh) ?></h4>
            <p class="text-muted">Hari ini.</p>
            <div class="row">
                <div class="col">
                    <p class="text-muted m-b-5">Kemarin</p>
                    <p><b><?= rupiah($tmk) ?></b></p>
                </div>
                <div class="col">
                    <p class="text-muted m-b-5">Bulan ini</p>
                    <p><b><?= rupiah($tmb) ?></b></p>
                </div>
                <div class="col">
                    <p class="text-muted m-b-5">Total</p>
                    <p><b><?= rupiah($tmt) ?></b></p>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-lg-8 col-md-12">
    <div class="card table-card latest-activity-card">
        <div class="card-header borderless">
            <h5>Pesanan Ticket</h5>
            <div class="card-header-right">                                                             <ul class="list-unstyled card-option">                                                                 <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>                                                                 <li><i class="feather icon-maximize full-card"></i></li>                                                                 <li><i class="feather icon-minus minimize-card"></i></li>                                                                 <li><i class="feather icon-refresh-cw reload-card"></i></li>                                                                 <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>                                                             </ul>                                                         </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tiket</th>
                            <th>Jumlah</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $baru = $this->db->where('status','baru')->order_by('waktu','DESC')->get('ms_penonton',1)->result_array(); 
                         foreach($baru as $b) { ?>
                        <tr>
                            <td><?= $b['nama'] ?></td>
                            <td><?= klub(match(tribun($b['id_tribun'],'id_match'),'nama_tuan_match'),'nama_klub') ?> VS <?= klub(match(tribun($b['id_tribun'],'id_match'),'nama_tamu_match'),'nama_klub') ?> | <?= tribun($b['id_tribun'],'kelas_tribun') ?></td>
                            <td><?= $b['jumlah'] ?></td>
                            <td><?= rupiah($b['jumlah']*tribun($b['id_tribun'],'harga_tribun')) ?></td>
                            <td><a href="<?= site_url() ?>admin/order/baru"><label class="label label-primary">Baru</label></a></td>
                        </tr>
                        <?php } $pending = $this->db->where('status','pending')->order_by('waktu_upload','DESC')->get('ms_penonton',1)->result_array(); 
                        foreach($pending as $p) { ?>
                        <tr>
                            <td><?= $p['nama'] ?></td>
                            <td><?= klub(match(tribun($p['id_tribun'],'id_match'),'nama_tuan_match'),'nama_klub') ?> VS <?= klub(match(tribun($p['id_tribun'],'id_match'),'nama_tamu_match'),'nama_klub') ?> | <?= tribun($p['id_tribun'],'kelas_tribun') ?></td>
                            <td><?= $p['jumlah'] ?></td>
                            <td><?= rupiah($p['jumlah']*tribun($p['id_tribun'],'harga_tribun')) ?></td>
                            <td><a href="<?= site_url() ?>admin/order/pending"><label class="label label-warning">Pending</label></a></td>
                        </tr>
                        <?php } $sukses = $this->db->where('status','sukses')->order_by('waktu_verifed','DESC')->get('ms_penonton',1)->result_array(); 
                        foreach($sukses as $s) { ?>
                        <tr>
                            <td><?= $s['nama'] ?></td>
                            <td><?= klub(match(tribun($s['id_tribun'],'id_match'),'nama_tuan_match'),'nama_klub') ?> VS <?= klub(match(tribun($s['id_tribun'],'id_match'),'nama_tamu_match'),'nama_klub') ?> | <?= tribun($s['id_tribun'],'kelas_tribun') ?></td>
                            <td><?= $s['jumlah'] ?></td>
                            <td><?= rupiah($s['jumlah']*tribun($s['id_tribun'],'harga_tribun')) ?></td>
                            <td><a href="<?= site_url() ?>admin/order/sukses"><label class="label label-success">Sukses</label></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right  m-r-20">
            </div>
        </div>
    </div>
</div>
<!-- Latest Order end -->

<!-- order  start -->

<div class="col-md-12 col-xl-4">
    <a href="<?= site_url() ?>admin/order/baru">
    <div class="card bg-c-blue order-card">
        <div class="card-block">
            <h6>Pesanan Baru</h6>
            <h2>
                <?php
                $this->db->from('ms_penonton');
                $this->db->where('status', 'baru');
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo number_format($rowcount, 0, ',', '.');
                ?>
            </h2>
            <i class="card-icon feather icon-filter"></i>
        </div>
    </div>
        </a>
</div>

<div class="col-md-6 col-xl-4">
    <a href="<?= site_url() ?>admin/order/pending">
    <div class="card bg-c-yellow order-card">
        <div class="card-block">
            <h6>Pesanan Pending</h6>
            <h2>
                <?php
                $this->db->from('ms_penonton');
                $this->db->where('status', 'pending');
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo number_format($rowcount, 0, ',', '.');
                ?>
            </h2>
            <i class="card-icon feather icon-users"></i>
        </div>
    </div>
    </a>
</div>
<div class="col-md-6 col-xl-4">
    <a href="<?= site_url() ?>admin/order/sukses">
    <div class="card bg-c-green order-card">
        <div class="card-block">
            <h6>Pesanan Sukses</h6>
            <h2>
                <?php
                $this->db->from('ms_penonton');
                $this->db->where('status', 'sukses');
                $query = $this->db->get();
                $rowcount = $query->num_rows();
                echo number_format($rowcount, 0, ',', '.');
                ?>
            </h2>
            <i class="card-icon feather icon-radio"></i>
        </div>
    </div>
    </a>
</div>
<!-- order  end -->

<!-- Latest Customers start -->
<div class="col-lg-8 col-md-12">
    <div class="card table-card review-card">
        <div class="card-header borderless ">
            <h5>Pesan Masuk</h5>
            <div class="card-header-right">                                                             <ul class="list-unstyled card-option">                                                                 <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>                                                                 <li><i class="feather icon-maximize full-card"></i></li>                                                                 <li><i class="feather icon-minus minimize-card"></i></li>                                                                 <li><i class="feather icon-refresh-cw reload-card"></i></li>                                                                 <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>                                                             </ul>                                                         </div>
        </div>
        <div class="card-block">
            <div class="review-block">
                <?php $pesan = $this->db->where('status','new')->order_by('waktu','DESC')->get('ms_pesan',4)->result_array(); ?>
                <?php foreach ($pesan as $psn)  { ?>
                <div class="row">
                    <div class="col">
                        <h6 class="m-b-15"><?= $psn['nama'] ?>(<?= $psn['email'] ?>) <span class="float-right f-13 text-muted"> <?= waktu_lalu($psn['waktu']) ?></span></h6>
                        <p class="m-t-15 m-b-15 text-muted"><?= $psn['pesan'] ?></p>
                    </div>
                </div>
                        <?php } ?>
            </div>
            <div class="text-right  m-r-20">
            <a href="<?= site_url() ?>admin/pesan" class="m-r-30"><i class="feather icon-thumbs-up m-r-15"></i>Tampilkan Semua?</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-12">
    <!-- Profit Visitor Start -->
    <div class="card ">
        <div class="card-block ">
            <h2 class="text-center f-w-400 "><?php
$this->db->from('ms_penonton');
$this->db->group_by('email');
$query = $this->db->get();
$rowcount = $query->num_rows();
echo number_format($rowcount, 0, ',', '.');
?></h2>
            <p class="text-center text-muted ">Member</p>
            <div id="monthlyprofit-1" style="height:70px"></div>
            <div class="m-t-20">
            </div>
        </div>
    </div>
    <div class="card ">
        <div class="card-block ">
            <h2 class="text-center f-w-400 "><?php
                                        $this->db->from('views');
                                        $query = $this->db->get();
                                        $rowcount = $query->num_rows();
                                        echo number_format($rowcount,0,',','.');
                                        ?></h2>
            <p class="text-center text-muted ">Total Visit</p>
            <div id="monthlyprofit-2" style="height:70px"></div>
            <div class="m-t-20">
                <div class="row ">
                    <div class="col-6 text-center ">
                        <h6 class="f-20 f-w-400"><?php
                                        $tanggal = date("Ymd");
                                        $this->db->from('views');
                                        $this->db->where('tanggal', $tanggal);
                                        $query = $this->db->get();
                                        $rowcount = $query->num_rows();
                                        echo number_format($rowcount,0,',','.');
                                        ?></h6>
                        <p class="text-muted f-14 m-b-0">Hari Ini</p>
                    </div>
                    <div class="col-6 text-center ">
                        <h6 class="f-20 f-w-400"><?php
                                        $bln = date("m");
                                        $tgl = date("d");
                                        $thn = date("Y");
                                        $tglk = $tgl - 1;

                                        if ($tglk == '1' | $tglk == '2' | $tglk == '3' | $tglk == '4' | $tglk == '5' | $tglk == '6' | $tglk == '7' | $tglk == '8' | $tglk == '9') {
                                            $kemarin = $this->db->query("SELECT * FROM views WHERE tanggal='$thn-$bln-0$tglk'");
                                        } else {
                                            $kemarin = $this->db->query("SELECT * FROM views WHERE tanggal='$thn-$bln-$tglk'");
                                        }
                                        $kemarin1 = $kemarin->num_rows();
                                        echo number_format($kemarin1,0,',','.');
                                        ?></h6>
                        <p class="text-muted f-14 m-b-0">Kemarin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>