<?php $this->load->view('templates/header') ?>

<div class="wrapper">

    <?php $this->load->view('templates/navbar') ?>

    <?php $this->load->view('templates/sidebar') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Paket Wahana</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Paket Wahana</li>
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
                            Paket Wahana
                        </h3>
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addPaket">
                            <li class="fa fa-plus"></li> Add Paket
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Paket</th>
                                    <th>Nama Paket</th>
                                    <th>Items</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;

                                foreach ($tampilpaket as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->code_paket; ?></td>
                                        <td><?= $row->paket_name; ?></td>
                                        <td><?= $row->wahana_item; ?> Items</td>
                                        <td>Rp. <?= number_format($row->wahana_price, 0, ",", ".") ?></td>
                                        <td>
                                            <?= $row->diskon ?>% <font class="text-danger">(Rp. <?= $diskon = ($row->diskon / 100) * $row->wahana_price; ?>)</font>
                                        </td>
                                        <td>Rp. <?= number_format($row->wahana_price - $diskon, 0, ",", ".") ?></td>
                                        <td>
                                            <?php
                                            if ($row->paket_status == 1) {
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
                                            if ($row->paket_status == 1) {
                                            ?>
                                                <a href="<?= site_url('marketing/editpaket_inactive/') . $row->paket_id ?>" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times-circle"></i>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= site_url('marketing/editpaket_active/') . $row->paket_id ?>" class="btn btn-sm btn-default">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>

                                            <a href="#" class="btn btn-sm btn-warning update-record" data-paket_id="<?= $row->paket_id; ?>" data-paket_name="<?= $row->paket_name; ?>" data-code="<?= $row->code_paket; ?>" data-diskon="<?= $row->diskon; ?>">
                                                <li class="fa fa-edit"></li>
                                            </a>
                                            <a href="<?= site_url('marketing/del_paket/') . $row->paket_id ?>" id="btn-delete" class="btn btn-sm btn-danger">
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
<form action="<?= site_url('marketing/proses_add_paket') ?>" method="post" id="addpaket">
    <div class="modal fade" id="addPaket" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Paket <font color="red">*</font></label>
                                <input type="hidden" id="add_paket_id" name="add_paket_id">
                                <input type="text" class="form-control" id="add_code" name="add_code" placeholder="Masukan Kode Paket">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Paket <font color="red">*</font></label>
                                <input type="char" class="form-control" id="add_name" name="add_name" placeholder="Masukan Nama Paket">
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Wahana <font color="red">*</font></label>
                            <select class="select2 select2bs4" id="add_wahana[]" name="add_wahana[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" required>
                                <?php foreach ($tampilwahana as $data) { ?>
                                    <option value="<?= $data->wahana_id; ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Diskon</label>
                            <input type="text" class="form-control" id="add_diskon" name="add_diskon" placeholder="%">
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

<!-- Modal Update Package-->
<form action="<?php echo site_url('marketing/proses_edit_paket'); ?>" method="post" id="editpaket">
    <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Paket </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Paket <font color="red">*</font></label>
                                <input type="hidden" id="paket_id" name="paket_id">
                                <input type="text" class="form-control" id="code" name="code" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Paket <font color="red">*</font></label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Wahana <font color="red">*</font></label>
                            <select class="select2 select2bs4 strings" id="wahana[]" name="wahana[]" multiple style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                <?php foreach ($tampilwahana as $data) { ?>
                                    <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Diskon </label>
                            <input type="text" class="form-control" id="diskon" name="diskon">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Update Package-->

<?php $this->load->view('templates/js') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        //SWEETALERT2
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

        //GET UPDATE 
        $('.update-record').on('click', function() {
            var paket_id = $(this).data('paket_id');
            var code = $(this).data('code');
            var name = $(this).data('paket_name');
            var diskon = $(this).data('diskon');
            $(".strings").val('');
            $('#UpdateModal').modal('show');
            $('[name="paket_id"]').val(paket_id);
            $('[name="code"]').val(code);
            $('[name="name"]').val(name);
            $('[name="diskon"]').val(diskon);

            //AJAX REQUEST TO GET SELECTED PRODUCT
            $.ajax({
                url: "<?php echo site_url('marketing/get_wahana_by_paket'); ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    paket_id: paket_id
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                    var item = data;
                    var val1 = item.toString().replace("[", "");
                    var val2 = val1.toString().replace("]", "");
                    var values = val2;
                    $.each(item, function(i, e) {
                        $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                        // $('.strings').select2('refresh');
                    });
                }
            });
            return false;
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

        $('#addpaket').validate({
            rules: {
                add_code: {
                    required: true,
                    charnumber: true,
                    minlength: 6,
                    maxlength: 6,
                },

                add_name: {
                    required: true,
                },

                add_diskon: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                add_code: {
                    required: "Kode harus diisi",
                    charnumber: "Kode hanya boleh huruf dan angka",
                    minlength: "Kode harus minimal 6 karakter",
                    maxlength: "Kode harus maximal 6 karakter",
                },

                add_name: {
                    required: "Nama harus diisi",
                },

                add_diskon: {
                    required: "Diskon harus diisi",
                    number: "Diskon hanya boleh angka",
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

        $('#editpaket').validate({
            rules: {
                name: {
                    required: true,
                },

                diskon: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                name: {
                    required: "Nama harus diisi",
                },

                diskon: {
                    required: "Diskon harus diisi",
                    number: "Diskon hanya boleh angka",
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
    });
</script>