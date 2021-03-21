<h1>Daftar User</h1>
<a href="<?= url('admin/rekening/create') ?>">Buat Rekening</a>
<table border="1" cellpadding="10" width="50%">
    <thead>
        <th>No</th>
        <th>No Rekening</th>
        <th>Saldo</th>
        <th>Nasabah</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php $i=0; foreach($rekening as $rek): $i++ ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $rek['no_rekening'] ?></td>
            <td><?= $rek['saldo'] ?></td>
            <td><?= $rek['nm_nasabah'] ?></td>
            <td>
                <a href="<?= url('admin/rekening/edit/'.$rek['no_rekening']) ?>">Edit</a> 
                <form style="display: inline" action="<?= url('admin/rekening/delete/').$rek['no_rekening'] ?>" method="post" class="delete-user">
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