<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- select wahana -->
</head>

<body class="hold-transition sidebar-mini layout-fixed <?= $this->uri->segment(1) == 'form' ? 'sidebar-collapse' : '' ?>">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                <a href="<?= site_url('dashboard_m') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard_m' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
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
                    <a href="<?= site_url('tampilpesanan_m') ?>" class="nav-link">
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
                <a href="<?= site_url('dashboard_p') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard_p' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class=" nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item <?= $this->uri->segment(1) == 'tiketoffline_tampil_p' || $this->uri->segment(1) == 'tiketoffline_form_p' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $this->uri->segment(1) == 'tiketoffline_tampil_p' || $this->uri->segment(1) == 'tiketoffline_form_p' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Pesan Tiket Offline
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url('tiketoffline_tampil_p') ?>" class="nav-link <?= $this->uri->segment(1) == 'tiketoffline_tampil_p' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Order Ticket</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('tiketoffline_form_p') ?>" class="nav-link <?= $this->uri->segment(1) == 'tiketoffline_form_p' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Order</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('dashboard_p') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard_p' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
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
                <a href="" class="nav-link ">
                  <i class=" nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Pesan Tiket
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url('konsumen/tampil_konsumen') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Pesanan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('konsumen/add') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pesan Tiket</p>
                    </a>
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
            <!-- END MENU KONSUMEN -->

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php echo $contents ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('assets/') ?>plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url('assets/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url('assets/') ?>dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url('assets/') ?>dist/js/pages/dashboard.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('assets/') ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    // table
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": true,
        "ordering": true,
        "info": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#example3').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#reservationdate').datetimepicker({
        format: 'L'
      });

      //Initialize Select2 Elements
      $('.select2').select2()

      //GET UPDATE
      $('.update-record').on('click', function() {
        var paket_id = $(this).data('paket_id');
        var code = $(this).data('code');
        var name = $(this).data('name');
        var price = $(this).data('price');

        $(".strings").val('');
        $('#UpdateModal').modal('show');
        $('[name="paket_id"]').val(paket_id);
        $('[name="code"]').val(code);
        $('[name="name"]').val(name);
        $('[name="price"]').val(price);

        //AJAX REQUEST TO GET SELECTED PRODUCT
        $.ajax({
          url: "<?php echo site_url('marketing/get_wahana_by_paket'); ?>",
          method: "POST",
          data: {
            paket_id: paket_id
          },
          cache: false,
          success: function(data) {
            var item = data;
            var val1 = item.replace("[", "");
            var val2 = val1.replace("]", "");
            var values = val2;
            $.each(values.split(","), function(i, e) {
              $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
              $(".strings").selectpicker('refresh');

            });
          }

        });
        return false;
      });

    });
  </script>
</body>

</html>