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
        $query = $this->wahana->get();
        // $data['wahana'] = $query->result();
        $data = array(
            'header' => 'Data Wahana',
            'wahana' => $query->result()
        );
        // print_r($data);
        $this->template->load('marketing/templates', 'marketing/datawahana/wahana_tampil', $data);
    }

    public function add()
    {
        $data = array(
            'header' => 'Tambah Data Wahana'
        );
        $this->template->load('marketing/templates', 'marketing/datawahana/wahana_tambah', $data);
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
        $query = $this->wahana->get($id);
        $data = array(
            'header' => 'Edit Data Wahana',
            'wahana' => $query->row()
        );

        $this->template->load('marketing/templates', 'marketing/datawahana/wahana_edit', $data);
    }

    public function del($id)
    {
        $this->wahana->del($id);
        redirect('wahana');
    }
}
