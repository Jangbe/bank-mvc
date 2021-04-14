<?php include 'header.php'; ?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Daftar Nasabah</h3>
                </div>
                <div class="card-body mx--4">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <th width="2%">No</th>
                            <th width="70%">Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody class="list">
                            <?php $i=0; foreach($nasabah as $nsbh): $i++ ?>
                                <tr>
                                    <td>
                                        <b><?= $i ?></b>
                                    </td>
                                    <td>
                                        <span class="text-muted"><?= ucwords($nsbh['nm_nasabah']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= $nsbh['jk'] == 'L'? 'primary' : 'warning' ?>">
                                            <?= $nsbh['jk'] == 'L'? 'Laki-laki' : 'Perempuan'  ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted"><?= ucwords($nsbh['email']) ?></span>
                                    </td>
                                    <td>
                                        <span class="text-muted"><?= ucwords($nsbh['alamat']) ?></span>
                                    </td>
                                    <td>
                                        <button class="btn btn-success edit-nasabah" data-id="<?= $nsbh['id_nasabah']; ?>">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </button> 
                                        <form style="display: inline" action="<?= url('operator/nasabah/delete/').$nsbh['id_nasabah'] ?>" method="post">
                                            <button type="button" class="btn btn-danger delete-nasabah" data-id="<?= $nsbh['id_nasabah']; ?>">
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
    </div>

<?php include 'modal.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#nasabah').addClass('active');

        $('.delete-nasabah').on('click', function(){
            let id_nasabah = $(this).data('id');
            let hapus = $(this);
            $.ajax({
                url: "<?= url('ajax_nasabah') ?>",
                method: "post",
                data: {id_nasabah, id_nasabah},
                success: function(result){
                    result = JSON.parse(result);
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        html: `nasabah <b>${result.nm_nasabah}</b> akan terhapus selamanya!`,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak'
                    }).then(hasil => {
                        if(hasil.value){hapus[0].form.submit()}
                    });
                }
            });
        });

        $('#buatUser').click(function(){
            $('#id_user').attr('disabled', false);
            $('#nm_nasabah').val('');
            $('#jk').val('');
            $('#no_hp').val('');
            $('#email').val('');
            $('#alamat').val('');
            $('#id_user').val('');
            
            $('#modalForm').attr('action', "<?= url('operator/nasabah/create') ?>");
            $('#createUser').modal('show');
        });

        $('.edit-nasabah').click(function(e){
            let id_nasabah = $(this).data('id');
            $.ajax({
                url: "<?= url('ajax_nasabah') ?>",
                method: 'post',
                data: {id_nasabah : id_nasabah},
                success: function(result){ 
                  result = JSON.parse(result);
                  
                  $('#id_user').attr('disabled', true);
                  $('#nm_nasabah').val(result.nm_nasabah);
                  $('#jk').val(result.jk);
                  $('#no_hp').val(result.no_hp);
                  $('#email').val(result.email);
                  $('#alamat').val(result.alamat);
                  $('#id_user').val(result.id_user);

                  $('#modalForm').attr('action', "<?= url('operator/nasabah/edit/') ?>"+result.id_nasabah);
                  $('#createUser').modal('show');
                }
            });
        })

    });
</script>