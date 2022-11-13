<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="text-center mb-5">Formulir Permintaan Barang</h2>
    <form>

        <div class="row">
            <div class="col mb-2">
                <input type="text" class="form-control" placeholder="No PB: " disabled>
            </div>
        </div>
        <div class="control-group after-add-more">
            <label class="mt-2">Jenis Barang</label>
            <select class="form-control mb-1" id="jenis_barang" name="jenis_barang[]">
                <option>ATK</option>
                <option>RTK</option>
                <option>Mesin Cetak</option>
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
            <input type="text" name="desk_barang[]" class="form-control mb-1" placeholder="deskripsikan barang yang anda inginkan">
            <label class="mt-2">Jumlah Order</label>
            <input type="int" name="qty_order[]" class="form-control mb-1">
            <label class="mt-2">Satuan Jumlah</label>
            <select class="form-control mb-1" name="sat_order[]">
                <option>Unit</option>
                <option>Pcs</option>
                <option>Kg</option>
                <option>Set</option>
                <option>Bundle</option>
                <option>Roll</option>
                <option>Box</option>
                <option>Liter</option>
                <option>dll</option>
            </select>
            <br>
            <div class="text-center">
                <button class="btn btn-success add-more" type="button"><i class=" fa fa-plus"> tambah barang</i>
                </button>
                <hr>
            </div>
        </div>
    </form>
    <hr>
    <table class="table table-sm dataTable-container" id="myTable">
        <thead align=center>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Jumlah Order</th>
                <th>Satuan</th>
                <th>foto rekomendasi</th>
                <th>Kode Order</th>
            </tr>
        </thead>

        <tbody align=center>
            <?php $no = 0;
            foreach ($detail as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['jenis_barang'] ?></td>
                    <td><?= $row['desk_barang'] ?></td>
                    <td><?= $row['qty_order'] ?></td>
                    <td><?= $row['sat_order'] ?></td>
                    <td><?= $row['img_order'] ?></td>
                    <td><?= $row['sat_order'] ?></td>
                    <td><?= $row['kode_order'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->