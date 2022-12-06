<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Formulir Konfirmasi Pembayaran</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="row my-3 mx-1">
            <a class="btn btn-secondary" href="<?= base_url('cashbank') ?>" role="button">Kembali</a>
        </div>
        <div class="card-header">
            <h5>Silahkan isi formulir konfirmasi pembayaran dibawah ini</h5>
        </div>
        <div class="card-body">
            <?= form_open_multipart('cashbank/save_confirm/' . $cashbank['id_cbr'] . '/' . $cashbank['kode_req'] . '/' . $cashbank['kode_pur']); ?>
            <div class="row">
                <div class="col-lg-6">
                    <label>Kode Pembayaran</label>
                    <input type="text" name="kode_byr" id="kode_bayar" class="form-control my-1" value="<?= $kodeotomatis; ?>" readonly>
                    <label>Kode Cash Bank Request</label>
                    <input type="text" name="kode_cbr" id="kode_cbr" class="form-control my-1" value="<?= $cashbank['kode_cbr']; ?>" readonly>
                    <label>Total Pembayaran</label>
                    <input type="text" name="total_byr" id="total_byr" class="form-control my-1" value="<?= $cashbank['biaya']; ?>">
                    <small>masukan hanya nominal tanpa titik, koma dan rupiah</small><br>
                    <label class="mt-2">Tgl Pembayaran</label>
                    <input type="date" name="tgl_byr" id="tgl_byr" class="form-control my-2" required>
                    <label>Upload Foto Rekomendasi</label>
                    <input type="file" class="form-control" id="bukti_byr" name="bukti_byr" required>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            </div>
            <div class="row mt-4">
                <button type="submit" class="btn btn-primary offset-5">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>