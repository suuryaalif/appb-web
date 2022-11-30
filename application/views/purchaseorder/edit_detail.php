<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Edit Detail PO</h1>
    <!-- Page Body -->
    <div class="card">
        <div class="row">
            <div class="ml-5 mt-3">
                <a class="btn btn-secondary" href="<?= base_url('purchaseorder/detail/' . $kode_po) ?>" role="button">Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?php foreach ($detail_po as $dpo) : ?>
                    <?= form_open_multipart('purchaseorder/update_detail/' . $dpo['id_dpo']); ?>
                    <div class="card-body ml-5 mt-3">
                        <label>Kode Po :</label>
                        <input class="form-control mb-1" type="text" id="kode_purchase" name="kode_purchase" value="<?= $kode_po; ?>" readonly>
                        <label class="mt-2">Jenis Barang</label>
                        <select class="form-control mb-1" id="jenis_barang" name="jenis_barang">
                            <option value="<?= $dpo['jenis_barang'] ?>" disabled selected><?= $dpo['jenis_barang'] ?></option>
                            <option>ATK</option>
                            <option>RTK</option>
                            <option>Mesin Cetak</option>
                            <option>Aksesoris Mesin Cetak</option>
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
                        <input type="text" name="desk_barang" id="desk_barang" class="form-control mb-1" placeholder="deskripsikan barang yang anda inginkan" value="<?= $dpo['desk_barang'] ?>" required>
                        <label class="mt-2">Jumlah Order</label>
                        <input type="int" name="qty_order" placeholder="masukan jumlah hanya angka" class="form-control mb-1" value="<?= $dpo['qty_order'] ?>">
                        <label class="mt-2">Satuan Jumlah</label>
                        <select class="form-control mb-1" name="sat_order">
                            <option value="<?= $dpo['sat_order'] ?>" disabled selected><?= $dpo['sat_order'] ?></option>
                            <option>Unit</option>
                            <option>Pasang</option>
                            <option>Buku</option>
                            <option>Rim</option>
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
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit"><i class=" fa fa-plus"> Simpan</i>
                        </button>
                    </div>
                <?php endforeach; ?>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->