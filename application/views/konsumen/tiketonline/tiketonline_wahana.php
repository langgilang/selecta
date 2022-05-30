<title><?= $header; ?></title>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pesan Tiket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pesan Tiket</li>
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
                        Form Add Wahana
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Include Wahana <font style="color: red;">*</font></label>
                                <select class="select2bs4" name="wahana_id[]" id="wahana_id" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    <?php foreach ($wahana->result() as $data) { ?>
                                        <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>Wahana</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('') ?>" class="btn btn-primary float-right">
                        <li class="fa fa-arrow-alt-circle-right"></li>
                        Next
                    </a>
                    <a href="<?= base_url('form') ?>" class="btn btn-warning float-left">
                        <li class="fa fa-arrow-alt-circle-left"></li>
                        Back
                    </a>
                </div>
            </div>
        </div>
</section><!-- /.content -->