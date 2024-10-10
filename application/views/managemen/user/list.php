<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>User</h5>
        </div>
        <div class="card-block">
            <button type="button" class="btn btn-primary btn-round waves-effect waves-light" data-toggle="modal" onclick="add()"><i class="icofont icofont-plus-circle"></i> Tambah</button>
            <div class="dt-responsive table-responsive">
                <table id="show-hide-res" class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {

        //datatables
        table = $('.dataTable').DataTable({
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'Bi><'col-sm-6'p>>",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pagingType": "full_numbers",
            responsive: true,
            buttons: [
                'excel', 'copy', 'pdf'
            ],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('managemen/user/listdata') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],
            language: {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 Data",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "&laquo;",
                    "sPrevious": "&lsaquo;",
                    "sNext": "&rsaquo;",
                    "sLast": "&raquo;"
                }
            }
        });



        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });



    function add()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#tambah').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah User'); // Set Title to Bootstrap modal title
        $('#btnSave').text('Simpan');
        $('#photo-preview').hide(); // hide photo preview modal
        $('#label-photo').text('Upload Foto'); // label photo upload
    }

    function editdata(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('managemen/user/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_user"]').val(data.id_user);
                $('[name="username"]').val(data.username);
                $('[name="nama_user"]').val(data.nama_user);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="email"]').val(data.email);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="password"]').val(data.password);
                $('[name="hak_akses"]').val(data.hak_akses);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                $('[name="alamat"]').val(data.alamat);
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit User'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Update');
                $('#photo-preview').show(); // hide photo preview modal

                if (data.foto)
                {
                    $('#label-photo').text('Change Foto'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'foto/' + data.foto + '" class="img-fluid">'); // show photo
                } else
                {
                    $('#label-photo').text('Upload Foto'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/no-image.png" class="img-fluid">');
                }


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    $(document).on('click', '.kuot', function() {
                var href = $(this).attr('rel');
		var CaptionHeader = 'Tiket Pertandingan ' + $(this).text();
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-dialog').addClass('modal-lg');
		$('#modaljudul').html(CaptionHeader);
		$('#modalisi').load(href);
		$('#modalfooter').html('<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button><button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="simpankuota()">Update</button>');
		$('#modalku').modal('show');
	});

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function save()
    {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('managemen/user/save') ?>";
        } else {
            url = "<?php echo site_url('managemen/user/update') ?>";
        }

        // ajax adding data to database

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#tambah').modal('hide');
                    reload_table();
                } else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
    
    function simpankuota()
    {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url = "<?php echo site_url('managemen/jadwal/uptribun') ?>";

        // ajax adding data to database

        var formData = new FormData($('#formtiket')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modalku').modal('hide');
                    reload_table();
                } else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
    

    function deletedata(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('managemen/user/hapus') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        
    }
    
    
    $(document).on('click', '.pen', function() {
                var href = $(this).attr('rel');
                swal({
                    title: "Open Tiket Online?",
                    text: "Anda Yakin ingin membuka sistem Tiket Online?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Saya yakin!",
                    closeOnConfirm: false
                },
                function() {
                    swal({
                        title: "Terbuka!",
                        text: "Sistem Tiket Online Sudah Terbuka.",
                        type: "success"
                    },
                    function() {
                        opensistem(href);
                    });
                });

                return false;
            });
         
         function opensistem(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/jadwal/open') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        
    }
    


</script>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-material" id="form" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" name="id_user" value="">
                    <input type="hidden" name="password" value="">
                    <input type="hidden" name="hak_akses" value="">

                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-id-card"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input type="text" class="form-control" name="username"  value="">
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
                                    <input type="text" class="form-control" name="nama_user"  value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nama</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-ui-email"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input type="email" class="form-control" name="email"  value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-telephone"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input type="text" class="form-control" name="no_hp"  value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">No. HP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-ui-calendar"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input type="text" class="form-control" name="tgl_lahir" id="date" value="">
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
                                        <option value="" default selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
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
                                    <input type="text" class="form-control" name="alamat" value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Alamat</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="form-group row" id="photo-preview">
                        <div class="col-sm-12">
                            [No Banner]
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <a><i class="icofont icofont-ui-image" onclick="document.getElementById('fileup').click()"></i></a>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input class="form-control" id="fileup" style="display: none" name="foto" type="file" onchange="document.getElementById('namafile').value=this.value">
                                    <input class="form-control" id="namafile" type="text" onclick="document.getElementById('fileup').click()" placeholder="Insert File Foto">
                                    <span class="form-bar"></span>
                                    <label class="float-label" id="label-photo">Upload Foto </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalku" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modaljudul"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalisi">
                
            </div>
            <div class="modal-footer" id="modalfooter"></div>
        </div>
    </div>
</div>

<script>
		$('#modalku').on('hide.bs.modal', function () {
		   setTimeout(function(){ 
		   		$('#modaljudul, #modalisi, #modalfooter').html('');
		   }, 500);
		});
		</script>
