<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i>Selamat Datang <?= $user['nama']; ?></i></h1>

    <!--panel info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Cash Bank Requestion Info</i></h5>
        </div>
        <div class="card-body">
            <div class="row">

                <!--query info-->
                <?php $id = $this->session->userdata('nip');
                $total = $this->db->get('cashbank_requestion')->num_rows();
                $baru = $this->db->get_where('cashbank_requestion', array('status_cbr' => 1))->num_rows();
                $reject = $this->db->get_where('cashbank_requestion', array('status_cbr' => 2))->num_rows();
                $aprove = $this->db->get_where('cashbank_requestion', array('status_cbr' => 3))->num_rows();
                $paid = $this->db->get_where('cashbank_requestion', array('status_cbr' => 10))->num_rows();
                $proceed = $this->db->get_where('cashbank_requestion', array('status_cbr' > 3))->num_rows();

                ?>
                <!---->
                <!-- CBR Total -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Total</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $total; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-invoice-dollar fa-2x text-gray
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CBR Wait Approve -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Menunggu<br>Approval</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $baru; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-import fa-2x text-warning
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CBR Reject -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Ditolak</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $reject; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-danger
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CBR Approve -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Disetujui</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $aprove; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-2x text-success
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CBR Paid -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Lunas</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $paid; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-info
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card border-left-warning shadow h-100 m-xl-3">
            <div class="card card-header">
                <h3>Ketentuan Aplikasi</h3>
                <div class="card-body">
                    aplikasi ini digunakan untuk mempermudah proses pengadaan barang, anda memiliki hak untuk melakukan approval dan menginput data pembayaran yang diajukan dengan payment order dari Admin Purchasing.
                </div>
            </div>
        </div>
        <div class="card border-left-warning shadow h-100 mx-xl-3">
            <div class="card card-header">
                <h3>Panduan Informasi</h3>
                <div class="card-body">
                    <h5>berikut adalah informasi mengenai sistem aplikasi ini :<br>
                        Aplikasi ini hanya digunakan untuk internal perusahaan, ini berfungsi untuk pengajuan pengadaan barang silahkan download panduan nya dibawah :
                        <br /><br />
                        <a href="#" class="badge bg-light"><i class="fas fa-file-download ml-1 mr-2"></i>Panduan Pengadaan Barang</a><br />
                        <a href="#" class="badge bg-light"><i class="fas fa-file-download ml-1 mr-2"></i>Panduan User</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>