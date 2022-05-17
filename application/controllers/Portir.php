<?php
class Portir extends CI_Controller
{

    public function index()
    {
        check_not_login();
        check_admin();
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
        // $this->load->helper('url');
    }
}
