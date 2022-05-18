<title><?= $header; ?></title>

<section class="content-header">
    <h1>
        Tiket Online
        <small>Data Pesanan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tiker Online</li>
        <li class="active">Data Pesanan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- form tambah data wahana -->
    <?php $this->view('konsumen/messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Pesanan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="table1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Foto KTP</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Telephone</th>
                        <th>Wahana Pilihan</th>
                        <th>Jumlah Tiket</th>
                        <th>Jenis Tiket</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tiketonline as $w => $row) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->barcode; ?></td>
                            <td>
                                <?php if ($row->image != null) { ?>
                                    <img src="<?= base_url('uploads/tiketonline_ktp/' . $row->image); ?>" style="width: 100px;">
                                <?php } ?>
                            </td>
                            <td><?= $row->nik; ?></td>
                            <td><?= $row->tiketonline_name; ?></td>
                            <td><?= $row->telp; ?></td>
                            <td><?= $row->wahana_name; ?></td>
                            <td><?= $row->ticket_total; ?></td>
                            <td><?= $row->ticket_type == 1 ? "Perorangan" : "Rombongan"; ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('konsumen/edit/' . $row->tiketonline_id); ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                                <a href="<?= site_url('konsumen/del/' . $row->tiketonline_id); ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Foto KTP</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Telephone</th>
                        <th>Wahana Pilihan</th>
                        <th>Jumlah Tiket</th>
                        <th>Jenis Tiket</th>
                        <th>#</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- end form tambah wahana -->
</section><!-- /.content -->