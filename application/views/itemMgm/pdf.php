<!DOCTYPE html>
<html lang="en">
<title>Data Barang</title>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php foreach ($dataItem as $itm) : ?>
        <table width="100%" style="border: 2px solid black;font-size:18px;text-align:center;background-color: gold;" align="center">
            <tr>
                <td style=" border:solid black;width:120px;background-color:white">Kode Barang</td>
                <td colspan="2" style=" border:solid black;background-color:white"><?= $itm['kode_barang']; ?></td>
                <td></td>
                <td style=" border:  solid black;" rowspan="4" style="width:180px ;"> <img src="<?= base_url(); ?>assets/img/qr-barang/<?= $itm['qr_barang']; ?>" style="width:170px;height:170px;margin-right:;border:  solid black;"></td>
            </tr>
            <tr>
                <td style=" border:solid black;background-color:white">Nama Barang</td>
                <td style=" border:solid black;background-color:white" colspan="2"><?= $itm['nama_barang']; ?></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style=" border:solid black;background-color:white">Deskripsi Barang</td>
                <td style="font-size:12px;border:solid black;background-color:white" colspan="2"><?= $itm['desk_barang']; ?></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size:13px;border:  solid black;">
                <td style="border:solid black">Kode Po : <?= $itm['kode_po']; ?></td>
                <td style="border:solid black">Kode RO : <?= $itm['kode_ro']; ?></td>
                <td style="border:solid black">Tgl Input : <?= date('d/m/Y', $itm['tgl_input']); ?></td>
                <td></td>
            </tr>
        </table>
    <?php endforeach; ?>
</body>

</html>