<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="ml-md-auto mb-2"><a class="btn btn-secondary" style="align-content:flex-end;" href="<?= base_url('requestorder/finish_request'); ?>" role="button">
            Kembali</a>
        <?php foreach ($request as $req) : ?>
            <a class="btn btn-info" style="align-content:flex-end;" href="<?= base_url('requestorder/save_pdf/' . $req['kode_ro']); ?>" role="button">
                Pdf</a>
        <?php endforeach; ?>
    </div>
    <div class="card card-header">
        <h2 class="text-center mt-3">Request Order</h2>
        <h5 class="text-center mb-5"></h5>
        <div class="card-body" class=" m-4">

            <!-- Page Heading -->
            <?= $this->session->flashdata('msg'); ?>
            <div>
                <table class="table-responsive">
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <td><?= $user['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <th>:</th>
                        <td><?= $user['nip']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>:</th>
                        <td><?= $user['email']; ?></td>
                    </tr>
                </table>
                <hr />
                <table class="table table-responsive-sm table-stripped border-3">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Kode Order</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Order</th>
                            <th>Satuan</th>
                            <th>foto rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody align=center>
                        <?php
                        $no = 1;
                        foreach ($items as $row) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode_order'] ?></td>
                                <td><?= $row['jenis_barang'] ?></td>
                                <td><?= $row['desk_barang'] ?></td>
                                <td><?= $row['qty_order'] ?></td>
                                <td><?= $row['sat_order'] ?></td>
                                <td><img src="<?= base_url(); ?>assets/img/foto-order/<?= $row['img_order']; ?>" style="max-width:100%; max-height: 100%; height: 100px; width: 80px"></td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
                <hr>
                <table>
                    <?php
                    foreach ($request as $row) {
                    ?>
                        <tr>
                            <th>Alasan Request</th>
                            <td><?= $row['kode_ro'] ?></td>
                        </tr>
                        <tr>
                            <th>Dijukan Tanggal</th>
                            <td><?= date("d/m/Y-H/i/s" . $row['submit_date']) ?></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->