<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Data
            <small>Data Wahana</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data</li>
            <li class="active">Data Wahana</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- form tambah data wahana -->
        <div class="row">
            <!-- ukuran konten -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Wahana</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wahana</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($wahana as $w => $data) { ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->nama_wahana; ?></td>
                                        <td><?= $data->harga; ?></td>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            ?>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wahana</th>
                                    <th>Harga</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
            <!-- end ukuran konten -->
        </div>
        <!-- end form tambah wahana -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
</body>

</html>