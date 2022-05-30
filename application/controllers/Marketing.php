<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Marketing extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_marketing();
        $this->load->model('marketing_m');
    }


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
            'tampilwahana' => $this->marketing_m->get_wahana(),
        );
        $this->template->load('templates', 'marketing/datawahana/wahana_tampil', $data);
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

    // KE HALAMAN TAMBAH WAHANA
    public function add_wahana()
    {
        $data = array(
            'page' => 'add_wahana',
            'header' => 'Tambah Data Wahana',
        );
        $this->template->load('templates', 'marketing/datawahana/wahana_add', $data);
    }

    // PROSES SIMPAN / EDIT WAHANA
    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add_wahana'])) {
            $this->marketing_m->add_wahana($post);
            // redirect('marketing/tampil_wahana');
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('marketing/tampil_wahana');
    }
}
