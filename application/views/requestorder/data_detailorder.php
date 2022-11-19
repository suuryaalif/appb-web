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
                                    <th>foto rekomendasi</th>
                                    <th>Status</th>
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
                                        <td><img src="<?= base_url(); ?>assets/img/foto-order/<?= $row['img_order']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 80px"></td>
                                        <td><?= $row['status_info'] ?></td>
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
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-sm m-2">
                                    Diajukan Oleh :
                                    <br />
                                    <img class="" src="<?= base_url(); ?>assets/img/qr-sign/<?= $det['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                    <i><?= $det['nama']; ?></i>
                                </div>
                                <?php foreach ($request as $req) : ?>
                                    <?php if ($req['status_pengajuan'] == 'telah disetujui') : { ?>
                                            <?php foreach ($user_approve as $us) : ?>
                                                <div class="col-sm m-2">
                                                    Disetujui Oleh :
                                                    <br />
                                                    <img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $us['nip']; ?>.png" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                                    <i><?= $us['nama']; ?></i>
                                                </div>
                                            <?php endforeach ?>
                                        <?php }
                                    else : { ?>
                                            <i>belum disetujui</i>
                                        <?php }
                                    endif; { ?>
                                    <?php } ?>
                                <?php endforeach ?>
                                <div class="col-sm m-2">
                                    Admin Pruchasing :
                                    <br />
                                    <img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $det['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                    <i>Admin Purchasing</i>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<hr />
<div class="container">
    <div class="row">
        <div class="col">
            <a name="kembali" id="kembali" class="btn btn-primary" href="<?= base_url('requestorder'); ?>" role="button">Kembali</a>
        </div>

        <!-- tombol approval dan reject hanya bisa diakses oleh user approval -->
        <?php if ($this->session->userdata('role_id') == 3) { ?>

            <!-- validasi apakah ada salah satu isian dari list pengajuan yang disetujui/tidak -->
            <?php if ($verify_status == 0) { ?>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anda belum memberi keputusan / salah satu pengajuan harus disetujui">
                        <i class="fas fa-check"></i> Approve Pengajuan
                    </button>
                </div>
                <div class="col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-danger" href="<?= base_url('requestorder'); ?>" role="button">Reject Pengajuan</a>
                </div>
            <?php } else { ?>
                <div class="col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-success" href="<?= base_url('requestorder'); ?>" role="button"><i class="fas fa-check"></i> Approve Pengajuan</a>
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anda salah satu pengajuan disetujui"><i class="fas fa-times"></i> Reject Pengajuan
                    </button>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->