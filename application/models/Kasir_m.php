<?php

class Kasir_m extends CI_Model
{
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

    public function gett_all_tiketoffline()
    {
        $this->db->select('
        tb_tiketoffline.*,
        tb_paket.*,
        tb_tiketoffline.name AS customer_name,
        tb_paket.name AS paket_name,
        tb_tiketoffline.created_at AS reservationdate,
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        SUM(tb_wahana.price) AS paket_price,
        ');
        $this->db->from('tb_tiketoffline');
        $this->db->join('tb_paket', 'tb_tiketoffline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_tiketoffline.tiketoffline_id');
        $this->db->order_by('status_tiket');
        return $this->db->get();
    }

    //online
    public function get_print_per_id($id)
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
        $this->db->where(array('tb_tiketonline.tiketonline_id' => $id, 'status_code' => 200));
        return $this->db->get('tb_tiketonline');
    }

    public function print_arrage($tgl1, $tgl2)
    {
        // $sql = "SELECT * FROM tb_tiketonline WHERE reservationdate BETWEEN '$tgl1' AND '$tgl2' ";
        // return $this->db->query($sql);
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
        $this->db->where('reservationdate >=', $tgl1);
        $this->db->where('reservationdate <=', $tgl2);
        return $this->db->get('tb_tiketonline');
    }

    //offline
    public function get_printoff_per_id($id)
    {
        $this->db->select('
        tb_tiketoffline.*,
        tb_paket.*,
        tb_tiketoffline.name AS customer_name,
        tb_paket.name AS paket_name,
        tb_tiketoffline.created_at AS reservationdate,
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        SUM(tb_wahana.price) AS paket_price,
        ');
        $this->db->from('tb_tiketoffline');
        $this->db->join('tb_paket', 'tb_tiketoffline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_tiketoffline.tiketoffline_id');
        $this->db->where('tiketoffline_id', $id);
        return $this->db->get();
    }

    public function printoff_arrage($tgl1, $tgl2)
    {
        $this->db->select('
        tb_tiketoffline.*,
        tb_paket.*,
        tb_tiketoffline.name AS customer_name,
        tb_paket.name AS paket_name,
        tb_tiketoffline.created_at AS reservationdate,
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        SUM(tb_wahana.price) AS paket_price,
        ');
        $this->db->from('tb_tiketoffline');
        $this->db->join('tb_paket', 'tb_tiketoffline.paket_id = tb_paket.paket_id');
        $this->db->join('tb_detail_paket', 'tb_detail_paket.detail_paket_id = tb_paket.paket_id');
        $this->db->join('tb_wahana', 'tb_detail_paket.detail_wahana_id = tb_wahana.wahana_id');
        $this->db->group_by('tb_tiketoffline.tiketoffline_id');
        $this->db->where('tb_tiketoffline.created_at >=', $tgl1);
        $this->db->where('tb_tiketoffline.created_at <=', $tgl2);
        return $this->db->get();
    }
}
