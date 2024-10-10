<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>Penjualan Tiket</h5>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="show-hide-res" class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Konfirmasi</th>
                            <th>Data Penonton</th>
                            <th>Pertandingan</th>
                            <th>Tiket - Total</th>
                            <th>Data Bank</th>
                            <th>Nominal Bayar</th>
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
                "url": "<?php echo site_url('admin/order/listfinddatapending') ?>",
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


    });

    function bukti(id)
    {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/order/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_penonton"]').val(data.id_penonton);
                $('#bukti').modal('show'); // show bootstrap modal
                $('.modal-title').text('Bukti Pembayaran'); // Set Title to Bootstrap modal title
                $('#photo-preview').show();
                $('#photo-preview div').html('<img src="' + base_url + 'resi/' + data.resi + '" class="img-fluid">'); // show photo

                


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function kirim()
    {
        $('#btnkirim').text('Mengirim...'); //change button text
        $('#btnkirim').attr('disabled', true); //set button disable 
        var url;
        url = "<?php echo site_url('admin/order/kirim') ?>";

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
                    $('#bukti').modal('hide');
                    reload_table();
                } else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnkirim').text('Simpan'); //change button text
                $('#btnkirim').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $('#bukti').modal('hide');
                    reload_table();

            }
        });
    }
    

    
    

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    

    function deletedata(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/order/hapus') ?>/" + id,
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

<div class="modal fade" id="bukti" tabindex="-1" role="dialog">
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
                    <input type="hidden" name="id_penonton" value="">

                    <div class="form-group row" id="photo-preview">
                        <div class="col-sm-12">
                            [No Banner]
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnkirim" onclick="kirim()">Kirim Tiket</button>
            </div>
        </div>
    </div>
</div>