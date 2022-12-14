<!-- Begin Page Content -->
<?php foreach ($request as $req) : ?>
    <div class="container-fluid">
        <div class="col-md-2 ml-md-auto mb-2"><a class="btn btn-secondary" style="align-content:flex-end;" href="<?= base_url('requestorder/detail/' . $req['kode_ro']); ?>" role="button">
                Kembali</a>
        </div>
    <?php endforeach; ?>

    <div class="card card-header">
        <h2 class="text-center mt-3">Formulir Edit</h2>
        <h5 class="text-center mb-5">Edit Isian Data Barang</h5>
        <div class="card-body" class=" m-4">
            <!-- Page Heading -->

            <?= $this->session->flashdata('msg'); ?>
            <div>
                <div class="row">
                    <?php foreach ($request as $req) : ?>
                        <div class="row">
                            <div class="col-auto"><a class="btn btn-success" href="<?= base_url('requestorder/get_add_byedit/') . $req['kode_ro']; ?>" role="button"><i class="fa fa-plus"></i> Tambah Detail</a></div>
                        </div>
                        <div class="col mb-2">
                            <input type="hidden" class="form-control" id="kode_order" name="kode_order" placeholder="<?= $req['kode_ro']; ?>" value="<?= $req['kode_ro']; ?>" readonly>
                        </div>
                    <?php endforeach; ?>
                </div>
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
                            <th></th>
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
                                <td>
                                    <a class="btn btn-info far fa-thrash-alt" href="<?= base_url('requestorder/form_edit_detail/'); ?><?= $row['id_detail']; ?>"><i class="far fa-edit"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-danger far fa-thrash-alt" href="<?= base_url('requestorder/delete_detailByID/'); ?><?= $row['id_detail']; ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php foreach ($request as $req) : ?>
                    <div class="col-md-auto">
                        <a class="btn btn-primary" href="<?= base_url('requestorder/form_edit_request/' . $req['kode_ro']); ?>" role="button">Selanjutnya</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->