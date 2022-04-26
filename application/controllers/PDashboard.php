<?php
class PDashboard extends CI_Controller
{

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('portir/dashboard/index');

        $this->load->view('templates/footer');
        $this->load->helper('url');
    }

    public function linktiketoffline()
    {
        $this->load->view('templates/header');
        $this->load->view('portir/tiketoffline/index');
        $this->load->view('templates/footer');
        $this->load->helper('url');
    }

    public function linkdashboard()
    {
        $this->load->view('templates/header');
        $this->load->view('portir/dashboard/index');
        $this->load->view('templates/footer');
        $this->load->helper('url');
    }
}
