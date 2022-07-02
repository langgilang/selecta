<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Pesanan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Detail Pesanan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Detail Pesanan Tiket Online.
                                <!-- <small class="float-right">Date: 2/10/2014</small> -->
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Data Pemesan :</strong><br>
                                <?= $row->name; ?><br>
                                Phone: <?= $row->telp; ?><br>
                                Email: <?= $this->fungsi->user_login()->email ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <!-- <b>Invoice #007612</b><br> -->
                            <br>
                            <b>Order ID:</b> <?= $row->order_key; ?><br>
                            <b>Order Date:</b> <?= date('D-m-Y') ?><br>
                            <b>Account:</b> <?= $this->fungsi->user_login()->user_id ?>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <?php
                    $diskon = (($row->diskon / 100) * $row->wahana_price);
                    $harga_paket_diskon = $row->wahana_price - $diskon;

                    $subtotal_tiket = $harga_paket_diskon * $row->ticket_total;
                    $total_hargatiketmasuk = $row->ticket_total * 40000;
                    $total_tiketall = $subtotal_tiket + $total_hargatiketmasuk;
                    ?>

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jenis Tiket</th>
                                        <th>Jenis Paket</th>
                                        <th>Detail Paket</th>
                                        <th>Harga Paket</th>
                                        <th>Jumlah Paket</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan";; ?></td>
                                        <td><?= $row->paket_name ?></td>
                                        <td>
                                            <?php
                                            foreach ($get_wahana_by_invoice as $v) {
                                            ?>
                                                <ul>
                                                    <li><?= $v->wahana_name ?></li>
                                                </ul>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td><?= 'Rp ' . number_format($harga_paket_diskon, 0, ".", ",") ?></td>
                                        <td><?= number_format($row->ticket_total, 0, ".", ",") ?> tiket</td>
                                        <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <!-- <p class="lead">Amount Due 2/22/2014</p> -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td><?= 'Rp ' . number_format($subtotal_tiket, 0, ".", ",") ?></td>
                                    </tr>

                                    <tr>
                                        <th>Tiket Masuk <font color="red">(Rp 40,000)</font>
                                        </th>
                                        <td><?= 'Rp ' . number_format($total_hargatiketmasuk, 0, ".", ",") ?></td>
                                    </tr>

                                    <tr>
                                        <th>Total:</th>
                                        <td><?= 'Rp ' . number_format($total_tiketall, 0, ".", ",") ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <hr>

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="" id="pay-button" class="btn btn-success float-right" data-paket_id="<?= $row->paket_id ?>" data-total_all="<?= $total_tiketall ?>" data-harga_paket_diskon="<?= $harga_paket_diskon ?>" data-ticket_total="<?= $row->ticket_total ?>" data-order_key="<?= $row->order_key; ?>" data-order_name="<?= $row->name; ?>" data-telp="<?= $row->telp; ?>" data-email="<?= $this->fungsi->user_login()->email ?>" data-tiketonline_id="<?= $row->tiketonline_id; ?>" data-paket_name="<?= $row->paket_name; ?>">
                                <i class="far fa-credit-card"></i> Submit
                                Payment
                            </a>
                            <a href="<?= site_url('konsumen/tampil_konsumen') ?>" class="btn btn-sm btn-warning float-left                                                                                                              ">
                                <i class="fas fa-undo"></i> Back
                            </a>
                            <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a> -->
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <br>
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
    <input type="hidden" name="result_type" id="result-type" value="">
    </div>
    <input type="hidden" name="result_data" id="result-data" value="">
    </div>
</form>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-2628sDdKgoXg19is"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#pay-button').click(function(event) {
        var total_all = $(this).data('total_all');
        var order_key = $(this).data('order_key');
        var order_name = $(this).data('order_name');
        var telp = $(this).data('telp');
        var email = $(this).data('email');
        var tiketonline_id = $(this).data('tiketonline_id');
        var paket_name = $(this).data('paket_name');
        var ticket_total = $(this).data('ticket_total');
        var harga_paket_diskon = $(this).data('harga_paket_diskon');
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?= site_url() ?>snap/token',
            cache: false,
            data: {
                total_all: total_all,
                order_key: order_key,
                order_name: order_name,
                telp: telp,
                email: email,
                tiketonline_id: tiketonline_id,
                paket_name: paket_name,
                ticket_total: ticket_total,
                harga_paket_diskon: harga_paket_diskon,
            },

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>

<?php $this->load->view('templates/js') ?>