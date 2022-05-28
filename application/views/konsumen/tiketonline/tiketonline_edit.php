<title><?= $header; ?></title>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pesan Tiket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pesan Tiket</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php $this->view('konsumen/messages') ?>
        <div class="card card-default">
            <!-- card header -->
            <div class="card-header">
                <h3 class="card-title"><?= ucfirst($page) ?> Pesanan Tiket Online</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- end card header -->
            <!-- card body -->
            <div class="card-body">
                <form action="<?= site_url('konsumen/proses'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nik">NIK <font color="red">*</font></label>
                                <input type="hidden" value="<?= $row->tiketonline_id ?>" name="tiketonline_id">
                                <input type="number" value="<?= $row->nik ?>" id="nik" name="nik" class="form-control" placeholder="Masukan NIK Anda" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama <font color="red">*</font></label>
                                <input type="text" value="<?= $row->tiketonline_name ?>" id="name" name="name" class="form-control" placeholder="Masukan Nama Lengkap Anda" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                <input type="date" value="<?= $row->reservationdate ?>" id="reservationdate" name="reservationdate" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telp">Telp <font color="red">*</font></label>
                                <input type="number" value="<?= $row->telp ?>" id="telp" name="telp" class="form-control" placeholder="Masukan Nomer Telephone" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Wahana <font color="red">*</font></label>
                                <select name="wahana" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($wahana->result() as $data) { ?>
                                        <option value="<?= $data->wahana_id ?>" <?= $data->wahana_id == $row->wahana_id ? "selected" : null ?>><?= $data->name ?> - <?= $data->price ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                <input type="number" value="<?= $row->ticket_total ?>" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Tiket <font color="red">*</font></label>
                                <select name="ticket_type" id="" class="form-control">
                                    <option value=""> - Pilih - </option>
                                    <option value="1"> Perorangan </option>
                                    <option value="2"> Rombongan </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12"> -->
                    <!-- </div> -->
                    <button type="submit" name="<?= $page ?>" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section><!-- /.content -->