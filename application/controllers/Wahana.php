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
        check_not_login();
        check_marketing();
        $query = $this->wahana->get();
        // $data['wahana'] = $query->result();
        $data = array(
            'header' => 'Data Wahana',
            'wahana' => $query->result()
        );
        // print_r($data);
        $this->template->load('templates', 'marketing/datawahana/wahana_tampil', $data);
    }

    public function add()
    {
        $data = array(
            'header' => 'Tambah Data Wahana'
        );
        $this->template->load('templates', 'marketing/datawahana/wahana_tambah', $data);
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

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data Berhasil disimpan');</script>";
        }
        echo "<script>window.location='" . site_url('wahana') . "'</script>";
    }

    public function edit($id = null)
    {
        $query = $this->wahana->get($id);
        $data = array(
            'header' => 'Edit Data Wahana',
            'wahana' => $query->row()
        );

        $this->template->load('templates', 'marketing/datawahana/wahana_edit', $data);
    }

    public function del($id)
    {
        $this->wahana->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data Berhasil dihapus');</script>";
        }
        echo "<script>window.location='" . site_url('wahana') . "'</script>";
    }
}
