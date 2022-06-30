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
}
