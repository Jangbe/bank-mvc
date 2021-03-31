<!-- Modal Detail -->
<div class="modal fade" id="detailTransaksi" tabindex="-1" role="dialog" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
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
                                <th>Waktu</th>
                                <th>Nominal</th>
                                <th>Jenis Transaksi</th>
                            </thead>
                            <tbody class="list">
                            
                            </tbody>
                        </table>
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