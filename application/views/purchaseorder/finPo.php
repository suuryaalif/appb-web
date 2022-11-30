<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Buat Po Baru Order</h1>
    <h1 class="h5 mb-4 ml-5 text-gray-800"><i>Masukan Keterangan PO</i></h1>
    <!-- Page Body -->
    <div><?= $this->session->flashdata('msg'); ?></div>
    <div class="card">
        <div class="row">
            <div class="ml-5 mt-3">
                <a class="btn btn-secondary" href="<?= base_url('purchaseorder/get_formPrePo') ?>" role="button">Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?= form_open_multipart('purchaseorder/save_po/' . $kodeotomatis); ?>
                <div class="card-body ml-5 mt-3">
                    <label>Kode Po :</label>
                    <input class="form-control mb-1" type="text" id="kode_po" name="kode_po" value="<?= $kodeotomatis; ?>" readonly>
                    <label class="mt-2">Kode Request Order</label>
                    <select class="form-control mb-1" id="kode_ro" name="kode_ro">
                        <option disabled selected>--pilih Request Order--</option>
                        <?php foreach ($ro as $kd) : ?>
                            <option value="<?= $kd['kode_ro']; ?>"><?= $kd['kode_ro']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="mt-2">Keterangan PO</label>
                    <input type="text" name="desk_po" id="desk_po" class="form-control mb-1" placeholder="Keterangan PO" required>
                    <label class="mt-2">Nama Supplier</label>
                    <select class="form-control mb-1" name="id_sup" id="id_sup">
                        <option disabled selected>--pilih Supplier--</option>
                        <?php foreach ($supplier as $sup) : ?>
                            <option value="<?= $sup['id_sup'] ?>"><?= $sup['nama_sup'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="mt-2">Tanggal PO</label>
                    <input type="date" name="tgl_po" id="tgl_po" class="form-control mb-1">
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="submit">Simpan PO</i>
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="table-responsive-lg mt-3 ml-lg-5">
            <h1 class="h3 mb-4 ml-5 text-gray-800">Data list barang</h1>
            <table class="table table-responsive-md">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">kode PO</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Keterangan Barang</th>
                        <th scope="col">Jumlah Order</th>
                        <th scope="col">Satuan Order</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($temp_po as $row) :
                        $no++;
                    ?>
                        <tr class="">
                            <td scope="row"><?= $no ?></td>
                            <td><?= $row['kode_purchase']; ?></td>
                            <td><?= $row['jenis_barang']; ?></td>
                            <td><?= $row['desk_barang']; ?></td>
                            <td><?= $row['qty_order']; ?></td>
                            <td><?= $row['sat_order']; ?></td>
                            <td><a class="btn btn-danger fa fa-trash-alt" href="<?= base_url('purchaseorder/delete_temp_detail/' . $row['id']) ?>" role="button"></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->