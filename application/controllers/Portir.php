<?php
class Portir extends CI_Controller
{
    public function index()
    {
        $this->template->load('portir/templates', 'portir/tiketoffline/tiketoffline_tampil');
        // $this->load->helper('url');
    }
}
