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
        $query = $this->marketing_m->total_wahana();
        $query2 = $this->marketing_m->total_paket();
        $query3 = $this->marketing_m->total_paket_non_diskon();
        $query4 = $this->marketing_m->total_paket_diskon();
        if ($query->num_rows == 0 || $query2->num_rows == 0 || $query3->num_rows == 0 || $query4->num_rows == 0) {
            $data = array(
                'header' => 'Dashboard',
                'total_wahana' => $query->row(),
                'total_paket' => $query2->row(),
                'diskon' => $query3->row(),
                'gak_diskon' => $query4->row(),
            );
            $this->load->view('marketing/dashboard/dashboard_tampil', $data);
        }
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
        $item = $this->marketing_m->get_wahana($id)->row();
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

        if ($this->marketing_m->check_paket_code($code)->num_rows() > 0) {
            $this->session->set_flashdata('error', "Kode paket $code sudah digunakan!");
            redirect('marketing/tampil_paket');
        } else {
            $this->marketing_m->add_paket($paket, $wahana);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tambah data paket berhasil disimpan');
                redirect('marketing/tampil_paket');
            }
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
    public function proses()
    {
        $config['upload_path'] = './uploads/foto_wahana/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 10240;
        $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->upload->initialize($config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambahwahana'])) {
            if ($this->marketing_m->check_wahana_code($post['code'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Kode wahana $post[code] sudah digunakan!");
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->marketing_m->add_wahana($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data Wahana berhasil disimpan!');
                            redirect('marketing/tampil_wahana');
                        }
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('marketing/tampil_wahana');
                    }
                } else {
                    $post['image'] = null;
                    $this->marketing_m->add_wahana($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data Wahana berhasil disimpan!');
                        redirect('marketing/tampil_wahana');
                    }
                }
            }
        } else if (isset($_POST['editwahana'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post['image'] = $this->upload->data('file_name');

                    $item = $this->marketing_m->get_wahana($post['wahana_id'])->row();
                    if ($item->image != null) {
                        $target_file = './uploads/foto_wahana/' . $item->image;
                        unlink($target_file);
                    }

                    $this->marketing_m->edit_wahana($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Updated wahana berhasil disimpan!');
                    }
                    redirect('marketing/tampil_wahana');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('marketing/tampil_wahana');
                }
            } else {
                $post['image'] = null;
                $this->marketing_m->edit_wahana($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Updated wahana berhasil disimpan!');
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

    public function editpaket_active($id)
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

    public function editpaket_inactive($id)
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

    public function editwahana_active($id)
    {
        $data = array(
            'status' => 1
        );
        $this->db->where('wahana_id', $id);
        $this->db->update('tb_wahana', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Wahana Telah Active');
        }
        redirect('marketing/tampil_wahana');
    }

    public function editwahana_inactive($id)
    {
        $data = array(
            'status' => 2
        );
        $this->db->where('wahana_id', $id);
        $this->db->update('tb_wahana', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Wahana Telah Inactive');
        }
        redirect('marketing/tampil_wahana');
    }
}
