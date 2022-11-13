<div class="card text-start">
    <div class="card-body">
        <h2 class="text-center mb-5">Formulir Permintaan Barang</h2>
        <form>
            <div class="row">
                <div class="col mb-2">
                    <input type="text" class="form-control" placeholder="Dari User: " disabled>
                </div>
                <div class="col mb-2">
                    <input type="text" class="form-control" placeholder="Kepada Divisi Purchasing" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <input type="text" class="form-control" placeholder="No PB: " disabled>
                </div>
                <div class="col mb-2">
                    <input type="text" class="form-control" placeholder="Tanggal: " disabled>
                </div>
            </div>
            <hr>
        </form>
        <form class=" form-control">
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
            <button class="btn btn-success" type="submit">Submit</button>
        </form>

        <!-- class hide membuat form disembunyikan  -->
        <!-- ini formulir di hide, kalau pas di pencet tambah baru nongol  -->
        <div class="copy invisible">
            <div class="control-group">
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
                    <button class="btn btn-danger remove" type="button"><i class=""></i> Hapus Tambahan</button>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>