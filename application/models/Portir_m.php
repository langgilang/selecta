<?php

class Portir_m extends CI_Model
{
    public function order_key()
    {
        $sql = "SELECT MAX(MID(order_key,9,4)) AS order_number 
                FROM tb_tiketoffline 
                WHERE MID(order_key,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->order_number) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $order_id = "OF" . date('ymd' . $no);
        return $order_id;
    }
    public function get()
    {
        // $query=$this->db->query("SELECT * FROM tb_tiketoffline");
        $this->db->select('
        tb_tiketoffline.*,
        tb_paket.*,
        tb_tiketoffline.name AS customer_name,
        tb_paket.name AS paket_name,
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        SUM(tb_wahana.price) AS paket_price,
        ');
        $this->db->from('tb_tiketoffline');
        $this->db->join('tb_paket', 'tb_tiketoffline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_tiketoffline.tiketoffline_id');
        return $this->db->get();
    }

    public function get_paket()
    {
        return $this->db->get('tb_paket');
    }

    public function get_wahana()
    {
        return $this->db->get('tb_wahana');
    }

    public function get_selectpaket($id)
    {
        $sql = "SELECT * 
                FROM tb_paket 
                JOIN tb_tiketoffline ON tb_tiketoffline.paket_id = tb_paket.paket_id 
                WHERE tiketoffline_id=$id";
        $query = $this->db->query($sql);
        return $query;
    }

    public function add_perorangan($data)
    {
        $user = $this->fungsi->user_login()->user_id;
        $param = array(
            'order_key' => $data['order_key'],
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
            'ticket_type' => 1,
            'status_tiket' => 1,
            'paket_id' => $data['paket_id'],
            'user_id' => $user
        );
        $this->db->insert('tb_tiketoffline', $param);
    }

    public function edit($data)
    {
        $param = array(
            'tiketoffline_id' => $data['tiketoffline_id'],
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
            'paket_id' => $data['paket_id'],
            'ticket_type' => $data['ticket_type'],
        );
        $this->db->set($param);
        $this->db->where('tiketoffline_id', $data['tiketoffline_id']);
        $this->db->update('tb_tiketoffline');
    }

    public function del($id)
    {
        $this->db->where('tiketoffline_id', $id);
        $this->db->delete('tb_tiketoffline');
    }

    public function gett_all_tiketonline()
    {
        $this->db->select('*, 
        tb_paket.name AS paket_name,
        COUNT(tb_wahana.wahana_id) AS paket_items,
        tb_tiketonline.name AS customer_name,
        SUM(tb_wahana.price) AS wahana_price');
        $this->db->join('tb_paket', 'tb_paket.paket_id=tb_tiketonline.paket_id');
        $this->db->join('tb_detail_paket', 'tb_paket.paket_id = tb_detail_paket.detail_paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_tiketonline.tiketonline_id');
        $this->db->where('status_code', 200);
        return $this->db->get('tb_tiketonline');
    }
}
