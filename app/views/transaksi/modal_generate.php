<!-- Modal Detail -->
<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= url('generate') ?>" target="_blank" method="post" id="modalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateModalLabel">Generate Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_nasabah">Pilih Nasabah</label>
                        <select name="id_nasabah" id="id_nasabah" class="custom-select select2" required>
                            <option value=""></option>
                            <option value="semua">Semua</option>
                            <?php foreach($nasabah as $nsbh) : ?>
                            <option value="<?= $nsbh['id_nasabah'] ?>"><?= $nsbh['nm_nasabah'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="all" id="all1" checked="true" class="form-check-input all">
                            <label for="all1" class="form-check-label">Pilih Semua Transaksi</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Pilih Tanggal</label>
                        <input type="text" id="date" name="dates" class="form-control date-detail">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Generate Transaksi Ini</button>
                </div>
            </form>
        </div>
    </div>
</div>