<?php
class Tiket extends CI_Controller
{
    public function tampil_marketing()
    {
        check_not_login();
        check_marketing();
        $data = array(
            'header' => 'Data Tiket'
        );

        $this->template->load('templates', 'marketing/datatiket/datatiket_tampil', $data);
    }
}
