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
    <?php foreach ($data_purchase as $dp) : ?>
        <table width="100%">
            <tr>
                <td width="100%"><img src="<?php echo base_url('assets/img/logo/text_logo.png') ?>" style="width: 100px;"></td>
                <td align="right" valign="top"> <span style="font-size: 12px">FGA/CTL/2022</span></td>
            </tr>
        </table>
        <hr>
        <p align="center">
            <span style="font-size: 25px"><b><b>PURCHASE ORDER FORM</b></b></span> <br>
            <span style="font-size: 15px"><i><b>formulir permintaan barang ke supplier</b></i></span> <br>
            <span style="font-size: 18px"><b>No : <?= $dp['kode_po'] . '/' . date("m/Y", strtotime($dp['tgl_po'])); ?></b></span> <br>
        </p>
        <hr>
        <p>
        <table style="text-align:left;font-size:16px;">
            <tr>
                <th style="text-align:left ;">Tgl Purchase Order</th>
                <td>:</td>
                <td><?= $dp['tgl_po']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">Kode Request Order</th>
                <td>:</td>
                <td><?= $dp['kode_ro']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">Keterangan</th>
                <td>:</td>
                <td><?= $dp['desk_po']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">Nama Supplier</th>
                <td>:</td>
                <td><?= $dp['nama_sup']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">Alamat Supplier</th>
                <td>:</td>
                <td><?= $dp['alamat_sup']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">PIC Supplier</th>
                <td>:</td>
                <td><?= $dp['pic_sup']; ?></td>
            </tr>
            <tr>
                <th style="text-align:left ;">No. Telepon/HP Supplier</th>
                <td>:</td>
                <td><?= $dp['tlp_sup']; ?></td>
            </tr>
        </table>
        </p>
        <br>
        <p>
            Daftar barang yang diorder :
        </p>
        <br>
        <p>
        <table style="border: 2px solid black;border-collapse: collapse;font-size: 17px" width="100%">
            <thead>
                <tr>
                    <th style=" border: 1px solid black;">No</th>
                    <th style="border: 1px solid black;">kode PO</th>
                    <th style="border: 1px solid black;">Jenis Barang</th>
                    <th style="border: 1px solid black;">Keterangan Barang</th>
                    <th style="border: 1px solid black;">Jumlah Order</th>
                    <th style="border: 1px solid black;">Satuan Order</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($detail_purchase as $row) :
                    $no++;
                ?>
                    <tr style="margin: 5px">
                        <td style="border: 1px solid black;text-align:center"><?= $no ?></td>
                        <td style="border: 1px solid black;text-align:center"><?= $row['kode_purchase']; ?></td>
                        <td style="border: 1px solid black;text-align:center"><?= $row['jenis_barang']; ?></td>
                        <td style="border: 1px solid black;text-align:center"><?= $row['desk_barang']; ?></td>
                        <td style="border: 1px solid black;text-align:center"><?= $row['qty_order']; ?></td>
                        <td style="border: 1px solid black;text-align:center"><?= $row['sat_order']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </p>
        <br>
        <p style="font-size:16px ;">
            adapun ketentuan mengenai order kami sebagai berikut :
        <ul style="font-size:16px ;">
            <li style="font-size:16px ;">Bilamana dalam waktu 3x24 jam tidak ada konfirmasi penerimaan PO dari supplier, maka kami berhak melakukan pembatalan atau mencari alternatif supplier lainnya.</li>
        </ul>
        <ul style="font-size:16px ;">
            <li style="font-size:16px ;">Pengiriman Barang wajib menginformasikan kepada bagian purchasing terlebih dahulu.</li>
        </ul>
        <ul style="font-size:16px ;">
            <li style="font-size:16px ;">Purchase Order Resmi hanya diterbitkan oleh divisi purchasing perusahaan.</li>
        </ul>
        </p>
        <br>
        <p style="text-align:right ;">
            Jakarta, <?= date("d-F-Y", strtotime($dp['tgl_po'])) ?>
            <br>
            <img src="<?= base_url(); ?>assets/img/qr-sign/<?= $user['qr_sign']; ?>" style="width:80px;height:80px;margin-right:5px ;">
            <br>
            Admin Purchasing
            <br>
            PT. CERINDO
        </p>
        <br />
        <br />
        <br />
        <p style="font-size:14px ;text-align:center">
            Purchase Order ini ditanda tangani secara digital , sehingga tidak memerlukan stamp basah dan tanda tangan asli.
        </p>
    <?php endforeach; ?>
</body>

</html>