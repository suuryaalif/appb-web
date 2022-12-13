<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan Request Order</h1>
    <!-- Page Body -->
    <div class="card text-start">
        <div class="card-body">
            <div><?= $this->session->flashdata('msg'); ?></div>
            <!-- <div><a name="newrequest" id="newrequest" class="btn btn-primary" href="<?= base_url('requestorder/get_pre_request'); ?>" role="button">Tambah Request</a></div> -->
            <div class="table-responsive-md">
                <?= form_open_multipart('report/get_ro_report'); ?>
                <div class="row">
                    <div class="col-lg-5">
                        <h5>Cari Data Sesuai Filter Dibawah</h5>
                        <label> Tanggal Awal Pengajuan </label>
                        <input class="form-control" type="date" id="tgl_awal" name="tgl_awal">
                        <label> Tanggal Akhir Pengajuan </label>
                        <input class="form-control" type="date" id="tgl_akhir" name="tgl_akhir">
                        <label>Divisi</label>
                        <select class="form-control" name="divisi" id="divisi">
                            <option value="all">Semua Divisi</option>
                            <?php foreach ($divisi as $div) : ?>
                                <option value="<?= $div['div_id']; ?>"><?= $div['divisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="all">Semua Status</option>
                            <?php foreach ($status as $st) : ?>
                                <option value="<?= $st['id_status']; ?>"><?= $st['alias_status']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->