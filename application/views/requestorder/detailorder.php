<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data <?= $title; ?></h1>
    <!-- Page Body -->
    <div class="card text-start">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-sm dataTable-container" id="myTable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Order</th>
                            <th>Satuan</th>
                            <th>Nama</th>
                            <th>foto rekomendasi</th>
                            <th>Aksi</th>
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
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['img_order'] ?></td>
                                <td><a name="edit_ro" id="edit_ro" class="btn fa fa-edit btn-success" href="<?= base_url('requestorder/edit_ro'); ?>" role="button"> Edit</a></td>
                                <td><a name="hapus_ro" id="hapus_ro" class="btn far fa-trash-alt btn-danger" href="<?= base_url('requestorder/hapus_ro'); ?>" role="button"> Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a name="kembali" id="kembali" class="btn btn-primary" href="<?= base_url('requestorder'); ?>" role="button">Kembali</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->