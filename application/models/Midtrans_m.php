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
            'transaction_status' => $data['transaction_status'],
            'bank' => $data['bank'],
            'va_number' => $data['va_number'],
            'pdf_url' => $data['pdf_url'],
        );
        $this->db->insert('tb_transaksi', $param);
    }
}
