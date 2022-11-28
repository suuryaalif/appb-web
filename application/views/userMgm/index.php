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
                <table class="table table-sm table-bordered" id="datatable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>alamat</th>
                            <th>No. Handphone</th>
                            <th>Hak Akses</th>
                            <th>Divisi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
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
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['alamat_tinggal'] ?></td>
                                <td><?= $row['no_hp'] ?></td>
                                <td><?= $row['role user'] ?></td>
                                <td><?= $row['divisi'] ?></td>
                                <td><?= $row['img_profile'] ?></td>
                                <td>
                                    <a class="btn btn-success" href="<?= base_url('') ?>user_mgm/edit_user/<?= $row['id_user']; ?>" role="button"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="#" role="button"><i class="fa fa-trash-alt"></i></a>
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