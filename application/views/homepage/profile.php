<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Profil Data <?= $user['nama']; ?></h1>
    <!-- Page Body -->
    <div class="container-fluid">
        <div class="card mb-3 shadow" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4 justify-content-center">
                    <img src="<?= base_url('assets/img/profile/') . $user['img_profile']; ?>" class="img-fluid m-lg-3" alt="profile">
                </div>
                <div class="col-10">
                    <div class="card-body">
                        <div class="table table-responsive-sm">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <td>Nama Pengguna</td>
                                        <td>:</td>
                                        <td><?= $user['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Pengguna</td>
                                        <td>:</td>
                                        <td><?= $user['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Induk Pegawai</td>
                                        <td>:</td>
                                        <td><?= $user['nip']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hak Akses</td>
                                        <td>:</td>
                                        <td><?php if ($user['role_id'] == 2) {
                                                echo "user requestion";
                                            } elseif ($user['role_id'] == 3) {
                                                echo "user approval";
                                            } elseif ($user['role_id'] == 4) {
                                                echo "user payment";
                                            } else {
                                                echo "Admin Purchasing";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>User sejak</td>
                                        <td>:</td>
                                        <td><?= date('d F Y', $user['created_at']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><a class="btn btn-primary" href="#">Edit</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->