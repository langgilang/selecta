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
?>
            <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.css">
            <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
            <style>
                body {
                    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                    font-size: 1.124em;
                    font-weight: normal;
                }
            </style>

            <body>
            </body>
            <?php
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'email' => $row->email,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);

                if ($params['level'] == 1) {
            ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Selamat, Login Marketing berhasil!'
                        }).then((result) => {
                            window.location = '<?= site_url('marketing/dashboard') ?>';
                        })
                    </script>
                <?php
                } elseif ($params['level'] == 2) {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Selamat, Login Kasir berhasil!'
                        }).then((result) => {
                            window.location = '<?= site_url('kasir/dashboard') ?>';
                        })
                    </script>
                <?php
                } elseif ($params['level'] == 3) {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Selamat, Login Portir berhasil!'
                        }).then((result) => {
                            window.location = '<?= site_url('portir/dashboard') ?>';
                        })
                    </script>
                <?php
                } elseif ($params['level'] == 4) {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Selamat, Login Konsumen berhasil!'
                        }).then((result) => {
                            window.location = '<?= site_url('konsumen/dashboard') ?>';
                        })
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Failure!',
                        text: 'Login Gagal, Username atau Password salah!'
                    }).then((result) => {
                        window.location = '<?= site_url('auth') ?>';
                    })
                </script>
            <?php
            }
        }
    }

    public function proses()
    {
        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->auth->add($inputan);

            ?>
            <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.css">
            <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
            <style>
                body {
                    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                    font-size: 1.124em;
                    font-weight: normal;
                }
            </style>

            <body>
            </body>
            <?php

            if ($inputan == false) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Failure!',
                        text: 'Register Gagal, silahkan mendaftar kembali!'
                    }).then((result) => {
                        window.location = '<?= site_url('auth/register') ?>';
                    })
                </script>
            <?php
            } else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Register Berhasil, silahkan login!'
                    }).then((result) => {
                        window.location = '<?= site_url('auth') ?>';
                    })
                </script>
<?php
            }
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
