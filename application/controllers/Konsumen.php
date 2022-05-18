<?php

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_konsumen();
        $this->load->model(['konsumen_m', 'wahana_m']);
    }

    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );

        $this->template->load('templates', 'konsumen/dashboard/dashboard_tampil', $data);
    }

    public function tampil_konsumen()
    {
        $query = $this->konsumen_m->get();
        $data = array(
            'header' => 'Data Pesanan',
            'tiketonline' => $query->result()
        );
        // print_r($data);
        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_tampil', $data);
    }

    public function proses()
    {
        $config['upload_path'] = './uploads/tiketonline_ktp/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 20480;
        $config['file_name'] = 'ktp-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->konsumen_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai");
                redirect('konsumen/add');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->konsumen_m->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('konsumen/tampil_konsumen');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('konsumen/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->konsumen_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('konsumen/tampil_konsumen');
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->konsumen_m->check_barcode($post['barcode'], $post['tiketonline_id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai");
                redirect('konsumen/add');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->konsumen_m->get($post['tiketonline_id'])->row();
                        if ($item->image != null) {
                            $target_file = './uploads/tiketonline_ktp/' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->konsumen_m->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('konsumen/tampil_konsumen');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('konsumen/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->konsumen_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('konsumen/tampil_konsumen');
                }
            }
        }
    }

    public function add()
    {
        $kosumen = new stdClass();
        $kosumen->tiketonline_id = null;
        $kosumen->barcode = null;
        $kosumen->nik = null;
        $kosumen->name = null;
        $kosumen->telp = null;
        $kosumen->ticket_total = null;
        $kosumen->ticket_type = null;
        $kosumen->wahana_id = null;

        $wahana = $this->wahana_m->get();
        $data = array(
            'page' => 'add',
            'header' => 'Tambah Data kosumen',
            'row' => $kosumen,
            'wahana' => $wahana
        );
        $this->template->load('templates', 'konsumen/tiketonline/tiketonline_form', $data);
    }

    public function edit($id = null)
    {
        $query = $this->konsumen_m->get($id);
        if ($query->num_rows() > 0) {
            $kosumen = $query->row();
            $wahana = $this->wahana_m->get();
            $data = array(
                'page' => 'edit',
                'header' => 'Tambah Data kosumen',
                'row' => $kosumen,
                'wahana' => $wahana
            );
            $this->template->load('templates', 'konsumen/tiketonline/tiketonline_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('konsumen/tiketonline_tampil') . "';</script>";
        }
    }

    public function del($id)
    {
        $item = $this->konsumen_m->get($id)->row();
        if ($item->image != null) {
            $target_file = './uploads/tiketonline_ktp/' . $item->image;
            unlink($target_file);
        }

        $this->konsumen_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('konsumen/tampil_konsumen');
    }

    public function barcode_qrcode($id)
    {
        $data['row'] = $this->konsumen_m->get($id)->row();
        $this->template->load('templates', 'konsumen/tiketonline/barcode_qrcode', $data);
    }
}
