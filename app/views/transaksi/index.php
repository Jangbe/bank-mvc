<?php include 'header.php' ?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col">
        <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Daftar Rekening</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
            <thead class="thead-light ">
                <th width="2%">No</th>
                <th>No Rekening</th>
                <th width="48%">Nama Nasabah</th>
                <th>Jumlah Transaksi</th>
                <th>Aksi</th>
            </thead>
            <tbody class="list">
                <?php $i=0; foreach($transaksi as $tr): $i++ ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td class="text-success"><?= $tr['no_rekening'] ?></td>
                        <td class="text-muted"><?= $tr['nm_nasabah'] ?></td>
                        <td class="text-center font-weight-bold"><?= $tr['jml'] ?></td>
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

<?php include 'modal_form.php' ?>

<?php include 'modal_detail.php' ?>

<?php include 'modal_generate.php' ?>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#transaksi').addClass('active');

        $('input[name="dates"]').daterangepicker({
            opens: 'left',
            drops: 'auto',
            format: 'YYYY-MM-DD'
        });

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

        $('.detail-transaksi').click(function(e){
            let id = $(this).data('id');
            $.ajax({
                url: "<?= url('ajax_transaksi') ?>",
                method: 'post',
                data: {id},
                success: function(result){
                    result = JSON.parse(result);
                    $('#detailTransaksiLabel').text("Detail Transaksi "+result[0].nm_nasabah);
                    console.log(result[0].no_rekening);
                    $('#id_nasabah').val(result[0].id_nasabah);
                    $('#detailTransaksiNasabah').DataTable({
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
                    })
                }
            })
            $('#detailTransaksi').modal('show');
        })
        
    });
</script>