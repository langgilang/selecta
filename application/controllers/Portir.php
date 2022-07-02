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
        $query = $this->portir_m->total_pesanan_offline();
        $query2 = $this->portir_m->total_pesanan_online_checkin();
        $query3 = $this->portir_m->tiketoffline_checkout();
        $query4 = $this->portir_m->tiketonline_checkout();
        if ($query->num_rows == 0 || $query2->num_rows == 0 || $query3->num_rows == 0 || $query4->num_rows == 0) {
            $data = array(
                'header' => 'Dashboard',
                'total_tiketoffline' => $query->row(),
                'total_pesanan_online_checkin' => $query2->row(),
                'offline_checkout' => $query3->row(),
                'online_checkout' => $query4->row(),
            );
            $this->load->view('portir/dashboard/dashboard_tampil', $data);
        }
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
        $data = [
            'header' => 'Data Pesanan Online',
            'semuatiketonline' => $this->portir_m->gett_all_tiketonline()->result(),
        ];
        $this->load->view('portir/tiketonline/tiketonline_tampil', $data);
    }


    public function proses_add_perorangan()
    {
        $order_key = $this->portir_m->order_key();
        $name = $this->input->post('name', TRUE);
        $ticket_total = $this->input->post('ticket_total', TRUE);
        $paket_id = $this->input->post('paket_id', TRUE);

        if ($ticket_total < 30) {
            $data = array(
                'order_key' => $order_key,
                'name' => $name,
                'ticket_total' => $ticket_total,
                'ticket_type' => 1,
                'paket_id' => $paket_id,
            );
            // print_r($data);
            $this->portir_m->add_tiketoffline($data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tiket perorangan berhasil disimpan!');
            }
            redirect('portir/tampil_tiketoffline');
        } else {
            $data = array(
                'order_key' => $order_key,
                'name' => $name,
                'ticket_total' => $ticket_total,
                'ticket_type' => 2,
                'paket_id' => $paket_id,
            );
            // print_r($data);
            $this->portir_m->add_tiketoffline($data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tiket rombongan berhasil disimpan!');
            }
            redirect('portir/tampil_tiketoffline');
        }
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


    public function del($id)
    {
        $this->portir_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('portir/tampil_portir');
    }

    //tiket offline
    public function update_status_tiket($id)
    {
        $data = array(
            'status_tiket' => 2
        );
        $this->db->where('tiketoffline_id', $id);
        $this->db->update('tb_tiketoffline', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Tiket berhasil di Check-Out');
        }
        redirect('portir/tampil_tiketoffline');
    }

    // tiket online
    public function update_checkin($id)
    {
        $data = array(
            'status_tiket' => 2
        );
        $this->db->where('tiketonline_id', $id);
        $this->db->update('tb_tiketonline', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Tiket berhasil Check-In');
        }
        redirect('portir/tampil_tiketonline');
    }

    public function update_checkout($id)
    {
        $data = array(
            'status_tiket' => 3
        );
        $this->db->where('tiketonline_id', $id);
        $this->db->update('tb_tiketonline', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Tiket berhasil di Check-Out');
        }
        redirect('portir/tampil_tiketonline');
    }

    public function print($id)
    {
        $data = [
            'header' => 'Cetak Tiket',
            'row' => $this->portir_m->get_print($id)->row(),
        ];
        $html =  $this->load->view('portir/tiketoffline/tiketoffline_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['row']->order_key, 'A4', 'potrait');
    }
}
