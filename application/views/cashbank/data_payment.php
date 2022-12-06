<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Pembayaran</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <div>
                <div class="table-responsive-sm">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Bayar</th>
                                <th scope="col">Kode CBR</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Tgl Pembayaran</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($payment as $pay) :
                                $no++; ?>
                                <tr class="">
                                    <td scope="row"><?= $no; ?></td>
                                    <td scope="col"><?= $pay['kode_byr']; ?></td>
                                    <td scope="col"><?= $pay['kode_cbr']; ?></td>
                                    <td scope="col">Rp <?= number_format($pay['total_byr'], 2, ',', '.'); ?> </td>
                                    <td scope="col"><?= date("d F Y", strtotime($pay['tgl_byr'])); ?></td>
                                    <td scope="col">
                                        <a class="btn btn-success fa fa-edit " href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="edit data"></a>
                                        <a class="btn btn-danger fa fa-trash-alt" href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="hapus data"></a>
                                        <a class="btn btn-warning fa fa-file-pdf" href="<?= base_url('cashbank/download_bukti/' . $pay['id_byr']); ?>" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="download bukti"></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->