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
        $this->load->view('konsumen/dashboard/dashboard_tampil', $data);
    }

    public function tampil_konsumen()
    {
        $query = $this->konsumen_m->getall();
        $data = [
            'header' => 'Pesan Tiket Online',
            'semuatiketonline' => $query->result(),
        ];
        $this->load->view('konsumen/tiketonline/tiketonline_tampil', $data);
    }

    public function add()
    {
        $data = array(
            'header' => 'Tambah Data Paket',
            'tampilpaket' => $this->konsumen_m->get_paket()->result(),
            'order_key' => $this->konsumen_m->order_key()
        );
        $this->load->view('konsumen/tiketonline/tiketonline_add', $data);
    }

    public function edit($id)
    {
        echo "halaman edit";
        // $this->load->view('konsumen/tiketonline/tiketonline_edit');
    }

    public function proses()
    {
        $reservationdate = $this->input->post('reservationdate', TRUE);
        $nik = $this->input->post('nik', TRUE);
        $name = $this->input->post('name', TRUE);
        $telp = $this->input->post('telp', TRUE);
        $ticket_type = $this->input->post('ticket_type', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        $data = array(
            'reservationdate' => $reservationdate,
            'nik' => $nik,
            'name' => $name,
            'telp' => $telp,
            'ticket_type' => $ticket_type,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
        );
        $this->konsumen_m->add_pesanan_tiketonline($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pesanan Online berhasil disimpan');
        }
        redirect('konsumen/tampil_konsumen');
    }

    public function invoice($id)
    {
        $query = $this->konsumen_m->get_invoice($id);
        if ($query->num_rows() > 0) {
            $data = array(
                'header' => 'Detail Pesanan Online',
                'row' => $query->row(),
                'getwahana' => $this->konsumen_m->get_invoice($id)->result(),
            );
            $this->load->view('konsumen/tiketonline/tiketonline_detail', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('konsumen/tampil_konsumen') . "';</script>";
        }
    }

    public function del($id)
    {
        $this->konsumen_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pesanan berhasil dihapus');
        }
        redirect('konsumen/tampil_konsumen');
    }
}
