<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
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
                                            <td>Rp. <?= $row->paket_price; ?></td>
                                            <td class="text-center" width="160px">
                                                <a href="<?= site_url('marketing/edit_paket/') . $row->paket_id ?>" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i> Update
                                                </a>
                                                <!-- iki page -->
                                                <!-- <a href="#" class="btn btn-xs btn-default update-record" package_id="<?= $row->paket_id; ?>">
                                            <li class="fa fa-edit"></li> Edit
                                        </a>  -->
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
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>