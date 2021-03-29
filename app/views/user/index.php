<?php include 'header.php'; ?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col">
        <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Daftar User</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <th width="2%">No</th>
                <th width="70%">Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </thead>
            <tbody class="list">
                <?php $i=0; foreach($users as $user): $i++ ?>
                    <tr>
                        <td>
                            <b><?= $i ?></b>
                        </td>
                        <td>
                            <span class="text-muted"><?= ucwords($user['username']) ?></span>
                        </td>
                        <td>
                            <span class="badge badge-<?php if($user['level'] == 'admin'){echo 'warning';}else if($user['level'] == 'operator'){echo 'primary';}else{echo 'info';} ?>">
                                <?= $user['level'] ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-success edit-user" data-id="<?= $user['id_user']; ?>">
                                <i class="fas fa-edit"></i>
                                <span class="d-none d-md-inline">Edit</span>
                            </button> 
                            <form style="display: inline" action="<?= url('admin/user/delete/').$user['id_user'] ?>" method="post">
                                <button type="button" class="btn btn-danger delete-user" data-id="<?= $user['id_user']; ?>">
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
        $('#user').addClass('active');

        $('.delete-user').on('click', function(){
            let id_user = $(this).data('id');
            let hapus = $(this);
            $.ajax({
                url: "<?= url('ajax_user') ?>",
                method: "post",
                data: {id_user, id_user},
                success: function(result){
                    result = JSON.parse(result);
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        html: `User <b>${result[0].username}</b> akan terhapus selamanya!`,
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

        if($('#level').val() == 'admin'){
            $('#tingkat').hide();
        }

        $('#level').on('change', function(){
            if($(this).val() == 'admin'){
                $('#tingkat').fadeOut();
            }else{
                $('#tingkat').fadeIn();
            }
        });

        $('#buatUser').click(function(){
            $('#username').val('');
            $('#pass').val('').parent().show();
            $('#level').val('admin');
            $('#nama').val('');
            $('#jk').val('');
            $('#no_hp').val('');
            $('#email').val('');
            $('#alamat').val('');
            
            $('#modalForm').attr('action', "<?= url($_SESSION['user']['level'].'/user/create') ?>");
            $('#createUserLabel').text('Buat User Baru');
            $('#createUser').modal('show');
            $('#tingkat').fadeOut(1000);
        });

        $('.edit-user').click(function(e){
            let id_user = $(this).data('id');
            $.ajax({
                url: "<?= url('ajax_user') ?>",
                method: "post",
                data: {id_user, id_user},
                success: function(result){
                    result = JSON.parse(result);
                    $('#username').val(result[0].username);
                    $('#pass').parent().hide();
                    $('#level').val(result[0].level);

                    if(result[0].level == 'admin') $('#tingkat').fadeOut(1000); else $('#tingkat').fadeIn(1000);
                    $('#nama').val(result[1].nm_nasabah ?? result[1].nm_pegawai ?? '');
                    $('#jk').val(result[1].jk ?? 'L');
                    $('#no_hp').val(result[1].no_hp ?? '');
                    $('#email').val(result[1].email ?? '');
                    $('#alamat').val(result[1].alamat ?? '');

                    $('#modalForm').attr('action', "<?= url($_SESSION['user']['level'].'/user/edit/') ?>"+result[0].id_user);
                    $('#createUserLabel').text('Edit User '+result[0].username).css('textTransform', 'capitalize');
                    $('#createUser').modal('show');
                }
            });
        })

    });
</script>