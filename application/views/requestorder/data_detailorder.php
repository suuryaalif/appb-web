<!-- Begin Page Content -->
<div>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Data <?= $title; ?></h1>
        <!-- Page Body -->
        <div class="card text-start">
            <div class="card-body">
                <div class="table-responsive">
                    <?= $this->session->flashdata('msg'); ?>
                    <?php foreach ($user_req as $det) : ?>
                        <div class="table-responsive-md">
                            <div class="justify-content-center col-md">
                                <h3 class="text-center col-sm">Request Order</h3>
                                <h4 class="header text-center col-md">No. <?= $det['kode_ro']; ?>/<?= date("m/y", strtotime($det['submit_date'])); ?></h4>
                            </div>
                            <hr />
                            <table class="table table-light col-5">
                                <tbody>
                                    <tr class="">
                                        <th>Nama User</th>
                                        <th>:</th>
                                        <td scope="row" colspan="2"><?= $det['email']; ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>Tgl Pengajuan</th>
                                        <th>:</th>
                                        <td scope="row" colspan="2"><?= date("d-F-Y", strtotime($det['submit_date'])); ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>Status</th>
                                        <th>:</th>
                                        <td scope="row" colspan="2"><?= $det['status_pengajuan']; ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>Alasan Request</th>
                                        <th>:</th>
                                        <td scope="row" colspan="2"><?= $det['alasan_req']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr />
                        <table class="table table-sm dataTable-container" id="myTable">
                            <thead align=center>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Order</th>
                                    <th>Satuan</th>
                                    <th>Status</th>
                                    <th>foto rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody align=center>
                                <?php $no = 0;
                                foreach ($detail as $row) :
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['jenis_barang'] ?></td>
                                        <td><?= $row['desk_barang'] ?></td>
                                        <td><?= $row['qty_order'] ?></td>
                                        <td><?= $row['sat_order'] ?></td>
                                        <!---nampilin setiap nama status table detail order-->
                                        <?php foreach ($status as $st) : ?>
                                            <td><?= $st['status_pengajuan'] ?></td>
                                        <?php endforeach; ?>
                                        <!--sampe sini-->
                                        <td><img src="<?= base_url(); ?>assets/img/foto-order/<?= $row['img_order']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 80px"></td>
                                        <!--disini ada validasi untuk mengecek apakah pengajuan sudah diberikan keputusan atau belum-->
                                        <td>
                                            <!--kalau belum maka ada tombol approval/reject-->
                                            <?php
                                            if ($user['role_id'] == 3) { ?>
                                                <?php if ($row['status_detail'] == 1) { ?>
                                                    <a class="btn btn-success" href="<?= base_url('requestorder/approve_detail/'); ?><?= $row['id_detail']; ?>">approve
                                                    </a>
                                                    <a class="btn btn-danger" href="<?= base_url('requestorder/reject_detail/'); ?><?= $row['id_detail']; ?>">reject
                                                    </a>
                                                    <!--kalau sudah maka tombol yang muncul hanya informasi/tooltip-->
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anda sudah beri keputusan!"><i class="fas fa-info"></i></button>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <div class="card">
                                <tr class="">
                            </div>
                        </table>
                        <hr />
                        <div class="col-md-3 ml-md-auto mb-3"><i>Dibuat Dan Diajukan Oleh</i></div>
                        <div class="col-md-3 ml-md-auto mb-3">
                            <img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $det['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px">
                        </div>
                        <div class="col-md-3 ml-md-auto mb-3"><i><?= $det['nama']; ?></i>
                        </div>
                        <a name="kembali" id="kembali" class="btn btn-primary" href="<?= base_url('requestorder'); ?>" role="button">Kembali</a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->