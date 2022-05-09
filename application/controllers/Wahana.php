<?php

class Wahana extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('wahana_m', 'wahana');
    }

    public function index()
    {
        $this->load->view('marketing/templates/header');
        $this->load->view('marketing/templates/sidebar');

        $query = $this->wahana->get();
        // $data['wahana'] = $query->result();
        $data = array(
            'header' => 'Data Wahana',
            'wahana' => $query->result()
        );
        // print_r($data);
        $this->load->view('marketing/datawahana/wahana_tampil', $data);
        
        $this->load->view('marketing/templates/footer');
    }

    public function add()
    {
        $this->load->view('marketing/templates/header');
        $this->load->view('marketing/templates/sidebar');

        $data = array(
            'header' => 'Tambah Data Wahana'
        );
        $this->load->view('marketing/datawahana/wahana_tambah', $data);

        $this->load->view('marketing/templates/footer');
    }

    public function proses()
    {
        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->wahana->add($inputan);
        } else if (isset($_POST['edit'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->wahana->edit($inputan);
        }
        redirect('wahana');
    }

    public function edit($id = null)
    {
        $this->load->view('marketing/templates/header');
        $this->load->view('marketing/templates/sidebar');

        $query= $this->wahana->get($id);
        $data = array(
            'header' => 'Edit Data Wahana',
            'wahana' => $query->row()
        );
        $this->load->view('marketing/datawahana/wahana_edit', $data);
        
        $this->load->view('marketing/templates/footer');
    }

    public function del($id)
    {
        $this->wahana->del($id);
        redirect('wahana');
    }
}
