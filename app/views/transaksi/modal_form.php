<!-- Modal -->
<div class="modal fade" id="addTransaksi" tabindex="-1" role="dialog" aria-labelledby="addTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= url($_SESSION['user']['level'].'/transaksi/add') ?>" method="post" id="modalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiLabel">Buat Transaksi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="norek">No Rekening</label>
                        <select name="norek" id="norek" class="custom-select select2">
                            <option value=""></option>
                            <?php foreach($rekening as $rek) : ?>
                            <option value="<?= $rek['no_rekening'] ?>"><b><?= $rek['no_rekening'] ?></b> --<?= $rek['nm_nasabah'] ?>--</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pin">PIN Rekening</label>
                        <input type="password" id="pin" class="form-control pin" name="pin">
                    </div>
                    <div class="form-group">
                        <label for="jns_transaksi">Jenis Transaksi</label>
                        <select name="jns_transaksi" id="jns_transaksi" class="custom-select">
                            <?php foreach(transaksi() as $k => $tr) : ?>
                                <option value="<?= $k ?>"><?= $tr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span for="nominal" class="input-group-text">Rp. </span>
                            </div>
                            <input type="text" class="form-control pin" name="nominal" id="nominal">
                        </div>
                    </div>
                    <div id="tf">
                        <div class="form-group">
                            <label for="no_tf">No Rekening Transfer</label>
                            <select name="no_tf" id="no_tf" class="custom-select select2">
                                <option value=""></option>
                                <?php foreach($rekening as $rek) : ?>
                                <option value="<?= $rek['no_rekening'] ?>"><b><?= $rek['no_rekening'] ?></b> --<?= $rek['nm_nasabah'] ?>--</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jns_pembayaran">Jenis Pembayaran</label>
                            <select name="jns_pembayaran" id="jns_pembayaran" class="custom-select">
                                <option value="1">--Cicilan--</option>
                                <option value="2">Pembayaran Tunai</option>
                                <option value="3">Pembayaran Hutang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea id="keterangan" class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>