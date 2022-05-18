<?php

class Wahana_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_wahana");
        $this->db->select('*');
        $this->db->from('tb_wahana');
        if ($id != null) {
            $this->db->where('wahana_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $param = array(
            'name' => $data['name'],
            'price' => $data['price'],
        );
        $this->db->insert('tb_wahana', $param);
    }

    public function edit($data)
    {
        $param = array(
            'name' => $data['name'],
            'price' => $data['price'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->set($param);
        $this->db->where('wahana_id', $data['wahana_id']);
        $this->db->update('tb_wahana');
    }

    public function del($id)
    {
        $this->db->where('wahana_id', $id);
        $this->db->delete('tb_wahana');
    }
}
