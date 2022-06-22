<?php

class Paralax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('paralax_m');
    }

    public function index()
    {
        $data = array(
            'header' => 'Selecta.com',
            'getpaket' => $this->paralax_m->get_paket()->result(),
            'getwahana' => $this->paralax_m->get_wahana()->result(),
        );
        $this->load->view('paralax/index', $data);
    }

    public function setting()
    {

        $this->load->view('');
    }
}
