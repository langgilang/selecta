<title><?= $header; ?></title>

<section class="content-header">
    <h1>
        Data Wahana
        <small>Edit Data Wahana</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Data</li>
        <li class="active">Data Wahana</li>
        <li class="active">Edit Data Wahana</li>
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
                    <h3 class="box-title">Edit Data Wahana</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('wahana/proses'); ?>" method="post">
                    <input type="hidden" name="id_wahana" value="<?= $wahana->id_wahana; ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Wahana</label>
                            <input type="text" value="<?= $wahana->nama_wahana; ?>" class="form-control" name="nama_wahana" placeholder="Masukan Nama Wahana">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <input type="number" value="<?= $wahana->harga; ?>" class="form-control" name="harga" placeholder="Masukan Harga Wahana">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <!-- end ukuran konten -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->