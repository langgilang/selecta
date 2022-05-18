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

    public function add($data)
    {
        $param = array(
            'barcode' => $data['barcode'],
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'wahana_id' => $data['wahana'],
            'ticket_total' => $data['ticket_total'],
            'ticket_type' => $data['ticket_type'],
        );
        $this->db->insert('tb_tiketonline', $param);
    }

    public function edit($data)
    {
        $param = array(
            'barcode' => $data['barcode'],
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'wahana_id' => $data['wahana'],
            'ticket_total' => $data['ticket_total'],
            'ticket_type' => $data['ticket_type'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->set($param);
        $this->db->where('tiketonline_id', $data['tiketonline_id']);
        $this->db->update('tb_tiketonline');
    }

    public function del($id)
    {
        $this->db->where('tiketonline_id', $id);
        $this->db->delete('tb_tiketonline');
    }
}
