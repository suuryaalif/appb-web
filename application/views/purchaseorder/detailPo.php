<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Purchase Order</h1>
    <!-- Page Body -->
    <div class="card">
        <div class="row">
            <div class="ml-5 mt-3">
                <a class="btn btn-secondary" href="<?= base_url('purchaseorder') ?>" role="button">Kembali</a>
                <a class="btn btn-success fa fa-edit" href="<?= base_url('purchaseorder') ?>" role="button"> Edit</a>
                <a class="btn btn-danger fa fa-file-pdf" href="<?= base_url('purchaseorder/save_pdf/' . $kode) ?>" role="button"> Download</a>
            </div>
        </div>
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <?php foreach ($data_purchase as $dp) : ?>
                <div class="justify-content-center col-md">
                    <h3 class="text-center col-sm">Purchase Order</h3>
                    <h4 class="header text-center col-md">No. <?= $dp['kode_po']; ?>/<?= date("m/y", strtotime($dp['tgl_po'])); ?></h4>
                </div>
                <hr />
                <hr />
                <div class="row">
                    <div class="col-8 ml-lg-5">
                        <table>
                            <tr>
                                <th>Tgl Purchase Order</th>
                                <td>:</td>
                                <td><?= $dp['tgl_po']; ?></td>
                            </tr>
                            <tr>
                                <th>Kode Request Order</th>
                                <td>:</td>
                                <td><?= $dp['kode_ro']; ?></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>:</td>
                                <td><?= $dp['desk_po']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Supplier</th>
                                <td>:</td>
                                <td><?= $dp['nama_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Supplier</th>
                                <td>:</td>
                                <td><?= $dp['alamat_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>PIC Supplier</th>
                                <td>:</td>
                                <td><?= $dp['pic_sup']; ?></td>
                            </tr>
                            <tr>
                                <th>No. Telepon/HP Supplier</th>
                                <td>:</td>
                                <td><?= $dp['tlp_sup']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr />
                <div class="table-responsive-lg ml-lg-5">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">kode PO</th>
                                <th scope="col">Jenis Barang</th>
                                <th scope="col">Keterangan Barang</th>
                                <th scope="col">Jumlah Order</th>
                                <th scope="col">Satuan Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($detail_purchase as $row) :
                                $no++;
                            ?>
                                <tr class="">
                                    <td scope="row"><?= $no ?></td>
                                    <td><?= $row['kode_purchase']; ?></td>
                                    <td><?= $row['jenis_barang']; ?></td>
                                    <td><?= $row['desk_barang']; ?></td>
                                    <td><?= $row['qty_order']; ?></td>
                                    <td><?= $row['sat_order']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->