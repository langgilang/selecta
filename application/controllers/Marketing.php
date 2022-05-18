<?php

class Marketing extends CI_Controller
{

    public function dashboard()
    {
        check_not_login();
        check_marketing();
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('templates', 'marketing/dashboard/dashboard_tampil', $data);
    }
}
