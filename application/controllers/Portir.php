<?php
class Portir extends CI_Controller
{
<<<<<<< HEAD
    public function dashboard()
    {
=======
    public function index()
    { 
>>>>>>> 7ba4e12e21e3692b1ef83d1a74b58e4ea075fd79
        check_not_login();
        check_portir();
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
        // $this->load->helper('url');
    }
<<<<<<< HEAD

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
=======
    
>>>>>>> 7ba4e12e21e3692b1ef83d1a74b58e4ea075fd79
}
