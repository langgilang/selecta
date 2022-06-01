<title><?= $header; ?></title>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Paket Wahana</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Paket Wahana</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <?php $this->view('marketing/messages') ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Paket Wahana
                    </h3>
                    <a href="<?= site_url('marketing/add_paket') ?>" class="btn btn-sm btn-success float-right">
                        <li class="fa fa-plus"></li>
                        Tambah Paket
                    </a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Paket</th>
                                <th>Nama Paket</th>
                                <th>Created At</th>
                                <th>Items</th>
                                <th>Harga</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($tampilpaket as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->code_paket; ?></td>
                                    <td><?= $row->paket_name; ?></td>
                                    <td><?= $row->create_paket; ?></td>
                                    <td><?= $row->wahana_item; ?> Items</td>
                                    <td>Rp. <?= $row->price; ?></td>
                                    <td class="text-center" width="160px">
                                        <!-- <a href="<?= site_url('marketing/edit_paket/') . $row->paket_id ?>" class="btn btn-xs btn-default">
                                            <i class="fa fa-edit"></i> Update
                                        </a> -->
                                        <!-- <a href="#" class="btn btn-xs btn-default update-record" package_id="<?= $row->paket_id; ?>">
                                            <li class="fa fa-edit"></li> Edit
                                        </a> -->
                                        <a href="<?= site_url('marketing/del_paket/') . $row->paket_id ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Paket</th>
                                <th>Nama Paket</th>
                                <th>Created At</th>
                                <th>Items</th>
                                <th>Harga</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<!-- Modal Update Package-->
<form action="<?php echo site_url('package/update'); ?>" method="post">
    <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Paket </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Kode Paket <font color="red">*</font></label>
                            <input type="hidden" id="paket_id" name="paket_id">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" required>
                        </div>
                        <div class="form-group col-6">
                            <label>Nama Paket <font color="red">*</font></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Harga <font color="red">*</font></label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                        </div>

                        <div class="form-group col-6">
                            <label>Wahana <font color="red">*</font></label>
                            <select class="select2 select2bs4 strings" id="wahana[]" name="wahana[]" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                <?php foreach ($tampilwahana->result() as $data) { ?>
                                    <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>