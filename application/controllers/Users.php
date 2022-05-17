<?php
class Users extends CI_Controller
{
    public function index()
    {
        $data = array(
            'header' => 'Register',
        );
        // print_r($data);
        $this->load->view('register');
    }

    public function add()
    {
        // print_r($_POST['username']);

    }
}
