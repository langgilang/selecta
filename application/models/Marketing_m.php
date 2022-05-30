<?php

class Marketing_m extends CI_Model
{
    public function get_pesananonline($id = null)
    {
        $this->db->select('a.*, b.*, a.name as tiketonline_name, b.name as wahana_name');
        $this->db->join('tb_wahana as b', 'a.wahana_id=b.wahana_id  ');
        if ($id != null) {
            $this->db->where('tiketonline_id', $id);
        }
        return $this->db->get('tb_tiketonline as a')->result();
    }

    public function get_wahana($id = null)
    {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('wahana_id', $id);
        }
        return $this->db->get('tb_wahana')->result();
    }

    public function add_wahana($data)
    {
        $param = array(
            'code' => $data['code'],
            'name' => $data['name'],
            'price' => $data['price'],
        );
        $this->db->insert('tb_wahana', $param);
        var_dump($param);
    }

    public function del($id)
    {
        $this->db->where('wahana_id', $id);
        $this->db->delete('tb_wahana');
    }
}
