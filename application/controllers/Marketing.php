<?php

class Marketing extends CI_Controller
{

    public function index()
    {
        $this->load->view('marketing/templates/sidebar');
        $this->load->view('marketing/templates/header');
        $this->load->view('marketing/dashboard/index');
        $this->load->view('marketing/templates/footer');
    }
}
