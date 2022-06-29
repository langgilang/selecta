<?php

require_once 'assets/dompdf/autoload.inc.php';

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('users_m');
        $id_user = $this->ci->session->userdata('email');
        $user_data = $this->ci->users_m->get($id_user)->row();
        return $user_data;
    }

    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename . "pdf", array("Attachment" => FALSE));
    }
}
