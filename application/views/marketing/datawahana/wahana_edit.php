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
                            <li class="breadcrumb-item active"> Pesan Tiket</li>
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
                                Tambah Data Wahana
                            </h3>
                        </div>
                        <form action="<?= site_url('marketing/proses_edit') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Kode Wahana <font color="red">*</font></label>
                                        <input type="hidden" value="<?= $row->wahana_id ?>" id="wahana_id" name="wahana_id">
                                        <input type="text" value="<?= $row->code ?>" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Nama Wahana <font color="red">*</font></label>
                                        <input type="text" value="<?= $row->name ?>" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Harga <font color="red">*</font></label>
                                        <input type="number" value="<?= $row->price ?>" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                                    </div>
                                </div>
                                <!-- <div class="row">
                            <div class="form-group col-12">
                                <label>Gambar <font color="red">*</font></label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div> -->
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section><!-- /.content -->
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>

<?php $this->load->view('templates/js') ?>