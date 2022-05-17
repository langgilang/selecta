<title><?= $header; ?></title>

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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Wahana</h3>
            <div class="pull-right">
                <a href="<?= site_url('wahana/add'); ?>" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="table1" class="table table-bordered table-striped">
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
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('wahana/edit/' . $row->id_wahana); ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                                <a href="<?= site_url('wahana/del/' . $row->id_wahana); ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i> Delete
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
        </div>
        <!-- /.box-body -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->