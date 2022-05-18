<?php

class Konsumen_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_wahana");
        $this->db->select('*');
        $this->db->from('tb_tiketonline');
        if ($id != null) {
            $this->db->where('tiketonline_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
