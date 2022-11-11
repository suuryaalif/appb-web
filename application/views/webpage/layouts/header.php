<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cerindo Website</title>
    <!-- Tabicon-->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets') ?>/img/c.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('assets') ?>/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/font-awesome/css/fontawesome.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <!-- logo cerindo pada navbar -->
            <a class="navbar-brand" href="#"><img width="120px" class="img-fluid" src="<?= base_url('assets') ?>/img/logo/text_logo.png"></a>
            <!-- toogler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <!-- About Us l -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Webpage/index'); ?>">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Webpage/service'); ?>">Service</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Webpage/contact'); ?>">Contact</a></li>
                    <li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            APPBweb
                        </button></li>
                </ul>
            </div>
        </div>
    </nav>