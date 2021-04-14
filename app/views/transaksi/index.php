<?php include 'header.php' ?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Histori Transaksi</h3>
            </div>
            <div class="card-body  mx--4">
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" width="100%">
                    <thead class="thead-light ">
                        <th width="2%">No</th>
                        <th width="48%">Nama Nasabah</th>
                        <th class="d-none d-md-block">Email</th>
                        <th>Jumlah Rekening</th>
                        <th>Jumlah Transaksi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody class="list">
                        <?php $i=0; foreach($transaksi as $tr): $i++ ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td class="text-success"><?= $tr['nm_nasabah'] ?></td>
                                <td class="text-warning d-none d-md-block"><?= $tr['email'] ?></td>
                                <td class="text-center font-weight-bold"><?= $tr['rekening']['jumlah'] ?></td>
                                <td class="text-center font-weight-bold"><?= $tr['transaksi']['jumlah'] ?></td>
                                <td>
                                    <button class="btn btn-success detail-transaksi" data-id="<?= $tr['id_nasabah'] ?>">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="d-none d-md-inline">
                                            Detail
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'modal_form.php' ?>

<?php include 'modal_detail.php' ?>

<?php if(user('level') == 'admin'){include 'modal_generate.php';} ?>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        function isDisabled(check){
            if(check){
                $('#pilih-tanggal').addClass('text-muted');
                $('#date-detail').attr('disabled', true);
            }else{
                $('#pilih-tanggal').removeClass('text-muted');
                $('#date-detail').attr('disabled', false);
            }
        }
        var check = true;
        isDisabled(check);
        
        $.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
            if(check){
                return true;
            }
            let date = $('#date-detail').val() || '12/12/1212 - 12/12/1212';
            date = date.split(' - ');
            let waktu = data[3].split(' ')[0];
            date = date.map(function(tgl){
                tgl = new Date(tgl);
                var d = tgl.getDate();
                var m = tgl.getMonth() + 1;
                var y = tgl.getFullYear();
                return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
            });
            return waktu >= date[0] && waktu <= date[1];
        });

        $('#transaksi').addClass('active');

        $('input[name="dates"]').daterangepicker({
            opens: 'left',
            drops: 'auto',
            format: 'YYYY-MM-DD'
        });

        $('.select2').select2();

        //validasi input pin harus angka
        $('.pin').on('keydown', function(e){
            if(e.key.length === 1 && e.key.match(/[a-z]/i)){
                e.preventDefault();
            }
        });

        if($('#jns_transaksi').val()=='tf'){
            $('#tf').fadeIn(700);
        }else{
            $('#tf').fadeOut(500);
        }
        $('#jns_transaksi').change(function(){
            if($(this).val() == 'tf'){
                $('#tf').fadeIn(700);
            }else{
                $('#tf').fadeOut(500);
            }
        })

        $('#buatRekening').click(function(){
            $('#addTransaksi').modal('show');
        });

        let table = null;

        $('.detail-transaksi').click(function(e){
            let id = $(this).data('id');
            $.ajax({
                url: "<?= url('ajax_transaksi') ?>",
                method: 'post',
                data: {id},
                success: function(result){
                    result = JSON.parse(result);
                    $('#detailTransaksiLabel').text("Detail Transaksi "+result[0].nm_nasabah);
                    $('#id_nasabah').val(result[0].id_nasabah);
                    table = $('#detailTransaksiNasabah').DataTable({
                        data: result,
                        destroy: true,
                        "bSort" : false,
                        columns: [
                            {data: 'no_rekening'},
                            {data: 'nominal'},
                            {data: 'jns_transaksi'},
                            {data: 'waktu'},
                        ],
                        "language": {
                            "oPaginate": {
                                "sNext": "<i class='ni ni-bold-right'></i>",
                                "sPrevious": "<i class='ni ni-bold-left'></i>"
                            }
                        }
                    });
                }
            })
            $('#detailTransaksi').modal('show');
        });

        $('#all').change(function(){
            check = $(this).is(':checked');
            isDisabled(check);
            table.draw();
        })

        $('#date-detail').change(function(){
            table.draw();
        });
        
    });
</script>