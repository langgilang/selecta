<?php
class Portir extends CI_Controller
{

    public function index()
    {
        $this->load->view('portir/templates/header');
        $this->load->view('portir/templates/sidebar');

        $data = array(
            'header' => 'Dashboard'
        );

        $this->load->view('portir/dashboard/index_tampil', $data);
        $this->load->view('portir/templates/footer');
        // $this->load->helper('url');

    }
}
