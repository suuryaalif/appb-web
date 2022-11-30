<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Buat Po Baru Order</h1>
    <h1 class="h5 mb-4 ml-5 text-gray-800"><i>Masukan Detail PO</i></h1>
    <!-- Page Body -->
    <div><?= $this->session->flashdata('msg'); ?></div>
    <div class="card">
        <div class="row">
            <div class="ml-5 mt-3">
                <a class="btn btn-secondary" href="<?= base_url('purchaseorder') ?>" role="button">Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?= form_open_multipart('purchaseorder/save_temp_detail'); ?>
                <div class="card-body ml-5 mt-3">
                    <label>Kode Po :</label>
                    <input class="form-control mb-1" type="text" id="kode_purchase" name="kode_purchase" value="<?= $kodeotomatis; ?>" readonly>
                    <label class="mt-2">Jenis Barang</label>
                    <select class="form-control mb-1" id="jenis_barang" name="jenis_barang">
                        <option disabled selected>--pilih jenis--</option>
                        <option>ATK</option>
                        <option>RTK</option>
                        <option>Mesin Cetak</option>
                        <option>Aksesoris Mesin Cetak</option>
                        <option>Cetakan</option>
                        <option>Laptop/PC</option>
                        <option>Aksesoris Laptop/PC</option>
                        <option>Cetakan</option>
                        <option>Alat Safety</option>
                        <option>Alat Packing</option>
                        <option>Seragam/Pakaian</option>
                        <option>lain-lain</option>
                    </select>
                    <label class="mt-2">Deskripsi Barang</label>
                    <input type="text" name="desk_barang" id="desk_barang" class="form-control mb-1" placeholder="deskripsikan barang yang anda inginkan" required>
                    <label class="mt-2">Jumlah Order</label>
                    <?= form_error('qty_order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <input type="int" name="qty_order" placeholder="masukan jumlah hanya angka" class="form-control mb-1">
                    <label class="mt-2">Satuan Jumlah</label>
                    <select class="form-control mb-1" name="sat_order">
                        <option disabled selected>--pilih satuan--</option>
                        <option>Unit</option>
                        <option>Pasang</option>
                        <option>Stel</option>
                        <option>Pak</option>
                        <option>Lusin</option>
                        <option>Kodi</option>
                        <option>Pcs</option>
                        <option>Kg</option>
                        <option>Set</option>
                        <option>Bundle</option>
                        <option>Roll</option>
                        <option>Box</option>
                        <option>Liter</option>
                        <option>dll</option>
                    </select>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="submit"><i class=" fa fa-plus"> Tambah Barang</i>
                    </button>
                    <?php if (empty($this->db->get('temp_po')->num_rows())) : ?>
                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anda wajib mengisi data detail!">
                            <i class="fas fa-check"></i> Lanjutkan
                        </button>
                    <?php else : ?>
                        <a class="btn btn-primary" href="<?= base_url('purchaseorder/get_formFinPo') ?>" role="button">Lanjutkan</a>
                    <?php endif; ?>
                    <hr>
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