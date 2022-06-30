<?php

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kasir_m');
    }

    public function dashboard()
    {
        $data = [
            'header' => 'Dashboard'
        ];
        $this->load->view('kasir/dashboard/kasir_dashboard', $data);
    }

    public function tiket_online()
    {
        $data = [
            'header' => 'Laporan Tiket Online',
            'semuatiketonline' => $this->kasir_m->gett_all_tiketonline()->result(),
        ];
        $this->load->view('kasir/datatiketonline/tiketonline_tampil', $data);
    }

    public function tiket_offline()
    {
        $data = [
            'header' => 'Laporan Tiket Offline'
        ];
        $this->load->view('kasir/datatiketoffline/tiketoffline_tampil', $data);
    }
}
