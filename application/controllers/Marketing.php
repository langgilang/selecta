<?php

class Marketing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_marketing();
        $this->load->model('marketing_m');
    }

    // DASHBOARD MARKETING
    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'marketing/dashboard/dashboard_tampil', $data);
    }

    // TAMPIL MENU DATA PESANAN
    public function tampil_pesananonline()
    {
        $data['pesananonline'] = $this->marketing_m->get_pesananonline();
        $this->template->load('templates', 'marketing/datapesanan/pesanan_tampil', $data);
    }

    // TAMPIL DATA WAHANA
    public function tampil_wahana()
    {
        $data = array(
            'header' => 'Data Wahana',
            'tampilwahana' => $this->marketing_m->get_wahana()->result(),
        );
        $this->template->load('templates', 'marketing/datawahana/wahana_tampil', $data);
    }

    // TAMPIL DATA PAKET WAHANA
    public function tampil_paket()
    {
        $data = array(
            'header' => 'Data Paket',
            'tampilpaket' => $this->marketing_m->get_paket()->result(),
            'tampilwahana' => $this->marketing_m->get_wahana()->result(),
        );
        $this->template->load('templates', 'marketing/datapaket/paket_tampil', $data);
    }

    // DELETE WAHANA
    public function del_wahana($id)
    {
        $this->marketing_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!!!');
        }
        redirect('marketing/tampil_wahana');
    }

    // DELETE WAHANA
    public function del_paket($id)
    {
        $this->marketing_m->del_paket($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data paket berhasil dihapus');
        }
        redirect('marketing/tampil_paket');
    }

    // KE HALAMAN TAMBAH WAHANA
    public function add_wahana()
    {
        $data = array(
            'header' => 'Tambah Data Wahana',
        );
        $this->template->load('templates', 'marketing/datawahana/wahana_add', $data);
    }

    // KE HALAMAN ADD PAKET
    public function add_paket()
    {
        $data = array(
            'header' => 'Tambah Data Paket',
            'tampilwahana' => $this->marketing_m->get_wahana()->result(),
        );
        $this->template->load('templates', 'marketing/datapaket/paket_add', $data);
    }

    public function edit_paket()
    {
        $package_id = $this->input->post('package_id');
        $data = $this->package_model->get_product_by_package($package_id)->result();
        foreach ($data as $result) {
            $value[] = (float) $result->product_id;
        }
        $this->template->load('templates', 'marketing/datapaket/paket_edit', $value);
    }

    // KE HALAMAN TAMBAH PAKET
    public function proses_add_paket()
    {
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $price = $this->input->post('price', TRUE);
        $wahana = $this->input->post('wahana', TRUE);

        $paket = array(
            'code' => $code,
            'name' => $name,
            'price' => $price,
        );
        $this->marketing_m->add_paket($paket, $wahana);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Tambah data paket berhasil disimpan');
        }
        redirect('marketing/tampil_paket');
    }

    // KE HALAMAN EDIT WAHANA
    public function edit_wahana($id)
    {
        $query = $this->marketing_m->get_wahana($id);
        if ($query->num_rows() > 0) {
            $data = array(
                'header' => 'Edit Data Wahana',
                'row' => $query->row(),
            );
            $this->template->load('templates', 'marketing/datawahana/wahana_edit', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('marketing/edit_wahana') . "';</script>";
        }
    }

    // PROSES SIMPAN
    public function proses_add()
    {
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $price = $this->input->post('price', TRUE);

        $data = array(
            'code' => $code,
            'name' => $name,
            'price' => $price,
        );

        $this->marketing_m->add_wahana($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('marketing/tampil_wahana');
    }

    // PROSES EDIT WAHANA
    public function proses_edit()
    {
        $wahana_id = $this->input->post('wahana_id', TRUE);
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $price = $this->input->post('price', TRUE);

        $data = array(
            'code' => $code,
            'name' => $name,
            'price' => $price,
        );
        $where['wahana_id'] = $wahana_id;

        $this->marketing_m->edit_wahana($data, $where);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('marketing/tampil_wahana');
    }
}
