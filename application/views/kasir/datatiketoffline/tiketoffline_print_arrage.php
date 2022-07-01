<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $header ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Nama</th>
                            <th>Tanggal <br> Reservasi</th>
                            <th>Jenis <br>Tiket</th>
                            <th>Paket <br>Pilihan</th>
                            <th>Jumlah <br>Tiket</th>
                            <th>Total <br>Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($cetak_arrage as $row) : ?>
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
                                <td><?= $row->reservationdate ?></td>
                                <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                <td><?= $row->paket_name ?></td>
                                <td><?= $row->ticket_total ?> Tiket</td>
                                <td><?= 'Rp ' . number_format($total, 0, ".", ",") ?></td>
                            </tr>
                        <?php

                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
</body>

</html>