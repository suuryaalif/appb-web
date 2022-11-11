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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.min.css">
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container p-lg-3">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login Page</h3>
                                </div>
                                <div class="card-body">
                                    <div><?= $this->session->flashdata('warning'); ?></div>

                                    <!-- formulir login -->
                                    <form class="user" action="<?= base_url('Auth'); ?>" method="POST">
                                        <!-- input email -->
                                        <label>Email address</label>
                                        <div class="form-floating mb-3">
                                            <input class=" form-control" id="email" name="Email" placeholder="name@example.com" autofocus />
                                            <?= form_error('email', '<small class="text-danger p-lg-3">', '</small>'); ?>
                                        </div>
                                        <!-- input password -->
                                        <label>Password</label>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="Password" type="password" placeholder="Password" autofocus />
                                            <?= form_error('password', '<small class="text-danger p-lg-3">', '</small>'); ?>
                                        </div>
                                        <!-- remember me -->
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <!-- forget password & login button-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary" href="<?= base_url('Auth') ?>">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><button type="button" id="tombol" class="btn btn-light">Need an account? Request to admin purhasing!</button></div>
                                </div>
                                <div class="card text-center py-2"><a href="<?= base_url('Webpage/index'); ?>" class="btn btn-light">Back To Official Website</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets'); ?>/sbadmin/js/scripts.js"></script>
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