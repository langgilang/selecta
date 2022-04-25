<?php

class MDashboard extends CI_Controller
{

    public function index()
    {
        // $this->load->view('templates/navbar');
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('marketing/dashboard/index');
        $this->load->view('templates/footer');
    }
}
