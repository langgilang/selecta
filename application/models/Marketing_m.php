<?php

class Marketing_m extends CI_Model
{
    public function get_pesananonline($id = null)
    {
        $this->db->select('a.*, b.*, a.name as tiketonline_name, b.name as paket_name');
        $this->db->join('tb_paket as b', 'a.paket_id = b.paket_id  ');
        if ($id != null) {
            $this->db->where('a.tiketonline_id', $id);
        }
        return $this->db->get('tb_tiketonline as a')->result();
    }

    public function get_wahana($id = null)
    {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('wahana_id', $id);
        }
        $this->db->from('tb_wahana');
        return $this->db->get();
    }

    public function get_paket()
    {
        $this->db->select('*, 
        tb_paket.code AS code_paket, 
        tb_paket.created_at AS create_paket, 
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        tb_paket.name AS paket_name,
        tb_paket.price AS paket_price');
        $this->db->from('tb_paket');
        $this->db->join('tb_detail_paket', 'paket_id = detail_paket_id');
        $this->db->join('tb_wahana', 'detail_wahana_id = wahana_id');
        $this->db->group_by('paket_id');
        $query = $this->db->get();
        return $query;
    }

    public function get_wahana_by_paket($paket_id)
    {
        $this->db->select('*');
        $this->db->from('tb_wahana');
        $this->db->join('tb_detail_paket', 'detail_wahana_id = wahana_id');
        $this->db->join('tb_paket', 'paket_id = detail_paket_id');
        $this->db->where('paket_id', $paket_id);
        return $this->db->get();
    }

    public function get_wahanaselect($id)
    {
        $this->db->select('tb_wahana.name AS wahana_name, wahana_id');
        $this->db->from('tb_wahana');
        $this->db->join('tb_detail_paket', 'detail_wahana_id = wahana_id');
        $this->db->join('tb_paket', 'paket_id = detail_paket_id');
        $this->db->where('paket_id', $id);
        return $this->db->get();
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
                'detail_paket_id'  => $paket_id,
                'detail_wahana_id' => $_POST['wahana'][$a]
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

    public function edit_paket($paket_id, $data, $wahana)
    {
        //UPDATE TO PACKAGE
        $data  = array(
            'code' => $data['code'],
            'name' => $data['name'],
            'price' => $data['price'],
        );
        $this->db->where('paket_id', $paket_id);
        $this->db->update('tb_paket', $data);

        //DELETE DETAIL PACKAGE
        $this->db->delete('tb_detail_paket', array('detail_paket_id' => $paket_id));

        $result = array();
        foreach ($wahana as $key => $val) {
            $result[] = array(
                'detail_paket_id'      => $paket_id,
                'detail_wahana_id'      => $_POST['wahana'][$key]
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tb_detail_paket', $result);
    }

    public function del($id)
    {
        $this->db->where('wahana_id', $id);
        $this->db->delete('tb_wahana');
    }

    public function del_paket($id)
    {
        $this->db->delete('tb_detail_paket', array('detail_paket_id' => $id));
        $this->db->delete('tb_paket', array('paket_id' => $id));
    }
}
