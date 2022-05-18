<title><?= $header; ?></title>

<section class="content-header">
    <h1>
        Tiket Online
        <small>Barcode</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tiket Online</li>
        <li class="active">Barcode</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- form tambah data wahana -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Barcode</h3>
                    <div class="pull-right">
                        <a href="<?= site_url('konsumen/tampil_konsumen'); ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
                    ?><br>
                    <?= $row->barcode ?>
                </div>

                <div class="box-footer">
                </div>
            </div><!-- /.box -->
        </div>
        <!-- end ukuran konten -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->