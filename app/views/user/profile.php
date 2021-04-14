<!-- Header -->
<div class="header bg-primary pb-6 d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">
    <div class="row">
        <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Halo <?= level('nama') ?></h1>
        <p class="text-white mt-0 mb-4">Ini adalah halaman profil Anda. Anda dapat melihat kemajuan yang telah Anda buat dengan pekerjaan Anda dan mengelola proyek atau tugas yang diberikan</p>
        </div>
    </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?= url() ?>/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center pb-2">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?= url('assets/img/theme/').(level('jk')=='L'?'team-1.jpg':'team-4.jpg') ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-6">
              <div class="text-center">
                <h5 class="h3">
                  <?= level('nama') ?>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni ni-location_pin mr-2"></i><?= level('email') ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?= user('level') ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i><?= level('alamat') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?= url('profile/edit-profile') ?>" method="post">
                <h6 class="heading-small text-muted mb-4">Informasi User</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" name="username" id="input-username" class="form-control" placeholder="Username" value="<?= user('username') ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" name="email" id="input-email" class="form-control" placeholder="jesse@example.com" value="<?= level('email') ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nama Awal</label>
                        <input type="text" name="first_name" id="input-first-name" class="form-control" placeholder="Nama Awal" value="<?= $nama_awal ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Nama Akhir</label>
                        <input type="text" name="last_name" id="input-last-name" class="form-control" placeholder="Nama Akhir" value="<?= $nama_akhir ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Alamat</label>
                        <input id="input-address" name="alamat" class="form-control" placeholder="Alamat Rumah" value="<?= level('alamat') ?>" type="text">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <div class="row">
                          <div class="col-8">
                            <input type="text" name="no_hp" class="form-control number" value="<?= level('no_hp') ?>">
                          </div>
                          <div class="col-4">
                            <button class="btn btn-primary col">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
              </form>
              <form action="<?= url('profile/ganti-sandi') ?>" method="post">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Ganti Kata Sandi</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Kata Sandi Lama</label>
                        <input type="password" name="pass_old" id="input-city" class="form-control" placeholder="Kata sandi lama">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Kata Sandi Baru</label>
                        <div class="row">
                          <div class="col-8">
                            <input type="password" name="pass_new" id="input-country" class="form-control" placeholder="Kata sandi baru">
                          </div>
                          <div class="col-4">
                            <button class="btn btn-primary col">Ganti Kata Sandi</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <script> 
        document.addEventListener('DOMContentLoaded', function(){
            $('#profile').addClass('active');
        })
    </script>