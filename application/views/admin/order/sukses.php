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
                            <th>Waktu Verifed</th>
                            <th>Tiket</th>
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
                "url": "<?php echo site_url('admin/order/listfinddatasukses') ?>",
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



    

    
    

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    
    
    
    

    function deletedata(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/order/hapusall') ?>/" + id,
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