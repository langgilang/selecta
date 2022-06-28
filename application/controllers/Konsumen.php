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

    public function tampil_konsumen($id = null)
    {
        if ($id != null) {
            $tampilwahanaselect = $this->konsumen_m->get_paket($id)->result();
            $data = [
                'header' => 'Pesan Tiket Online',
                'semuatiketonline' => $this->konsumen_m->getall()->result(),
                'transaksi' => $this->konsumen_m->get_transaksi()->result(),
                'order_key' => $this->konsumen_m->order_key(),
                'tampilpaket' => $this->konsumen_m->get_paket()->result(),
                'tampilwahana' => $this->konsumen_m->get_wahana()->result(),
                'tampilselectwahana' => $tampilwahanaselect,
                'editperorangan' => $this->konsumen_m->getall()->result(),
                'editrombongan' => $this->konsumen_m->getall()->result(),
            ];
            $this->load->view('konsumen/tiketonline/tiketonline_tampil', $data);
        }

        $data = [
            'header' => 'Pesan Tiket Online',
            'semuatiketonline' => $this->konsumen_m->getall()->result(),
            'transaksi' => $this->konsumen_m->get_transaksi()->result(),
            'order_key' => $this->konsumen_m->order_key(),
            'tampilpaket' => $this->konsumen_m->get_paket()->result(),
            'tampilwahana' => $this->konsumen_m->get_wahana()->result(),
            'editperorangan' => $this->konsumen_m->getall()->result(),
            'editrombongan' => $this->konsumen_m->getall()->result(),
        ];

        // var_dump($data);
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

    public function proses_add_rombongan()
    {
        $order_key = $this->konsumen_m->order_key();
        $nik = $this->input->post('nik', TRUE);
        $name = $this->input->post('name', TRUE);
        $telp = $this->input->post('telp', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $reservationdate = $this->input->post('reservationdate', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        $data = array(
            'order_key' => $order_key,
            'reservationdate' => $reservationdate,
            'nik' => $nik,
            'name' => $name,
            'telp' => $telp,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
        );
        // print_r($data);
        // die();
        $this->konsumen_m->add_rombongan($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pesanan Tiket Online Rombongan berhasil disimpan!');
        }
        redirect('konsumen/tampil_konsumen');
    }

    public function proses_add_perorangan()
    {
        $order_key = $this->konsumen_m->order_key();
        $nik = $this->input->post('nik', TRUE);
        $name = $this->input->post('name', TRUE);
        $telp = $this->input->post('telp', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $reservationdate = $this->input->post('reservationdate', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        $data = array(
            'order_key' => $order_key,
            'reservationdate' => $reservationdate,
            'nik' => $nik,
            'name' => $name,
            'telp' => $telp,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
        );
        // print_r($data);
        // die();
        $this->konsumen_m->add_perorangan($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pesanan Tiket Online Perorangtan berhasil disimpan!');
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
                'get_wahana_by_invoice' => $this->konsumen_m->get_wahana_by_invoice($id)->result(),
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
