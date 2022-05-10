<?php 

class Users_m extends CI_Model {

    public function login($post)
    {
         $this->db->select('*');
         $this->db->from('tb_users');
         $this->db->where('username', $post['username']);
         $this->db->where('password', SHA1($post['password']));
         $query = $this->db->get();
         return $query;
    }
}
