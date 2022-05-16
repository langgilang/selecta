<?php

class Auth extends CI_Controller
{

    public function __construct()
    {
        // parent::__construct();
        // $this->load->library('form_validation');

        parent::__construct();
        $this->load->model('auth_m', 'auth');
    }

    public function index()
    {
        check_already_login();
        $data = array(
            'header' => 'LOGIN'
        );
        $this->load->view('auth/login', $data);
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
                    'email' => $row->email,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                if ($params['level'] == 1) {
                    echo "<script>
                    alert('Selamat, login marketing berhasil');
                    window.location='" . site_url('marketing') . "';
                    </script>";
                } elseif ($params['level'] == 2) {
                    echo "<script>
                    alert('Selamat, login kasir berhasil');
                    window.location='" . site_url('kasir') . "';
                    </script>";
                } elseif ($params['level'] == 3) {
                    echo "<script>
                    alert('Selamat, login portir berhasil');
                    window.location='" . site_url('portir') . "';
                    </script>";
                } elseif ($params['level'] == 4) {
                    echo "<script>
                    alert('Selamat, login portir berhasil');
                    window.location='" . site_url('konsumen') . "';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Login gagal, silahkan login kembali');
                    window.location='" . site_url('auth') . "';
                </script>";
            }
        }
    }

    public function proses()
    {
        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->auth->add($inputan);
            redirect('auth');
        } else if (isset($_POST['edit'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->auth->edit($inputan);
        }
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function logout()
    {
        $params = array('email', 'level');
        $this->session->unset_userdata($params);
        redirect('auth');
    }
}
