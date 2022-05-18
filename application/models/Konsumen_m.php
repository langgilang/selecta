<?php

class Konsumen_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_wahana");
        $this->db->select('tb_tiketonline.*, tb_wahana.name as wahana_name, tb_tiketonline.name as tiketonline_name');
        $this->db->from('tb_tiketonline');
        $this->db->join('tb_wahana', 'tb_wahana.wahana_id = tb_tiketonline.wahana_id');
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

    public function check_barcode($code, $id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_tiketonline');
        $this->db->where('barcode', $code);
        if ($id != null) {
            $this->db->where('tiketonline_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('tiketonline_id', $id);
        $this->db->delete('tb_tiketonline');
    }
}
