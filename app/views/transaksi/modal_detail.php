<!-- Modal Detail -->
<div class="modal fade" id="detailTransaksi" tabindex="-1" role="dialog" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= url('generate') ?>" target="_blank" method="post" id="modalForm">
                <input type="hidden" name="id_nasabah" id="id_nasabah">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTransaksiLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table width="100%" class="table align-items-center table-flush" id="detailTransaksiNasabah">
                            <thead class="thead-light">
                                <th>No Rekening</th>
                                <th>Nominal</th>
                                <th>Jenis Transaksi</th>
                                <th>Waktu</th>
                            </thead>
                            <tbody class="list">
                            
                            </tbody>
                        </table>
                    </div>
                    <?php if(user('level') == 'admin') : ?>
                    <hr>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="all" id="all" checked="true" class="form-check-input all">
                            <label for="all" class="form-check-label">Pilih Semua Transaksi</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" id="pilih-tanggal">Pilih Tanggal Generate Laporan</label>
                        <input disabled type="text" id="date-detail" name="dates" class="form-control date-detail">
                    </div>
                    <?php endif ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Generate Transaksi Ini</button>
                </div>
            </form>
        </div>
    </div>
</div>