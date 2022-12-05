<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Formulir Cashbank Requestion</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-header">
            <h5>Silahkan isi formulir dibawah ini</h5>
        </div>
        <div class="card-body">
            <?= form_open_multipart('cashbank/add_new'); ?>
            <div class="row">
                <div class="col-lg-7">
                    <label>Kode CBR</label>
                    <input class="form-control mb-2" type="text" name="kode_cbr" id="kode_cbr" value="<?= $kodeotomatis; ?>" readonly>
                    <label>Kode Request Order</label>
                    <?= form_error('kode_req', '<small class="text-danger pl-3">', '</small>'); ?>
                    <select name="kode_req" id="kode_req" class="form-control mb-2">
                        <option disabled selected>silahkan pilih</option>
                        <?php foreach ($kodero as $ro) : ?>
                            <option value="<?= $ro['kode_ro'] ?>"><?= $ro['kode_ro'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Kode Purchase Order</label>
                    <?= form_error('kode_pur', '<small class="text-danger pl-3">', '</small>'); ?>
                    <select id="kode_pur" name="kode_pur" class="form-control mb-2">
                        <option disabled selected>silahkan pilih</option>
                        <?php foreach ($kodepo as $po) : ?>
                            <option value="<?= $po['kode_po'] ?>"><?= $po['kode_po'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Deskripsi Cash Bank Requestion</label>
                    <?= form_error('desk_cbr', '<small class="text-danger pl-3">', '</small>'); ?>
                    <textarea id="desk_cbr" name="desk_cbr" class="form-control mb-2" type="text"></textarea>
                    <label>Nominal Biaya Pengajuan</label>
                    <?= form_error('biaya', '<small class="text-danger pl-3">', '</small>'); ?>
                    <br>
                    Rp <input id="biaya" name="biaya" type="number" class="form-control mb-2" placeholder="masukan hanya nilai, tanpa titik atau koma">
                    <label>Supplier</label>
                    <select id="id_supplier" name="id_supplier" class="form-control" required>
                        <option disabled selected>silahkan pilih</option>
                        <?php foreach ($supplier as $sp) : ?>
                            <option value="<?= $sp['id_sup'] ?>"><?= $sp['nama_sup'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="mt-2">Tanggal Jatuh Tempo</label>
                    <?= form_error('tempo_byr', '<small class="text-danger pl-3">', '</small>'); ?>
                    <input type="date" name="tempo_byr" id="tempo_byr" class="form-control mb-1">
                    <label>Cara Pembayaran</label>
                    <select id="cara_byr" name="cara_byr" class="form-control">
                        <option value="cash">cash</option>
                        <option value="transfer">transfer</option>
                    </select>
                    <label class="mt-2">Tanggal Pengajuan</label>
                    <?= form_error('tgl_cbr', '<small class="text-danger pl-3">', '</small>'); ?>
                    <input type="date" name="tgl_cbr" id="tgl_cbr" class="form-control mb-1">
                    <div class="mt-4 offset-lg-10">
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>