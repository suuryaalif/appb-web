<!-- Begin Page Content -->
<div class="container-fluid">
    <?php foreach ($request as $req) : ?>
        <div class="col-md-2 ml-md-auto mb-2"><a class="btn btn-secondary" style="align-content:flex-end;" href="<?= base_url('requestorder/get_data_edit/' . $req['kode_ro']); ?>" role="button">Kembali</a>
        </div>
    <?php endforeach; ?>
    <div class="card card-header">
        <h2 class="text-center mt-3">Tambah Detail</h2>
        <div class="card-body" class=" m-4">
            <?php foreach ($request as $req) : ?>
                <?= form_open_multipart('requestorder/add_new_detail/' . $req['kode_ro']); ?>
                <div class="row">
                    <div class="col mb-2">
                        <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="No Permintaan : <?= $req['kode_ro'] ?>" value="<?= $req['kode_ro'] ?>" readonly>
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
                    <?php
                    if (isset($error)) {
                        echo "ERROR UPLOAD : <br/>";
                        print_r($error);
                        echo "<hr/>";
                    }
                    ?>
                    <br>
                    <div class="text-center mt-3">
                        <button class="btn btn-success" type="submit"><i class=" fa fa-plus"> Tambah Barang</i>
                        </button>
                    <?php endforeach; ?>
                    <?= form_close(); ?>
                    </div>
                </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->