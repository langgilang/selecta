<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">e-Ticket SELECTA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->fungsi->user_login()->name ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!-- MENU MARKETING -->
                <?php if ($this->session->userdata('level') ==  1) { ?>

                    <li class="nav-item">
                        <a href="<?= site_url('marketing/dashboard') ?>" class="nav-link ">
                            <i class=" nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Tiket
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('marketing/tampil_pesananonline') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Pesanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Wahana
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= site_url('marketing/tampil_wahana') ?>" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Data Wahana</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= site_url('marketing/tampil_paket') ?>" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Data Paket Wahana</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">SETTING</li>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout') ?>" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                <?php } ?>
                <!-- END MENU MARKETING -->

                <!-- MENU PORTIR -->
                <?php if ($this->session->userdata('level') ==  3) { ?>
                    <li class="nav-item">
                        <a href="<?= site_url('portir/dashboard') ?>" class="nav-link">
                            <i class=" nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Pesan Tiket Offline
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('portir/tampil_tiketoffline') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('portir/add') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Order Ticket</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('portir/tampil_tiketonline') ?>" class="nav-link">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>
                                Data Order Tiket Online
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">SETTING</li>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout') ?>" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- END MENU PORTIR -->

                <!-- MENU KONSUMEN -->
                <?php if ($this->session->userdata('level') ==  4) { ?>
                    <li class="nav-item">
                        <a href="<?= site_url('konsumen/dashboard') ?>" class="nav-link ">
                            <i class=" nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= site_url('konsumen/tampil_konsumen') ?>" class="nav-link ">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Pesan Tiket
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">SETTING</li>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout') ?>" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- END MENU KONSUMEN -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>