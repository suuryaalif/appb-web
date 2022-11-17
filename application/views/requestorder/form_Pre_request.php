<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="col-md-2 ml-md-auto mb-2"><a class="btn btn-secondary" style="align-content:flex-end;" href="<?= base_url('requestorder'); ?>" role="button">
            Kembali</a>
    </div>
    <div class="card card-header">
        <h2 class="text-center mt-3">Formulir Permintaan Barang</h2>
        <h5 class="text-center mb-5">Isian Data Barang</h5>
        <div class="card-body" class=" m-4">
            <!-- Page Heading -->
            <?= $this->session->flashdata('msg'); ?>
            <div>
                <form method="POST" action="<?= base_url('requestorder/add_new_detail'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col mb-2">
                            <!-- dibawah ini inputan yang muncul kode request order selanjutnya secara otomatis -->
                            <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="No Permintaan : <?= $kodeotomatis; ?>" value="<?= $kodeotomatis; ?>" readonly>
                        </div>
                    </div>
                    <div class="control-group after-add-more">
                        <label class="mt-2">Jenis Barang</label>
                        <select class="form-control mb-1" id="jenis_barang" name="jenis_barang">
                            <option>ATK</option>
                            <option>RTK</option>
                            <option>Mesin Cetak</option>
                            <option>Cetakan</option>
                            <option>Laptop/PC</option>
                            <option>Aksesoris Laptop/PC</option>
                            <option>Cetakan</option>
                            <option>Alat Safety</option>
                            <option>Alat Packing</option>
                            <option>Seragam/Pakaian</option>
                            <option>lain-lain</option>
                        </select>
                        <label class="mt-2">Deskripsi Barang</label>
                        <input type="text" name="desk_barang" id="desk_barang" class="form-control mb-1" placeholder="deskripsikan barang yang anda inginkan" required>
                        <label class="mt-2">Jumlah Order</label><?= form_error('qty_order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <input type="int" name="qty_order" class="form-control mb-1">
                        <label class="mt-2">Satuan Jumlah</label>
                        <select class="form-control mb-3" name="sat_order">
                            <option>Unit</option>
                            <option>Pasang</option>
                            <option>Stel</option>
                            <option>Pak</option>
                            <option>Lusin</option>
                            <option>Kodi</option>
                            <option>Pcs</option>
                            <option>Kg</option>
                            <option>Set</option>
                            <option>Bundle</option>
                            <option>Roll</option>
                            <option>Box</option>
                            <option>Liter</option>
                            <option>dll</option>
                        </select>
                        <label>Upload Foto Rekomendasi</label>
                        <div class="form-group">
                            <input type="file" class="form-control" id="foto_order" name="foto_order" required>
                        </div>
                        <br>
                        <div class="text-center mt-3">
                            <button class="btn btn-success" type="submit"><i class=" fa fa-plus"> Tambah Barang</i>
                            </button>

                            <!--ini fungsi kalau ngecek apakah detail_request udah diisi, kalau belum diisi, sampai mati gak bisa di klik itu tombol lanjutkan -->
                            <?php
                            if (empty($detail)) { ?>
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anda wajib mengisi data detail!">
                                    <i class="fas fa-check"></i> Lanjutkan Proses
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-check"></i> Lanjutkan Proses</button>
                            <?php } ?>
                            <hr>
                        </div>
                </form>
                <hr>
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
                                <td><a class="btn btn-danger far fa-thrash-alt" href="<?= base_url('requestorder/delete_detail/'); ?><?= $row['id']; ?>"><i class="far fa-times-circle"> Hapus</i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal konfirmasi lanjutkan-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                periksa kembali isian data anda dan pastikan telah benar, klik lanjutkan bila sudah yakin
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <a class="btn btn-primary" href="<?= base_url('requestorder/get_fin_request'); ?>" role="button">Lanjutkan</a>
            </div>
        </div>
    </div>
</div>