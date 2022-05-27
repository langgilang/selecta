<?php
class Tiketoffline_p extends CI_Controller
{




    public function proses()
    {
        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->tiketoffline->add($inputan);
        } else if (isset($_POST['edit'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->tiketoffline->edit($inputan);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('tiketoffline/index');
    }

    public function add()
    {
        $tiketoffline = new stdClass();
        $tiketoffline->tiketoffline_id = null;
        $tiketoffline->name = null;
        $tiketoffline->ticket_total = null;
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data Tiket Offline',
            'row' => $tiketoffline
        );
        $this->template->load('templates', 'portir/tiketoffline/tiketoffline_form', $data);
    }

    public function edit($id = null)
    {
        $query = $this->tiketoffline->get($id);
        if ($query->num_rows() > 0) {
            $tiketoffline = $query->row();
            $data = array(
                'page' => 'edit',
                'header' => 'Tambah Data Tiket Offline',
                'row' => $tiketoffline
            );
            $this->template->load('templates', 'portir/tiketoffline/tiketoffline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('tiketoffline/index') . "';</script>";
        }
    }
    public function del($id)
    {
        $this->tiketoffline->del($id);
        redirect('tiketoffline/index');
    }
}
