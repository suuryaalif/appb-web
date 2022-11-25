<section class="py-5 bg-light" id="scroll-target">
    <div class="container px-10 my-5">


        <div class="text-center">
            <h2 class="section-heading text-uppercase">Tracking pengajaun</h2>
            <h3 class="section-subheading text-muted">Masukkan kode <b> Request Order</b> :</h3>
        </div>
        <div class="text-justify pl-5 pr-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <?= form_open('webpage/track', 'id="track_code"'); ?>
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" type="search" name="trackid" placeholder="Masukkan ID Pengajuan Anda">
                    </div>
                    <?php foreach ($result_kode as $row) : ?>
                        <div class="col-auto">
                            <button name="submit" class="btn btn-lg btn-success mt-2" type="submit" value="<?= $row['kode_ro'] ?>">Cari</button>
                        </div>
                    <?php endforeach; ?>
                    <?= form_close(); ?>
                </div>
                <div>
                    <table class="table table-sm table-striped dataTable" id="dataTable">
                        <thead align=center>
                            <tr>
                                <th>No</th>
                                <th>Kode RO</th>
                                <th>Desk. Permintaan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Status Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody align=center>
                            <?php $no = 0;
                            foreach ($result_kode as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['kode_ro'] ?></td>
                                    <td class="col-3"><?= $row['alasan_req'] ?></td>
                                    <td><?= $row['submit_date'] ?></td>
                                    <td><?= $row['status_info'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!--end of col-->
            </div>
        </div>
    </div>
</section>