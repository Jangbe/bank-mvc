<a href="<?= url('admin/transaksi/add') ?>">Tambah Transaksi</a>
<h1>Log Transaksi</h1>
<table border="1" cellpadding="10">
    <thead>
        <th>No</th>
        <th>Nasabah</th>
        <th>Jumlah Transaksi</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php $i=0; foreach($transaksi as $tr) : $i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $tr['nm_nasabah'] ?></td>
                <td><?= $tr['jml'] ?></td>
                <td>
                    <a href="<?= url('admin/transaksi/detail/'.$tr['id_nasabah']) ?>"><button>Detail</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>