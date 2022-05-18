<?php

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_konsumen();
        $this->load->model('konsumen_m', 'konsumen');
        $this->load->model('wahana_m', 'wahana');
    }

    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'konsumen/dashboard/dashboard_tampil', $data);
    }

    public function tampil_konsumen()
    {
        $query = $this->konsumen->get();
        $data = array(
            'header' => 'Data Pesanan',
            'tiketonline' => $query->result()
        );
        // print_r($data);
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
        redirect('konsumen/tiketonline/tiketonline_tampil');
    }

    public function add()
    {
        $kosumen = new stdClass();
        $kosumen->tiketonline_id = null;
        $kosumen->barcode = null;
        $kosumen->nik = null;
        $kosumen->name = null;
        $kosumen->telp = null;

        $wahana = $this->wahana->get();

        $kosumen->ticket_total = null;
        $kosumen->ticket_type = null;
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data kosumen',
            'row' => $kosumen,
            'wahana' => $wahana
        );
        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_form', $data);
    }

    public function edit($id = null)
    {
        $query = $this->kosumen->get($id);
        if ($query->num_rows() > 0) {
            $kosumen = $query->row();
            $data = array(
                'page' => 'edit',
                'header' => 'Tambah Data kosumen',
                'row' => $kosumen
            );
            $this->template->load('templates', 'konsumen/tiketonline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('konsumen/tiketonline_tampil') . "';</script>";
        }
    }

    public function del($id)
    {
        $this->kosumen->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('konsumen/tiketonline/tiketonline_tampil');
    }
}
