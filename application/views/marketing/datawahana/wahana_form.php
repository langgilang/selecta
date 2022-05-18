<title><?= $header; ?></title>

<section class="content-header">
    <h1>
        Data Wahana
        <small>Tambah Data Wahana</small>
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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= ucfirst($page) ?> Wahana</h3>
                    <div class="pull-right">
                        <a href="<?= site_url('wahana'); ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('wahana/proses'); ?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama Wahana</label>
                            <input type="hidden" name="id_wahana" value="<?= $row->id_wahana ?>">
                            <input type="text" value="<?= $row->nama_wahana ?>" class="form-control" name="nama_wahana" placeholder="Masukan Nama Wahana" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" value="<?= $row->harga ?>" class="form-control" name="harga" placeholder="Masukan Harga Wahana" required>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="<?= $page ?>" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <!-- end ukuran konten -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->