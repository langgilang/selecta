<?php

class Marketing extends CI_Controller
{

    public function index()
    {
        check_not_login();
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'marketing/dashboard/dashboard_tampil', $data);
    }
}
