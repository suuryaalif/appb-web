<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Edit Purchase Order</h1>
    <!-- Page Body -->
    <div class="card">
        <div class="row">
            <div class="ml-5 mt-3">
                <a class="btn btn-secondary" href="<?= base_url('purchaseorder/detail/' . $kode_po) ?>" role="button">Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?php foreach ($data_po as $dpo) : ?>
                    <?= form_open_multipart('purchaseorder/save_po_edited/' . $kode_po); ?>
                    <div class="card-body ml-5 mt-3">
                        <label>Kode Po :</label>
                        <input class="form-control mb-1" type="text" id="kode_po" name="kode_po" value="<?= $kode_po; ?>" readonly>
                        <label class="mt-2">Kode Request Order</label>
                        <select class="form-control mb-1" id="kode_ro" name="kode_ro">
                            <option value="<?= $dpo['kode_ro'] ?>"><?= $dpo['kode_ro'] ?></option>
                            <?php foreach ($ro as $kd) : ?>
                                <option value="<?= $kd['kode_ro']; ?>"><?= $kd['kode_ro']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="mt-2">Keterangan PO</label>
                        <input type="text" name="desk_po" id="desk_po" class="form-control mb-1" placeholder="Keterangan PO" value="<?= $dpo['desk_po'] ?>" required>
                        <label class="mt-2">Nama Supplier</label>
                        <select class="form-control mb-1" name="id_sup" id="id_sup">
                            <option value="<?= $dpo['id_supplier'] ?>"><?= $dpo['nama_sup'] ?></option>
                            <?php foreach ($supplier as $sup) : ?>
                                <option value="<?= $sup['id_sup'] ?>"><?= $sup['nama_sup'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="mt-2">Tanggal PO</label>
                        <input type="date" name="tgl_po" id="tgl_po" class="form-control mb-1" value="<?= $dpo['tgl_po'] ?>">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Simpan</i>
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