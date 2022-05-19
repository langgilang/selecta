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
    <?php $this->view('portir/messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Tiket Offline</h3>
            <div class="pull-right">
                <a href="<?= site_url('tiketoffline/add'); ?>" class="btn btn-sm btn-success">
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
                        <th>Nama</th>
                        <th>Jumlah Tiket</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tiketoffline as $w => $row) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->name; ?></td>
                            <td><?= $row->ticket_total; ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('tiketoffline/edit/' . $row->tiketoffline_id); ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                                <a href="<?= site_url('tiketoffline/del/' . $row->tiketoffline_id); ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Tiket</th>
                        <th>#</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->