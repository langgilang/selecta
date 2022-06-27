<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pesanan Tiket Online</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pesanan Tiket Online</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php
                // $this->view('konsumen/messages')
                ?>
                <div id="flash" data-flash="<?= $this->session->flashdata('success'); ?>"></div>

                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                        Tambah Pesanan Tiket Online
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg-right">
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#addPesananPerorangan">Tiket Perorangan</button>
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#addPesananRombongan">Tiket Rombongan</button>
                    </div>
                </div>

                <!-- <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#addPesanan">
                    <i class="fa fa-plus-circle"></i> Tambah Pesanan
                </button> -->
                <br><br>
                <!-- tabel pesanan -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan Online</h3>
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
                                    <th>Jenis <br>Tiket</th>
                                    <th>Paket <br>Pilihan</th>
                                    <th>Paket <br>Items</th>
                                    <th>Harga <br>Paket</th>
                                    <th>Jumlah <br>Tiket</th>
                                    <th>Subtotal <br>Tiket</th>
                                    <th>Type <br> Pembayaran</th>
                                    <th>Total <br> Pembayaran</th>
                                    <th>Bank</th>
                                    <th>VA Number</th>
                                    <th>Status</th>
                                    <th>Tiket <br> Online</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($semuatiketonline as $row) : ?>
                                    <?php
                                    $diskon = (($row->diskon / 100) * $row->wahana_price);
                                    $subtotal_paket = $row->wahana_price - $diskon;
                                    $subtotal_tiket = $subtotal_paket * $row->ticket_total;
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->order_key; ?></td>
                                        <td><?= $row->customer_name; ?></td>
                                        <td><?= $row->telp ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td><?= $row->paket_name; ?></td>
                                        <td><?= $row->paket_items; ?> items</td>
                                        <?php if ($row->diskon > 0) {
                                        ?>
                                            <td style="width: 80px;">
                                                <p style="text-decoration: line-through; color: darkred;"> <?= 'Rp ' . number_format($row->wahana_price, 0, ".", ",") ?> </p>
                                                <p><?= 'Rp ' . number_format($subtotal_paket, 0, ".", ",") ?></p>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><?= 'Rp ' . number_format($row->wahana_price, 0, ".", ",") ?></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= number_format($row->ticket_total, 0, ".", ",") ?> tiket</td>
                                        <td style="width: 100px;"><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                                        <td>
                                            <?php
                                            if ($row->payment_type == null) {
                                            ?>
                                                <label class="badge bg-danger">type pembayaran kosong</label>
                                            <?php
                                            } else {
                                            ?>
                                                <?= $row->payment_type ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->gross_amount == null) {
                                            ?>
                                                <label class="badge bg-danger">total pembayaran kosong</label>
                                            <?php
                                            } else {
                                            ?>
                                                <?= 'Rp ' . number_format($row->gross_amount, 0, ".", ",") ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->bank == null) {
                                            ?>
                                                <label class="badge bg-danger">bank kosong</label>
                                            <?php
                                            } else {
                                            ?>
                                                <?= $row->bank ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->va_number == null) {
                                            ?>
                                                <label class="badge bg-danger">va number kosong</label>
                                            <?php
                                            } else {
                                            ?>
                                                <?= $row->va_number ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->status_code == 200) {
                                            ?>
                                                <label class="badge bg-success">Success</label>
                                            <?php
                                            } else if ($row->status_code == 201) {
                                            ?>
                                                <label class="badge bg-warning">Pending</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge bg-danger">Menunggu Pembayaran</label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->status_code == 200) {
                                            ?>
                                                <a href="#">cetak tiket</a>
                                            <?php
                                            } else if ($row->status_code == 201) {
                                            ?>
                                                <a href="#" class="badge bg-danger">tiket kosong</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="#" class="badge bg-danger">tiket kosong</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center" style="width: 150px;">
                                            <?php
                                            if ($row->status_code == 200) {
                                            ?>
                                                <a href="<?= $row->pdf_url ?>" class="btn btn-sm btn-default">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            <?php
                                            } else if ($row->status_code == 201) {
                                            ?>
                                                <a href="<?= $row->pdf_url ?>" class="btn btn-sm btn-success">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= site_url('konsumen/edit/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="<?= site_url('konsumen/invoice/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-credit-card"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            <!-- <a href="<?= site_url('konsumen/del/' . $row->tiketonline_id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash-alt"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                <?php

                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- end tabel pesanan -->
                <br>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <!-- modal tambah pesanan perorangan -->
    <form action="" method="post">
        <div class="modal fade" id="addPesananPerorangan" data-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Pesanan Tiket Online Perorangan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="order_key">Order Id <font color="red">*</font></label>
                                    <input type="text" value="<?= $order_key ?>" id="order_key" name="order_key" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                    <input type="date" value="" id="reservationdate" name="reservationdate" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="number" min="1" max="29" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="ticket_type">Jenis Tiket <font color="red">*</font></label>
                                    <select name="ticket_type" id="ticket_type" class="form-control" disabled="true">
                                        <option value="1">Perorangan</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

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

                            <div class="col-md 3">
                                <div class="form-group ">
                                    <label for="telp">Telephone <font color="red">*</font></label>
                                    <input type="text" value="" id="telp" name="telp" class="form-control" placeholder="Masukkan Telephone " required>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paket_id">Jenis Paket <font color="red">*</font></label>
                                    <select name="paket_id" id="paket_id" class="form-control">
                                        <option value="">-- Pilih -- </option>
                                        <?php foreach ($tampilpaket as $data) : ?>
                                            <option value="<?= $data->paket_id ?>"><?= $data->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Wahana <font color="red">*</font></label>
                                    <select class="select2 select2bs4" id="add_wahana[]" name="add_wahana[]" multiple style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                        <?php foreach ($tampilwahana as $data) { ?>
                                            <option value="<?= $data->wahana_id; ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Simpan </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end tambah pesanan perorangan -->

    <!-- modal tambah pesanan rombongan -->
    <form action="<?= site_url('konsumen/proses_add_rombongan') ?>" method="post">
        <div class="modal fade" id="addPesananRombongan" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Pesanan Tiket Online Rombongan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="order_key">Order Id <font color="red">*</font></label>
                                    <input type="text" value="<?= $order_key ?>" id="order_key" name="order_key" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                    <input type="date" class="form-control " name="reservationdate" id="reservationdate">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="number" min="30" max="300" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">

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

                            <div class="col-md 3">
                                <div class="form-group ">
                                    <label for="telp">Telephone <font color="red">*</font></label>
                                    <input type="text" value="" id="telp" name="telp" class="form-control" placeholder="Masukkan Telephone " required>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="ticket_type">Jenis Tiket <font color="red">*</font></label>
                                    <select name="ticket_type" id="ticket_type" class="form-control" disabled="true">
                                        <option value="2">Rombongan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paket_id">Jenis Paket <font color="red">*</font></label>
                                    <select name="paket_id" id="paket_id" class="form-control">
                                        <option value="">-- Pilih -- </option>
                                        <?php foreach ($tampilpaket as $data) : ?>
                                            <option value="<?= $data->paket_id ?>"><?= $data->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end tambah pesanan rombongan -->

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>

<script>
    $(document).ready(function() {
        //SWEETALERT2
        var flash = $('#flash').data('flash');
        if (flash) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flash
            })
        }
        $(document).on('click', '#btn-delete', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data Akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            })
        });
    });
</script>