<!-- Modal -->
<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserLabel">Buat User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="password" id="pass">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="custom-select" name="level" id="level">
                            <?php foreach($level as $k => $v) : ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div id="tingkat">
                        <div class="form-group">
                            <label for="nama">Nama Pegawai/Nasabah</label>
                            <input type="text" class="form-control" name="nm" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="custom-select" name="jk" id="jk">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat"></textarea>
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