<!-- Begin Page Content -->
<div class="container-fluid text-center">
    <h3>Edit User</h3>
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            Edit
        </div>
        <div class="card-body offset-1 col-9">
            <?php foreach ($data_user as $data) : ?>
                <?= form_open_multipart('user_mgm/update_user/') ?>
                <?= $this->session->set_flashdata(
                    'msg'
                ); ?>
                <input type="hidden" id="id" name="id" value="<?= $data['id_user']; ?>" readonly>
                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?= $data['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= $data['nip']; ?>">
                    <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= $data['email']; ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" value="<?= $data['alamat_tinggal']; ?>"><?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor Handphone" value="<?= $data['no_hp']; ?>">
                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <label>select role :</label>
                    <select class="form-control" id="role" name="role" value="<?= set_value('role'); ?>">
                        <option value="<?= $data['role_id']; ?>" selected><?= $data['role user']; ?></option>
                        <option value="1">admin purchasing</option>
                        <option value="2">user requestion</option>
                        <option value="3">user approval</option>
                        <option value="4">user payment</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label>select division :</label>
                    <select class="form-control" id="id_divisi" name="id_divisi">
                        <option value="<?= $data['id_divisi']; ?>" selected><?= $data['divisi']; ?></option>
                        <option value="1">Keuangan</option>
                        <option value="2">Ops Kantor</option>
                        <option value="3">Ops Lapangan</option>
                        <option value="4">Umum</option>
                        <option value="5">Gudang</option>
                    </select>
                </div>
                <div style="text-align:left;">
                    <label>Upload Foto Profile Anda</label>
                    <input type="file" class="form-control" id="img_profile" name="img_profile" required>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Simpan Data
                    </button>
                    <br>
                    <a class="btn btn-secondary btn-block" href="<?= base_url('user_mgm'); ?>" role="button">Kembali</a>
                </div>
            <?php endforeach; ?>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</div>