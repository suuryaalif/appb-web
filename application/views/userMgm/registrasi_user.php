<!-- Begin Page Content -->
<div class="container-fluid text-center">
    <h3>Daftar User</h3>
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            Silahkan Isi Formulir
        </div>
        <div class="card-body offset-1 col-9">
            <?= form_open_multipart('user_mgm/add_new') ?>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP">
                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('nama'); ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat"><?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor Handphone">
                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
                <label>select role :</label>
                <select class="form-control" id="role" name="role" value="<?= set_value('role'); ?>">
                    <option value="1">admin purchasing</option>
                    <option value="2">user requestion</option>
                    <option value="3">user approval</option>
                    <option value="4">user payment order</option>
                </select>
            </div>
            <div class="form-group row">
                <label>select division :</label>
                <select class="form-control" id="id_divisi" name="id_divisi" value="<?= set_value('role'); ?>">
                    <option value="1">Keuangan</option>
                    <option value="2">Ops Kantor</option>
                    <option value="3">Ops Lapangan</option>
                    <option value="4">Umum</option>
                    <option value="5">Gudang</option>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah Data
                </button>
                <br>
                <a class="btn btn-secondary btn-block" href="<?= base_url('user_mgm'); ?>" role="button">Kembali</a>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</div>