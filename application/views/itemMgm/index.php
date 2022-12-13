<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Barang Pengadaan</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <div>
                <ul class="list-group">Untuk Kategori Barang</ul>
                <li>Inventaris = nilai barang satuan lebih dari sama dengan Rp. 500.000,- </li>
                <li>Perlengkapan = nilai barang satuan kurang dari Rp. 500.000,- </li>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table table-light" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Tgl Input</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($item as $itm) :
                            $no++ ?>
                            <tr class="">
                                <td scope="row"><?= $no; ?></td>
                                <td><?= $itm['kode_barang']; ?></td>
                                <td><?= $itm['kategori_barang']; ?></td>
                                <td><?= $itm['jenis_barang']; ?></td>
                                <td><?= $itm['nama_barang']; ?></td>
                                <td><?= $itm['desk_barang']; ?></td>
                                <td><?= $itm['qty_barang']; ?></td>
                                <td><?= $itm['sat_barang']; ?></td>
                                <td><?= $itm['tgl_terima']; ?></td>
                                <td>
                                    <a class="btn btn-success fa fa-edit" href="<?= base_url('item/add/' . $itm['id_barang']); ?>" role="button"></a>
                                </td>
                                <td>
                                    <a class="btn btn-danger fa fa-trash-alt" href="<?= base_url('item/delete/' . $itm['id_barang']); ?>" role="button"></a>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary fa fa-eye" data-toggle="modal" data-target="#ModalBarang<?= $itm['id_barang']; ?>">
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<?php foreach ($item as $itm) : ?>
    <div class="modal fade" id="ModalBarang<?= $itm['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data <?= $itm['kode_barang']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= base_url(); ?>assets/img/qr-barang/<?= $itm['qr_barang']; ?>" style="width:100px;height:100px;margin-right:5px ;">
                    </div>
                    <div class="table-sm-responsive">
                        <table class="table table-light">
                            <tr>
                                <td>Kode Barang</td>
                                <td>:</td>
                                <td><?= $itm['kode_barang']; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Request Order</td>
                                <td>:</td>
                                <td><?= $itm['kode_ro']; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Purhcase Order</td>
                                <td>:</td>
                                <td><?= $itm['kode_po']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Barang</td>
                                <td>:</td>
                                <td><?= $itm['nama_barang']; ?></td>
                            </tr>
                            <tr>
                                <td>Deskripsi Barang</td>
                                <td>:</td>
                                <td><?= $itm['desk_barang']; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Barang</td>
                                <td>:</td>
                                <td><?= $itm['qty_barang']; ?>&nbsp;<?= $itm['sat_barang']; ?></td>
                            </tr>
                            <tr>
                                <td>Tgl Terima Barang</td>
                                <td>:</td>
                                <td><?= date('d/m/y', strtotime($itm['tgl_terima'])); ?></td>
                            </tr>
                            <tr>
                                <td>Waktu Input</td>
                                <td>:</td>
                                <td><?= date('d/m/Y H:i:s', $itm['tgl_input']); ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <?php if ($itm['kategori_barang'] == 'Inventaris') : ?>
                        <a class="btn btn-warning" href="<?= base_url('item/save_pdf/' . $itm['id_barang']); ?>" role="button">Download Label</a>
                    <?php else : ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>