<?php

class Midtrans_m extends CI_Model
{
    public function edit($data, $where)
    {
        $param = array(
            'gross_amount' => $data['gross_amount'],
            'payment_type' => $data['payment_type'],
            'transaction_time' => $data['transaction_time'],
            'status_code' => $data['status_code'],
            'bank' => $data['bank'],
            'va_number' => $data['va_number'],
            'pdf_url' => $data['pdf_url'],
        );
        $this->db->where($where);
        $this->db->update('tb_tiketonline', $param);
    }
}
