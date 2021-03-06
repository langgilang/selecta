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
        $this->db->from('tb_wahana');
        if ($id != null) {
            $this->db->where('wahana_id', $id);
        }
        $this->db->order_by('code');
        return $this->db->get();
    }

    public function get_paket()
    {
        $this->db->select('*, 
        tb_paket.code AS code_paket, 
        tb_paket.created_at AS create_paket, 
        COUNT(tb_wahana.wahana_id) AS wahana_item,
        tb_paket.name AS paket_name,
        tb_wahana.name AS wahana_name,
        tb_paket.status AS paket_status,
        SUM(tb_wahana.price) AS wahana_price');
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

    public function add_wahana($post)
    {
        $param = array(
            'code' => $post['code'],
            'name' => $post['name'],
            'price' => $post['price'],
            'image' => $post['image'],
        );
        $this->db->insert('tb_wahana', $param);
    }

    public function edit_wahana($post)
    {
        $param = array(
            'code' => $post['code'],
            'name' => $post['name'],
            'price' => $post['price'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        if ($post['image'] != null) {
            $param['image'] = $post['image'];
        }

        $this->db->where('wahana_id', $post['wahana_id']);
        $this->db->update('tb_wahana', $param);
    }

    public function check_wahana_code($code, $id = null)
    {
        $this->db->from('tb_wahana');
        $this->db->where('code', $code);
        if ($id != null) {
            $this->db->where('wahana_id !=', $id);
        }
        return $this->db->get();
    }

    public function check_paket_code($code, $id = null)
    {
        $this->db->from('tb_paket');
        $this->db->where('code', $code);
        if ($id != null) {
            $this->db->where('paket_id !=', $id);
        }
        return $this->db->get();
    }

    public function add_paket($paket, $wahana)
    {
        // INSERT PAKET
        $param = array(
            'code' => $paket['add_code'],
            'name' => $paket['add_name'],
            'status' => 2,
            'diskon' => $paket['add_diskon'],
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
                'detail_wahana_id' => $_POST['add_wahana'][$a]
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tb_detail_paket', $result);
    }

    public function edit_paket($paket_id, $data, $wahana)
    {
        //UPDATE TO PACKAGE
        $data  = array(
            'code' => $data['code'],
            'name' => $data['name'],
            'diskon' => $data['diskon'],
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

    public function total_wahana()
    {
        $query = "SELECT 
        COUNT(wahana_id) AS total_wahana
        FROM tb_wahana";
        return $this->db->query($query);
    }

    public function total_paket()
    {
        $query = "SELECT 
        COUNT(paket_id) AS total_paket
        FROM tb_paket";
        return $this->db->query($query);
    }

    public function total_paket_non_diskon()
    {
        $query = "SELECT 
        COUNT(paket_id) AS total_paket
        FROM tb_paket
        WHERE diskon = 0";
        return $this->db->query($query);
    }

    public function total_paket_diskon()
    {
        $query = "SELECT 
        COUNT(paket_id) AS total_paket
        FROM tb_paket
        WHERE diskon > 0";
        return $this->db->query($query);
    }
}
