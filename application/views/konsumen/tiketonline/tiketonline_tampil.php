<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php $this->view('konsumen/messages') ?>
                <!-- <a href="<?= site_url('konsumen/add') ?>" class="btn btn-sm btn-success">
                    <i class="fa fa-plus-circle"></i> Tambah Pesanan
                </a><br>&nbsp; -->
                <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modal-xl">
                    <i class="fa fa-plus-circle"></i> Tambah Pesanan
                </button><br>&nbsp;

                <!-- tabel pesanan -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan Online</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Id</th>
                                    <th>Nama</th>
                                    <th>Telephone</th>
                                    <th>Jenis Tiket</th>
                                    <th>Paket Pilihan</th>
                                    <th>Harga Paket</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Sub Total</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($semuatiketonline as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->order_key; ?></td>
                                        <td><?= $row->username; ?></td>
                                        <td><?= $row->telp ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td><?= $row->name; ?></td>
                                        <td>Rp. <?= number_format($row->price); ?></td>
                                        <td><?= $row->ticket_total ?>x</td>
                                        <td>Rp. <?= number_format(($row->price * $row->ticket_total)) ?>
                                        </td>
                                        <td class="text-center" width="160px">
                                            <a href="<?= site_url('konsumen/edit/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('konsumen/del/' . $row->tiketonline_id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <a href="<?= site_url('konsumen/invoice/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-warning">
                                                <i class="fa fa-credit-card"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $row->price * $row->ticket_total;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- end tabel pesanan -->

                <!-- tabel transaksi -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Id</th>
                                    <th>Total Pembayaran</th>
                                    <th>Type Pembayaran</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Bank</th>
                                    <th>VA Number</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($transaksi as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->order_id; ?></td>
                                        <td>Rp. <?= number_format($row->gross_amount); ?></td>
                                        <td><?= $row->payment_type ?></td>
                                        <td><?= $row->transaction_time ?></td>
                                        <td><?= $row->bank; ?></td>
                                        <td><?= $row->va_number; ?></td>
                                        <td>
                                            <?php
                                            if ($row->transaction_status == "settlement") {
                                            ?>
                                                <label class="badge bg-success">Success</label>
                                            <?php
                                            } else if ($row->transaction_status == "pending") {
                                            ?>
                                                <label class="badge bg-warning">Pending</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge bg-primary">Expired</label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->transaction_status == "settlement") {
                                            ?>
                                                <a href="<?= $row->pdf_url; ?>" target="_blank" class="btn btn-danger btn-sm">
                                                    <li class="fa fa-trash-alt"></li>
                                                </a>

                                            <?php
                                            } else if ($row->transaction_status == "pending") {
                                            ?>
                                                <a href="<?= $row->pdf_url; ?>" target="_blank" class="btn btn-success btn-sm">
                                                    <li class="fa fa-download"></li>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= $row->pdf_url; ?>" target="_blank" class="btn btn-danger btn-sm">
                                                    <li class="fa fa-trash-alt"></li>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- end tabel transaksi -->
                <br>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <!-- modal add pesanan online -->
    <form action="" method="post">
        <div class="modal fade" id="modal-xl">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Extra Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md 3">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="order_key">Order Id <font color="red">*</font></label>
                                    <input type="text" value="<?= $order_key ?>" id="order_key" name="order_key" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md 3">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                    <input type="date" value="" id="reservationdate" name="reservationdate" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md 3">
                                <div class="form-group">
                                    <label for="nik">NIK <font color="red">*</font></label>
                                    <input type="text" value="" id="nik" name="nik" class="form-control" placeholder="Masukkan Nik " required>
                                </div>
                            </div>
                            <div class="col-md 3">
                                <div class="form-group ">
                                    <label for="name">Nama <font color="red">*</font></label>
                                    <input type="text" value="" id="name" name="name" class="form-control" placeholder="Masukkan Nama Anda " required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md 3">
                                <div class="form-group ">
                                    <label for="telp">Telephone <font color="red">*</font></label>
                                    <input type="text" value="" id="telp" name="telp" class="form-control" placeholder="Masukkan Telephone " required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="ticket_type">Jenis Tiket <font color="red">*</font></label>
                                    <select name="ticket_type" id="ticket_type" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Perorangan</option>
                                        <option value="2">Rombongan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="number" value="" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="paket_id">Jenis Paket <font color="red">*</font></label>
                                    <select name="paket_id" id="paket_id" class="form-control">
                                        <option value="">-- Pilih -- </option>
                                        <?php foreach ($tampilpaket as $tp => $data) : ?>
                                            <option value="<?= $data->paket_id ?>"><?= $data->name ?> - <?= $data->price ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end modal pesanan online -->

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>