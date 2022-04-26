<?php
class Portir extends CI_Controller
{

    public function index()
    {
        $this->load->view('portir/templates/header');
        $this->load->view('portir/templates/sidebar');
        $this->load->view('portir/dashboard/index');
        $this->load->view('portir/templates/footer');
        $this->load->helper('url');
    }

    public function linktiketoffline()
    {
        $this->load->view('portir/templates/header');
        $this->load->view('portir/templates/sidebar');
        $this->load->view('portir/tiketoffline/index');
        $this->load->view('potir/templates/footer');
        $this->load->helper('url');
    }

    public function linkdashboard()
    {
        $this->load->view('portir/templates/header');
        $this->load->view('portir/templates/sidebar');
        $this->load->view('portir/dashboard/index');
        $this->load->view('portir/templates/footer');
        $this->load->helper('url');
    }
}
