<?php

class Kasir extends CI_Controller
{
    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'kasir', $data);
    }
}
