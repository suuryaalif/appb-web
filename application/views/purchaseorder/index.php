<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Purchase Order</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <div class="table-responsive-lg ml-lg-5">
                <table class="table table-responsive-lg table-light" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">kode PO</th>
                            <th scope="col">Keterangan PO</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Tgl PO</th>
                            <th scope="col" hidden></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($PO as $dt) :
                            $no++;
                        ?>
                            <tr class="">
                                <td scope="row"><?= $no ?></td>
                                <td><?= $dt['kode_po']; ?></td>
                                <td><?= $dt['desk_po']; ?></td>
                                <td><?= $dt['nama_sup']; ?></td>
                                <td><?= $dt['tgl_po']; ?></td>
                                <td><a class="btn btn-info fa fa-eye" href="<?= base_url('purchaseorder/detail/' . $dt['kode_po']); ?>" role="button">Detail</a></td>
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