<title><?=$header;?></title>
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
            <div class="col-md-2">
                <a href="<?= site_url('wahana/add'); ?>"><button class="btn btn-block btn-success">Tambah</button></a>
            </div><br><br>
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
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($wahana as $w => $row) { ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->nama_wahana; ?></td>
                                        <td><?= $row->harga; ?></td>
                                        <td>
                                            <a href="<?= site_url('wahana/edit'.$row->id_wahana); ?>" class="btn btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('wahana/del'.$row->id_wahana); ?>" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
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
                                    <th>#</th>
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