<div class="card card-header">
    <h5 class="text-center mb-5">Edit Data Barang</h5>
    <div class="card-body" class=" m-4">
        <!-- Page Heading -->
        <div class="container">
            <?php foreach ($detail as $det) : ?>
                <?= form_open_multipart('requestorder/save_edit_detail/' . $det['id_detail']); ?>
                <div class="row">
                    <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="<?= $det['kode_order']; ?>" value="<?= $det['kode_order']; ?>" readonly>
                    <label class="mt-2">Jenis Barang</label>
                    <select class="form-control mb-1" id="jenis_barang" name="jenis_barang">
                        <option value="<?= $det['jenis_barang']; ?>" disabled selected><?= $det['jenis_barang']; ?></option>
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
                    <input type="text" name="desk_barang" id="desk_barang" class="form-control mb-1" placeholder="<?= $det['desk_barang']; ?>" value="<?= $det['desk_barang']; ?>" required>
                    <label class="mt-2">Jumlah Order</label>
                    <?= form_error('qty_order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <input type="int" name="qty_order" class="form-control mb-1" placeholder="<?= $det['qty_order']; ?>" value="<?= $det['qty_order']; ?>">
                    <label class="mt-2">Satuan Jumlah</label>
                    <select class="form-control mb-3" name="sat_order">
                        <option value="<?= $det['sat_order']; ?>" disabled selected><?= $det['sat_order']; ?></option>
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
                    <br />
                    <input type="file" class="form-control" id="foto_order" name="foto_order" placeholder="<?= $det['img_order']; ?>">
                    <?php
                    if (isset($error)) {
                        echo "ERROR UPLOAD : <br/>";
                        print_r($error);
                        echo "<hr/>";
                    }
                    ?>
                    <br>
                <?php endforeach; ?>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-success" type="submit"><i class=" fa fa-plus">Simpan Hasil Edit</i>
                    </button>
                </div>
                <?php form_close() ?>
        </div>

    </div>
</div>