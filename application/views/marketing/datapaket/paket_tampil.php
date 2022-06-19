<?php $this->load->view('templates/header') ?>
<?php echo $header; ?>
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
                <div class="col-md-12">
                    <?php $this->view('marketing/messages') ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Paket Wahana
                            </h3>
                            <!-- <a href="<?= site_url('marketing/add_paket') ?>" class="btn btn-sm btn-success float-right">
                                <li class="fa fa-plus"></li>
                                Tambah Paket
                            </a> -->
                            <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-lg">
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
                                            <td><?= $row->diskon ?>% <font color="red">(Rp. <?= $diskon = ($row->diskon / 100) * $row->wahana_price; ?>)</font>
                                            </td>
                                            <td>Rp. <?= number_format($row->wahana_price - $diskon, 0, ",", ".") ?></td>
                                            <td class="text-center">
                                                <!-- <a href="<?= site_url('marketing/edit_paket/') . $row->paket_id ?>" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i> Update
                                                </a> -->
                                                <a href="#" class="btn btn-sm btn-warning update-record" data-paket_id="<?= $row->paket_id; ?>" data-paket_name="<?= $row->paket_name; ?>" data-code="<?= $row->code_paket; ?>">
                                                    <li class="fa fa-edit"></li>
                                                </a>
                                                <a href="<?= site_url('marketing/del_paket/') . $row->paket_id ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-default">
                                                    <i class="fa fa-eye"></i>
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

    <!-- modal tambah data -->
    <form action="<?= site_url('marketing/proses_add_paket') ?>" method="post">
        <div class="modal fade" id="modal-lg" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Paket</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Paket <font color="red">*</font></label>
                            <input type="hidden" id="add_paket_id" name="add_paket_id">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="add_code" name="add_code" placeholder="Masukan kode wahana" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Paket <font color="red">*</font></label>
                            <div class="col-sm-10">
                                <input type="char" class="form-control" id="add_name" name="add_name" placeholder="Masukan Nama Wahana" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Wahana <font color="red">*</font></label>
                            <div class="col-sm-10">
                                <select class="select2 select2bs4" id="add_wahana[]" name="add_wahana[]" multiple style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                    <?php foreach ($tampilwahana as $data) { ?>
                                        <option value="<?= $data->wahana_id; ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Diskon <font color="red">(%)</font></label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="add_diskon" name="add_diskon" placeholder="%" required>
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
    <form action="<?php echo site_url('package/update'); ?>" method="post">
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
                            <div class="form-group col-6">
                                <label>Kode Paket <font color="red">*</font></label>
                                <input type="hidden" id="paket_id" name="paket_id">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode wahana" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label>Nama Paket <font color="red">*</font></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wahana" required>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-6">
                                <label>Wahana <font color="red">*</font></label>
                                <select class="select2 select2bs4 strings" id="wahana[]" name="wahana[]" multiple data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                    <?php foreach ($tampilwahana as $data) { ?>
                                        <option value="<?= $data->wahana_id ?>"><?= $data->name ?> - <?= $data->price ?> </option>
                                    <?php } ?>
                                </select>
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

    <?php $this->load->view('templates/footer') ?>

</div>

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        //GET UPDATE 
        $('.update-record').on('click', function() {
            var paket_id = $(this).data('paket_id');
            var code = $(this).data('code');
            var name = $(this).data('paket_name');
            $(".strings").val('');
            $('#UpdateModal').modal('show');
            $('[name="paket_id"]').val(paket_id);
            $('[name="code"]').val(code);
            $('[name="name"]').val(name);

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
                    $.each(values.split(","), function(i, e) {
                        $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                        // $('.strings').select2('refresh');
                    });
                }
            });
            return false;
        });
    });
</script>

<?php $this->load->view('templates/js') ?>