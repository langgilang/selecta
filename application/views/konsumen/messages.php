<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert callout callout-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4> <i class="icon fa fa-check"></i> Success!</h4>
        <p><?= $this->session->flashdata('success'); ?></p>
    </div>
<?php } ?>

<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert callout callout-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4> <i class="icon fa fa-ban"></i> Error!</h4>
        <p><?= $this->session->flashdata('error'); ?></p>
    </div>
<?php } ?>