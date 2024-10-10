<form class="form-material" id="formuser" enctype="multipart/form-data" method="POST" action="">
                    <div class="form-group row">
                        <?php foreach ($adm as $r) { ?>
                            <input type="hidden" name="id_user" value="<?= $r['id_user'] ?>">
                        <div class="col-sm-12">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-support"></i> Jabatan <?= $r['hak_akses'] ?></label>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-id-card"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="username" type="text" value="<?= $r['username'] ?>" readonly>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-law-document"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="nama_user" type="text" value="<?= $r['nama_user'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-telephone"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="no_hp" type="text" value="<?= $r['no_hp'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">No HP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-ui-email"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="email" type="text" value="<?= $r['email'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-ui-calendar"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="tgl_lahir" type="text" id="date" value="<?= $r['tgl_lahir'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Tanggal Lahir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-users-alt-4"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="" default selected disabled>Pilih Status</option>
                                        <option value="L" <?= isset($r['jenis_kelamin']) && $r['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="P" <?= isset($r['jenis_kelamin']) && $r['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Jenis Kelamin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-ui-map"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                    <input class="form-control" name="alamat" type="text" value="<?= $r['alamat'] ?>">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Alamat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                <img class="img-fluid" src="<?= base_url() ?>foto/<?= $r['foto'] ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('fileup').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="fileup1" style="display: none" name="foto" type="file" onchange="document.getElementById('namafile1').value=this.value">
                                        <input class="form-control" id="namafile1" type="text" onclick="document.getElementById('fileup1').click()" placeholder="Insert File Foto">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Change Foto </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>
                        </div>
                </form>

                <script>
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