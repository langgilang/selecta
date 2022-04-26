<?php

class Wahana extends CI_Controller
{

    public function index()
    {
        $this->load->view('marketing/templates/header');
        $this->load->view('marketing/templates/sidebar');

        $this->load->model('wahana_m');
        $query = $this->wahana_m->get();
        $data['wahana'] = $query->result();
        // $data = array(
        //     'wahana' => $query->result()
        // );
        // print_r($data);
        $this->load->view('marketing/datawahana/index', $data);
        
        $this->load->view('marketing/templates/footer');
    }

    public function index2()
    {
        $this->load->view('marketing/datawahana/index2');
    }
}
