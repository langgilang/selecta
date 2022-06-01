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
                    <li class="breadcrumb-item active"> Tambah Paket</li>
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
                        Tambah Paket
                    </h3>
                </div>
                <form action="<?= site_url('marketing/proses_add_paket') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Kode Paket <font color="red">*</font></label>
                                <input type="hidden" id="paket_id" name="paket_id">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Nama Paket <font color="red">*</font></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                            </div>
                            <div class="form-group col-3">
                                <label>Harga <font color="red">*</font></label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                            </div>

                            <div class="form-group col-12">
                                <label>Wahana <font color="red">*</font></label>
                                <select class="select2" id="wahana[]" name="wahana[]" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($tampilwahana as $data) { ?>
                                        <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
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