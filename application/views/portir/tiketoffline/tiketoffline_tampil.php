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
                <?php
                //
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

                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Id</th>
                                    <th>Nama <br>Customer</th>
                                    <th>Jenis <br>Tiket</th>
                                    <th>Total <br>Tiket</th>
                                    <th>Paket <br>Pilihan</th>
                                    <th>Paket <br>Items</th>
                                    <th>Harga <br>Paket</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Status <br>Tiket</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $diskon = 0;
                                foreach ($semuatiketoffline as $row) : ?>
                                    <?php
                                    $diskon = (($row->diskon / 100) * $row->paket_price);
                                    $subtotal_paket = $row->paket_price - $diskon;
                                    $subtotal_tiket = $subtotal_paket * $row->ticket_total;
                                    $total = $subtotal_tiket + ($row->ticket_total * 40000);
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->order_key; ?></td>
                                        <td><?= $row->customer_name ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td><?= $row->paket_name ?></td>
                                        <td><?= $row->wahana_item ?> Items</td>
                                        <td><?= $row->ticket_total ?> Tiket</td>
                                        <?php if ($row->diskon > 0) {
                                        ?>
                                            <td style="width: 80px;">
                                                <p>
                                                    <font style="text-decoration: line-through; color: darkred;"><?= 'Rp ' . number_format($row->paket_price, 0, ".", ",") ?></font>
                                                    <?= 'Rp ' . number_format($subtotal_paket, 0, ".", ",") ?>
                                                </p>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><?= 'Rp ' . number_format($row->paket_price, 0, ".", ",") ?></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                                        <td><?= 'Rp ' . number_format($total, 0, ".", ",") ?></td>
                                        <td>
                                            <?php
                                            if ($row->status_tiket == 1) {
                                            ?>
                                                <label class="badge badge-success">Check In</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge badge-danger">Check Out </label>
                                            <?php
                                            }

                                            ?>
                                        </td>

                                        <td class="text-left">
                                            <?php
                                            if ($row->status_tiket == 1) {
                                            ?>
                                                <a href="<?= site_url('portir/update_status_tiket/' . $row->tiketoffline_id) ?>" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="#" class="btn btn-sm btn-default">
                                                    <li class="fa fa-eye"></li>
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
                </div>
            </div>
        </section><!-- /.content -->
    </div>
    <!--- Modal tambah pesanan perorangan --->
    <form action="<?= site_url('portir/proses_add_perorangan') ?>" method="POST">
        <div class="modal fade" id="addPesananPerorangan" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Pesanan Tiket Offline Perorangan</h4>
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
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="number" min="1" max="29" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>

                            <div class="col-md-4">
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
                                <div class="form-group ">
                                    <label for="name">Nama <font color="red">*</font></label>
                                    <input type="text" value="" id="name" name="name" class="form-control" placeholder="Masukkan Nama Anda " required>
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

    <!--modal tambah pesanan rombongan --->
    <form action="" method="post">
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
                                    <input type="text" value="" id="order_key" name="order_key" class="form-control" disabled>
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
                            <div class="form-group ">
                                <label for="name">Nama <font color="red">*</font></label>
                                <input type="text" value="" id="name" name="name" class="form-control" placeholder="Masukkan Nama Anda " required>
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
                                    <!-- <?php foreach ($tampilpaket as $data) : ?>
                                            <option value="<?= $data->paket_id ?>"><?= $data->name ?></option>
                                        <?php endforeach; ?> -->
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
    </form>
    <!-- end tambah pesanan rombongan -->
</div>

<?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>

<script>
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
</script>