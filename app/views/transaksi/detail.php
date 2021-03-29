<a href="<?= url('admin/transaksi/add') ?>">Tambah Transaksi</a>
<h1>Histori Transaksi <?= $transaksi[0]['nm_nasabah'] ?></h1>
<table border="1" cellpadding="10">
    <thead>
        <th>No</th>
        <th>Waktu</th>
        <th>Nominal</th>
        <th>Jenis Transaksi</th>
    </thead>
    <tbody>
        <?php $i=0; foreach($transaksi as $tr) : $i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= date('d F Y', strtotime($tr['waktu'])) ?></td>
                <td><?= $tr['nominal'] ?></td>
                <td><?= transaksi($tr['jns_transaksi']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>