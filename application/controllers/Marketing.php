<?php

class Marketing extends CI_Controller
{

    public function index()
    {
        $data = array(
            'header' => 'Dashboard'
        );
        $this->template->load('marketing/templates', 'marketing/dashboard/dashboard_tampil', $data);
    }

}
