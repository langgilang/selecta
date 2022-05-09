<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview <?= $this->uri->segment(1) == 'dashboard_m' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard_m') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview <?= $this->uri->segment(1) == 'datatiket_m' || $this->uri->segment(1) == 'datawahana_m' ? 'active' : '' ?>">
                <a href="">
                    <i class="fa fa-edit"></i><span>Master Data</span>
                    <i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li <?= $this->uri->segment(1) == 'datatiket_m' ? 'class="active"' : '' ?>><a href="<?= site_url('datatiket_m') ?>"><i class="fa fa-circle-o"></i> Data Konsumen</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Data Portir</a></li>
                    <li <?= $this->uri->segment(1) == 'databwahana_m' ? 'class="active"' : '' ?>><a href="<?= site_url('datawahana_m') ?>"><i class="fa fa-circle-o"></i> Data Wahana</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Data Tiket</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-book"></i><span>Documentation</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Tiket Offline</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Tiket Online</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>