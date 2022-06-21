<?php

class Marketing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_marketing();
        $this->load->model('marketing_m');
    }

    // DASHBOARD MARKETING
    public function dashboard()
    {
        $data = array(
            'header' => 'Dashboard'
        );
        $this->load->view('marketing/dashboard/dashboard_tampil', $data);
    }

    // TAMPIL MENU DATA PESANAN
    public function tampil_pesananonline()
    {
        $data = array(
            'header' => 'Data Pesanan',
            'pesananonline' => $this->marketing_m->get_pesananonline(),
        );
        $this->load->view('marketing/datapesanan/pesanan_tampil', $data);
    }

    // TAMPIL DATA WAHANA
    public function tampil_wahana()
    {
        $data = array(
            'header' => 'Data Wahana',
            'tampilwahana' => $this->marketing_m->get_wahana()->result(),
        );
        $this->load->view('marketing/datawahana/wahana_tampil', $data);
    }

    // TAMPIL DATA PAKET WAHANA
    public function tampil_paket()
    {
        $data = array(
            'header' => 'Data Paket',
            'tampilpaket' => $this->marketing_m->get_paket()->result(),
            'tampilwahana' => $this->marketing_m->get_wahana()->result(),
        );
        $this->load->view('marketing/datapaket/paket_tampil', $data);
    }

    // DELETE WAHANA
    public function del_wahana($id)
    {
        $item = $this->marketing_m->get_wahana($id['wahana_id'])->row();
        if ($item->image != null) {
            $target_file = './uploads/foto_wahana/' . $item->image;
            unlink($target_file);
        }
        $this->marketing_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!!!');
        }
        redirect('marketing/tampil_wahana');
    }

    // DELETE WAHANA
    public function del_paket($id)
    {
        $this->marketing_m->del_paket($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data paket berhasil dihapus');
        }
        redirect('marketing/tampil_paket');
    }

    // KE HALAMAN TAMBAH WAHANA
    public function add_wahana()
    {
        $data = array(
            'header' => 'Tambah Data Wahana',
        );
        $this->load->view('marketing/datawahana/wahana_add', $data);
    }

    // KE HALAMAN ADD PAKET
    // public function add_paket()
    // {
    //     $data = array(
    //         'header' => 'Tambah Data Paket',
    //         'tampilwahana' => $this->marketing_m->get_wahana()->result(),
    //     );
    //     $this->load->view('marketing/datapaket/paket_add', $data);
    // }

    public function edit_paket($id)
    {
        $query = $this->marketing_m->get_wahana_by_paket($id);
        // $query = $this->marketing_m->get_wahana()->result();

        if ($query->num_rows() > 0) {
            $data = array(
                'header' => 'Edit Data Paket',
                'row' => $query->row(),
                'tampilselect' => $this->marketing_m->get_wahanaselect($id)->result(),
                'tampilwahana' => $this->marketing_m->get_wahana()->result(),
            );
            // print_r($data);
            // die();
            $this->load->view('marketing/datapaket/paket_edit', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('marketing/edit_paket/') . "';</script>";
        }
    }

    // KE HALAMAN EDIT WAHANA
    public function edit_wahana($id)
    {
        $query = $this->marketing_m->get_wahana($id);
        if ($query->num_rows() > 0) {
            $data = array(
                'header' => 'Edit Data Wahana',
                'row' => $query->row(),
            );
            $this->load->view('marketing/datawahana/wahana_edit', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('marketing/edit_wahana') . "';</script>";
        }
    }

    // KE HALAMAN TAMBAH PAKET
    public function proses_add_paket()
    {
        $code = $this->input->post('add_code', TRUE);
        $name  = $this->input->post('add_name', TRUE);
        $diskon = $this->input->post('add_diskon', TRUE);
        $wahana = $this->input->post('add_wahana', TRUE);

        $paket = array(
            'add_code' => $code,
            'add_name' => $name,
            'add_diskon' => $diskon,
        );
        $this->marketing_m->add_paket($paket, $wahana);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Tambah data paket berhasil disimpan');
            redirect('marketing/tampil_paket');
        }
    }

    public function proses_edit_paket()
    {
        $paket_id = $this->input->post('paket_id', TRUE);
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $diskon = $this->input->post('diskon', TRUE);
        $wahana = $this->input->post('wahana', TRUE);

        $data = array(
            'code' => $code,
            'name' => $name,
            'diskon' => $diskon,
        );
        // print_r($data);
        // die();
        $this->marketing_m->edit_paket($paket_id, $data, $wahana);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Update data paket berhasil');
        }
        redirect('marketing/tampil_paket');
    }

    // PROSES SIMPAN WAHANA
    public function proses_add()
    {
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $price = $this->input->post('price', TRUE);
        $image = $_FILES['image']['name'];

        $data = array(
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'image' => $image
        );

        $config['upload_path'] = './uploads/foto_wahana/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 10240;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $image = null;
            $this->marketing_m->add_wahana($data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data wahana berhasil disimpan!');
            }
            redirect('marketing/tampil_wahana');
        } else {
            $image = $this->upload->data('file_name');
            $this->marketing_m->add_wahana($data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Wahana berhasil disimpan!');
            }
            redirect('marketing/tampil_wahana');
        }
    }

    // PROSES EDIT WAHANA
    public function proses_edit()
    {
        $wahana_id = $this->input->post('wahana_id', TRUE);
        $code = $this->input->post('code', TRUE);
        $name = $this->input->post('name', TRUE);
        $price = $this->input->post('price', TRUE);
        $image = $_FILES['image']['name'];

        $config['upload_path'] = './uploads/foto_wahana';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 10240;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $data = array(
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'image' => $image,
        );

        if ($image = null) {
        } else {
            if (!$this->upload->do_upload('image')) {
                $image = null;
                $where['wahana_id'] = $wahana_id;
                $this->marketing_m->edit_wahana($data, $where);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Update data wahana berhasil disimpan');
                }
                redirect('marketing/tampil_wahana');
            } else {
                $item = $this->marketing_m->get_wahana($wahana_id['wahana_id'])->row();
                if ($item->image != null) {
                    $target_file = './uploads/foto_wahana/' . $item->image;
                    unlink($target_file);
                }

                $image = $this->upload->data('file_name');
                $where['wahana_id'] = $wahana_id;
                $this->marketing_m->edit_wahana($data, $where);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Update data wahana berhasil disimpan');
                }
                redirect('marketing/tampil_wahana');
            }
        }
    }

    function get_wahana_by_paket()
    {
        $paket_id = $this->input->post('paket_id');
        $data = $this->marketing_m->get_wahana_by_paket($paket_id)->result();
        foreach ($data as $result) {
            $value[] = (float) $result->wahana_id;
        }
        echo json_encode($value);
    }

    public function editwahana_active($id)
    {
        $data = array(
            'status' => 1
        );
        $this->db->where('paket_id', $id);
        $this->db->update('tb_paket', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Paket Telah Active');
        }
        redirect('marketing/tampil_paket');
    }

    public function editwahana_inactive($id)
    {
        $data = array(
            'status' => 2
        );
        $this->db->where('paket_id', $id);
        $this->db->update('tb_paket', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Paket Telah Inactive');
        }
        redirect('marketing/tampil_paket');
    }
}
