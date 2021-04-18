<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Nasabah</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="#">Transfer</a></li>
            </ol>
            </nav>
        </div>
        </div>
    </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Histori Transaksi</h3>
                </div>
                <div class="card-body">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="logTransaksi">
                        <thead class="thead-light ">
                            <th width="2%">No</th>
                            <th>No Rekening</th>
                            <th>Nominal</th>
                            <th>Jenis Transaksi</th>
                            <th>Waktu</th>
                        </thead>
                        <tbody class="list">
                            <?php $i=0; foreach($transaksi as $tr): $i++ ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td class="text-danger"><?= $tr['no_ku'] ?></td>
                                    <td class="text-center font-weight-bold"><?= rupiah($tr['nominal']) ?></td>
                                    <td class="text-success">
                                        <?= $tr['jns_transaksi']=='tf'?'Transfer':ucwords($tr['jns_transaksi']) ?>
                                        <?= $tr['jns_transaksi']!='tf'?:'<button class="btn btn-sm btn-info ml-2" onclick="detail_transaksi('.$tr['id_transaksi'].')">Detail</button' ?>
                                    </td>
                                    <td class="text-warning"><?= date('d M Y',strtotime($tr['waktu'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transfer Uang -->
        <div class="col-xl-4">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Transfer Uang</h3>
                </div>
                <div class="card-body">
                    <!-- Light table -->
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="norek">Pilih No Rekening Mu</label>
                            <select name="norek" id="norek" class="custom-select">
                                <?php foreach($rekening as $rek) : ?>
                                <option value="<?= $rek['no_rekening'] ?>"><?= $rek['no_rekening'].' (Saldo Rp. '.number_format($rek['saldo'], 0,',','.').',00)' ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pin">PIN Mu</label>
                            <input type="password" class="form-control pin" name="pin">
                        </div>
                        <div class="form-group">
                            <label for="no_tf">Pilih No Rekening Transfer</label>
                            <select name="no_tf" id="no_tf" class="custom-select">
                                <option value=""></option>
                                <?php foreach($rekening_transfer as $rek) : ?>
                                <option value="<?= $rek['no_rekening'] ?>"><b><?= $rek['no_rekening'] ?></b> --<?= $rek['nm_nasabah'] ?>--</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control pin">
                        </div>
                        <div class="form-group">
                        <label for="jns_pembayaran">Jenis Pembayaran</label>
                            <select name="jns_pembayaran" id="jns_pembayaran" class="custom-select">
                                <option value="spp">Bayar SPP</option>
                                <option value="hutang">Bayar Hutang</option>
                                <option value="cicil">Bayar Cicilan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailTransfer" tabindex="-1" role="dialog" aria-labelledby="detailTransferLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTransferLabel">Detail Transfer <?= level('nama') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function detail_transaksi(id_transaksi){
            $.ajax({
                url:"<?= url('ajax_transfer') ?>",
                method: 'post',
                data: {id_transaksi},
                success: function(result){
                    console.log(result);
                    result = JSON.parse(result);
                    $('#detailTransfer').modal('show');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function(){
            $('#transfer').addClass('active');

            $('#norek_transfer').select2();

            //validasi input pin harus angka
            $('.pin').on('keydown', function(e){
                if(e.key.length === 1 && e.key.match(/[a-z]/i)){
                    e.preventDefault();
                }
            });
        });
    </script>