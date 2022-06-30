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
                                    <th>Jenis <br>Tiket</th>
                                    <th>Paket <br>Pilihan</th>
                                    <th>Harga <br>Paket</th>
                                    <th>Total <br> Pembayaran</th>
                                    <th>Status</th>
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
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td><?= $row->paket_name; ?></td>
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
                                            if ($row->status_code == 200) {
                                            ?>
                                                <label class="badge bg-success">Pembayaran Success</label>
                                            <?php
                                            } else if ($row->status_code == 201) {
                                            ?>
                                                <label class="badge bg-warning">Pembayaran Pending</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge bg-danger">Menunggu Pembayaran</label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center" style="width: 200px;">
                                            <?php
                                            if ($row->status_code == 200) {
                                            ?>
                                                <a href="#" class="btn btn-sm btn-default">
                                                    <i class="fa fa-print"></i> Cetak Tiket
                                                </a>
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailPesanan<?= $row->tiketonline_id; ?>">
                                                    <li class="fa fa-eye"></li>
                                                </button>
                                            <?php
                                            } else if ($row->status_code == 201) {
                                            ?>
                                                <a href="<?= $row->pdf_url ?>" class="btn btn-sm btn-success">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailPesanan<?= $row->tiketonline_id; ?>">
                                                    <li class="fa fa-eye"></li>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateReservation<?= $row->tiketonline_id; ?>">
                                                    <li class="fa fa-edit"></li>
                                                </a>

                                                <a href="<?= site_url('konsumen/invoice/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-credit-card"></i>
                                                </a>
                                                <a href="<?= site_url('konsumen/batal_pesanan/' . $row->tiketonline_id) ?>" class="btn btn-sm btn-danger">
                                                    Batal
                                                </a>
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailPesanan<?= $row->tiketonline_id; ?>">
                                                    <li class="fa fa-eye"></li>
                                                </button>
                                            <?php
                                            }
                                            ?>

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
    <form action="<?= site_url('konsumen/proses_add_perorangan') ?>" method="post">
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

                            <!-- <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Wahana <font color="red">*</font></label>
                                    <select class="select2 select2bs4" id="add_wahana[]" name="add_wahana[]" multiple style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                        <?php foreach ($tampilwahana as $data) { ?>
                                            <option value="<?= $data->wahana_id; ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end tambah pesanan perorangan -->

    <!-- modal update reservationdate -->
    <?php
    foreach ($semuatiketonline as $detail) :
        $tiketonline_id = $detail->tiketonline_id;
        $reservationdate = $detail->reservationdate;
    ?>
        <form action="" method="post">
            <div class="modal fade" id="updateReservation<?= $tiketonline_id ?>" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tanggal Reservasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group row">
                                <input type="hidden" value="<?= $tiketonline_id ?>" name="tiketonline_id">
                                <label class="col-sm-3 col-form-label">Tanggal Reservasi <font color="red">*</font></label>
                                <div class="col-sm-9">
                                    <input type="date" value="<?= $reservationdate ?>" id="reservationdate" name="reservationdate" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
    <!-- end update reservationdate -->

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

    <!-- modal detail-->
    <?php
    foreach ($semuatiketonline as $detail) :
        $tiketonline_id = $detail->tiketonline_id;
        $order_id = $detail->order_key;
        $nik = $detail->nik;
        $customer_name = $detail->customer_name;
        $telp = $detail->telp;
        $ticket_total = $detail->ticket_total;
        $reservationdate = $detail->reservationdate;
        $ticket_type = $detail->ticket_type;
        $paket_id = $detail->paket_id;
        $paket_name = $detail->paket_name;
        $paket_items = $detail->paket_items;
        $gross_amount = $detail->gross_amount;
        $payment_type = $detail->payment_type;
        $transaction_time = $detail->transaction_time;
        $status_code = $detail->status_code;
        $bank = $detail->bank;
        $va_number  = $detail->va_number;
    ?>
        <form action="<?= site_url('marketing/proses_edit') ?>" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="detailPesanan<?= $tiketonline_id; ?>">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Pesanan Online</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Oder Id </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $order_id; ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIK </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $nik; ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $customer_name ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telephone </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $telp; ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Pesanan </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $reservationdate ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah Pesanan </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $ticket_total; ?> Tiket</td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pilihan Paket </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $paket_name; ?></td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Paket Items </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?= $paket_items; ?> Items</td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total Pesanan </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td>
                                        <?php
                                        if ($gross_amount == null) {
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
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tipe Pembayaran </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td>
                                        <?php
                                        if ($payment_type == null) {
                                        ?>
                                            <label class="badge bg-danger">type pembayaran kosong</label>
                                        <?php
                                        } else {
                                        ?>
                                            <?= $payment_type ?>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bank </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td>
                                        <?php
                                        if ($bank == null) {
                                        ?>
                                            <label class="badge bg-danger">bank kosong</label>
                                        <?php
                                        } else {
                                        ?>
                                            <?= strtoupper($bank) ?>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">VA Number </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td>
                                        <?php
                                        if ($va_number == null) {
                                        ?>
                                            <label class="badge bg-danger">va number kosong</label>
                                        <?php
                                        } else {
                                        ?>
                                            <?= $va_number ?>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Pembayaran </label>
                                <div class="col-sm-1">
                                    <td>:</td>
                                </div>
                                <div class="col-sm-8">
                                    <td><?php
                                        if ($status_code == 200) {
                                        ?>
                                            <label class="badge bg-success">Pembayaran Success</label>
                                        <?php
                                        } else if ($status_code == 201) {
                                        ?>
                                            <label class="badge bg-warning">Pembayaran Pending</label>
                                        <?php
                                        } else {
                                        ?>
                                            <label class="badge bg-danger">Menunggu Pembayaran</label>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
    <?php endforeach; ?>
    <!-- end modal detail -->

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
    });
</script>