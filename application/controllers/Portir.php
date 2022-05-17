<?php
class Portir extends CI_Controller
{
    public function index()
    {
        check_not_login();
        check_portir();
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
    }
    // guemoyyy elek kecotttttt
}
