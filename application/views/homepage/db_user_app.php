<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i>Selamat Datang <?= $user['nama']; ?></i></h1>

    <!--panel info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Request Order Info Divisi <?= $user_info['divisi']; ?></i></h5>
        </div>
        <div class="card-body">
            <div class="row">

                <!--query info-->
                <?php $id = $this->session->userdata('nip');
                $divisi = $this->session->userdata('id_divisi');
                $total = $this->db->get_where('request_order', array('divisi' => $divisi))->num_rows();
                $newcreate = array('divisi' => $divisi, 'status_pengajuan' => 1);
                $statusapprove = array('divisi' => $divisi, 'status_pengajuan' => 3);
                $statusreject = array('divisi' => $divisi, 'status_pengajuan' => 2);
                $statusproceed = array('divisi' => $divisi, 'status_pengajuan >' => 3);
                $statusdone = array('divisi' => $divisi, 'status_pengajuan' => 8);
                $disetujui = $this->db->get_where('request_order', $statusapprove)->num_rows();
                $ditolak = $this->db->get_where('request_order', $statusreject)->num_rows();
                $diproses = $this->db->get_where('request_order', $statusproceed)->num_rows();
                $selesai = $this->db->get_where('request_order', $statusdone)->num_rows();
                $baru = $this->db->get_where('request_order', $newcreate)->num_rows();

                $draft = $this->db->get_where('temp_order', array('id_user' => $id))->num_rows();
                if ($draft >= 1) {
                    $tampilkan_draft = "1";
                } else {
                    $tampilkan_draft = "kosong";
                }
                ?>
                <!---->

                <!-- Request Order Total -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Total</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $total; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-import fa-2x text-primary
                        "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menunggu Approval -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Menuggu Approval</div>
                                    <!-- kondisi -->
                                    <?php if ($baru == 0) : ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $baru; ?></div>
                                    <?php else : ?>
                                        <div class="h5 mb-0 font-weight-bold text-white"><span class="badge badge-danger"><?= $baru; ?></span></div>
                                    <?php endif; ?>
                                    <!-- kondisi -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-edit fa-2x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Order Disetujui -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i>Telah Disetujui</i>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $disetujui; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Order Ditolak -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Ditolak</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ditolak; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-excel fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Order Diproses -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Diproses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $diproses; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-sync-alt fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Order Selesai -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Selesai</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $selesai; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray"></i>
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
                    <p>berikut adalah informasi mengenai sistem aplikasi ini :</p>
                    <br>
                    <p>"hak aplikasi anda hanyalah sebagai approval , anda hanya mempunyai akses untuk melihat total request order dari divisi anda dan melakukan approval dari request order yang sesuai divisi anda"</p>
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