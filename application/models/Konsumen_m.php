<?php

class Konsumen_m extends CI_Model
{
    public function get_wahana()
    {
        return $this->db->get('tb_wahana');
    }

    public function getall($id = null)
    {
        $this->db->select('a.*, b.*, a.name as tiketonline_name, b.name as wahana_name');
        $this->db->join('tb_wahana as b', 'a.wahana_id=b.wahana_id  ');
        if ($id != null) {
            $this->db->where('tiketonline_id', $id);
        }
        return $this->db->get('tb_tiketonline as a');
    }

    public function add($data)
    {
        $param = array(
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'wahana_id' => $data['wahana'],
            'ticket_total' => $data['ticket_total'],
            'reservationdate' => $data['reservationdate'],
            'ticket_type' => $data['ticket_type'],
        );
        $this->db->insert('tb_tiketonline', $param);
    }

    public function edit($data)
    {
        $param = array(
            'nik' => $data['nik'],
            'name' => $data['name'],
            'telp' => $data['telp'],
            'wahana_id' => $data['wahana'],
            'ticket_total' => $data['ticket_total'],
            'reservationdate' => $data['reservationdate'],
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
