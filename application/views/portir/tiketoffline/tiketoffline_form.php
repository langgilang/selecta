<section class="content-header">
    <h1>
        Tiket Offline
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tiket Offline</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-md-12 connectedSortable">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <!-- $page inisial edit tambah form jadi satu -->
                    <h3 class="box-title"><?= ucfirst($page) ?> Tiket Offline</h3>
                    <div class="pull-right">
                        <a href="<?= site_url('portir/tampil_portir'); ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('portir/proses'); ?>" enctype="multipart/form-data" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama Customer <label color="red">*</label></label>
                            <input type="hidden" name="tiketoffline_id" value="<?= $row->tiketoffline_id ?>">
                            <input type="text" value="<?= $row->name ?>" class="form-control" name="name" placeholder="Masukkan Nama">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Tiket</label>
                            <input type="number" value="<?= $row->ticket_total ?>" class="form-control" name="ticket_total" id="exampleInputEmail1" placeholder="Masukkan Jumlah Tiket">
                        </div>
                        <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Jenis Tiket</label>
                            <select class="form-control select2" style="width: 100%;">

                                <option>Perorangan</option>
                                <option>Rombongan</option>
                            </select>
                        </div>

                        <label>Wahana</label>
                        <div class="form-group">
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Sepeda Air</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Kiddie Ride</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Perahu Ayun</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Sepeda Udara</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Cinema 4 Dimensi</label>
                            </div>
                            <div class="row"></div>
                        </div><!-- /.box-body -->
                        <div class="form-group">
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Family Coaster</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Mobil Ayun</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Tagada</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" value="">Bianglala</label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="<?= $page ?>" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div><!-- /.box -->
        </section><!-- right col -->
    </div><!-- /.row (main row) -->

</section><!-- /.content -->