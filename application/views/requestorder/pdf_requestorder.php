<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <style type="text/css">
        p {
            margin: 5px 0 0 0;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
            display: block;
        }

        .bold {
            font-weight: bold;
        }

        #footer {
            clear: both;
            position: relative;
            height: 40px;
            margin-top: -40px;
        }
    </style>
</head>

<body style="font-size: 20px">
    <p align="center">
        <?php foreach ($request as $req) : ?>
            <span style="font-size: 25px;font-family:Verdana, Geneva, Tahoma, sans-serif"><b>REQUEST ORDER FORM</b></span> <br>
            <span style="font-size: 19px"><i>formulir permintaan pengadaan barang</i></span><br />
            <span style="font-size: 20px">No : <?= $req['kode_ro'] . '/' . date("m/Y", strtotime($req['submit_date'])); ?></span>
    </p>
    <hr>
    <p>
    <table>
        <tr>
            <th align="left"> Nama </th>
            <td> : <?= $req['nama']; ?></td>
        </tr>
        <tr>
            <th align="left"> NIP </th>
            <td> : <?= $req['nip']; ?></td>
        </tr>
        <tr>
            <th align="left"> Email </th>
            <td> : <?= $req['email']; ?></td>
        </tr>
        <tr>
            <th align="left"> Divisi </th>
            <td> : <?= $req['divisi']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    </p>
    <p>
        Daftar barang yang diminta :
    </p>
    <p>
    <table style="border: 1px solid black;border-collapse: collapse;font-size: 20px" width="100%">
        <tr style="margin: 5px">
            <th style="border: 1px solid black;">No</th>
            <th style="border: 1px solid black;">Jenis</th>
            <th style="border: 1px solid black;">Deskripsi</th>
            <th style="border: 1px solid black;">Jumlah</th>
            <th style="border: 1px solid black;">Satuan</th>
            <th style="border: 1px solid black;">Gambar</th>
            <th style="border: 1px solid black;">Status</th>
        </tr>
        <?php $no = 0;
        foreach ($detail as $det) :
            $no++; ?>
            <tr style="margin: 5px">
                <td style="border: 1px solid black;text-align:center"><?= $no ?></td>
                <td style="border: 1px solid black;text-align:center"><?= $det['jenis_barang']; ?></td>
                <td style="border: 1px solid black;text-align:justify"><?= $det['desk_barang']; ?></td>
                <td style="border: 1px solid black;text-align:center"><?= $det['qty_order']; ?></td>
                <td style="border: 1px solid black;text-align:center"><?= $det['sat_order']; ?></td>
                <td>
                    <picture>
                        <source srcset="" type="image/svg+xml">
                        <img src="<?= base_url(); ?>assets/img/foto-order/<?= $det['img_order']; ?>" style="width:60px;height:80px;" class="img-fluid img-thumbnail">
                    </picture>
                </td>
                <td style="border: 1px solid black;text-align:center"><?= $det['alias_status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </p>
    <br>
    <p>
    <table width="100%">
        <tr>
            <td align="center">Diajukan oleh<br><br><br><br><br><u>Nama Pelaksana</u><br>Supervisor</td>
            <?php foreach ($user_approve as $us) : ?>
                <td align="center">Disetujui oleh<br><br><br><br><br><u><?= $us['nama']; ?></u><br>Manager Divisi</td>
            <?php endforeach ?>
            <td align="center">Diterima oleh<br><br><br><br><br><u>Nama Diketahui</u><br>Purchasing Staff</td>
        </tr>
    </table>
    </p>

</body>

</html>