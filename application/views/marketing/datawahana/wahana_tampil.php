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
                <?php
                // $this->view('marketing/messages') 
                ?>
                <div id="flash_success" data-flash_success="<?= $this->session->flashdata('success'); ?>"></div>
                <div id="flash_error" data-flash_error="<?= $this->session->flashdata('error'); ?>"></div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Wahana Table
                        </h3>
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addWahana">
                            <li class="fa fa-plus"></li> Add Wahana
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Code</th>
                                    <th>Nama Wahana</th>
                                    <th>Harga</th>
                                    <th>Status</th>
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
                                        <td align="center">
                                            <?php if ($row->image != null) { ?>
                                                <img src="<?= base_url('uploads/foto_wahana/' . $row->image); ?>" style="width: 150px; ">
                                            <?php } ?>
                                        </td>
                                        <td><?= $row->code; ?></td>
                                        <td><?= $row->name; ?></td>
                                        <td><?= 'Rp. ' . number_format($row->price, 0, ".", ","); ?></td>
                                        <td>
                                            <?php
                                            if ($row->status == 1) {
                                            ?>
                                                <label class="badge bg-success">Active</label>
                                            <?php
                                            } else {
                                            ?> <label class="badge bg-danger">Inactive</label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($row->status == 1) {
                                            ?>
                                                <a href="<?= site_url('marketing/editwahana_inactive/') . $row->wahana_id ?>" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times-circle"></i>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= site_url('marketing/editwahana_active/') . $row->wahana_id ?>" class="btn btn-sm btn-default">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
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
        </section><!-- /.content -->
        <br>
    </div>

    <?php $this->load->view('templates/footer') ?>

</div>
<!-- modal tambah data -->
<form action="<?= site_url('marketing/proses') ?>" method="post" enctype="multipart/form-data" id="addwahana">
    <div class="modal fade" id="addWahana" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Wahana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md 4">
                            <div class="form-group ">
                                <label>Kode <font color="red">* <small>Contoh (WHN001)</small></font></label>
                                <input type="hidden" id="wahana_id" name="wahana_id">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode wahana">
                            </div>
                        </div>
                        <div class="col-md 4">
                            <div class="form-group ">
                                <label>Nama <font color="red">*</font></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana">
                            </div>
                        </div>
                        <div class="col-md 4">
                            <div class="form-group">
                                <label>Harga<font color="red">*</font></label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Masukan harga wahana">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="tambahwahana" class="btn btn-primary">Submit</button>
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
    $image = $i->image;
?>
    <form action="<?= site_url('marketing/proses') ?>" method="post" enctype="multipart/form-data" id="editwahana">
        <div class="modal fade " id="updateWahana<?= $wahana_id; ?>" data-backdrop="static">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Wahana</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label>Kode <font color="red">*</font></label>
                                    <input type="hidden" value="<?= $wahana_id ?>" id="wahana_id" name="wahana_id">
                                    <input type="text" value="<?= $code ?>" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" readonly>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label>Nama <font color="red">*</font></label>
                                    <input type="text" value="<?= $name ?>" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana">
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label>Harga <font color="red">*</font></label>
                                    <input type="number" value="<?= $price ?>" class="form-control" id="price" name="price" placeholder="Masukan harga wahana">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Image <font color="red">*</font></label>
                            <div class="col-sm-10">
                                <?php if ($image != null) { ?>
                                    <small style="color: black; font-size: 16px;">Preview</small><br>
                                    <div style="margin-bottom: 10px;">
                                        <img src="<?= base_url('uploads/foto_wahana/' . $image); ?>" style="width: 500px;">
                                    </div>
                                    <small style="color: red;">(Biarkan kosong jika gambar ada)</small>
                                <?php
                                }
                                ?>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="editwahana" class="btn btn-primary">Submit</button>
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
    var flash_success = $('#flash_success').data('flash_success');
    if (flash_success) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: flash_success
        })
    }

    var flash_error = $('#flash_error').data('flash_error');
    if (flash_error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: flash_error
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

    //validasi
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Hanya boleh huruf");

    jQuery.validator.addMethod("numberonly", function(value, element) {
        return this.optional(element) || /^[0-9]$/.test(value);
    }, "Hanya boleh angka");

    $.validator.addMethod("charnumber", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    }, "Kode wahana hanya boleh huruf dan angka");

    $('#addwahana').validate({
        rules: {
            code: {
                required: true,
                charnumber: true,
                minlength: 6,
                maxlength: 6,
            },

            name: {
                required: true,
            },

            price: {
                required: true,
                number: true,
            },
        },
        messages: {
            code: {
                required: "Kode harus diisi",
                charnumber: "Kode hanya boleh huruf dan angka",
                minlength: "Kode harus minimal 6 karakter",
                maxlength: "Kode harus maximal 6 karakter",
            },

            name: {
                required: "Nama harus diisi",
            },

            price: {
                required: "Harga tidak boleh kosong",
                number: "Harga hanya boleh angka",
            },

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#editwahana').validate({
        rules: {
            name: {
                required: true,
            },

            price: {
                required: true,
                number: true,
            },
        },
        messages: {
            name: {
                required: "Nama harus diisi",
            },

            price: {
                required: "Harga tidak boleh kosong",
                number: "Harga hanya boleh angka",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    
</script>