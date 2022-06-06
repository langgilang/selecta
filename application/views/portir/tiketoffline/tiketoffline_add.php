<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Tiket Masuk
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="name_portir">Portir Id <font color="red">*</font></label>
                                    <input type="text" id="name_portir" name="name_portir" class="form-control" placeholder="Masukan Nama Portir" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name_portir">Nama Portir <font color="red">*</font></label>
                                    <input type="text" id="name_portir" name="name_portir" class="form-control" placeholder="Masukan Nama Portir" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name_portir">Nama Customer <font color="red">*</font></label>
                                    <input type="text" id="name_portir" name="name_portir" class="form-control" placeholder="Masukan Nama Portir" required>
                                </div>
                                <div class="form-group col-3">
                                    <label for="telp">Jumlah Tiket<font color="red">*</font></label>
                                    <input type="number" id="ticket_total" name="ticket_total" class="form-control" placeholder="Masukan Jumlah Tiket" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Wahana <font color="red">*</font></label>
                                    <select name="wahana" class="form-control" required>
                                        <option value="">- Pilih -</option>

                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>Jenis Tiket <font color="red">*</font></label>
                                    <select name="ticket_type" id="" class="form-control">
                                        <option value=""> - Pilih - </option>
                                        <option value="1"> Perorangan </option>
                                        <option value="2"> Rombongan </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>