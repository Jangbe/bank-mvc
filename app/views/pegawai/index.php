<?php include 'header.php' ?>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col">
        <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Daftar Pegawai</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <th width="2%">No</th>
                <th width="70%">Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </thead>
            <tbody class="list">
                <?php $i=0; foreach($operator as $nsbh): $i++ ?>
                    <tr>
                        <td>
                            <b><?= $i ?></b>
                        </td>
                        <td>
                            <span class="text-muted"><?= ucwords($nsbh['nm_pegawai']) ?></span>
                        </td>
                        <td>
                            <span class="badge badge-<?= $nsbh['jk'] == 'L'? 'primary' : 'warning' ?>">
                                <?= $nsbh['jk'] == 'L'? 'Laki-laki' : 'Perempuan'  ?>
                            </span>
                        </td>
                        <td>
                            <span class="text-muted"><?= ucwords($nsbh['no_hp']) ?></span>
                        </td>
                        <td>
                            <span class="text-muted"><?= ucwords($nsbh['email']) ?></span>
                        </td>
                        <td>
                            <span class="text-muted"><?= ucwords($nsbh['alamat']) ?></span>
                        </td>
                        <td>
                            <button class="btn btn-success edit-pegawai" data-id="<?= $nsbh['id_pegawai']; ?>">
                                <i class="fas fa-edit"></i>
                                <span class="d-none d-md-inline">Edit</span>
                            </button> 
                            <form style="display: inline" action="<?= url('admin/operator/delete/').$nsbh['id_pegawai'] ?>" method="post">
                                <button type="button" class="btn btn-danger delete-nasabah" data-id="<?= $nsbh['id_pegawai']; ?>">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none d-md-inline">Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<?php include 'modal.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#operator').addClass('active');

        $('.delete-nasabah').on('click', function(){
            let id_pegawai = $(this).data('id');
            let hapus = $(this);
            $.ajax({
                url: "<?= url('ajax_pegawai') ?>",
                method: "post",
                data: {id_pegawai, id_pegawai},
                success: function(result){
                    result = JSON.parse(result);
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        html: `nasabah <b>${result.nm_pegawai}</b> akan terhapus selamanya!`,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak'
                    }).then(hasil => {
                        console.log(hapus[0].form);
                        if(hasil.value){hapus[0].form.submit()}
                    });
                }
            });
        });

        $('#buatPegawai').click(function(){
            $('#id_user').attr('disabled', false);
            $('#nm_pegawai').val('');
            $('#jk').val('');
            $('#no_hp').val('');
            $('#email').val('');
            $('#alamat').val('');
            $('#id_user').val('');
            
            $('#modalForm').attr('action', "<?= url(user('level').'/operator/create') ?>");
            $('#createUser').modal('show');
        });

        $('.edit-pegawai').click(function(e){
            let id_pegawai = $(this).data('id');
            console.log(id_pegawai);
            $.ajax({
                url: "<?= url('ajax_pegawai') ?>",
                method: 'post',
                data: {id_pegawai : id_pegawai},
                success: function(result){ 
                  result = JSON.parse(result);
                  
                  $('#id_user').attr('disabled', true);
                  $('#nm_pegawai').val(result.nm_pegawai);
                  $('#jk').val(result.jk);
                  $('#no_hp').val(result.no_hp);
                  $('#email').val(result.email);
                  $('#alamat').val(result.alamat);
                  $('#id_user').val(result.id_user);

                  $('#modalForm').attr('action', "<?= url(user('level').'/operator/edit/') ?>"+result.id_pegawai);
                  $('#createUser').modal('show');
                }
            });
        })

    });
</script>