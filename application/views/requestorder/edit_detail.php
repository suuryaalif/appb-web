<div class="card card-header">
    <h5 class="text-center mb-5">Edit Data Barang</h5>
    <div class="card-body" class=" m-4">
        <!-- Page Heading -->
        <div class="container">
            <form method="POST" action="<?= base_url('requestorder/add_new_detail'); ?>" enctype="multipart/form-data">
                <div class="row">
                    <?php foreach ($detail as $det) : ?>
                        <input type="hidden" class="form-control" id="kode_order" name="kode_order" placeholder="<?= $det['id_detail']; ?>" value="<?= $det['id_detail']; ?>">
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
                        <input type="text" name="desk_barang" id="desk_barang" class="form-control mb-1" placeholder="<?= $det['desk_barang']; ?>" required>
                        <label class="mt-2">Jumlah Order</label>
                        <?= form_error('qty_order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <input type="int" name="qty_order" class="form-control mb-1" placeholder="<?= $det['qty_order']; ?>">
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
                        <input type="file" class="form-control" id="foto_order" name="foto_order" placeholder="<?= $det['img_order']; ?>" required>
                        <br>
                    <?php endforeach; ?>
                </div>
            </form>
            <div class="text-center mt-3">
                <button class="btn btn-success" type="submit"><i class=" fa fa-plus"> Tambah Barang</i>
                </button>
            </div>
        </div>
    </div>
</div>