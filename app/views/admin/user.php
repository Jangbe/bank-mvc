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
                <form style="display: inline" action="<?= url('admin/user/delete/').$user['id_user'] ?>" method="post" class="delete-user">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        let deleteButton = document.querySelectorAll('.delete-user');
        deleteButton.forEach(function(btn){
            btn.addEventListener('submit', function(e){
                if(!confirm('Yakin menghapus user ini?')){
                    e.preventDefault();
                }
            });
        });
    });
</script>