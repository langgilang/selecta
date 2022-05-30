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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php $this->view('portir/messages') ?>
        <div class="card card-header">
            <h3 class="card-title">Data Pesanan Offline</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="<?= site_url('portir/proses'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3" hidden>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_portir">Nama Portir <font color="red">*</font></label>
                            <input type="text" id="name_portir" name="name_portir" class="form-control" placeholder="Masukan Nama Portir" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Customer <font color="red">*</font></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukan Nama Lengkap Anda" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telp">Jumlah Tiket<font color="red">*</font></label>
                            <input type="number" id="ticket_total" name="ticket_total" class="form-control" placeholder="Masukan Jumlah Tiket" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Wahana <font color="red">*</font></label>
                            <select name="wahana" class="form-control" required>
                                <option value="">- Pilih -</option>

                            </select>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->