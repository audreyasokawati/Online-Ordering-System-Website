<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cPages extends CI_Controller{

	// Konstruktor
	public function __construct(){
		parent:: __construct();
		// $this->load->model("mOrder");
		$this->load->model("mMenu");

		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

	// default parameter var page adalah home
	public function view($page = "home"){

		$data = $this->data;
		// Memeriksa apakah halaman yang diminta benar2 ada
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			// Error message jika file yg dituju tidak ada
			show_404();
		}

		// menyimpan isi halaman ke array data sbg judul
		$data['title'] = ucfirst($page);
		$data['menu'] = $this->mMenu->getMenu();

		// Memuat view
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}
}
