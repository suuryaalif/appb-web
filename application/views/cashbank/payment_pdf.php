<!DOCTYPE html>
<title><?= $title; ?></title>
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


<?php foreach ($payment as $pay) : ?>

    <body style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif">
        <table width="100%">
            <tr>
                <td width="100%"><img src="<?php echo base_url('assets/img/logo/text_logo.png') ?>" style="width: 100px;"></td>
                <td align="right" valign="top"> <span style="font-size: 12px">FFN/CTL/2022</span></td>
            </tr>
        </table>
        <hr>
        <p align="center">
            <span style="font-size: 25px"><b><b>Proof Of Payment</b></b></span> <br>
            <span style="font-size: 15px"><i><b>bukti pembayaran purchase order</b></i></span> <br>
            <span style="font-size: 18px"><b>No : <?= $pay['kode_byr'] . '/' . date("m/Y", strtotime($pay['tgl_byr'])); ?></b></span> <br>
        </p>
        <hr>
        <?php foreach ($supplier as $sup) : ?>
            <p style="font-size:16px ;">
                Kepada Yth.<br>
                Bpk/Ibu/Perusahaan<br>
                <?= $sup['nama_sup']; ?> / <?= $sup['pic_sup']; ?><br>
                <?= $sup['alamat_sup']; ?><br>
                <?= $sup['email_sup']; ?> / <?= $sup['tlp_sup']; ?><br>
            </p>
            <br />
            <p style="font-size:16px ;font-family:Verdana, Geneva, Tahoma, sans-serif">&nbsp; &nbsp; &nbsp;anda telah menerima pembayaran dari kami dengan keterangan sebagai berikut :<br />
            <table style="font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px">
                <?php foreach ($data_po as $dpo) : ?>
                    <tr>
                        <td>Kode Bayar</td>
                        <td>:</td>
                        <td><?= $pay['kode_byr']; ?></td>
                    </tr>
                    <tr>
                        <td>Kode PO</td>
                        <td>:</td>
                        <td><?= $dpo['kode_po']; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan PO</td>
                        <td>:</td>
                        <td><?= $dpo['kode_po']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal PO</td>
                        <td>:</td>
                        <td><?= date("d/m/Y", strtotime($dpo['tgl_po'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            </p>
            <p style="font-size:16px ;font-family:Verdana, Geneva, Tahoma, sans-serif">
                Dengan bukti bayar sebagai berikut :
            </p>
            <hr>
            <p>
                <img src="<?= base_url(); ?>assets/img/foto-bayar/<?= $pay['bukti_byr']; ?>" style="width:300px;height:300px;">
            </p>
            <hr>
            <p style="font-size:14px ;font-family:Verdana, Geneva, Tahoma, sans-serif">
                Mohon dapat segera melakukan konfirmasi penerimaan dana dengan menghubungi bagian purchasing kami melalui email atau nomor berikut :<br /><br />
                Admin Purchasing<br>
                Surya Alif Rachman<br>
                0812138492893<br>
                admin@gmail.com<br>
            </p>
            <p style="font-size:14px ;font-family:Verdana, Geneva, Tahoma, sans-serif">
                Demikian kami sampaikan, terimakasih atas perhatian anda
            </p>
            <p style="font-size:14px ;font-family:Verdana, Geneva, Tahoma, sans-serif;text-align:right;">
                Jakarta, <?= date("d/m/Y", strtotime($pay['tgl_byr'])); ?><br>
                PT. CERINDO<br>
                <img src="<?= base_url(); ?>assets/img/qr-sign/<?= $qr_aprv; ?>" style="width:60px;height:60px;"><br>
                User Payment / Kasir
            </p>
            <p style="font-size:10px ;text-align:center">
                Dokumen ini ditanda tangani secara digital , sehingga tidak memerlukan stamp basah dan tanda tangan asli.
            </p>
        <?php endforeach; ?>
    </body>
<?php endforeach; ?>

</html>