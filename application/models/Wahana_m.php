<?php

class Wahana_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_wahana");
        $this->db->select('*');
        $this->db->from('tb_wahana');
        if ($id != null) {
            $this->db->where('id_wahana', $id);
        }
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

    public function edit($data)
    {
        $param = array(
            'nama_wahana' => $data['nama_wahana'],
            'harga' => $data['harga'],
        );
        $this->db->set($param);
        $this->db->where('id_wahana', $data['id_wahana']);
        $this->db->update('tb_wahana');
    }

    public function del($id)
    {
        $this->db->where('id_wahana', $id);
        $this->db->delete('tb_wahana');
    }
}
