<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data User</h1>
    <!-- Page Body -->
    <div class="card text-start">
        <div class="row p-2">
            <div class="col-md-10 mt-2 offset-md-10">
                <!-- Button trigger modal -->
                <a name="adduser" id="adduser" class="btn btn-primary" href="user_mgm/user_add_form" role="button">Tambah User</a>
            </div>
            <!-- Modal trigger button -->
        </div>
        <div class="card-body">
            <div><?= $this->session->flashdata('msg'); ?></div>
            <div class="table-responsive-md">
                <table class="table table-responsive-sm table-bordered" id="datatable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Handphone</th>
                            <th>Hak Akses</th>
                            <th>Divisi</th>
                            <th hidden></th>
                            <th hidden></th>
                            <th hidden></th>
                        </tr>
                    </thead>
                    <tbody align=center>
                        <?php $no = 0;
                        foreach ($user_data as $row) :
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['no_hp'] ?></td>
                                <td><?= $row['role user'] ?></td>
                                <td><?= $row['divisi'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#detailUser<?= $row['id_user'] ?>">
                                        lihat
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="<?= base_url('') ?>user_mgm/edit_user/<?= $row['id_user']; ?>" role="button"><i class="fa fa-edit"></i> edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="<?= base_url(''); ?>user_mgm/delete_user/<?= $row['id_user']; ?>" role="button"><i class="fa fa-trash-alt"></i> hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!--Detail Modal Modal -->
<?php $no = 0;
foreach ($user_data as $us) : $no++; ?>
    <div class="modal fade" id="detailUser<?= $us['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= base_url(''); ?>assets/img/profile/<?= $row['img_profile']; ?>">
                        </div>
                    </div>
                    <div class="table-responsive-sm border-0">
                        <table class="table table-light">
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td><?= $us['nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <td>:</td>
                                <td><?= $us['nip']; ?></td>
                            </tr>
                            <tr>
                                <th>Email Resmi</th>
                                <td>:</td>
                                <td><?= $us['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Tinggal</th>
                                <td>:</td>
                                <td><?= $us['alamat_tinggal']; ?></td>
                            </tr>
                            <tr>
                                <th>Hak Akses User</th>
                                <td>:</td>
                                <td><?= $us['role user']; ?></td>
                            </tr>
                            <tr>
                                <th>Divisi</th>
                                <td>:</td>
                                <td><?= $us['divisi']; ?></td>
                            </tr>
                            <tr>
                                <th>QR Sign</th>
                                <td>:</td>
                                <td><img class="float right" src="<?= base_url(); ?>assets/img/qr-sign/<?= $us['qr_sign']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 120px"></td>
                            </tr>
                            <tr>
                                <th>User Dibuat Tgl</th>
                                <td>:</td>
                                <td><?= date('d-m-Y', ($us['created_at'])); ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>