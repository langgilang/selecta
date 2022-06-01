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
        <div class="col-md-12">
            <div class="alert callout callout-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fas fa-info"></i> Note:</h5>
                <div class="row">
                    <div class="col-md-6">
                        Use one select visit date
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        No Reservation need
                    </div>
                    <div class="col-md-6" style="align-items: right;">
                        Rp. 45.000
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Non-Refundable
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Taman Rekreasi Selecta Tiket Masuk
                    </h3>
                </div>
                <form action="<?= site_url('konsumen/proses'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md 6">
                                <div class="form-group ">
                                    <input type="hidden" value="" name="tiketonline_id">
                                    <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                    <input type="date" value="" id="reservationdate" name="reservationdate" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                    <input type="number" value="" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</section><!-- /.content -->