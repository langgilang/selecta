<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Wahana</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Wahana</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <?php
                    // $this->view('marketing/messages') 
                    ?>
                    <div id="flash" data-flash="<?= $this->session->flashdata('success'); ?>"></div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Wahana Table
                            </h3>
                            <!-- <a href="<?= site_url('marketing/add_wahana') ?>" class="btn btn-sm btn-success float-right">
                                <li class="fa fa-plus"></li>
                                Add Wahana
                            </a> -->
                            <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addWahana">
                                <li class="fa fa-plus"></li> Add Wahana
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Nama Wahana</th>
                                        <th>Harga</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($tampilwahana as $row) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->code; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= 'Rp. ' . number_format($row->price, 0, ".", ","); ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#updateWahana<?= $row->wahana_id; ?>">
                                                    <li class="fa fa-edit"></li>
                                                </button>
                                                <a href="<?= site_url('marketing/del_wahana/' . $row->wahana_id); ?>" id="btn-delete" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>
<!-- modal tambah data -->
<form action="<?= site_url('marketing/proses_add') ?>" method="post">
    <div class="modal fade" id="addWahana" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Wahana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kode Wahana <font color="red">*</font></label>
                        <input type="hidden" id="wahana_id" name="wahana_id">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Wahana <font color="red">*</font></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga <font color="red">*</font></label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<!-- end modal tambah data -->

<!-- modal edit-->
<?php
foreach ($tampilwahana as $i) :
    $wahana_id = $i->wahana_id;
    $code = $i->code;
    $name = $i->name;
    $price = $i->price;
?>
    <form action="<?= site_url('marketing/proses_edit') ?>" method="post">
        <div class="modal fade" id="updateWahana<?= $wahana_id; ?>" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Wahana</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Wahana <font color="red">*</font></label>
                            <input type="hidden" value="<?= $wahana_id ?>" id="wahana_id" name="wahana_id">
                            <div class="col-sm-10">
                                <input type="text" value="<?= $code ?>" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Wahana <font color="red">*</font></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?= $name ?>" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga <font color="red">*</font></label>
                            <div class="col-sm-5">
                                <input type="number" value="<?= $price ?>" class="form-control" id="price" name="price" placeholder="Masukan harga wahana" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
<?php endforeach; ?>
<!-- end edit -->

<?php $this->load->view('templates/js') ?>

<script>
    var flash = $('#flash').data('flash');
    if (flash) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: flash
        })
    }
    $(document).on('click', '#btn-delete', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data Akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = link;
            }
        })
    });
</script>