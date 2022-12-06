<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i>Selamat Datang <?= $user['nama']; ?></i></h1>

    <!--panel info-->
    <!--Request Order info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Request Order Info</i></h5>
        </div>
        <div class="card-body">
            <div class="row">

                <!--query info-->
                <?php $id = $this->session->userdata('nip');
                $total = $this->db->get('request_order')->num_rows();
                $newcreate = array('status_pengajuan' => 1);
                $statusapprove = array('status_pengajuan' => 3);
                $statusreject = array('status_pengajuan' => 2);
                $statusproceed = array('status_pengajuan >' => 3);
                $statusdone = array('status_pengajuan' => 8);
                $disetujui = $this->db->get_where('request_order', $statusapprove)->num_rows();
                $ditolak = $this->db->get_where('request_order', $statusreject)->num_rows();
                $diproses = $this->db->get_where('request_order', $statusproceed)->num_rows();
                $selesai = $this->db->get_where('request_order', $statusdone)->num_rows();
                $baru = $this->db->get_where('request_order', $newcreate)->num_rows();


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

    <!--Cash Bank Requestion Order info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Cash Bank Requstion Info</i></h5>
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
    <!--Purchase Order info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Purchase Order Info</i></h5>
        </div>
        <div class="card-body">
            <div class="row">

                <!--query info-->
                <?php $id = $this->session->userdata('nip');
                $total = $this->db->get('purchase_order')->num_rows();
                ?>
                <!---->

                <!-- PO Total -->
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
            </div>
        </div>
    </div>

</div>
</div>