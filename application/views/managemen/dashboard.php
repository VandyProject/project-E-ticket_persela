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

<?php foreach($master as $m) { ?>
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-header">
            <h5><?= klub($m['nama_tuan_match'],'nama_klub') ?> VS <?= klub($m['nama_tamu_match'],'nama_klub') ?></h5>
        </div>
        <div class="card-block">
            <p class="text-purple text-center f-w-500"><i class="icofont icofont-network m-r-15"></i><?php if($m['type']=="O"){echo "Online Ticket";}else if($m['type']=="S"){echo "Semi Online";} ?> | <i class="icofont icofont-whisle m-r-15"></i><?= $m['status_match'] ?> | <i class="icofont icofont-kick m-r-15"></i><?= kompetisi($m['kompetisi_match'],'nama_kompetisi') ?> | <i class="icofont icofont-ui-calendar m-r-15"></i><?= tanggal($m['tanggal_match'],True) ?> | <i class="icofont icofont-time m-r-15"></i><?= $m['pukul_match'] ?> WIB | <i class="icofont icofont-field m-r-15"></i><?= $m['stadion_match'] ?></p>
            <div class="row">
                <?php $tribun = $this->crud->read('ms_tribun',['id_match' => $m['id_match'],'kuota_tribun !=' => 0]); ?>
                <?php $no=1; foreach($tribun as $t) { 
                    $mod=$no%2; 
                    if($t['kelas_tribun']=="Barat"){
                        $wrn = 'text-primary';
                    }else if($t['kelas_tribun']=="Timur"){
                        $wrn = 'text-success';
                    }else if($t['kelas_tribun']=="Selatan"){
                        $wrn = 'text-danger';
                    }else if($t['kelas_tribun']=="Utara"){
                        $wrn = 'text-warning';
                    }

                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status', 'used');
                    $this->db->from('ms_ticket');
                    $tic = $this->db->get()->num_rows();
                ?>
                <div class="col-6 <?php if($mod==1){echo "b-r-default";} ?>">
                    <p class="text-muted text-center m-b-5"><?= $t['kelas_tribun']; ?></p>
                    <h5 class="text-center <?= $wrn ?> m-b-5">
                    <?php
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status !=', 'baru');
                    $this->db->from('ms_penonton');
                    $terjual = $this->db->get()->row()->tot;
                    if($m['type']=="O"){
                        echo number_format($terjual, 0, ',', '.');
                    }else if($m['type']=="S"){
                        if($terjual>=$tic){
                            echo number_format($terjual, 0, ',', '.');
                        }else {
                            echo number_format((($tic-$terjual)+$terjual), 0, ',', '.'); 
                        }
                    }
                    
                    ?>
                    </h5>
                    <h5 class="text-center <?= $wrn ?> m-b-5">
                    <?php
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status !=', 'baru');
                    $this->db->from('ms_penonton');
                    $jml = ($this->db->get()->row()->tot)*$t['harga_tribun'];
                    if($m['type']=="O"){
                        echo rupiah($jml);
                    }else if($m['type']=="S"){
                        if($jml>=($tic*$t['harga_tribun'])){
                            echo rupiah($jml);
                        }else {
                            echo rupiah(($tic*$t['harga_tribun'])-$jml+$jml);
                        }
                    }
                   
                    ?>
                    </h5>
                    <h5 class="text-center <?= $wrn ?> m-b-5">
                    <?php
                    $this->db->select('SUM(jumlah) as tot');
                    $this->db->where('id_tribun', $t['id_tribun']);
                    $this->db->where('status !=', 'baru');
                    $this->db->from('ms_penonton');
                    $sm = $this->db->get()->row()->tot;
                    if($t['kuota_tribun']==0){
                        $prn=0;
                    }else{
                        $prn = $sm/$t['kuota_tribun']*100;
                    }

                    if($m['type']=="O"){
                        echo number_format($prn,2).'%';
                    }else if($m['type']=="S"){
                        
                        if($prn>=($tic/$t['kuota_tribun']*100)){
                            echo number_format($prn,2).'%';
                        }else {
                            echo number_format((($tic/$t['kuota_tribun']*100)-$prn+$prn),2).'%';
                        }
                    }
                   
                    ?>
                    </h5>
                </div>
                <?php $no++; } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php foreach($panpel as $p) { ?>
<div class="col-md-6 col-xl-4">
    <div class="card client-map">
        <div class="card-block">
            <div class="client-detail">
                <div class="client-profile">
                    <img src="<?= base_url() ?>foto/<?= $p['foto'] ?>" alt="">
                </div>
                <div class="client-contain">
                    <h5><?= $p['nama_user'] ?></h5>
                    <a href="#" class="text-muted" title="<?= $p['email'] ?> | <?= $p['no_hp'] ?>"><?= substr($p['email'],0,20) ?>..</a>
                    <p class="text-muted"><?= $p['hak_akses'] ?></p>
                </div>
            </div>
            <div class="">
                <div class="client-card-box">
                    <div class="row">
                        <div class="col-6 text-center client-border p-10">
                            <p class="text-muted m-0">Count</p>
                            <span class="text-c-green f-20 f-w-600"><?php
                                        $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0];
                                        $mtri = $this->crud->read('ms_tribun', ['id_match' => $j['id_match']]);
                                        
                                        $tb=0;
                                        foreach($mtri as $tri){
                                            $this->db->from('ms_penonton');
                                            $this->db->where('id_tribun',  $tri['id_tribun']);
                                            $this->db->where('panpel',  $p['id_user']);
                                            $query = $this->db->get();
                                            $tb = $tb+($query->num_rows());
                                        }
                                        
                                        $this->db->from('ms_ticket');
                                        $this->db->where('id_match',  $j['id_match']);
                                        $this->db->where('panpel',  $p['id_user']);
                                        $query = $this->db->get();
                                        $ta = $query->num_rows();
                                        echo number_format(($tb+$ta),0,',','.').' Ticket';
                                        ?></span>
                        </div>
                        <div class="col-6 text-center p-10">
                            <p class="text-muted m-0">Total</p>
                            <span class="text-c-green f-20 f-w-600"><?php
                                        $this->db->from('ms_ticket');
                                        $this->db->where('panpel',  $p['id_user']);
                                        $query = $this->db->get();
                                        $ta = $query->num_rows();
                                        $this->db->from('ms_penonton');
                                        $this->db->where('panpel',  $p['id_user']);
                                        $query = $this->db->get();
                                        $tb = $query->num_rows();
                                        echo number_format(($ta+$tb),0,',','.').' Ticket';
                                        ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>