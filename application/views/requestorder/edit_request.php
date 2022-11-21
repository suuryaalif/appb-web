<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card card-header">
        <h2 class="text-center mt-3">Formulir Edit</h2>
        <h5 class="text-center mb-5">Edit Keterangan Permintaan</h5>
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
                <hr>
                <h5 class="mt-4 text-center">silahkan edit form dibawah ini</h5>
                <div class="control-group">
                    <?php foreach ($request as $req) : ?>
                        <?= form_open_multipart('requestorder/save_edit_request/' . $req['kode_ro']); ?>
                        <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="No Permintaan : <?= $req['kode_ro']; ?>" value="<?= $req['kode_ro']; ?>" readonly>
                        <label class="mt-2">Alasan Permintaan</label>
                        <input type="text" name="alasan_req" id="alasan_req" class="form-control mb-1" value="<?= $req['alasan_req']; ?>" required>
                        <label class="mt-2">Tanggal Request</label>
                        <input type="date" name="submit_date" id="submit_date" class="form-control mb-1" value="<?= $req['submit_date']; ?>">
                        <br>
                        <?php foreach ($request as $req) : ?>
                            <div class="text-center mt-3">
                                <a class="btn btn-secondary" href="<?= base_url('requestorder/get_data_edit/' . $req['kode_ro']); ?>" role="button">Kembali</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>
                                    Submit Request Order
                                </button>
                                <hr>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php form_close(); ?>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->