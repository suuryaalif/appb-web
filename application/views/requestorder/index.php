<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Request Order Data</h1>
    <!-- Page Body -->
    <div class="card text-start">
        <div class="card-body">
            <div><?= $this->session->flashdata('msg'); ?></div>
            <!-- <div><a name="newrequest" id="newrequest" class="btn btn-primary" href="<?= base_url('requestorder/get_pre_request'); ?>" role="button">Tambah Request</a></div> -->
            <div class="table-responsive-md">
                <table class="table table-sm" id="dataTable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Kode RO</th>
                            <th>Desk. Permintaan</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>NIP</th>
                            <th colspan="3">Info</th>
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
                                <td><?= $row['status_info'] ?></td>
                                <td><?= $row['id_user'] ?></td>
                                <td><a name="detail_order" id="detail_order" class="btn btn-info" href="<?= base_url('') ?>requestorder/detail/<?= $row['kode_ro']; ?>" role="button"><i class="far fa-eye"></i> </a></td>
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