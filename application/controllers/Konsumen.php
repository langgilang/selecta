<?php

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('konsumen_m', 'konsumen');
    }

    public function dashboard()
    {
        check_not_login();
        check_konsumen();
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'konsumen/dashboard/dashboard_tampil', $data);
    }

    public function tampil_konsumen()
    {
        $data = array(
            'header' => 'Pesanan Online'
        );

        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_tampil', $data);
    }

    public function proses()
    {
        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->konsumen->add($inputan);
        } else if (isset($_POST['edit'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->konsumen->edit($inputan);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('konsumen/tiketonline_tampil');
    }

    public function add()
    {
        $wahana = new stdClass();
        $wahana->wahana_id = null;
        $wahana->name = null;
        $wahana->price = null;
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data Wahana',
            'row' => $wahana
        );
        $this->template->load('templates', 'konsumen/tiketonline_form', $data);
    }

    public function edit($id = null)
    {
        $query = $this->wahana->get($id);
        if ($query->num_rows() > 0) {
            $wahana = $query->row();
            $data = array(
                'page' => 'edit',
                'header' => 'Tambah Data Wahana',
                'row' => $wahana
            );
            $this->template->load('templates', 'konsumen/tiketonline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('konsumen/tiketonline_tampil') . "';</script>";
        }
    }

    public function del($id)
    {
        $this->wahana->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('konsumen/tiketonline_tampil');
    }
}
