<?php

class Wahana_m extends CI_Model {

    public function get()
    {
        $this->db->select('*');
        $this->db->from('tb_wahana');
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $param = array(
            'nama_wahana' => $data['nama_wahana'],
            'harga' => $data['harga'],
        );
        $this->db->insert('tb_wahana', $param);
    }
    
}
