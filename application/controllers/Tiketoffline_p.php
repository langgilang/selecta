<?php
class Tiketoffline_p extends CI_Controller
{
    public function index()
    {
        check_not_login();
        check_portir();
        $data = array(
            'header' => 'Tiket Offline',
        );
        // print_r($data);
        $this->template->load('templates', 'portir/tiketoffline/tiketoffline_tampil', $data);
    }
}
