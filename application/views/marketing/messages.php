<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><i class="icon fas fa-check"></i><?= $this->session->flashdata('success'); ?>.</p>
    </div>
<?php } ?>