<?php $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0]; ?>
<?php if($j['tanggal_match'] == date('Y-m-d')) { ?>
<div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block text-center">
            <i class="icofont icofont-5x icofont-hand-drawn-left text-c-blue d-block f-40"></i>
            <h4 class="m-t-20"><span class="text-c-blue">
                <?php
                $j = $this->crud->read('ms_match', ['tanggal_match >=' => date('Y-m-d')], 'tanggal_match ASC', 1)[0];
                $b = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Barat'])[0];
                echo number_format($b['kuota_tribun'], 0, ',', '.');
                ?>
            </span> Ticket</h4>
            <h4><span class="text-c-blue">
                <?php
                if($j['type']=="O"){
                $this->db->select('SUM(jumlah) as tot');
                $this->db->where('id_tribun', $b['id_tribun']);
                $this->db->where('status', 'done');
                $this->db->from('ms_penonton');
                $barat = $this->db->get()->row()->tot;
                echo number_format($barat, 0, ',', '.');
                }else if($j['type']=="S"){
                $this->db->where('id_tribun', $b['id_tribun']);
                $this->db->where('status', 'used');
                $this->db->from('ms_ticket'); 
                $barat = $this->db->get()->num_rows();
                echo number_format($barat, 0, ',', '.');
                }
                ?>
            </span> Masuk</h4>
            <p class="m-b-20"><?= klub($j['nama_tuan_match'],'nama_klub') ?> VS <?= klub($j['nama_tamu_match'],'nama_klub') ?></p>
            <button class="btn btn-primary btn-sm btn-round">Tribun <?= $b['kelas_tribun'] ?></button>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block text-center">
            <i class="icofont icofont-5x icofont-hand-drawn-right text-c-green d-block f-40"></i>
            <h4 class="m-t-20"><span class="text-c-green">
                <?php
                $t = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Timur'])[0];
                echo number_format($t['kuota_tribun'], 0, ',', '.');
                ?>
                </span> Ticket</h4>
            <h4><span class="text-c-green">
            <?php
                if($j['type']=="O"){
                $this->db->select('SUM(jumlah) as tot');
                $this->db->where('id_tribun', $t['id_tribun']);
                $this->db->where('status', 'done');
                $this->db->from('ms_penonton');
                $timur = $this->db->get()->row()->tot;
                echo number_format($timur, 0, ',', '.');
                }else if($j['type']=="S"){
                $this->db->where('id_tribun', $t['id_tribun']);
                $this->db->where('status', 'used');
                $this->db->from('ms_ticket'); 
                $timur = $this->db->get()->num_rows();
                echo number_format($timur, 0, ',', '.');
                }
                ?>
                </span> Masuk</h4>
            <p class="m-b-20"><?= klub($j['nama_tuan_match'],'nama_klub') ?> VS <?= klub($j['nama_tamu_match'],'nama_klub') ?></p>
            <button class="btn btn-success btn-sm btn-round">Tribun <?= $t['kelas_tribun'] ?></button>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block text-center">
            <i class="icofont icofont-5x icofont-hand-drawn-down text-c-red d-block f-40"></i>
            <h4 class="m-t-20"><span class="text-c-red">
                <?php
                $s = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Selatan'])[0];
                echo number_format($s['kuota_tribun'], 0, ',', '.');
                ?>
                </span> Ticket</h4>
            <h4><span class="text-c-red">
            <?php
                if($j['type']=="O"){
                $this->db->select('SUM(jumlah) as tot');
                $this->db->where('id_tribun', $s['id_tribun']);
                $this->db->where('status', 'done');
                $this->db->from('ms_penonton');
                $selatan = $this->db->get()->row()->tot;
                echo number_format($selatan, 0, ',', '.');
                }else if($j['type']=="S"){
                $this->db->where('id_tribun', $s['id_tribun']);
                $this->db->where('status', 'used');
                $this->db->from('ms_ticket'); 
                $selatan = $this->db->get()->num_rows();
                echo number_format($selatan, 0, ',', '.');
                }
                ?>
                </span> Masuk</h4>
            <p class="m-b-20"><?= klub($j['nama_tuan_match'],'nama_klub') ?> VS <?= klub($j['nama_tamu_match'],'nama_klub') ?></p>
            <button class="btn btn-danger btn-sm btn-round">Tribun <?= $s['kelas_tribun'] ?></button>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block text-center">
            <i class="icofont icofont-5x icofont-hand-drawn-up text-c-yellow d-block f-40"></i>
            <h4 class="m-t-20"><span class="text-c-yellow">
                <?php
                $u = $this->crud->read('ms_tribun', ['id_match' => $j['id_match'], 'kelas_tribun' => 'Utara'])[0];
                echo number_format($u['kuota_tribun'], 0, ',', '.');
                ?>
                </span> Ticket</h4>
            <h4><span class="text-c-yellow">
            <?php
                if($j['type']=="O"){
                $this->db->select('SUM(jumlah) as tot');
                $this->db->where('id_tribun', $u['id_tribun']);
                $this->db->where('status', 'done');
                $this->db->from('ms_penonton');
                $utara = $this->db->get()->row()->tot;
                echo number_format($utara, 0, ',', '.');
                }else if($j['type']=="S"){
                $this->db->where('id_tribun', $u['id_tribun']);
                $this->db->where('status', 'used');
                $this->db->from('ms_ticket'); 
                $utara = $this->db->get()->num_rows();
                echo number_format($utara, 0, ',', '.');
                }
                ?>
                </span> Masuk</h4>
            <p class="m-b-20"><?= klub($j['nama_tuan_match'],'nama_klub') ?> VS <?= klub($j['nama_tamu_match'],'nama_klub') ?></p>
            <button class="btn btn-warning btn-sm btn-round">Tribun <?= $u['kelas_tribun'] ?></button>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-block text-center">
            <i class="icofont icofont-5x icofont-football-alt text-c-red d-block f-40"></i>
            <h4 class="m-t-20"><span class="text-c-red">Tidak Pertandingan Hari Ini</span></h4>
            <button class="btn btn-danger btn-sm btn-round">Salam Dari Admin :)</button>
        </div>
    </div>
</div>
<?php  } ?>