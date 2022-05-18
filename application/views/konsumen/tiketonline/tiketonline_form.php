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
                    <h3 class="box-title">Wahana</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('wahana/proses'); ?>" enctype="multipart/form-data" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama Wahana <label color="red">*</label></label>
                            <input type="hidden" name="wahana_id" value="<?= $row->wahana_id ?>">
                            <input type="text" value="<?= $row->name ?>" class="form-control" name="name" placeholder="Masukan Nama Wahana" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" value="<?= $row->price ?>" class="form-control" name="price" placeholder="Masukan price Wahana" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
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