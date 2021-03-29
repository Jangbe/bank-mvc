<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create New Nasabah
</button>



<table class="table mt-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Nasabah</th>
      <th scope="col">Gender</th>
      <th scopr="col">No Telepon</th>
      <th scope="col">Email</th>
      <th scope="col">Alamat</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0; foreach($nasabah as $nsbh) : $i++ ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $nsbh['nm_nasabah'] ?></td>
      <td><?= $nsbh['jk'] ?></td>
      <td><?= $nsbh['no_hp'] ?></td>
      <td><?= $nsbh['email'] ?></td>
      <td><?= $nsbh['alamat'] ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Nasabah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="input-group mb-3">
              <select class="custom-select" name="id_user" id="">
                <?php foreach($users as $user) : ?>
                  <option value="<?= $user['id_user'] ?>"><?= $user['username'] ?></option>
                <?php endforeach; ?>
              </select>
          </div>

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" name="nm_nasabah" placeholder="Nama Lengkap">
          </div>

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
              </div>
              <select class="custom-select" name="jk" id="">
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
              </select>
          </div>

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" class="form-control" name="no_hp" placeholder="No telepon">
          </div>

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-envelope"></i></span>
              </div>
              <input type="text" class="form-control" name="email" placeholder="email@example.com">
          </div>

          <div class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="alamat"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>