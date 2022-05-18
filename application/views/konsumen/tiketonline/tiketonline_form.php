<title><?= $header; ?></title>

<section class="content-header">
    <h1>
        Tiket Online
        <small>Tambah Pesanan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tiket Online</li>
        <li class="active">Tambah Pesanan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- form tambah data wahana -->
    <div class="row">
        <!-- ukuran konten -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= ucfirst($page) ?> Pesanan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('konsumen/proses'); ?>" enctype="multipart/form-data" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Barcode <font color="red">*</font></label>
                                    <input type="hidden" value="<?= $row->tiketonline_id ?>" name="tiketonline_id">
                                    <input type="text" value="<?= $row->barcode ?>" class="form-control" name="barcode" placeholder="Masukan Barcode" required>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK <font color="red">*</font></label>
                                    <input type="number" value="<?= $row->nik ?>" id="nik" name="nik" class="form-control" placeholder="Masukan NIK Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama <font color="red">*</font></label>
                                    <input type="text" value="<?= $row->name ?>" id="name" name="name" class="form-control" placeholder="Masukan Nama Lengkap Anda" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="telp">Telp <font color="red">*</font></label>
                                        <input type="number" value="<?= $row->telp ?>" id="telp" name="telp" class="form-control" placeholder="Masukan Nomer Telephone" required>
                                    </div>
                                    <label>Wahana <font color="red">*</font></label>
                                    <select name="wahana" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($wahana->result() as $key => $data) { ?>
                                            <option value="<?= $data->wahana_id ?>"><?= $data->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="hidden" value="<?= $row->tiketonline_id ?>" name="tiketonline_id">
                                    <input type="number" value="<?= $row->barcode ?>" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Tiket <font color="red">*</font></label>
                                    <select name="ticket_type" id="" class="form-control">
                                        <option value=""> - Pilih - </option>
                                        <option value="1"> Perorangan </option>
                                        <option value="2"> Rombongan </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
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