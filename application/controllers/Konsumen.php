<?php

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_konsumen();
        $this->load->model(['konsumen_m', 'wahana_m']);
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
        $query = $this->konsumen_m->getall();
        $data = [
            'semuatiketonline' => $query->result(),
        ];
        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_tampil', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->konsumen_m->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
        } else if (isset($_POST['edit'])) {
            $this->konsumen_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
        }
        redirect('konsumen/tampil_konsumen');
    }

    public function add()
    {
        $wahana = $this->wahana_m->get();
        $data = array(
            'page' => 'add',
            'header' => 'Pesan Tiket Online',
            'wahana' => $wahana
        );
        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_add', $data);
    }

    public function edit($id = null)
    {
        $query = $this->konsumen_m->getall($id);
        if ($query->num_rows() > 0) {
            $data = array(
                'page' => 'edit',
                'header' => 'Edit Pesanan Tiket Online',
                'row' => $query->row(),
                'wahana' => $this->wahana_m->get()
            );
            $this->template->load('templates', 'konsumen/tiketonline/tiketonline_edit', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('konsumen/tiketonline_tampil') . "';</script>";
        }
    }

    public function del($id)
    {
        $item = $this->konsumen_m->getall($id);
        if ($item->image != null) {
            $target_file = './uploads/tiketonline_ktp/' . $item->image;
            unlink($target_file);
        }

        $this->konsumen_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('konsumen/tampil_konsumen');
    }
}
