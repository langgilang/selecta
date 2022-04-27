<?php

class Marketing extends CI_Controller
{

    public function index()
    {
        $this->load->view('marketing/templates/sidebar');
        $this->load->view('marketing/templates/header');

        $data = array(
            'header' => 'Dashboard'
        );
        $this->load->view('marketing/dashboard/dashboard_tampil', $data);

        $this->load->view('marketing/templates/footer');
    }

}
