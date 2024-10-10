<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>Konfigurasi</h5>
        </div>
        <div class="card-block">
            <button type="button" class="btn btn-primary btn-round waves-effect waves-light" data-toggle="modal" onclick="editdata()"><i class="icofont icofont-plus-circle"></i> Edit</button>
            <div class="dt-responsive table-responsive">
                <table id="show-hide-res" class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Banner Barat</th>
                            <th>Tiket Barat</th>
                            <th>Banner Timur</th>
                            <th>Tiket Timur</th>
                            <th>Banner Selatan</th>
                            <th>Tiket Selatan</th>
                            <th>Banner Utara</th>
                            <th>Tiket Utara</th>
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
                "url": "<?php echo site_url('admin/config/listdata') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-8, -7, -6, -5, -4, -3, -2, -1], //2 last column (photo)
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


    function editdata()
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/config/edit') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_config"]').val(data.id_config);
                $('#photo-bbarat div').html('<img src="' + base_url + 'config/' + data.banner_barat + '" class="img-fluid">'); // show photo
                $('#photo-tbarat div').html('<img src="' + base_url + 'config/' + data.tiket_barat + '" class="img-fluid">'); // show photo
                $('#photo-btimur div').html('<img src="' + base_url + 'config/' + data.banner_timur + '" class="img-fluid">'); // show photo
                $('#photo-ttimur div').html('<img src="' + base_url + 'config/' + data.tiket_timur + '" class="img-fluid">'); // show photo
                $('#photo-bselatan div').html('<img src="' + base_url + 'config/' + data.banner_selatan + '" class="img-fluid">'); // show photo
                $('#photo-tselatan div').html('<img src="' + base_url + 'config/' + data.tiket_selatan + '" class="img-fluid">'); // show photo
                $('#photo-butara div').html('<img src="' + base_url + 'config/' + data.banner_utara + '" class="img-fluid">'); // show photo
                $('#photo-tutara div').html('<img src="' + base_url + 'config/' + data.tiket_utara + '" class="img-fluid">'); // show photo
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Update');


},
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

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
            url = "<?php echo site_url('admin/config/save') ?>";
        } else {
            url = "<?php echo site_url('admin/config/update') ?>";
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
                    <input type="hidden" name="id_config" value="">

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-institution"></i> Barat</label>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-bbarat">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filebb').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filebb" style="display: none" name="banner_barat" type="file" onchange="document.getElementById('namabb').value = this.value">
                                        <input class="form-control" id="namabb" type="text" onclick="document.getElementById('filebb').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-tbarat">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filetb').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filetb" style="display: none" name="tiket_barat" type="file" onchange="document.getElementById('namatb').value = this.value">
                                        <input class="form-control" id="namatb" type="text" onclick="document.getElementById('filetb').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Tiket </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-institution"></i> Timur</label>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-btimur">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filebt').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filebt" style="display: none" name="banner_timur" type="file" onchange="document.getElementById('namabt').value = this.value">
                                        <input class="form-control" id="namabt" type="text" onclick="document.getElementById('filebt').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-ttimur">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filett').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filett" style="display: none" name="tiket_timur" type="file" onchange="document.getElementById('namatt').value = this.value">
                                        <input class="form-control" id="namatt" type="text" onclick="document.getElementById('filett').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-institution"></i> Selatan</label>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-bselatan">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filebs').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filebs" style="display: none" name="banner_selatan" type="file" onchange="document.getElementById('namabs').value = this.value">
                                        <input class="form-control" id="namabs" type="text" onclick="document.getElementById('filebs').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-tselatan">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filets').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filets" style="display: none" name="tiket_selatan" type="file" onchange="document.getElementById('namats').value = this.value">
                                        <input class="form-control" id="namats" type="text" onclick="document.getElementById('filets').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-12 text-center "><i class="icofont icofont-institution"></i> Utara</label>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-butara">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filebu').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filebu" style="display: none" name="banner_utara" type="file" onchange="document.getElementById('namabu').value = this.value">
                                        <input class="form-control" id="namabu" type="text" onclick="document.getElementById('filebu').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row" id="photo-tutara">
                                    <div class="col-sm-12">
                                        [No Banner]
                                    </div>
                                </div>
                                <div class="material-group material-group-danger">
                                    <div class="material-addone">
                                        <a><i class="icofont icofont-ui-image" onclick="document.getElementById('filetu').click()"></i></a>
                                    </div>
                                    <div class="form-group form-danger form-static-label">
                                        <input class="form-control" id="filetu" style="display: none" name="tiket_utara" type="file" onchange="document.getElementById('namatu').value = this.value">
                                        <input class="form-control" id="namatu" type="text" onclick="document.getElementById('filetu').click()" placeholder="Insert File Banner">
                                        <span class="form-bar"></span>
                                        <label class="float-label" id="label-photo">Upload Banner </label>
                                    </div>
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

