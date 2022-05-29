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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" value="" name="tiketonline_id">
                            <label for="nik">NIK <font color="red">*</font></label>
                            <input type="number" value="" id="nik" name="nik" class="form-control" placeholder="Masukan NIK Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama <font color="red">*</font></label>
                            <input type="text" value="<?= $this->fungsi->user_login()->name ?>" id="name" name="name" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="telp">Telp <font color="red">*</font></label>
                            <input type="number" value="" id="telp" name="telp" class="form-control" placeholder="Masukan Nomer Telephone" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Wahana <font color="red">*</font></label>
                                <select name="wahana" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($wahana->result() as $data) { ?>
                                        <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="reservationdate">Tanggal Reservasi <font color="red">*</font></label>
                                <input type="date" value="" id="reservationdate" name="reservationdate" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Jenis Tiket <font color="red">*</font></label>
                                <select name="ticket_type" id="" class="form-control">
                                    <option value=""> - Pilih - </option>
                                    <option value="1"> Perorangan </option>
                                    <option value="2"> Rombongan </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="<?= $page ?>" class="btn btn-primary float-right" style="align-content: auto;">
                                    <li class="fa fa-cart-plus"></li> Add
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="ticket_total">Jumlah Tiket <font color="red">*</font></label>
                                <input type="number" value="" class="form-control" id="ticket_total" name="ticket_total" placeholder="Masukan Jumlah Tiket" required>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                                <th>#</th>
                                <th>Wahana</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Total</label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Rp. " disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="0% " disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Grand Total</label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="0% " disabled>
                            </div>
                            <button type="submit" name="<?= $page ?>" class="btn  btn-outline-warning float-right" style="align-content: auto;">
                                <li class="fa fa-cart-send"></li> SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section><!-- /.content -->