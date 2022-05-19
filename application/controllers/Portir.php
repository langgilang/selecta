<?php
class Portir extends CI_Controller
{
    public function dashboard()
    {
        check_not_login();
        check_portir();
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
        // $this->load->helper('url');
    }

    public function tampil_marketing()
    {
        check_not_login();
        check_marketing();
        $data = array(
            'header' => 'Data Portir'
        );

        $this->template->load('templates', 'marketing/dataportir/dataportir_tampil', $data);
    }
    // guemoyyy elek kecotttttt
}
