<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pesanan Tiket Online</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Pesanan Tiket Online</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan Online</h3>
                        <button type="button" class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#printArrage">
                            <li class="fa fa-print"></li> Print Arrage
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Telephone</th>
                                    <th>Paket <br>Pilihan</th>
                                    <th>Jenis <br>Tiket</th>
                                    <th>Jumlah <br>Tiket</th>
                                    <th>Total <br>Pesanan</th>
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
                                        <td><?= $row->customer_name ?></td>
                                        <td><?= $row->telp ?></td>
                                        <td><?= $row->paket_name ?></td>
                                        <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                        <td><?= $row->ticket_total ?> Tiket</td>
                                        <td><?= 'Rp ' . number_format($row->gross_amount, 0, ".", ",") ?></td>

                                        <td class="text-left">
                                            <a href="#" class="btn btn-sm btn-default">
                                                <li class="fa fa-print"></li>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $row->gross_amount * $row->ticket_total;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<!-- modal tambah data -->
<form action="" method="post">
    <div class="modal fade" id="printArrage" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cetak PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Awal <font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control " name="reservationdate" id="reservationdate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Akhir <font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control " name="reservationdate" id="reservationdate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<!-- end modal tambah data -->

<?php $this->load->view('templates/js') ?>