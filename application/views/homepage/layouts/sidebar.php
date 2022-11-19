<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar-dark sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3">
        <img class="img-profile" src="<?= base_url('assets'); ?>/img/logo/logo.png">
    </a>
    <a class="sidebar-brand d-block align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-2">APPBweb</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('home'); ?>">
            <i class="fas fa-laptop-house"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu :
    </div>

    <!-- ini mengecek menu sesuai dengan role yang diberikan -->
    <?php if ($this->session->userdata('role_id') !== '4') : ?>
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url('requestorder'); ?>">
                <i class="fas fa-tasks"></i>
                <span>Request Order</span></a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fa-tasks"></i>
                <span>Request Order</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href=" <?= base_url('requestorder'); ?>">Data Request</a>
                    <a class="collapse-item" href="<?= base_url('requestorder/get_pre_request'); ?>" id="newrequest">Create Request Order</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if ($this->session->userdata('role_id') == '1' or $this->session->userdata('role_id') == '4') : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('home'); ?>">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Payment Order</span></a>
        </li>
    <?php endif; ?>

    <?php if ($this->session->userdata('role_id') == '1') : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Purchasing Menu :
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('home'); ?>">
                <i class="fas fa-shopping-basket"></i>
                <span>Purchase Order</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('home'); ?>">
                <i class="fas fa-boxes"></i>
                <span>Item Management</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('home'); ?>">
                <i class="fas fa-users"></i>
                <span>User Management</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->