<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-4VHyfRFIUhBiJZ6xqj9cHgM1', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('konsumen_m');
		$this->load->model('midtrans_m');
	}

	public function index()
	{
		$this->load->view('midtrans/checkout_snap');
	}

	public function token()
	{

		$total = $this->input->get('total');
		$order_key = $this->input->get('order_key');
		$order_name = $this->input->get('order_name');
		$telp = $this->input->get('telp');
		$email = $this->input->get('email');
		$tiketonline_id = $this->input->get('tiketonline_id');
		$paket_price = $this->input->get('paket_price');
		$ticket_total = $this->input->get('ticket_total');
		$paket_name = $this->input->get('paket_name');

		// Required
		$transaction_details = array(
			'order_id' => $order_key,
			'gross_amount' => $total  // no decimal allowed for creditcard
		);


		// Optional
		$item1_details = array(
			'id' => $tiketonline_id,
			'price' => $paket_price,
			'quantity' => $ticket_total,
			'name' => $paket_name
		);

		// Optional
		$item2_details = array(
			'id' => $tiketonline_id,
			'price' => 45000,
			'quantity' => $ticket_total,
			'name' => "Tiket Masuk"
		);

		// // Optional
		$item_details = array($item1_details, $item2_details);

		// // Optional
		// $billing_address = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'address'       => "Mangga 20",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16602",
		// 	'phone'         => "081122334455",
		// 	'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		// 	'first_name'    => "Obet",
		// 	'last_name'     => "Supriadi",
		// 	'address'       => "Manggis 90",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16601",
		// 	'phone'         => "08113366345",
		// 	'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
			'first_name'    => $order_name,
			'email'         => $email,
			'phone'         => $telp
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'day',
			'duration'  => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), TRUE);
		// echo '<pre>';
		// var_dump($result);
		// echo '</pre>';
		$data = array(
			'order_id' => $result['order_id'],
			'gross_amount' => $result['gross_amount'],
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
			'bank' => $result['va_numbers'][0]['bank'],
			'va_number' => $result['va_numbers'][0]['va_number'],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code'],
		);
		$this->midtrans_m->add($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Transaksi Berhasil');
		}
		redirect('konsumen/tampil_konsumen');
	}
}
