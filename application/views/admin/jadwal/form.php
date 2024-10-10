<form class="form-material" id="formtiket" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" name="id_match" value="">
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php foreach ($pertandingan as $p) { ?>
                            <?php $k1 = $this->crud->read('ms_kompetisi', ['id_kompetisi' => $p['kompetisi_match']])[0] ?>
                            <?php $k2 = $this->crud->read('ms_klub', ['id_klub' => $p['nama_tuan_match']])[0] ?>
                            <?php $k3 = $this->crud->read('ms_klub', ['id_klub' => $p['nama_tamu_match']])[0] ?>
                            <h4 class="text-center"><?= $k2['nama_klub'] ?> VS <?= $k3['nama_klub'] ?></h4>
                            <h5 class="text-center"><?= $k1['nama_kompetisi'] ?> | <?= $p['status_match'] ?> | <?= tanggal($p['tanggal_match'],true) ?> | <?= substr($p['pukul_match'],0,5) ?> WIB | @<?= $p['stadion_match'] ?></h5>
                            <input type="hidden" name="id" value="<?= $p['id_match'] ?>">
                                <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <?php foreach ($data as $r) { ?>
                        <div class="col-sm-6">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-institution"></i> Tribun <?= $r['kelas_tribun'] ?></label>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-plane-ticket"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="kelas_<?= $r['kelas_tribun'] ?>" type="number" value="<?= $r['kuota_tribun'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Kuota</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-bill-alt"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="harga_<?= $r['kelas_tribun'] ?>" type="number" value="<?= $r['harga_tribun'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Harga</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                        <?php if($p['type'] == 'S'){ ?>
                    <div class="col-sm-12">
                        <a class="text-primary text-center" href="<?= site_url() ?>admin/jadwal/generate/<?= $p['id_match'] ?>" title="Print"><i class="icofont icofont-2x icofont-download"></i></a>
                    </div>
                        <?php } ?>
                        
                        
                    

                </form>