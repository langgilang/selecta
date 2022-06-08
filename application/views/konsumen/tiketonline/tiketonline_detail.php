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
                                <a href="<?= site_url('konsumen/tampil_konsumen') ?>" class="btn btn-sm btn-warning float-right">
                                    <i class="fas fa-undo"></i> Back
                                </a>
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
                            <b>Order ID:</b><br>
                            <b>Order Date:</b> <?= date('D-m-Y') ?><br>
                            <b>Account:</b> <?= $this->fungsi->user_login()->user_id ?>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jumlah Paket</th>
                                        <th>Jenis Tiket</th>
                                        <th>Jenis Paket</th>
                                        <th>Harga Paket</th>
                                        <th>Detail Paket</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $row->ticket_total; ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan";; ?></td>
                                        <td><?= $row->paket_name; ?></td>
                                        <td>Rp. <?= $row->paket_price; ?></td>

                                        <td>
                                            <?php foreach ($getwahana as $w) { ?>
                                                <p>- <?= $w->wahana_name ?> </p>
                                            <?php } ?>
                                        </td>
                                        <td>Rp. <?= $row->paket_price * $row->ticket_total ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <!-- <p class="lead">Payment Methods:</p>
                    <img src="<?= base_url('assets/') ?>dist/img/credit/visa.png" alt="Visa">
                    <img src="<?= base_url('assets/') ?>dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="<?= base_url('assets/') ?>dist/img/credit/american-express.png" alt="American Express">
                    <img src="<?= base_url('assets/') ?>dist/img/credit/paypal2.png" alt="Paypal"> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <!-- <p class="lead">Amount Due 2/22/2014</p> -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>Rp. <?= $row->paket_price * $row->ticket_total ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tiket Masuk</th>
                                        <td>Rp. <?= $row->ticket_total * 45000 ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>Rp. <?= (($row->paket_price * $row->ticket_total) + ($row->ticket_total * 45000)) ?> </td>
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
                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <a href="<?= site_url('snap') ?>" id="pay-button" class="btn btn-success float-right">
                                <i class="far fa-credit-card"></i> Submit
                                Payment
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->

            </div><!-- /.container-fluid -->
        </section>
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-2628sDdKgoXg19is"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?= site_url() ?>/snap/token',
            cache: false,

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