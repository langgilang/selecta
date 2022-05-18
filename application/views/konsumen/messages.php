<?php if ($this->session->has_userdata('success')) { ?>
    <div class="callout callout-success">
        <p><?= $this->session->flashdata('success'); ?></p>
    </div>
<?php } ?>