<?php

class Auth extends CI_Controller
{

    public function index()
    {
        $data = array(
            'header' => 'LOGIN'
        );
        $this->load->view('login', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('users_m');
            $query = $this->users_m->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'id_user' => $row->id_user,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script>
                    alert('Selamat, login berhasil');
                    window.location='".site_url('marketing')."';
                </script>";
            } else {
                echo "<script>
                    alert('Login gagal, silahkan login kembali');
                    window.location='".site_url('auth/login')."';
                </script>";
            }
        }
    }
}
