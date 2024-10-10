<form class="form-material" id="formuser" enctype="multipart/form-data" method="POST" action="">
                    <div class="form-group row">
                        <?php foreach ($adm as $r) { ?>
                            <input type="hidden" name="id_user" value="<?= $r['id_user'] ?>">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-ui-password"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="lama" type="password" value="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password Lama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-key"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="baru" type="password" value="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password Baru</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <i class="icofont icofont-key-hole"></i>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" name="konfirmasi" type="password" value="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Konfirmasi Password</label>
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