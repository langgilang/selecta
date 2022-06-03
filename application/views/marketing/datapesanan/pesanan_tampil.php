<title><?= $header; ?></title>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
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
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Telephone</th>
                            <th>Wahana Pilihan</th>
                            <th>Jenis Tiket</th>
                            <th>Jumlah Tiket</th>
                            <th>Sub Total</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($pesananonline as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->nik; ?></td>
                                <td><?= $row->tiketonline_name ?></td>
                                <td><?= $row->telp ?></td>
                                <td><?= $row->wahana_name ?> - Rp. <?= $row->price ?></td>
                                <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                                <td><?= $row->ticket_total ?></td>
                                <td>Rp. <?= ($row->price * $row->ticket_total) + 45000 ?></td>
                                <td class="text-center" width="160px">
                                    <a href="<?= site_url('konsumen/edit/' . $row->tiketonline_id) ?>" class="btn btn-xs btn-default">
                                        <i class="fa fa-lop"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $total += $row->price * $row->ticket_total;
                        endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Telephone</th>
                            <th>Wahana Pilihan</th>
                            <th>Jenis Tiket</th>
                            <th>Jumlah Tiket</th>
                            <th>Sub Total</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>