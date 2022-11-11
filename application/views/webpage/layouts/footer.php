<!-- Footer-->
<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0 text-white">Copyright &copy; SAR Website 2022</div>
            </div>
            <div class="col-auto">
                <a class="link-light small" href="#!">Privacy</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="#!">Terms</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="#!">Contact</a>
            </div>
        </div>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i>--- Warning ---<i class="fas fa-exclamation-circle"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                the site will switch to the company's internal application, do you want to continue? to enter the application you are required to log in with an account.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <a href="<?= base_url('Webpage/get_login'); ?>" class="btn btn-success">Ya Lanjutkan</a>
                <?php $this->session->set_flashdata('warning', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        make sure you have made an account request to the purchasing admin</div>'); ?>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?= base_url('assets') ?>/js/scripts.js"></script>
<script src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets') ?>/font-awesome/js/all.min.js"></script>
</body>

</html>