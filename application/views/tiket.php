<html>
    <head></head>
    <body>
<?php $no=1; foreach ($master as $m) { ?>
        <?php
            $r = $this->db->where([
                    'id_config' => 1
                ])->get('ms_config')->row_array();
            $gambar='';
            if(substr($m['id_tribun'], 0,1)=='b'){
                $gambar=$r['tiket_barat'];
            }else if(substr($m['id_tribun'], 0,1)=='t'){
                $gambar=$r['tiket_timur'];
            }else if(substr($m['id_tribun'], 0,1)=='u'){
                $gambar=$r['tiket_utara'];
            }else if(substr($m['id_tribun'], 0,1)=='s'){
                $gambar=$r['tiket_selatan'];
            }
        ?>
        <div style="background-image: url(<?= base_url() ?>config/<?= $gambar ?>); background-size: contain; width: 793px; height: 78px; text-align: center">
            <div style=""><div style="color: black; font-size: 12px"><b>No.<?= $no++ ?></b></div>
            <img style="height: 50px" src="<?= base_url() . 'barcode/' . $m['id_tiket'] . '.jpg' ?>" alt="" >
            <img style="height: 50px" src="<?= base_url() . 'barcode/' . $m['id_tiket'] . '.png' ?>" alt="" >
            <div style="color: #ffffff; font-size: 8px"></div></div>
        </div>
<?php } ?>
    </body>
</html>