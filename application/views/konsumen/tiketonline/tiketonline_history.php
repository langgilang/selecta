<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">History Pesanan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">History Pesanan</li>
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

                <!-- tabel pesanan -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">History Data Pesanan Online</h3>
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
                                    <th>Wahana <br>Items</th>
                                    <th>Jumlah <br> Tiket</th>
                                    <th>Subtotal</th>
                                    <th>Status <br> Tiket</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($history as $row) : ?>
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
                                        <td><?= $row->paket_items ?> Items</td>
                                        <td><?= $row->ticket_total ?> Tiket</td>
                                        <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                                        <td>
                                            <?php
                                            if ($row->status_tiket == 3) {
                                            ?>
                                                <label class="badge bg-secondary">Chekout</label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="badge bg-danger">Dibatalkan</label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">

                                            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#detailPesanan<?= $row->tiketonline_id; ?>">
                                                <li class="fa fa-eye"></li>
                                            </button>

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

    <!-- modal detail-->
    <?php
    foreach ($history as $detail) :
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
        $status_tiket = $detail->status_tiket;
        $subtotal_tiket = $detail->status_tiket;
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
                                <label class="col-sm-3 col-form-label">Wahana Items </label>
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
                                        if ($status_tiket == 4) {
                                        ?>
                                            <label class="badge bg-danger">Dibatalkan</label>
                                        <?php
                                        } else {
                                        ?>
                                            <?= 'Rp ' . number_format($gross_amount, 0, ".", ",") ?>
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
                                        if ($status_tiket == 4) {
                                        ?>
                                            <label class="badge bg-danger">Dibatalkan</label>
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
                                        if ($status_tiket == 4) {
                                        ?>
                                            <label class="badge bg-danger">Dibatalkan</label>
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
                                        if ($status_tiket == 4) {
                                        ?>
                                            <label class="badge bg-danger">Dibatalkan</label>
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
                                    <td>

                                        <?php if ($status_tiket == 4) {
                                        ?>
                                            <label class="badge bg-danger">Dibatalkan</label>
                                        <?php
                                        } else {
                                        ?>
                                            <?php
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