<!-- Modal -->
<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createNasabahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNasabahLabel">Buat Nasabah Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_user">User</label>
                        <select class="custom-select" name="id_user" id="id_user">
                        <?php foreach($users as $user) :  ?>
                            <option value="<?= $user['id_user'] ?>"><?= $user['username'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nm_pegawai">Nama Lengkap</label>
                        <input required type="text" class="form-control" name="nm_pegawai" id="nm_pegawai">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select required class="custom-select" name="jk" id="jk">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input required type="text" class="form-control" name="no_hp" id="no_hp">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea required class="form-control" name="alamat" id="alamat"></textarea>
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