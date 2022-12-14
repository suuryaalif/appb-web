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
                <table class="table table-sm table-striped dataTable" id="datatable">
                    <thead align=center>
                        <tr>
                            <th>No</th>
                            <th>Kode RO</th>
                            <th>Desk. Permintaan</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>NIP</th>
                            <th>Info</th>
                            <?php if ($this->session->userdata('role_id') == 1) : ?>
                                <th>Aksi</th>
                            <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
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
                                <td class="col-3"><?= $row['alasan_req'] ?></td>
                                <td><?= $row['submit_date'] ?></td>
                                <td><?= $row['status_info'] ?></td>
                                <td><?= $row['id_user'] ?></td>
                                <td><a name="detail_order" id="detail_order" class="btn btn-info" href="<?= base_url('') ?>requestorder/detail/<?= $row['kode_ro']; ?>" role="button"><i class="far fa-eye"></i></a></td>
                                <?php if ($this->session->userdata('role_id') == 1) : ?>
                                    <?php if ($row['status_pengajuan'] < 7) : ?>
                                        <td class="col-2">
                                            <a name="detail_order" id="detail_order" class="btn btn-success" href="<?= base_url('') ?>requestorder/update_status/<?= $row['kode_ro']; ?>" role="button"><i class="far fa-thumbs-up" data-bs-toggle="tooltip" data-bs-placement="left" title="update status proses"></i></a>
                                            <a name="detail_order" id="detail_order" class="btn btn-warning" href="<?= base_url('') ?>requestorder/back_status/<?= $row['kode_ro']; ?>" role="button"><i class="fas fa-backward" data-bs-toggle="tooltip" data-bs-placement="top" title="mundur proses request order"></i></a>
                                            <a name="detail_order" id="detail_order" class="btn btn-danger" href="<?= base_url('') ?>requestorder/reject_status/<?= $row['kode_ro']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="reject request order" role="button"><i class="fas fa-ban"></i></a>
                                        </td>
                                    <?php elseif ($row['status_pengajuan'] == 7) : ?>
                                        <td class="col-2">
                                            <a name="detail_order" id="detail_order" class="btn btn-success" href="<?= base_url('') ?>requestorder/selesai/<?= $row['id_ro']; ?>" role="button"><i data-bs-toggle="tooltip" data-bs-placement="left" title="selesaikan proses">Selesaikan Order</i></a>
                                        </td>
                                    <?php elseif ($row['status_pengajuan'] > 7) : ?>
                                        <td class="col-2">
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Permintaan telah diselesaikan">
                                                <i class="fas fa-info"></i> Selesai
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                                    <?php if ($row['status_pengajuan'] == 6) : ?>
                                        <td><a class="btn btn-primary" href="<?= base_url('requestorder/terima_barang/' . $row['id_ro']); ?>" role="button">Terima Barang</a></td>
                                    <?php else : ?>
                                        <td>
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="status pengajuan harus sudah proses kirim">
                                                <i>Terima Barang</i>
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
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