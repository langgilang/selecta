<?php

class Auth_m extends CI_Model
{

    public function add($data)
    {
        $param = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'image' => 'default.jpg',
            'password' => sha1($data['password']),
            'level' => 4,
        );
        $this->db->insert('tb_user', $param);
    }
}
