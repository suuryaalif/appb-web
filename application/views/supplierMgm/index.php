<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Supplier</h1>
    <!-- Page Body -->
    <div class="card">
        <div class="row">
            <div class="col-md-10 mt-2 offset-md-10">
                <a class="btn btn-primary" href="<?= base_url('Sup_mgm/new_form') ?>" role="button">Tambah Supplier</a>
            </div>
        </div>
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-light" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Supplier</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Nama PIC</th>
                            <th scope="col">Email Supplier</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col" hidden></th>
                            <th scope="col" hidden></th>
                            <th scope="col" hidden></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($data_supp as $dt) :
                            $no++;
                        ?>
                            <tr class="">
                                <td scope="row"><?= $no ?></td>
                                <td><?= $dt['nama_sup']; ?></td>
                                <td><?= $dt['pic_sup']; ?></td>
                                <td><?= $dt['email_sup']; ?></td>
                                <td><?= $dt['tlp_sup']; ?></td>
                                <td><button type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#detailSupplier<?= $dt['id_sup'] ?>">
                                        lihat
                                    </button></td>
                                <td><a class="btn btn-success fa fa-edit" href="<?= base_url('sup_mgm/edit/' . $dt['id_sup']); ?>" role="button"> edit</a></td>
                                <td><a class="btn btn-danger fas fa-trash-alt" href="<?= base_url('sup_mgm/delete/' . $dt['id_sup']); ?>" role="button"> Hapus</a></td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!--Detail Modal -->
<?php $no = 0;
foreach ($data_supp as $dt) : $no++; ?>
    <div class="modal fade" id="detailSupplier<?= $dt['id_sup'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                    <div class="table-responsive-sm border-0">
                        <h4>Informasi Umum</h4>
                        <table class="table table-light">
                            <tr>
                                <th>Nama Supplier</th>
                                <td>:</td>
                                <td><?= $dt['nama_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama PIC Supplier</th>
                                <td>:</td>
                                <td><?= $dt['pic_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>:</td>
                                <td><?= $dt['tlp_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Supplier</th>
                                <td>:</td>
                                <td><?= $dt['alamat_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Di daftarkan tgl</th>
                                <td>:</td>
                                <td><?= date('d-m-Y', $dt['created_at']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="table-responsive-sm border-0">
                        <h4>Informasi Rekening</h4>
                        <table class="table table-light">
                            <tr>
                                <th>Nama Bank</th>
                                <td>:</td>
                                <td><?= $dt['nama_bank_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Rekening</th>
                                <td>:</td>
                                <td><?= $dt['no_rek']; ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>