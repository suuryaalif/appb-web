<div class="container-fluid">
    <!--header-->
    <h1 class="h3 mb-4 text-gray-800">Data <?= $title; ?></h1>
    <div class="container">
        <!--tombol aksi-->
        <?php foreach ($request as $req) : ?>
            <div id="tombol-aksi" class="row mb-3">
                <!--==-tombol kembali===-->
                <div class="col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-primary" href="<?= base_url('requestorder'); ?>" role="button">Kembali</a>
                </div>
                <!--cek status pengajuan-->
                <?php if ($req['status_pengajuan'] == 1) : ?>
                    <!--cek role idnya 1&3-->
                    <?php if ($this->session->userdata('role_id') == 1 or $this->session->userdata('role_id') == 2) : ?>
                        <div class="col-sm-auto">
                            <a class="btn btn-success" href="<?= base_url('requestorder/get_data_edit/') . $req['kode_ro']; ?>" role="button"><i class="fa fa-edit"></i>
                                Edit</a>
                        </div>
                        <div class="col-sm-auto">
                            <a class="btn btn-danger" href="<?= base_url('requestorder/delete_req_data/' . $req['kode_ro']); ?>" role="button"><i class="fa fa-trash"></i>
                                Hapus</a>
                        </div>
                        <!--cek role idnya 3-->
                    <?php elseif ($this->session->userdata('role_id') == 3) : ?>
                        <!--cek semuanya approve/reject-->
                        <?php if ($verify_empty > 0) : ?>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="mohon beri keputusan pada masing-masing list">
                                    <i class="fas fa-info"></i> info
                                </button>
                            </div>
                            <!--seluruhnya ditolak-->
                        <?php elseif ($verify_approved < 1) : ?>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal<?= $req['id_ro'] ?>">
                                    Reject
                                </button>
                            </div>
                        <?php else : ?>
                            <!--ada 1 yg disetujui-->
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal<?= $req['id_ro'] ?>">
                                    Approve
                                </button>
                            </div>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="ada yang di approve tidak bisa reject">
                                    Reject
                                </button>
                            </div>
                        <?php endif; ?>
                        <!--kalo ini buat role requestion,gak bisa edit statusnya sudah disubmit-->
                    <?php endif; ?>
                    <!-- tombol approval dan reject hanya bisa diakses oleh user approval -->
                <?php elseif ($req['status_pengajuan'] == 2) : ?>
                    <?php if ($this->session->userdata('role_id') == 1 or $this->session->userdata('role_id') == 2) : ?>
                        <div class="col-sm-auto">
                            <a class="btn btn-warning" href="<?= base_url('requestorder/get_data_edit/') . $req['kode_ro']; ?>" role="button"><i class="fa fa-edit"></i>
                                Perbaiki</a>
                        </div>
                        <div class="col-sm-auto">
                            <a class="btn btn-danger" href="<?= base_url('requestorder/delete_req_data/' . $req['kode_ro']); ?>" role="button"><i class="fa fa-trash"></i>
                                Hapus</a>
                        </div>
                    <?php endif; ?>
                <?php elseif ($req['status_pengajuan'] > 2) : ?>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="order telah melewati proses approval"><i class="fas fa-info"></i></button>
                    </div>
                <?php endif; ?>
                <div class=" col-md-auto">
                    <a name="kembali" id="kembali" class="btn btn-danger" href="<?= base_url('requestorder/save_pdf/' . $req['kode_ro']); ?>" role="button"><i class="fa fa-file-pdf"></i>Download</a>
                </div>
            </div>
    </div>
<?php endforeach; ?>


<!--body-->
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
                            <?php if ($user['role_id'] == 3) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
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
                                <td>
                                    <!--tombol approval/reject-->
                                    <?php if ($user['role_id'] == 3) : ?>
                                        <?php if ($row['status_detail'] == 1) : ?>
                                            <!--blm approve/reject-->
                                            <a class="btn btn-success" href="<?= base_url('requestorder/approve_detail/'); ?><?= $row['id_detail']; ?>">approve
                                            </a>
                                            <a class="btn btn-danger" href="<?= base_url('requestorder/reject_detail/'); ?><?= $row['id_detail']; ?>">reject
                                            </a>
                                            <!--kalo reject-->
                                        <?php elseif ($row['status_detail'] == 2) : ?>
                                            <a class="btn btn-success" href="<?= base_url('requestorder/approve_detail/'); ?><?= $row['id_detail']; ?>">approve
                                            </a>
                                        <?php elseif ($row['status_detail'] == 3) : ?>
                                            <a class="btn btn-danger" href="<?= base_url('requestorder/reject_detail/'); ?><?= $row['id_detail']; ?>">reject
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
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
                            <u><i><?= $det['nama']; ?></i></u><br>
                            <a>Supervisor Divisi</a>
                        </div>
                        <?php foreach ($request as $req) : ?>
                            <?php if ($req['status_pengajuan'] > 2) : { ?>
                                    <?php foreach ($user_approve as $us) : ?>
                                        <div class="col-sm m-2">
                                            Disetujui Oleh :
                                            <br />
                                            <img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $us['nip']; ?>.png" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                            <u><i><?= $us['nama']; ?></i></u><br>
                                            <a>Manager Divisi</a>
                                        </div>
                                        <div class="col-sm m-2">
                                            Admin Purchasing :
                                            <br />
                                            <img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $det['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"><br />
                                            <i>Admin Purchasing</i>
                                        </div>
                                    <?php endforeach ?>
                                <?php }
                            else : { ?>
                                    <?php foreach ($user_approve as $us) : ?>
                                        <div class="col-sm m-2">
                                            Belum disetujui Oleh :
                                            <br><br><br><br><br>
                                            <u><i><?= $us['nama']; ?></i></u><br>
                                            <a>Manager Divisi</a>
                                        </div>
                                        <div class="col-sm m-2">
                                            Dikembalikan Oleh :
                                            <br><br><br><br><br>
                                            <i>Admin Purchasing</i>
                                        </div>
                                    <?php endforeach ?>
                                <?php }
                            endif; { ?>
                            <?php } ?>
                        <?php endforeach ?>
                        <!--sampe sini-->
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="col-sm-4 mt-">Catatan Dari Approval : </div>
                    <?php if (empty($req['note_ro'])) : ?>
                        <div class="col-sm-4 mt-">tidak ada komentar</div>
                    <?php else : ?>
                        <div class="col-sm-6"><?= $req['note_ro']; ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
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