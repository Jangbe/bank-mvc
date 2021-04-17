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
        .table-striped tbody tr:nth-of-type(odd){
            background: rgba(246, 249, 252, .3);
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
    
    <table class="table table-bordered table-striped" width="100%">
        <thead class="title">
            <tr>
                <th>No</th>
                <th>No Rekening</th>
                <?= isset($nasabah)?:'<th>Nama Nasabah</th>'?>
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
                <?= isset($nasabah)?:"<td>$tr[nm_nasabah]</td>"?>
                <td>Rp. <?= rupiah($tr['nominal']) ?></td>
                <td><?= $tr['jns_transaksi'] == 'tf'? 'Transfer':ucwords($tr['jns_transaksi']) ?></td>
                <td><?= $tr['waktu'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>