<?php
class Tiketoffline_p extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tiketoffline_p', 'tiketoffline');
    }

    public function index()
    {
        $this->load->view('portir/templates/header');
        $this->load->view('portir/templates/sidebar');

        $query = $this->tiketoffline->get();

        $data = array(
            'header' => 'Tiket Offline',
            'Tiketoffline_p' => $query->result()
        );
        // print_r($data);
        $this->load->view('portir/tiketoffline/tiketoffline_tampil', $data);
        $this->load->view('portir/templates/footer');

    }
}
