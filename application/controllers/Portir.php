<?php
class Portir extends CI_Controller
{
    public function index()
    {
<<<<<<< HEAD
        $this->template->load('portir/templates', 'portir/tiketoffline/tiketoffline_tampil');
=======
        check_not_login();
        check_admin();
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
>>>>>>> 8702d5d5ac6ca021bafc5dbe6af1347fe6409f04
        // $this->load->helper('url');
    }
}
