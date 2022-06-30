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

        $data = [
            'header' => 'Pesanan tiket Offline',
            'semuatiketoffline' => $this->portir_m->get()->result(),
            'order_key' => $this->portir_m->order_key(),
            'tampilpaket' => $this->portir_m->get_paket()->result(),
            // 'tampilwahana' => $this->portir_m-- > get_wahana()->result()

        ];
        // $data['semuatiketoffline'] = $this->portir_m->get()->result();
        $this->load->view('portir/tiketoffline/tiketoffline_tampil', $data);
    }

    public function tampil_paket()
    {
        $data = array(
            'header' => 'Data Paket',
            'tampilpaket' => $this->marketing_m->get_paket()->result(),
            'tampilwahana' => $this->marketing_m->get_wahana(),
        );
        $this->load->view('portir/tiketoffline/tiketoffline_tampil', $data);
    }

    public function tampil_tiketonline()
    {
        $this->load->view('portir/tiketonline/tiketonline_tampil');
    }


    public function proses_add_perorangan()
    {
        $order_key = $this->portir_m->order_key();
        $name = $this->input->post('name', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        $data = array(
            'order_key' => $order_key,
            'name' => $name,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
        );
        // print_r($data);
        $this->portir_m->add_perorangan($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pesanan Tiket Offline Rombongan berhasil disimpan!');
        }
        redirect('portir/tampiltiketoffline');
    }

    public function proses_add_rombongan()
    {
        $order_key = $this->portir_m->order_key();
        $nik = $this->input->post('nik', TRUE);
        $name = $this->input->post('name', TRUE);
        $telp = $this->input->post('telp', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        $data = array(
            'order_key' => $order_key,
            'nik' => $nik,
            'name' => $name,
            'telp' => $telp,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
        );

        $this->portir_m->add_rombongan($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pesanan Tiket Offline Rombongan berhasil disimpan!');
        }
        redirect('portir/tampil_tiketoffline');
    }


    public function proses()
    {
        $tiketoffline_id = $this->input->post('tiketoffline_id', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);
        $ticket_type = $this->input->post('ticket_type', TRUE);

        $data = array(
            'tiketoffline_id' => $tiketoffline_id,
            'user_id' => $user_id,
            'name' => $name,
            'ticket_total' => $ticket_total,
            'paket_id' => $paket_id,
            'ticket_type' => $ticket_type
        );
        $this->portir_m->add($data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pesanan Offline berhasil disimpan');
        }
        redirect('portir/tampil_tiketoffline');
    }

    // public function proses_edit()
    // {
    //     $tiketoffline_id = $this->input->post('tiketoffline_id', TRUE);
    //     $user_id = $this->input->post('user_id', TRUE);
    //     $name = $this->input->post('name', TRUE);
    //     $ticket_total = $this->input->post('ticket_total', TRUE);
    //     $paket_id = $this->input->post('paket_id', TRUE);
    //     $ticket_type = $this->input->post('ticket_type', TRUE);

    //     $data = array(
    //         'tiketoffline_id' => $tiketoffline_id,
    //         'user_id' => $user_id,
    //         'name' => $name,
    //         'ticket_total' => $ticket_total,
    //         'paket_id' => $paket_id,
    //         'ticket_type' => $ticket_type
    //     );
    //     $where['tiketoffline_id'] = $tiketoffline_id;

    //     $this->portir_m->add($data);
    //     if ($this->db->affected_rows() > 0) {
    //         $this->session->set_flashdata('success', 'Data pesanan Offline berhasil disimpan');
    //     }
    //     redirect('portir/tampil_tiketoffline');
    // }


    // public function edit($id)
    // {
    //     $query = $this->portir_m->get($id);
    //     if ($query->num_rows() > 0) {
    //         $data = array(
    //             'header' => 'Edit Data Tiket Offline',
    //             'row' => $query->row(),
    //             'tampilpaket' => $this->portir_m->get_paket()->result(),
    //             'tampilselect' => $this->portir_m->get_selectpaket($id)->result(),

    //         );
    //         $this->load->view('portir/tiketoffline/tiketoffline_edit', $data);
    //     } else {
    //         echo "<script>alert('Data tidak ditemukan');";
    //         echo "window.location='" . site_url('portir/edit/') . "';</script>";
    //     }
    // }

    public function del($id)
    {
        $this->portir_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('portir/tampil_portir');
    }
}
