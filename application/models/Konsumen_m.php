<?php

class Konsumen_m extends CI_Model
{
    public function getall($id = null)
    {
        $userlogin = $this->fungsi->user_login()->user_id;
        $this->db->select('a.*, b.*, a.name as tiketonline_name, b.name as wahana_name');
        $this->db->join('tb_wahana as b', 'a.wahana_id=b.wahana_id  ');
        if ($id != null) {
            $this->db->where('tiketonline_id', $id);
        }
        $this->db->where('user_id', $userlogin);
        return $this->db->get('tb_tiketonline as a');
    }

    public function add1($data)
    {
        $userlogin = $this->fungsi->user_login()->user_id;
        $param = array(
            'ticket_total' => $data['ticket_total'],
            'reservationdate' => $data['reservationdate'],
            'user_id' => $userlogin,
        );
        $this->db->insert('tb_tiketonline', $param);
    }

    public function edit1($data)
    {
        $userlogin = $this->fungsi->user_login()->user_id;
        $param = array(
            'wahana_id' => $data['wahana'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('tiketonline_id', $data['tiketonline_id']);
        $this->db->update('tb_tiketonline', $param);
    }

    public function del($id)
    {
        $this->db->where('tiketonline_id', $id);
        $this->db->delete('tb_tiketonline');
    }
}
