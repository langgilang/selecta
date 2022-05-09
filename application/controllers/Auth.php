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

}
