<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Detail CBR</h1>
    <!-- Page Body -->
    <div class="row">
        <div class="ml-5 mt-3">
            <a class="btn btn-secondary" href="<?= base_url('cashbank') ?>" role="button">Kembali</a>
            <a class="btn btn-warning fa fa-file-pdf" href="<?= base_url('purchaseorder/save_pdf/') ?>" role="button"> Download</a>
        </div>
    </div>
    <div class="card justify-content-center col-md">
        <?php foreach ($cashbank as $cbr) : ?>

            <div class="card-header mt-2">
                <h3 class="text-center col-sm">Cash Bank Request</h3>
                <h4 class="header text-center col-md">No. <?= $cbr['kode_cbr']; ?>/<?= date("m/y", strtotime($cbr['tgl_cbr'])); ?></h4>
            </div>
            <div class="card-body">
                <div class="mt-3">
                    <table>
                        <tr>
                            <th style="width:180px;">Kode CBR</th>
                            <td style="width:20px;">:</td>
                            <td><?= $cbr['kode_cbr']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Nominal Biaya</th>
                            <td style="width:20px;">:</td>
                            <td>Rp <?= number_format($cbr['biaya'], 2, ',', '.'); ?> </td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Keterangan</th>
                            <td style="width:20px;">:</td>
                            <td><?= $cbr['desk_cbr']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Status Pengajuan</th>
                            <td style="width:20px;">:</td>
                            <td><?= $cbr['status_info']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Tempo Pembayaran</th>
                            <td style="width:20px;">:</td>
                            <td><?= date("d F Y", strtotime($cbr['tgl_cbr'])); ?></td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Metode Pembayaran</th>
                            <td style="width:20px;">:</td>
                            <td><?= $cbr['cara_byr']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:180px;">Tanggal Approval</th>
                            <td style="width:20px;">:</td>
                            <td></td>
                        </tr>
                    </table>
                    <?php if ($this->session->userdata('role_id') == '4') : ?>
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalApprove">
                                Approve
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalReject">
                                Reject
                            </button>
                        </div>
                    <?php endif; ?>
                    <hr />
                    <h5>Lampiran Detail Purchase Order</h5>
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">kode PO</th>
                                <th scope="col">Jenis Barang</th>
                                <th scope="col">Keterangan Barang</th>
                                <th scope="col">Jumlah Order</th>
                                <th scope="col">Satuan Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($data_po as $po) :
                                $no++;
                            ?>
                                <tr class="">
                                    <td scope="row"><?= $no ?></td>
                                    <td><?= $po['kode_purchase']; ?></td>
                                    <td><?= $po['jenis_barang']; ?></td>
                                    <td><?= $po['desk_barang']; ?></td>
                                    <td><?= $po['qty_order']; ?></td>
                                    <td><?= $po['sat_order']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <h5>Lampiran Detail Request Order</h5>
                    <div class="row">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Kode RO</th>
                                    <th scope="col">Jenis Barang</th>
                                    <th scope="col">Deskripsi Barang</th>
                                    <th scope="col">Jumlah Permintaan</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Contoh Gambar</th>
                                    <th scope="col">Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($data_ro as $ro) :
                                    $no++; ?>
                                    <tr class="">
                                        <td scope="row"><?= $no; ?></td>
                                        <td><?= $ro['kode_order']; ?></td>
                                        <td><?= $ro['jenis_barang']; ?></td>
                                        <td><?= $ro['desk_barang']; ?></td>
                                        <td><?= $ro['qty_order']; ?></td>
                                        <td><?= $ro['sat_order']; ?></td>
                                        <td><img src="<?= base_url(); ?>assets/img/foto-order/<?= $ro['img_order']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 80px"></td>
                                        <td><?= $ro['status_info']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->
<!-- Modal -->
<?php foreach ($cashbank as $cbr) : ?>
    <div class="modal fade" id="exampleModalApprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda Yakin ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Ya Lanjutkan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda Yakin ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Ya Lanjutkan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>