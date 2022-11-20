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
                                        <?php foreach ($request as $req) : ?>
                                            <td scope="row" colspan="2"><?= $req['status_info']; ?></td>
                                        <?php endforeach; ?>
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

                        <!-- disini ada fungsi untuk mengatur kalau memang dia belum disetujui belum ada tanda tangan atasannya-->
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-sm m-2">
                                    Diajukan Oleh :
                                    <br />
                                    <img class="" src="<?= base_url(); ?>assets/img/qr-sign/<?= $det['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                    <i><?= $det['nama']; ?></i>
                                </div>
                                <?php foreach ($request as $req) : ?>
                                    <?php if ($req['status_pengajuan'] > 2) : { ?>
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
                                            <?php foreach ($user_approve as $us) : ?>
                                                <div class="col-sm m-2">
                                                    Belum disetujui Oleh :
                                                    <br class="mx-4" />
                                                    <i><?= $us['nama']; ?></i>
                                                </div>
                                            <?php endforeach ?>
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
                                <!--sampe sini-->
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="col-sm-4 mt-">Catatan Dari Approval : </div>
                            <div class="col-sm-6"><?= $row['note_ro']; ?></div>
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
        <?php if ($req['status_pengajuan'] == 1) { ?>
            <?php if ($this->session->userdata('role_id') == 1 or $this->session->userdata('role_id') == 2) { ?>
                <div class="col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-success" href="<?= base_url('requestorder/form_edit_ro/') . $req['kode_ro']; ?>" role="button">Edit</a>
                </div>
                <div class="col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-danger" href="<?= base_url('requestorder'); ?>" role="button">Hapus</a>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- tombol approval dan reject hanya bisa diakses oleh user approval -->
        <?php foreach ($request as $req) : ?>
            <?php if ($req['status_pengajuan'] == 1) { ?>
                <?php if ($this->session->userdata('role_id') == 3) { ?>
                    <!-- validasi apakah ada salah satu isian dari list pengajuan yang belum disetujui/tolak -->
                    <?php if ($verify_empty > 0) { ?>
                        <div class="col-md-auto">
                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="mohon beri keputusan pada masing-masing list">
                                <i class="fas fa-info"></i> info
                            </button>
                        </div>
                    <?php } elseif ($verify_approved < 1) { ?>
                        <!-- validasi apakah ada salah satu isian dari list pengajuan yang disetujui-->
                        <div class="col-md-auto">
                            <!-- <a name="kembali" id="kembali" class="btn btn-danger" href="<?= base_url('requestorder/ro_reject/') . $req['id_ro']; ?>" role="button">Reject Pengajuan</a> -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal<?= $req['id_ro'] ?>">
                                Reject
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-auto">
                            <!-- <a name="kembali" id="kembali" class="btn btn-success" href="<?= base_url('requestorder/ro_approval/') . $req['id_ro']; ?>" role="button"><i class="fas fa-check"></i> Approve Pengajuan</a> -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal<?= $req['id_ro'] ?>">
                                Approve
                            </button>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="order telah melewati proses approval"><i class="fas fa-info"></i></button>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->
</div>

<!--Approve Modal -->
<?php $no = 0;
foreach ($request as $req) : $no++; ?>
    <div class="modal fade" id="approveModal<?= $req['id_ro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('requestorder/ro_approval'); ?>
                    <div class="form-group">
                        <input type="hidden" id="id_ro" name="id_ro" value="<?= $req['id_ro'] ?>">
                        <label>Masukan catatan anda : </label>
                        <textarea class="form-control" id="note_ro" name="note_ro" rows="3"></textarea>
                    </div>
                    <p><strong>mohon dibaca</strong><br />
                        pastikan keputusan anda sudah benar, keputusan yang telah diberikan tidak dapat dirubah, selain admin purchasing</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">saya mengerti</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--Reject Modal -->
<?php $no = 0;
foreach ($request as $req) : $no++; ?>
    <div class="modal fade" id="rejectModal<?= $req['id_ro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('requestorder/ro_reject'); ?>
                    <div class="form-group">
                        <input type="hidden" id="id_ro" name="id_ro" value="<?= $req['id_ro'] ?>">
                        <label>Masukan catatan anda : </label>
                        <textarea class="form-control" id="note_ro" name="note_ro" rows="3"></textarea>
                    </div>
                    <p><strong>mohon dibaca</strong><br />
                        pastikan keputusan anda sudah benar, keputusan yang telah diberikan tidak dapat dirubah, selain admin purchasing</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">saya mengerti</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>