<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i>Selamat Datang <?= $user['nama']; ?></i></h1>
    <div class="row">
        <!--ini kolom panel informasi -->
        <!--Total RO-->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card bg-info mb-4" style="max-width: 25rem;">
                <div class="card border border-primary shadow h-50 mb-1" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-auto mr-3">
                                <i class="fas fa-file-import fa-3x text-gray-300"></i>
                            </div>
                            <!--  -->
                            <div class="col-auto">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 pb-4">
                                    Total Request Order</div>
                                <?php $jumlah_ro = $this->db->get('request_order')->num_rows();
                                if ($jumlah_ro >= 1) : ?>
                                    <div class="h3 mb-0 font-weight-bold text-gray-500 text-center">
                                        <?php echo $jumlah_ro; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="h3 mb-0 font-weight-bold text-center">
                                        <?php echo $jumlah_ro; ?></div>
                                <?php endif; ?>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ro Ditolak  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger mb-4" style="max-width: 25rem;">
                <div class="card border border-primary shadow h-50 mb-1" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-auto mr-3">
                                <i class="fas fa-file-excel fa-3x text-gray-300"></i>
                            </div>
                            <!--  -->
                            <div class="col mr-2 pb-1">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Request Order Ditolak</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800 text-center">
                                    <?php
                                    $reject_ro = $this->db->get_where('request_order', 'status_pengajuan = 2')->num_rows();
                                    echo $reject_ro;
                                    ?>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ro Disetujui  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success mb-4" style="max-width: 25rem;">
                <div class="card border border-primary shadow h-50 mb-1" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-auto mr-3 pb-1">
                                <i class="fa fa-thumbs-up fa-3x text-gray-300"></i>
                            </div>
                            <!--  -->
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Request Order Disetujui</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800 text-center">
                                    <?php $disetujui = $this->db->get_where('request_order', 'status_pengajuan = 3')->num_rows();
                                    echo $disetujui; ?>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ro Baru  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning mb-4" style="max-width: 25rem;">
                <?php $new_order = $this->db->get_where('request_order', 'status_pengajuan = 1')->num_rows(); ?>
                <!--  -->
                <?php if (!empty($new_order)) : ?>
                    <div class="card border border-success shadow h-50 mb-1" style="max-width: 20rem;">
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-auto mr-3">
                                    <span class="badge badge-danger"><i class="fa fa-bell fa-3x"></span></i>
                                <?php else : ?>
                                    <div class="card border border-primary shadow h-50 mb-1" style="max-width: 20rem;">
                                        <div class="card-body">
                                            <div class="row no-gutters">
                                                <div class="col-auto mr-3">
                                                    <i class="fa fa-bell fa-3x"></i>
                                                <?php endif; ?>
                                                <!--  -->
                                                </div>
                                                <div class="col mr-2 pb-1">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-4">
                                                        Request Order Baru!</div>
                                                    <div class="h3 mb-0 font-weight-bold text-gray-800 text-center">
                                                        <?php echo $new_order; ?>
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