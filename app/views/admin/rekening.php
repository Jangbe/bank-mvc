<h1>Daftar Rekening</h1>
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
                <form style="display: inline" action="<?= url('admin/rekening/delete/').$rek['no_rekening'] ?>" method="post">
                    <button type="button" class="delete-user">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#rekening').addClass('active');
        $('.delete-user').on('click', function(){
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Rekening akan terhapus selamanya!",
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