<?php

class Portir_m extends CI_Model
{

    public function get($id = null)
    {
        // $query=$this->db->query("SELECT * FROM tb_tiketoffline");
        $this->db->select('t.*, p.*, t.name AS customer_name, p.name AS paket_name');
        $this->db->join('tb_paket AS p', 'p.paket_id = t.paket_id');
        if ($id != null) {
            $this->db->where('t.tiketoffline_id ', $id);
        }
        return $this->db->get('tb_tiketoffline AS t');
    }

    public function get_paket()
    {
        return $this->db->get('tb_paket');
    }

    public function add($data)
    {
        $user = $this->fungsi->user_login()->id;
        $param = array(
            'tiketoffline_id' => $data['tiketoffline_id'],
            'user_id' => $user,
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
            'paket_id' => $data['paket_id'],
            'ticket_type' => $data['ticket_type'],
        );
        $this->db->insert('tb_tiketoffline', $param);
    }

    public function edit($data)
    {
        $param = array(
            'tiketoffline_id' => $data['tiketoffline_id'],
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'ticket_total' => $data['ticket_total'],
            'paket_id' => $data['paket_id'],
            'ticket_type' => $data['ticket_type'],
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
