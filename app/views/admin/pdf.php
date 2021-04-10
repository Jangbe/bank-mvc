<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- <link rel="stylesheet" type="text/css" media="print" href="<?= url() ?>assets/css/argon.css?v=1.2.0"> -->
    <style>
        .text-center{
            text-align: center;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
            background-color: white!important;
        }
        .table-bordered,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }  

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        table td,th{
            padding: 5px;
        }
        .title{
            background-color: gray;
        }
        body{
            font-family: 'serif';
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laporan Transaksi <?= $nasabah['nm_nasabah'] ?? '' ?></h1><br>
    
    <?php if(isset($nasabah)) : ?>
        <table class="table table-bordered" width="100%">
            <thead class="title">
                <tr>
                    <th>No</th>
                    <th>No Rekening</th>
                    <th>Nominal</th>
                    <th>Jenis Transaksi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody class="list">
            <?php foreach($transaksi as $no => $tr) : ?>
                <tr>
                    <td class="text-center"><?= $no+1 ?></td>
                    <td><?= $tr['no_rekening'] ?></td>
                    <td>Rp. <?= number_format($tr['nominal'],0,',','.') ?>,00</td>
                    <td><?= $tr['jns_transaksi'] == 'tf'? 'Transfer':ucwords($tr['jns_transaksi']) ?></td>
                    <td><?= $tr['waktu'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <table border="1" class="table table-bordered" width="100%">
            <thead class="title">
                <tr>
                    <th>No</th>
                    <th>No Rekening</th>
                    <th>Nama Nasabah</th>
                    <th>Nominal</th>
                    <th>Jenis Transaksi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody class="list">
            <?php foreach($transaksi as $no => $tr) : ?>
                <tr>
                    <td class="text-center"><?= $no+1 ?></td>
                    <td><?= $tr['no_rekening'] ?></td>
                    <td><?= $tr['nm_nasabah'] ?></td>
                    <td>Rp. <?= number_format($tr['nominal'],0,',','.') ?>,00</td>
                    <td><?= $tr['jns_transaksi'] == 'tf'? 'Transfer':ucwords($tr['jns_transaksi']) ?></td>
                    <td><?= $tr['waktu'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    
    <?php endif ?>
</body>
</html>