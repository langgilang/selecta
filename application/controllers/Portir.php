<?php
class Portir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('portir_m');
    }

    public function dashboard()
    {
        check_not_login();
        check_portir();
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'portir/dashboard/dashboard_tampil', $data);
        // $this->load->helper('url');
    }

    public function tampil_marketing()
    {
        check_not_login();
        check_marketing();
        $data = array(
            'header' => 'Data Portir'
        );

        $this->template->load('templates', 'marketing/dataportir/dataportir_tampil', $data);
    }

    public function tampil_portir()
    {
        check_not_login();
        check_portir();
        $query = $this->portir_m->get();
        $data = array(
            'header' => 'Data Tiket Offline',
            'row' => $query->result()
        );

        $this->template->load('templates', 'portir/tiketoffline/tiketoffline_add', $data);
    }
    // guemoyyy elek kecotttttt

    public function add()
    {
        $portir = new stdClass();
        $portir->tiketoffline_id = null;
        $portir->barcode = null;
        $portir->name_portir = null;
        $portir->name = null;
        $portir->ticket_total = null;
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data Wahana',
            'row' => $portir
        );
        // print_r($data);
        $this->template->load('templates', 'portir/tiketoffline/tiketoffline_form', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->portir_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->portir_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('portir/tampil_portir');
    }

    public function edit($id = null)
    {
        $query = $this->portir_m->get($id);
        if ($query->num_rows() > 0) {
            $portir = $query->row();
            $data = array(
                'page' => 'edit',
                'header' => 'Edit Data Tiket Offline',
                'row' => $portir
            );
            $this->template->load('templates', 'portir/tiketoffline/tiketoffline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            redirect('portir/tampil_portir');
        }
    }
    public function del($id)
    {
        $this->portir_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('portir/tampil_portir');
    }
}
