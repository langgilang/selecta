<?php

class Wahana_m extends CI_Model {

    public function get()
    {
        $this->db->select('*');
        $this->db->from('tb_wahana');
        $query = $this->db->get();
        return $query;
    }
    
}
