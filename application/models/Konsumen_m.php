<?php

class Konsumen_m extends CI_Model
{
    public function getall($id = null)
    {
        $userlogin = $this->fungsi->user_login()->user_id;
        $this->db->select('t.*, p.*, t.name AS username');
        $this->db->join('tb_paket AS p', 't.paket_id = p.paket_id');
        $this->db->where('user_id', $userlogin);
        return $this->db->get('tb_tiketonline as t');
    }

    public function get_paket()
    {
        $this->db->select('*');
        $this->db->from('tb_paket');
        return $this->db->get();
    }

    public function add_pesanan_tiketonline($data)
    {
        $user = $this->fungsi->user_login()->user_id;
        $param = array(
            'reservationdate' => $data['reservationdate'],
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'ticket_type' => $data['ticket_type'],
            'ticket_total' => $data['ticket_total'],
            'paket_id' => $data['paket_id'],
            'user_id' => $user
        );
        $this->db->insert('tb_tiketonline', $param);
    }

    public function get_invoice($id = null)
    {
        $this->db->select('tb_paket.*, 
        tb_detail_paket.*, 
        tb_wahana.*, 
        tb_tiketonline.*,
        tb_paket.name AS paket_name,
        tb_wahana.name AS wahana_name,
        tb_paket.price AS paket_price');
        $this->db->join('tb_tiketonline', 'tb_tiketonline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_wahana.wahana_id = tb_detail_paket.detail_wahana_id');
        if ($id != null) {
            $this->db->where('tb_tiketonline.tiketonline_id', $id);
        }
        $this->db->from('tb_paket');
        return $this->db->get();
    }
}
