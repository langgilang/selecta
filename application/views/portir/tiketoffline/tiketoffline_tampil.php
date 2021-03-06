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
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success float-right" type="button" data-toggle="modal" data-target="#addPesananPerorangan">Tambah Pesanan Tiket Offline</button>
                    </div>
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
                                    <!-- <th>Paket <br>Items</th> -->
                                    <th>Harga <br>Paket</th>
                                    <!-- <th>Subtotal</th> -->
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
                                        <!-- <td><?= $row->wahana_item ?> Items</td> -->
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
                                        <!-- <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td> -->
                                        <td><?= 'Rp ' . number_format($total, 0, ".", ",") ?></td>
                                        <td>
                                            <?php
                                            if ($row->status_tiket == 1) {
                                            ?>
                                                <label class="badge badge-success">Tiket Check-In</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge badge-danger">Tiket Check-Out </label>
                                            <?php
                                            }

                                            ?>
                                        </td>

                                        <td class="text-left">
                                            <?php
                                            if ($row->status_tiket == 1) {
                                            ?>
                                                <a href="<?= site_url('portir/print/' . $row->tiketoffline_id) ?>" target="_blank" class="btn btn-sm btn-default">
                                                    <li class="fa fa-qrcode"></li> Cetak Tiket
                                                </a>
                                                <a href="<?= site_url('portir/update_status_tiket/' . $row->tiketoffline_id) ?>" class="btn btn-sm btn-danger">
                                                    Checkout
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailPesanan<?= $row->tiketoffline_id ?>">
                                                    <li class="fa fa-eye"></li>
                                                </button>
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
        <br>
    </div>

</div>

<!--- Modal tambah pesanan  --->
<form action="<?= site_url('portir/proses_add_perorangan') ?>" method="POST" id="addtiketoffline">
    <div class="modal fade" id="addPesananPerorangan" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Pesanan Tiket Offline</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" value="" name="tiketonline_id">
                                <label for="order_key">Order Id <font color="red">*</font></label>
                                <input type="text" value="<?= $order_key ?>" id="order_key" name="order_key" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                <input type="text" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nama <font color="red">*</font></label>
                                <input type="text" value="" id="name" name="name" class="form-control" placeholder="Masukkan Nama Anda ">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end tambah pesanan perorangan -->

<?php
foreach ($semuatiketoffline as $detail) :
    $tiketoffline_id = $detail->tiketoffline_id;
    $order_id = $detail->order_key;
    $customer_name = $detail->customer_name;
    $ticket_total = $detail->ticket_total;
    $reservationdate = $detail->reservationdate;
    $ticket_type = $detail->ticket_type;
    $paket_id = $detail->paket_id;
    $paket_name = $detail->paket_name;
    $paket_price = $detail->paket_price;
    $paket_items = $detail->wahana_item;
?>
    <?php
    $diskon = (($row->diskon / 100) * $row->paket_price);
    $subtotal_paket = $row->paket_price - $diskon;
    $subtotal_tiket = $subtotal_paket * $row->ticket_total;
    $total = $subtotal_tiket + ($row->ticket_total * 40000);
    ?>
    <div class="modal fade" id="detailPesanan<?= $tiketoffline_id ?>">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pesanan Offline</h4>
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
                        <label class="col-sm-3 col-form-label">Nama </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <td><?= $customer_name ?></td>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Pesanan </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <td><?= date('d F Y', strtotime($reservationdate)) ?></td>
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
                        <label class="col-sm-3 col-form-label">Harga Paket </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <?php if ($row->diskon > 0) {
                            ?>
                                <td style="width: 80px;">
                                    <p>
                                        <font style="text-decoration: line-through; color: darkred;"><?= 'Rp ' . number_format($row->paket_price, 0, ".", ",") ?></font> - <?= 'Rp ' . number_format($subtotal_paket, 0, ".", ",") ?>
                                    </p>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td><?= 'Rp ' . number_format($row->paket_price, 0, ".", ",") ?></td>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Subtotal </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Pesanan </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <td><?= 'Rp ' . number_format($total, 0, ".", ",") ?>
                            </td>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Pembayaran </label>
                        <div class="col-sm-1">
                            <td>:</td>
                        </div>
                        <div class="col-sm-8">
                            <td>
                                <?php
                                if ($row->status_tiket == 1) {
                                ?>
                                    <label class="badge badge-success">Tiket Check-In</label>
                                <?php
                                } else {
                                ?>
                                    <label class="badge badge-danger">Tiket Check-Out </label>
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
<?php endforeach; ?>

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

    //validasi form
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Hanya boleh huruf");

    jQuery.validator.addMethod("numberonly", function(value, element) {
        return this.optional(element) || /^[0-9]$/.test(value);
    }, "Hanya boleh angka");

    jQuery.validator.addMethod('uppercaseandsymbols', function(value) {
        return value.match(/^[^A-Z0-9]+$/);
    }, 'Haya boleh huruf kapital dan angka');

    $('#addtiketoffline').validate({
        rules: {
            ticket_total: {
                required: true,
                number: true,
                min: 1
            },

            name: {
                required: true,
                lettersonly: true,
            },

            paket_id: {
                required: true,
            },

        },
        messages: {
            ticket_total: {
                required: "Tiket harus diisi",
                number: "Tiket hanya boleh diisi angka",
                min: "Tiket minimal harus 1",
            },

            name: {
                required: "Nama tidak boleh kosong",
                lettersonly: "Nama hanya diisi boleh huruf",
            },

            paket_id: {
                required: "Paket tidak boleh kosong",
            },

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>