<title><?= $header; ?></title>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Paket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"> Edit Paket</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Paket
                    </h3>
                </div>
                <form action="<?= site_url('marketing/proses_add_paket') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Kode Paket <font color="red">*</font></label>
                                <input type="hidden" value="<?= $row->paket_id ?>" id="paket_id" name="paket_id">
                                <input type="text" value="<?= $row->code ?>" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Nama Paket <font color="red">*</font></label>
                                <input type="text" value="<?= $row->name ?>" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                            </div>
                            <div class="form-group col-3">
                                <label>Harga <font color="red">*</font></label>
                                <input type="number" value="<?= $row->price ?>" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                            </div>

                            <div class="form-group col-12">
                                <label>Wahana <font color="red">*</font></label>
                                <select class="select2 select2bs4" id="wahana[]" name="wahana[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($tampilwahana as $data) { ?>
                                        <option value="<?= $data->wahana_id; ?>" <?php if ($data->wahana_id == $row->wahana_id) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo $data->name  ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!-- /.content -->