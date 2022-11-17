<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="login_appb" />
    <meta name="author" content="SAR" />
    <title>Form registration</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.min.css">
</head>

<body class="bg-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card bg-light o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <hr>
                                    <h1 class="h3 text-gray-900 text-center mb-5">Registration</h1>
                                    <!-- formulir login -->
                                    <div><?= $this->session->flashdata('msg'); ?></div>
                                    <form class="user" method="POST" action="<?= base_url('Auth/registration'); ?>">
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?= set_value('nama'); ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP">
                                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('nama'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat"><?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor Handphone">
                                            <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <label>select role :</label>
                                            <select class="form-control" id="role" name="role" value="<?= set_value('role'); ?>">
                                                <option value="1">admin purchasing</option>
                                                <option value="2">user requestion</option>
                                                <option value="3">user approval</option>
                                                <option value="4">user payment order</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label>select division :</label>
                                            <select class="form-control" id="id_divisi" name="id_divisi" value="<?= set_value('role'); ?>">
                                                <option value="1">Keuangan</option>
                                                <option value="2">Ops Kantor</option>
                                                <option value="3">Ops Lapangan</option>
                                                <option value="4">Umum</option>
                                                <option value="5">Gudang</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('Webpage/get_login'); ?>" class="btn btn-dark float-right">done registration , back to login</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; SAR Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/sbadmin/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.all.min.js"></script>
</body>

</html>

</body>

</html>