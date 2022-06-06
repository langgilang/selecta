<?php
class Portir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_portir();
        $this->load->model('portir_m');
    }
    // DASHBOARD PORTIR
    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );
        $this->load->view('portir/dashboard/dashboard_tampil', $data);
    }

    //TAMPIL MENU DATA TIKET OFFLINE 
    public function tampil_tiketoffline()
    {
        check_not_login();
        check_portir();
        $query = $this->portir_m->get();
        $data = array(
            'header' => 'Data Tiket Offline',
            'row' => $query->result()
        );

        $this->load->view('portir/tiketoffline/tiketoffline_tampil', $data);
    }

    public function tampil_tiketonline()
    {
        $this->load->view('portir/tiketonline/tiketonline_tampil');
    }


    public function add()
    {
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data Wahana'
        );
        // print_r($data);
        $this->load->view('portir/tiketoffline/tiketoffline_add', $data);
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
        redirect('portir/tampil_tiketoffline');
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
            $this->load->view('portir/tiketoffline/tiketoffline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            redirect('portir/tampil_tiketoffline');
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
