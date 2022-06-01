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

    public function get_wahana()
    {
        $this->db->select('*');
        $this->db->from('tb_wahana');
        return $this->db->get();
    }

    public function get_paket()
    {
        $this->db->select('p.*, p.code AS code_paket,p.created_at AS create_paket, COUNT(w.wahana_id) AS wahana_item');
        $this->db->from('tb_paket AS p');
        $this->db->join('tb_detail_paket AS dp', 'p.paket_id = dp.paket_id');
        $this->db->join('tb_wahana AS w', 'dp.wahana_id = w.wahana_id');
        $this->db->group_by('paket_id');
        $query = $this->db->get();
        return $query;
    }

    public function add_wahana($data)
    {
        $param = array(
            'code' => $data['code'],
            'name' => $data['name'],
            'price' => $data['price'],
        );
        $this->db->insert('tb_wahana', $param);
    }

    public function add_paket($paket, $wahana)
    {
        // INSERT PAKET
        $param = array(
            'code' => $paket['code'],
            'name' => $paket['name'],
            'price' => $paket['price'],
        );
        $this->db->insert('tb_paket', $param);
        // END INSERT PAKET

        // GET ID PAKET TERBARU
        // INSERT DETAIL PAKET
        $paket_id = $this->db->insert_id();
        $result = array();
        foreach ($wahana as $a => $whn) {
            $result[] = array(
                'paket_id'  => $paket_id,
                'wahana_id' => $_POST['wahana'][$a]
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tb_detail_paket', $result);
    }

    public function edit_wahana($data, $where)
    {
        $param = array(
            'code' => $data['code'],
            'name' => $data['name'],
            'price' => $data['price'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where($where);
        $this->db->update('tb_wahana', $param);
    }

    public function del($id)
    {
        $this->db->where('wahana_id', $id);
        $this->db->delete('tb_wahana');
    }

    public function del_paket($id)
    {
        $this->db->delete('tb_detail_paket', array('paket_id' => $id));
        $this->db->delete('tb_paket', array('paket_id' => $id));
    }
}
