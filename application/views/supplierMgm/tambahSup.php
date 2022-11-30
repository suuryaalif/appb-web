<!-- Begin Page Content -->
<div class="container-fluid text-center">
    <h3>Daftar Supplier</h3>
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            Silahkan Isi Formulir
            <br>Informasi Umum
        </div>
        <div class="card-body offset-1 col-9">
            <?= form_open_multipart('sup_mgm/add_new') ?>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="nama_sup" name="nama_sup" placeholder="Nama Supplier" value="<?= set_value('nama'); ?>">
                <?= form_error('nama_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="pic_sup" name="pic_sup" placeholder="Nama PIC Supplier">
                <?= form_error('pic_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="tlp_sup" name="tlp_sup" placeholder="No Telepon Supplier">
                <?= form_error('tlp_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="email" class="form-control form-control-user" id="email_sup" name="email_sup" placeholder="Email Supplier" value="<?= set_value('nama'); ?>">
                <?= form_error('email_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="alamat_sup" name="alamat_sup" placeholder="Alamat Tinggal Supplier"><?= form_error('alamat_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <br>Informasi Bank
        </div>
        <div class="card-body offset-1 col-9">
            <?= form_open_multipart('user_mgm/add_new') ?>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="nama_bank_sup" name="nama_bank_sup" placeholder="Nama Bank Supplier" value="<?= set_value('nama'); ?>">
                <?= form_error('nama_bank_sup', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="no_rek" name="no_rek" placeholder="No Rekening">
                <?= form_error('no_rek', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah Data
                </button>
                <br>
                <a class="btn btn-secondary btn-block" href="<?= base_url('sup_mgm'); ?>" role="button">Kembali</a>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</div>