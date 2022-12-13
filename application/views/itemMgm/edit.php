<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Edit Data Barang Pengadaan</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <?php foreach ($dataItem as $itm) : ?>
                <?= form_open_multipart('item/save/' . $itm['id_barang']); ?>
                <div class="row table-responsive-sm">
                    <div class="col-lg-5">
                        <label class="my-1">Nomor Barang</label>
                        <input type="text" id="kode_barang" name="kode_barang" class="form-control my-2" value="<?= $itm['kode_barang']; ?>" readonly>
                        <label class="my-1">Nomor Request Order</label>
                        <select class="form-control my-2" id="kode_ro" name="kode_ro">
                            <?php foreach ($kode_ro as $kdr) : ?>
                                <option selected><?= $itm['kode_ro']; ?></option>
                                <option><?= $kdr['kode_ro']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="my-1">Nomor Purchase Order</label>
                        <select class="form-control my-2" name="kode_po" id="kode_po">
                            <?php foreach ($kode_po as $kdp) : ?>
                                <option selected><?= $itm['kode_po']; ?></option>
                                <option><?= $kdp['kode_pur']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="my-1">Kategori</label>
                        <select class="form-control my-2" id="kategori_barang" name="kategori_barang">
                            <option selected><?= $itm['kategori_barang']; ?></option>
                            <option>Inventaris</option>
                            <option>Perlengkapan</option>
                        </select>
                        <label class="my-1">Jenis Barang</label>
                        <select class="form-control mb-1" id="jenis_barang" name="jenis_barang" required>
                            <option selected><?= $itm['jenis_barang']; ?></option>
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
                            <option>Kendaraan</option>
                            <option>Aksesoris Kendaraan</option>
                            <option>Spare Part Kendaraan</option>
                            <option>AC</option>
                            <option>Aksesoris AC</option>
                            <option>lain-lain</option>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <label class="my-1">Nama Barang</label>
                        <input class="form-control my-2" type="text" id="nama_barang" name="nama_barang" value="<?= $itm['nama_barang']; ?>" required>
                        <label class="my-1">Deskripsi Barang</label>
                        <textarea class="form-control my-2" type="text" id="desk_barang" name="desk_barang"><?= $itm['desk_barang']; ?></textarea>
                        <label class="my-1">Jumlah Barang</label>
                        <input class="form-control my-2" type="text" id="qty_barang" name="qty_barang" value="<?= $itm['qty_barang']; ?>" required>
                        <label class="my-1">Satuan Jumlah</label>
                        <select class="form-control my-1" id="sat_barang" name="sat_barang" required>
                            <option selected><?= $itm['sat_barang']; ?></option>
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
                        <label class="my-1">Tanggal Terima Barang</label>
                        <input class="form-control" type="date" id="tgl_terima" name="tgl_terima" value="<?= $itm['tgl_terima']; ?>" required>
                        <div class="offset-7 mt-4">
                            <a class="btn btn-secondary" href="<?= base_url('item'); ?>" role="button">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-1">Simpan</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                <?php endforeach; ?>
                </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->