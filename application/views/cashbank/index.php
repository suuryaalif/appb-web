<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 ml-5 text-gray-800">Data Cashbank Requestion</h1>
    <!-- Page Body -->
    <div class="card">
        <div><?= $this->session->flashdata('msg'); ?></div>
        <div class="card-body">
            <div>
                <table class="table table-responsive-sm text-sm table-striped table-light" id="">
                    <thead style="text-align:center ;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" style="width:100px ;">Kode CBR</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Nominal Biaya</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Tanggal CBR</th>
                            <th scope="col">Status CBR</th>
                            <th scope="col" style="width:200px ;" hidden></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($cashbank as $cbr) :
                            $no++;
                        ?>
                            <tr class="">
                                <td scope="row"><?= $no ?></td>
                                <td><?= $cbr['kode_cbr']; ?></td>
                                <td><?= $cbr['desk_cbr']; ?></td>
                                <td style="width:120px ;"><?= 'Rp ' . number_format($cbr['biaya'], '2', ',', '.'); ?></td>
                                <td style="width:120px ;"><?= $cbr['tempo_byr']; ?></td>
                                <td style="width:120px ;"><?= $cbr['tgl_cbr']; ?></td>
                                <td><?= $cbr['status_info']; ?></td>
                                <td style="width:200px ;">
                                    <?php if ($this->session->userdata('role_id') == '1') : ?>
                                        <a class="btn btn-info fa fa-eye" href="<?= base_url('cashbank/detail/' . $cbr['id_cbr'] . '/' . $cbr['kode_req'] . '/' . $cbr['kode_pur']); ?>" role="button"></a>
                                        <a class="btn btn-success fa fa-edit" href="<?= base_url('cashbank/get_edit/' . $cbr['id_cbr']); ?>" role="button"></a>
                                        <a class="btn btn-danger fa fa-trash-alt" href="<?= base_url('cashbank/delete_cbr/' . $cbr['id_cbr']); ?>" role="button"></a>
                                    <?php elseif ($this->session->userdata('role_id') == '4') : ?>
                                        <a class="btn btn-info fa fa-eye" href="<?= base_url('cashbank/detail/' . $cbr['id_cbr'] . '/' . $cbr['kode_req'] . '/' . $cbr['kode_pur']); ?>" role="button"></a>
                                        <a class="btn btn-success" href="<?= base_url('cashbank/get_form_confirm/' . $cbr['id_cbr'] . '/' . $cbr['kode_req'] . '/' . $cbr['kode_pur']); ?>" role="button"><i>Proses Bayar</i></a>
                                    <?php endif; ?>
                                </td>
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