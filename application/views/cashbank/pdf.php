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


<body style="font-size: 20px">
    <?php foreach ($cashbank as $cbr) : ?>
        <table width="100%">
            <tr>
                <td width="100%"><img src="<?php echo base_url('assets/img/logo/text_logo.png') ?>" style="width: 100px;"></td>
                <td align="right" valign="top"> <span style="font-size: 12px">FFN/CTL/2022</span></td>
            </tr>
        </table>
        <hr>
        <p align="center">
            <span style="font-size: 25px"><b><b>Cash Bank Requestion</b></b></span> <br>
            <span style="font-size: 15px"><i><b>formulir pengajuan biaya</b></i></span> <br>
            <span style="font-size: 18px"><b>No : <?= $cbr['kode_cbr'] . '/' . date("m/Y", strtotime($cbr['tgl_cbr'])); ?></b></span> <br>
        </p>
        <hr>
        <p>
        <p>Informasi Cash Bank</p>
        <table style="font-size:17px ;border:1px solid black;padding-top:10px;padding-bottom:20px;padding-left:10px;padding-right:0px;">
            <tr>
                <td style="width:120px;">
                    Kepada
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:20px;">
                    Bagian Keuangan
                </td>
                <td>
                    Dari
                </td>
                <td>
                    :
                </td>
                <td>
                    Bagian Purchasing
                </td>
            </tr>
            <br>
            <tr>
                <td style="width:120px ;">
                    Nominal Biaya
                </td>
                <td style="width:10px ;">
                    :
                </td>
                <td style="width:370px;">
                    Rp <?= number_format($cbr['biaya'], 2, ',', '.'); ?>
                </td>
                <br />
                <br />
            </tr>
            <tr>
                <td style="width:120px ;border-top:1px solid black;">
                    Keterangan Biaya
                </td>
                <td style="width:10px ;border-top:1px solid black;">
                    :
                </td>
                <td colspan="4" style="width:370px;border-top:1px solid black;"><?= $cbr['desk_cbr']; ?>
            </tr>
            <tr>
                <td style="width:120px ;border-top:1px solid black;">
                    Status Pengajuan Cash Bank
                </td>
                <td style="width:10px ;border-top:1px solid black;">
                    :
                </td>
                <td colspan="4" style="width:370px;border-top:1px solid black;"><?= $cbr['alias_status']; ?>
            </tr>
        </table>
        <br>
        <p>Informasi Pembayaran</p>
        <table style="font-size:17px ;border: 1px solid black ; padding: 10px 10px 10px 10px;">
            <tr>
                <td style="width:120px;">
                    Nama Supplier
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:435px;">
                    <?= $cbr['nama_sup']; ?>
                </td>
            </tr>
            <tr>
                <td style="width:120px;">
                    Pic Supplier
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:435px;">
                    <?= $cbr['pic_sup']; ?>
                </td>
            </tr>
            <tr>
                <td style="width:220px;">
                    Metode Pembayaran
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:435px;">
                    <?= $cbr['cara_byr']; ?>
                </td>
                <?php if ($cbr['cara_byr'] == 'transfer') : ?>
            <tr>
                <td style="width:120px;">
                    Nama Bank Supplier
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:435px;">
                    <?= $cbr['nama_bank_sup']; ?>
                </td>
            </tr>
            <tr>
                <td style="width:120px;">
                    Nomor Rekening
                </td>
                <td style="width:10px;">
                    :
                </td>
                <td style="width:435px;">
                    <?= $cbr['no_rek']; ?>
                </td>
            </tr>
        <?php else : ?>
        <?php endif; ?>
        <tr>
            <td style="width:120px;">
                Jatuh Tempo Pembayaran
            </td>
            <td style="width:10px;">
                :
            </td>
            <td style="width:435px;">
                <?= date("d/m/Y", strtotime($cbr['tempo_byr'])); ?>
            </td>
        </tr>
        </table>
        </p>
        <br>
        <p style="font-size:15px;">
            Mohon melakukan pembayaran sebelum jatuh tempo
        </p>
        <p style="font-size:15px;">
            Apabila telah diproses bayar, agar melakukan konfirmasi pembayaran.
        </p>
        <br />
        <table width="100%" style="font-family: Verdana, Geneva, Tahoma, sans-serif ;font-size:16px;">
            <?php if ($cbr['status_cbr'] > 2) : ?>
                <tr>
                    <td align="center">Disetujui Oleh :</td>
                    <td align="center">Di Ajukan Oleh :</td>
                </tr>
                <tr>
                    <td align="center"><img src="<?= base_url(); ?>assets/img/qr-sign/<?= $approval_qr; ?>" style="width:60px;height:60px;"></td>
                    <td align="center"><img src="<?= base_url(); ?>assets/img/qr-sign/20220101.png" style="width:60px;height:60px;"></td>
                </tr>
                <tr>
                    <td align="center"><?= $approval_pay; ?></td>
                    <td align="center">Admin Purchasing</td>
                </tr>
            <?php else : ?>
                <tr>
                    <td align="center">Di Ajukan Oleh :</td>
                </tr>
                <tr>
                    <td align="center"><img src="<?= base_url(); ?>assets/img/qr-sign/20220101.png" style="width:60px;height:60px;"></td>
                </tr>
                <tr>
                    <td align="center">Admin Purchasing</td>
                </tr>
            <?php endif; ?>
        </table>
        <?php if ($cbr['approve_time'] != 0) : ?>
            <p style="font-size:15px;">Waktu Approval : <?= date('d-m-y', $cbr['approval_time']); ?> </p>
        <?php else : ?>
            <p style="font-size:15px;">Waktu Approval : belum ada approval </p>
        <?php endif; ?>
        <br />
        <br />
        <br />
        <p style="font-size:10px ;text-align:center">
            Dokumen ini ditanda tangani secara digital , sehingga tidak memerlukan stamp basah dan tanda tangan asli.
        </p>
    <?php endforeach; ?>
    <br />
    <br />
    <br />
    <br />
    <h3>Lampiran Cash Bank Requestion :</h3>
    <p>
        Informasi Request Order :
    </p>
    <p>
    <table style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size:15px;">
        <?php foreach ($data_ro as $req) : ?>
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
            <tr>
                <th align="left"> Tanggal Pengajuan </th>
                <td> : <?= date("d/m/Y", strtotime($req['submit_date'])); ?></td>
            </tr>
            <tr>
                <th align="left"> Status Pengajuan </th>
                <td> : <?= $req['alias_status']; ?></td>
            </tr>
            <tr>
                <th align="left"> Tanggal Approval</th>
                <td> : <?= date("d/m/Y", $req['approval_time']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <table style="border: 2px solid black;border-collapse: collapse;font-size: 15px;font-family:Verdana, Geneva, Tahoma, sans-serif;" width="100%">
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
        foreach ($data_detail_ro as $det) :
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
    <p>
        Informasi Purchase Order :
    </p>
    <p>
    <table style="font-size: 15px;font-family:Verdana, Geneva, Tahoma, sans-serif;">
        <?php foreach ($data_po as $dp) : ?>
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
        <?php endforeach; ?>
    </table>
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
            foreach ($data_detail_po as $row) :
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
    </p>

</body>

</html>