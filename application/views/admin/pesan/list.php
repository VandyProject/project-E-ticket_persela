<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>Pesan</h5>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="show-hide-res" class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Diterima</th>
                            <th>Kontak</th>
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
                "url": "<?php echo site_url('admin/pesan/listdata') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [-2], //2 last column (photo)
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

    function editdata(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/pesan/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_pesan"]').val(data.id_pesan);
                $('[name="waktu"]').val(data.waktu);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="pesan"]').val(data.pesan);
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Pesan'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Oke');

                


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
            $('#tambah').modal('hide');
            reload_table();

    }
    
    
    

    function deletedata(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/pesan/hapus') ?>/" + id,
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-material" id="form" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" name="id_pesan" value="">

                    

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-time"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="waktu" readonly="" class="form-control" type="text" value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Pesan Masuk</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-id-card"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="nama" readonly="" class="form-control" type="text" value="">
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
                                    <input name="email" readonly="" class="form-control" type="text" value="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-ui-message"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <textarea name="pesan" readonly="" class="form-control" type="text" value=""></textarea>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Pesan</label>
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