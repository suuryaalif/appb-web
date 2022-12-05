<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Edit Cashbank Requestion</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-header">
            <h5>Silahkan Edit Formulir Dibawah Ini</h5>
        </div>
        <div class="card-body">
            <?php foreach ($cashbank as $cbr) : ?>
                <?= form_open_multipart('cashbank/update_cbr/' . $cbr['id_cbr']); ?>
                <div class="row">
                    <div class="col-lg-7">
                        <label>Kode CBR</label>
                        <input class="form-control mb-2" type="text" name="kode_cbr" id="kode_cbr" value="<?= $cbr['kode_cbr']; ?>" readonly>
                        <label>Kode Request Order</label>
                        <?= form_error('kode_req', '<small class="text-danger pl-3">', '</small>'); ?>
                        <select name="kode_req" id="kode_req" class="form-control mb-2">
                            <option selected value="<?= $cbr['kode_req']; ?>"><?= $cbr['kode_req']; ?></option>
                            <?php foreach ($kodero as $ro) : ?>
                                <option value="<?= $ro['kode_ro'] ?>"><?= $ro['kode_ro'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Kode Purchase Order</label>
                        <?= form_error('kode_pur', '<small class="text-danger pl-3">', '</small>'); ?>
                        <select id="kode_pur" name="kode_pur" class="form-control mb-2">
                            <option selected value="<?= $cbr['kode_pur']; ?>"><?= $cbr['kode_pur']; ?></option>
                            <?php foreach ($kodepo as $po) : ?>
                                <option value="<?= $po['kode_po'] ?>"><?= $po['kode_po'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Deskripsi Cash Bank Requestion</label>
                        <?= form_error('desk_cbr', '<small class="text-danger pl-3">', '</small>'); ?>
                        <textarea id="desk_cbr" name="desk_cbr" class="form-control mb-2" type="text"><?= $cbr['desk_cbr']; ?></textarea>
                        <label>Nominal Biaya Pengajuan</label>
                        <?= form_error('biaya', '<small class="text-danger pl-3">', '</small>'); ?>
                        <br>
                        Rp <input value="<?= $cbr['biaya']; ?>" id="biaya" name="biaya" type="number" class="form-control mb-2" placeholder="masukan hanya nilai, tanpa titik atau koma">
                        <label>Supplier</label>
                        <select id="id_supplier" name="id_supplier" class="form-control" required>
                            <option selected value="<?= $cbr['id_supplier']; ?>"><?= $cbr['nama_sup']; ?></option>
                            <?php foreach ($supplier as $sp) : ?>
                                <option value="<?= $sp['id_sup'] ?>"><?= $sp['nama_sup'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="mt-2">Tanggal Jatuh Tempo</label>
                        <?= form_error('tempo_byr', '<small class="text-danger pl-3">', '</small>'); ?>
                        <input type="date" name="tempo_byr" id="tempo_byr" class="form-control mb-1" value="<?= $cbr['tempo_byr']; ?>">
                        <label>Cara Pembayaran</label>
                        <select id="cara_byr" name="cara_byr" class="form-control">
                            <option selected value="<?= $cbr['cara_byr']; ?>"><?= $cbr['cara_byr']; ?></option>
                            <option value="cash">cash</option>
                            <option value="transfer">transfer</option>
                        </select>
                        <label class="mt-2">Tanggal Pengajuan</label>
                        <?= form_error('tgl_cbr', '<small class="text-danger pl-3">', '</small>'); ?>
                        <input value="<?= $cbr['tgl_cbr']; ?>" type="date" name="tgl_cbr" id="tgl_cbr" class="form-control mb-1">
                        <div class="mt-4 offset-lg-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>