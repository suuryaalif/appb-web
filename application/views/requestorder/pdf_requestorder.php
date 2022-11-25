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
    <?php foreach ($request as $req) : ?>
        <table width="100%">
            <tr>
                <td width="100%"><img src="<?php echo base_url('assets/img/logo/text_logo.png') ?>" style="width: 100px;"></td>
                <td align="right" valign="top"> <span style="font-size: 12px">FGA/CTL/2022</span></td>
            </tr>
        </table>
        <hr>
        <p align="center">
            <span style="font-size: 25px"><b><b>REQUEST ORDER FORM</b></b></span> <br>
            <span style="font-size: 15px"><i><b>formulir permintaan dan pengadaan barang</b></i></span> <br>
            <span style="font-size: 18px"><b>No : <?= $req['kode_ro'] . '/' . date("m/Y", strtotime($req['submit_date'])); ?></b></span> <br>
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
        </table>
        </p>
        <p>
            Daftar barang yang diminta :
        </p>
        <p>
        <table style="border: 2px solid black;border-collapse: collapse;font-size: 20px" width="100%">
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
                    <td style="text-align:center; margin-top:1px ;border: 1px solid black">
                        <img src="<?= base_url(); ?>assets/img/foto-order/<?= $det['img_order']; ?>" style="width:50px;height:60px;">
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
                <?php foreach ($request as $req) : ?>
                    <td align="center">Diajukan oleh<br>
                        <img class="" src="<?= base_url(); ?>assets/img/qr-sign/<?= $req['qr_sign']; ?>" style="width:80px;height:80px;">
                        <br><u><?= $req['nama']; ?></u><br>Supervisor
                    </td>
                    <?php foreach ($user_approve as $us) : ?>
                        <?php if ($req['status_pengajuan'] > 2) : ?>
                            <td align="center">Disetujui oleh
                                <br>
                                <img src="<?= base_url(); ?>assets/img/qr-sign/<?= $us['nip']; ?>.png" style="width:60px;height:60px;">
                                <br>
                                <u><?= $us['nama']; ?></u><br>Manager Divisi
                            </td>
                        <?php elseif ($req['status_pengajuan'] = 1) : ?>
                            <td align="center">
                                Belum disetujui:
                                <br><br><br><br>
                                <u><i><?= $us['nama']; ?></i></u>
                                <br>Manager Divisi
                            </td>
                        <?php elseif ($req['status_pengajuan'] >= 3) : ?>
                            <td align="center">Disetujui oleh
                                <br>
                                <img src="<?= base_url(); ?>assets/img/qr-sign/<?= $us['nip']; ?>.png" style="width:60px;height:60px;">
                                <br>
                                <u><?= $us['nama']; ?></u><br>Manager Divisi
                            </td>
                            <td align="center">Diterima oleh
                                <br>
                                <img src="<?= base_url(); ?>assets/img/qr-sign/20220101.png" style="width:60px;height:60px;">
                                <br><u>Admin</u><br>Purchasing Staff
                            </td>
                        <?php endif; ?>
                    <?php endforeach ?>
            </tr>
        </table>
        <h4>Catatan Dari Approval : </h4>
        <?php if (empty($req['note_ro'])) : ?>
            <h5>tidak ada komentar</h5>
        <?php else : ?>
            <h5 class="col-sm-6"><?= $req['note_ro']; ?></h5>
        <?php endif; ?>
        </p>
    <?php endforeach ?>
<?php endforeach; ?>
</body>

</html>