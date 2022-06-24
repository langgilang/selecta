<?php

class Konsumen_m extends CI_Model
{
    public function getall($id = null)
    {
        $user = $this->fungsi->user_login()->user_id;
        $this->db->select('*, 
        COUNT(tb_wahana.wahana_id),
        tb_paket.name AS paket_name,
        COUNT(tb_wahana.wahana_id) AS paket_items,
        tb_tiketonline.name AS customer_name,
        SUM(tb_wahana.price) AS wahana_price');
        $this->db->from('tb_tiketonline');
        $this->db->join('tb_paket', 'tb_paket.paket_id=tb_tiketonline.paket_id');
        $this->db->join('tb_detail_paket', 'tb_paket.paket_id = tb_detail_paket.detail_paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_paket.paket_id');
        $this->db->where('user_id', $user);
        return $this->db->get();
    }

    public function get_transaksi()
    {
        $this->db->select('*');
        return $this->db->get('tb_transaksi');
    }

    public function get_paket()
    {
        return $this->db->get('tb_paket');
    }

    public function get_wahana()
    {
        return $this->db->get('tb_wahana');
    }

    public function order_key()
    {
        $sql = "SELECT MAX(MID(order_key,9,4)) AS order_number 
                FROM tb_tiketonline 
                WHERE MID(order_key,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->order_number) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $order_id = "ON" . date('ymd' . $no);
        return $order_id;
    }

    public function add_rombongan($data)
    {
        $user = $this->fungsi->user_login()->user_id;
        $param = array(
            'order_key' => $data['order_key'],
            'reservationdate' => $data['reservationdate'],
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'ticket_type' => 2,
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
        SUM(tb_wahana.price) AS wahana_price');
        $this->db->join('tb_tiketonline', 'tb_tiketonline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_wahana.wahana_id = tb_detail_paket.detail_wahana_id');
        $this->db->where('tb_tiketonline.tiketonline_id', $id);
        $this->db->from('tb_paket');
        return $this->db->get();
    }

    public function del($id)
    {
        $this->db->where('tiketonline_id', $id);
        $this->db->delete('tb_tiketonline');
    }
}
