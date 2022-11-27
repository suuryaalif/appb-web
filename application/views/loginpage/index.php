<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="login_appb" />
    <meta name="author" content="SAR" />
    <title>Login - APPB</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.min.css">
</head>

<body class="" style="background-color:darkturquoise ;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center bg-transparent shadow-lg">
            <div class="col-lg-7">

                <div class="card bg-light o-hidden border-0 shadow-lg  my-5">
                    <div class="card-body p-5">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to APPBweb!</h1>
                                        <img class="img-fluid" src="<?= base_url('assets'); ?>/img/logo/text_logo.png">
                                    </div>
                                    <hr>
                                    <h1 class="h3 text-gray-900 text-center mb-5">Login Page</h1>
                                    <!-- formulir login -->
                                    <div><?= $this->session->flashdata('warning'); ?></div>
                                    <div><?= $this->session->flashdata('msg'); ?></div>
                                    <?= form_open_multipart('auth'); ?>
                                    <div class="form-group">
                                        <!-- input email -->
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger p-lg-3">', '</small>'); ?>
                                    </div>
                                    <!-- formulir password -->
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger p-lg-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                <?= form_close(); ?>
                                <hr>
                                <div class="text-center">
                                    <button type="button" id="tombol" class="btn btn-light">Need an account? Request to admin purhasing!</button>
                                </div>
                                <div class="p-1 mb-1">
                                    <a class="btn btn-blok btn-light float-right p-2" href="<?= base_url('webpage/get_registration'); ?>" hidden>Registration Form</a>
                                    <a href="<?= base_url('webpage'); ?>" class="btn btn-light btn-block">
                                        Kembali ke halaman website
                                    </a>
                                </div>
                            </div>
                        </div>
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
    <script>
        const tombol = document.querySelector('#tombol');
        tombol.addEventListener('click', function() {
            new Swal({
                icon: 'error',
                title: 'Sorry its not available',
                text: "you can't make request from website, call admin purchasing for account",
            });
        });
    </script>
</body>

</html>

</body>

</html>