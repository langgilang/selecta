<?php

class Portir_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_tiketoffline");
        $this->db->select('*');
        $this->db->from('tb_tiketoffline');
        if ($id != null) {
            $this->db->where('tiketoffline_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $param = array(
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
        );
        $this->db->insert('tb_tiketoffline', $param);
    }

    public function edit($data)
    {
        $param = array(
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
            'updated_at' => date('Y-m-d H:i:s')
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
}
