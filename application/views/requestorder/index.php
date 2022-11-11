<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Request Order Data</h1>
    <!-- Page Body -->
    <div class="card text-start">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-sm dataTable" id="myTable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Kode RO</th>
                            <th>Desk. Permintaan</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>NIP</th>
                            <th colspan="3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody align=center>
                        <?php $no = 0;
                        foreach ($request as $row) :
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode_ro'] ?></td>
                                <td><?= $row['alasan_req'] ?></td>
                                <td><?= $row['submit_date'] ?></td>
                                <td><?= $row['status_pengajuan'] ?></td>
                                <td><?= $row['nip_user'] ?></td>
                                <td><a name="detail_order" id="detail_order" class="btn btn-info" href="<?= base_url('') ?>requestorder/get_id/<?= $row['kode_ro']; ?>" role="button"> Detail</a></td>
                                <td><a name="edit_ro" id="edit_ro" class="btn fa fa-edit btn-success" href="<?= base_url('requestorder/edit_ro'); ?>" role="button"> Edit</a></td>
                                <td><a name="hapus_ro" id="hapus_ro" class="btn far fa-trash-alt btn-danger" href="<?= base_url('requestorder/hapus_ro'); ?>" role="button"> Hapus</a></td>
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