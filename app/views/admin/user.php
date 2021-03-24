<h1>Daftar User</h1>
<a href="<?= url('admin/user/create') ?>">Buat User</a>
<table border="1" cellpadding="10" width="50%">
    <thead>
        <th>No</th>
        <th>Username</th>
        <th>Level</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php $i=0; foreach($users as $user): $i++ ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['level'] ?></td>
            <td>
                <a href="<?= url('admin/user/edit/'.$user['id_user']) ?>">Edit</a> 
                <form style="display: inline" action="<?= url('admin/user/delete/').$user['id_user'] ?>" method="post">
                    <button type="button" class="delete-user">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#user').addClass('active');

        $('.delete-user').on('click', function(){
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "User akan terhapus selamanya!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak'
            }).then(result => {
                if (result.value) {
                    this.form.submit();
                    Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success' );
                }
            });
        });
    });
</script>