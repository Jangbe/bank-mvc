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
                        <label for="date">Pilih Tanggal</label>
                        <input type="text" id="date" name="dates" class="form-control ">
                    </div>
                    <div class="form-group">
                        <label for="nasabah">Pilih Nasabah</label>
                        <select name="nasabah" id="nasabah" class="custom-select">
                            <option value="semua">Semua</option>
                        </select>
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