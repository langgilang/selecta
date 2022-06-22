<?php

class Paralax_m extends CI_Model
{
    public function get_paket()
    {
        $this->db->select('*, 
        tb_paket.code AS code_paket, 
        tb_paket.created_at AS create_paket, 
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        tb_paket.name AS paket_name,
        tb_paket.status AS paket_status,
        SUM(tb_wahana.price) AS wahana_price');
        $this->db->from('tb_paket');
        $this->db->join('tb_detail_paket', 'paket_id = detail_paket_id');
        $this->db->join('tb_wahana', 'detail_wahana_id = wahana_id');
        $this->db->where('tb_paket.status', 1);
        $this->db->group_by('paket_id');
        $query = $this->db->get();
        return $query;
    }

    public function get_wahana()
    {
        return $this->db->get_where('tb_wahana', array('status' => 1));
    }
}
