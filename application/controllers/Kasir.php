<?php

class Kasir extends CI_Controller
{
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
            'header' => 'Laporan Tiket Online'
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
