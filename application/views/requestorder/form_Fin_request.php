<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card card-header">
        <h2 class="text-center mt-3">Formulir Permintaan Barang</h2>
        <h5 class="text-center mb-5">Isian Keterangan Permintaan</h5>
        <div class="card-body" class=" m-4">

            <!-- Page Heading -->
            <?= $this->session->flashdata('msg'); ?>
            <div>
                <table class="table table-responsive-sm border-3" id="datatable">
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
                        <?php $no = 0;
                        foreach ($detail as $row) :
                            $no++;
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
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="POST" action="<?= base_url('') ?>requestorder/insert_fin_request/<?= $kodeotomatis; ?>">
                    <hr>
                    <h5 class="mt-4 text-center">silahkan isi form dibawah ini</h5>
                    <div class="control-group">
                        <!-- dibawah ini inputan yang muncul kode request order selanjutnya secara otomatis -->
                        <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="No Permintaan : <?= $kodeotomatis; ?>" value="<?= $kodeotomatis; ?>" readonly>
                        <label class="mt-2">Alasan Permintaan</label>
                        <input type="text" name="alasan_req" id="alasan_req" class="form-control mb-1" placeholder="Masukan Keterangan Request Anda" required>
                        <label class="mt-2">Tanggal Request</label>
                        <input type="date" name="submit_date" id="submit_date" class="form-control mb-1">
                        <br>
                        <div class="text-center mt-3">
                            <a class="btn btn-secondary" href="<?= base_url('requestorder/get_pre_request'); ?>" role="button">Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>
                                Submit Request Order
                            </button>
                            <hr>
                        </div>
                    </div>
                </form>

                <hr>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->