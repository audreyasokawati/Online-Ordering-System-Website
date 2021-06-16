<?php 

class cKasir extends CI_Controller{

		// Konstruktor
	public function __construct(){
		parent:: __construct();

		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

	public function index($pilihan = ""){
		$data = $this->data;

		$data['pilihan'] = $pilihan;
		$data['pembeli'] = $this->mOrder->getCustomer();

		$this->load->view('templates/header', $data);
		$this->load->view('transaction/index', $data);
		$this->load->view('templates/footer', $data);

	}

	public function updateStatus($new_stat, $id_order){

		$this->mOrder->updateStatusOrder($new_stat, $id_order);

		if($new_stat == 2){
			redirect('ckasir/index/konfirmasi');
		}
		elseif($new_stat == 3){
			redirect('ckasir/index/status');
		}
	}

	public function DetailOrder($id_order){
		$data = $this->data;
		$data['pesanan'] = $this->mOrder->getDetailOrderBY_ID($id_order, 1);

			// $data['pembeli'] = $this->mOrder->getCustomer();

		$this->load->view('templates/header', $data);
		$this->load->view('transaction/detail', $data);
		$this->load->view('templates/footer', $data);
		
	}

	public function updateStatusDO_byIDO($new_stat, $id_detail_order, $id_order){
		
		$this->mOrder->updateStatusDO_byIDO($id_detail_order, $new_stat);

		redirect('ckasir/detailOrder/'.$id_order);
		
	}

	public function struk($id_order){
		$data = $this->data;
		$data['pesanan'] = $this->mOrder->getDetailOrderBY_ID($id_order, 1);

			// $data['pembeli'] = $this->mOrder->getCustomer();

		$this->load->view('templates/header', $data);
		$this->load->view('transaction/historiTransaksi', $data);
		$this->load->view('templates/footer', $data);
		
	}
}
