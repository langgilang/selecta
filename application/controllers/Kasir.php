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
        $query = $this->kasir_m->total_tiketonline_done();
        $query2 = $this->kasir_m->total_tiketoffline_done();
        $query3 = $this->kasir_m->off_checkin();
        $query4 = $this->kasir_m->off_checkout();
        if ($query->num_rows == 0 || $query2->num_rows == 0 || $query3->num_rows == 0 || $query4->num_rows == 0) {
            $data = [
                'header' => 'Dashboard',
                'tiketonline_done' => $query->row(),
                'tiketoffline_done' => $query2->row(),
                'in' => $query3->row(),
                'out' => $query4->row(),
            ];
            $this->load->view('kasir/dashboard/kasir_dashboard', $data);
        }
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
            'header' => 'Laporan Tiket Offline',
            'semuatiketoffline' => $this->kasir_m->gett_all_tiketoffline()->result(),
        ];
        $this->load->view('kasir/datatiketoffline/tiketoffline_tampil', $data);
    }

    //online
    public function print_per_id($id)
    {
        $data = [
            'header' => 'Export PDF',
            'row' => $this->kasir_m->get_print_per_id($id)->row(),
        ];
        $html =  $this->load->view('kasir/datatiketonline/tiketonline_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'laporan-' . $data['row']->order_key, 'A4', 'landscape');
    }

    public function print_arrage()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $data = [
            'header' => 'Cetak Laporan',
            'cetak_arrage' => $this->kasir_m->print_arrage($tgl_awal, $tgl_akhir)->result()
        ];
        $html =  $this->load->view('kasir/datatiketonline/tiketonline_print_arrage', $data, true);
        $this->fungsi->PdfGenerator($html, 'laporan', 'A4', 'landscape');
    }

    //offline
    public function printoff_per_id($id)
    {
        $data = [
            'header' => 'Export PDF',
            'row' => $this->kasir_m->get_printoff_per_id($id)->row(),
        ];
        $html =  $this->load->view('kasir/datatiketoffline/tiketoffline_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'laporan-' . $data['row']->order_key, 'A4', 'landscape');
    }

    public function printoff_arrage()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $data = [
            'header' => 'Cetak Laporan',
            'cetak_arrage' => $this->kasir_m->printoff_arrage($tgl_awal, $tgl_akhir)->result()
        ];
        $html =  $this->load->view('kasir/datatiketoffline/tiketoffline_print_arrage', $data, true);
        $this->fungsi->PdfGenerator($html, 'laporan', 'A4', 'landscape');
    }
}
