<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Formulir Edit Data Pembayaran</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="row my-3 mx-1">
            <a class="btn btn-secondary" href="<?= base_url('cashbank/get_pay_data') ?>" role="button">Kembali</a>
        </div>
        <div class="card-header">
            <h5>Silahkan edit data pembayaran dibawah ini</h5>
        </div>
        <div class="card-body">
            <?php foreach ($payment as $pay) : ?>
                <?= form_open_multipart('cashbank/save_confirm/' . $pay['id_byr']); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Kode Pembayaran</label>
                        <input type="text" name="kode_byr" id="kode_bayar" class="form-control my-1" value="<?= $pay['kode_byr']; ?>" readonly>
                        <label>Kode Cash Bank Request</label>
                        <input type="text" name="kode_cbr" id="kode_cbr" class="form-control my-1" value="<?= $pay['kode_cbr']; ?>" readonly>
                        <label>Total Pembayaran</label>
                        <input type="text" name="total_byr" id="total_byr" class="form-control my-1" value="<?= $pay['total_byr']; ?>">
                        <small>masukan hanya nominal tanpa titik, koma dan rupiah</small><br>
                        <label class="mt-2">Tgl Pembayaran</label>
                        <input type="date" name="tgl_byr" id="tgl_byr" class="form-control my-2" value="<?= $pay['tgl_byr']; ?>" required>
                        <label>Upload Foto Rekomendasi</label>
                        <input type="file" class="form-control" id="bukti_byr" name="bukti_byr" placeholder="<?= $pay['bukti_byr']; ?>" value="<?= $pay['bukti_byr']; ?>" required>
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                </div>
                <div class="row mt-4">
                    <button type="submit" class="btn btn-primary offset-5">Simpan</button>
                </div>
                <?= form_close(); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>