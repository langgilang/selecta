<?php

class Wahana extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('wahana_m', 'wahana');
    }

    public function tampil_wahana_marketing()
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
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('wahana/tampil_wahana_marketing');
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
        $this->template->load('templates', 'marketing/datawahana/wahana_form', $data);
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
            $this->template->load('templates', 'marketing/datawahana/wahana_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('wahana/tampil_wahana_marketing') . "';</script>";
        }
    }

    public function del($id)
    {
        $this->wahana->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('wahana/tampil_wahana_marketing');
    }
}
