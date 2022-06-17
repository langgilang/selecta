<?php

class Midtrans_m extends CI_Model
{
    public function add($data)
    {
        $param = array(
            'order_id' => $data['order_id'],
            'gross_amount' => $data['gross_amount'],
            'payment_type' => $data['payment_type'],
            'transaction_time' => $data['transaction_time'],
            'bank' => $data['bank'],
            'va_number' => $data['va_number'],
            'pdf_url' => $data['pdf_url'],
            'status_code' => $data['status_code'],
        );
        $this->db->insert('tb_transaksi', $param);
    }
}
