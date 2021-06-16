<?php 

	class cCodes extends CI_Controller{

	// Konstruktor
	public function __construct(){
		parent:: __construct();
		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

	public function index($pilihan = "tersedia"){
		$data = $this->data;
		
		$data['code'] = $this->mCode->getCode();
		$data['pilihan'] = $pilihan;

		$this->load->view('templates/header', $data);
    $this->load->view('codes/index', $data);
    $this->load->view('templates/footer', $data);
	}

	public function generateCode($length = 10) {

	    $this->mCode->add($length);

	    redirect('ccodes/index');
	}
}