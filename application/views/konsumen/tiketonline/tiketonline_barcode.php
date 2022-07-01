<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cetak Tiket Online</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cetak Tiket Online</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php
                                    require 'assets/vendor/autoload.php';
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->order_key, $generator::TYPE_CODE_128)) . '">';
                                    ?>
                                    <!-- <img src="<?= site_url('konsumen/tampil_qrcode/' . $row->order_key) ?>" alt=""> -->
                                </div>
                                <h3 class="profile-username text-center"><?= $row->order_key ?></h3>
                                <a href="<?= site_url('konsumen/print/' . $row->tiketonline_id) ?>" target="_blank" class="btn btn-primary btn-block"><b>Cetak Tiket</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pesanan Online</h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-pane" id="settings">

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="inputName">Name</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="">:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <td><?= $row->customer_name ?></td>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="inputName">Telephone</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="">:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <td><?= $row->telp ?></td>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="inputName">Tanggal Reservasi</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="">:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <td><?= date('d F Y', strtotime($row->reservationdate)) ?></td>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="inputName">Paket Pilihan</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="">:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <td><?= $row->paket_name ?></td>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>