<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i>Selamat Datang <?= $user['nama']; ?></i></h1>

    <!--panel info-->
    <div class="card border-2 p-3 mb-3">
        <div class="card-header bg-gradient-info text-light text-center">
            <h5><i>Payment Order Info Divisi <?= $user_info['divisi']; ?></i></h5>
        </div>
        <div class="card-body">
        </div>
    </div>
    <div class="row">
        <div class="card border-left-warning shadow h-100 m-xl-3">
            <div class="card card-header">
                <h3>Ketentuan Aplikasi</h3>
                <div class="card-body">
                    aplikasi ini digunakan untuk mempermudah proses pengadaan barang, anda memiliki hak untuk melakukan approval dan menginput data pembayaran yang diajukan dengan payment order dari Admin Purchasing.
                </div>
            </div>
        </div>
        <div class="card border-left-warning shadow h-100 mx-xl-3">
            <div class="card card-header">
                <h3>Panduan Informasi</h3>
                <div class="card-body">
                    <h5>berikut adalah informasi mengenai sistem aplikasi ini :<br>
                        Aplikasi ini hanya digunakan untuk internal perusahaan, ini berfungsi untuk pengajuan pengadaan barang silahkan download panduan nya dibawah :
                        <br /><br />
                        <a href="#" class="badge bg-light"><i class="fas fa-file-download ml-1 mr-2"></i>Panduan Pengadaan Barang</a><br />
                        <a href="#" class="badge bg-light"><i class="fas fa-file-download ml-1 mr-2"></i>Panduan User</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>