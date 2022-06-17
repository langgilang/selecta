<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pesanan Offline</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan Offline</h3>
                        <a href="<?= site_url('portir/add') ?>" class="btn btn-success float-right">
                            <li class="fa fa-plus"></li> Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Total Tiket</th>
                                    <th>Paket</th>
                                    <th>Jenis Tiket</th>
                                    <th>Harga Paket</th>
                                    <th>Subtotal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($semuatiketoffline as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->customer_name ?></td>
                                        <td><?= $row->ticket_total ?>x</td>
                                        <td><?= $row->paket_name ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td>Rp. <?= $row->price ?></td>
                                        <td>Rp. <?=
                                                $total = $row->price * $row->ticket_total;
                                                $total; ?></td>
                                        <td class="text-center" width="160px">
                                            <a href="<?= site_url('portir/edit/' . $row->tiketoffline_id) ?>" class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Update
                                            </a>
                                            <a href="<?= site_url('portir/del/' . $row->tiketoffline_id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            <a href="<?= site_url('portir/invoice/' . $row->tiketoffline_id) ?>" class="btn btn-xs btn-default">
                                                <i class="fa fa-print"></i> Payment
                                            </a>
                                        </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>Total Tiket</th>
                                <th>Paket</th>
                                <th>Jenis Tiket</th>
                                <th>Harga Paket</th>
                                <th>Subtotal</th>
                                <th>#</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>