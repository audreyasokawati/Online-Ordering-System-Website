<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cOrders extends CI_Controller{

	// Konstruktor
	public function __construct(){
		parent:: __construct();
		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

	// default parameter var page adalah home
	public function entrycode(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('noMeja', 'Nomor Meja', 'required');

    // Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){

			$this->session->set_flashdata('failed', "Gagal");
			// Memanggil view
			$this->load->view('templates/header');
			// session di message box nya
			$this->load->view('pages/home');
			$this->load->view('templates/footer');

		// Jika terisi, maka TRUE
		}else{
	    // ambil id dari kode yang di input user
			$data = $this->mCode->getIdFromCode();

			// jika id nya ada
			if($data){

				// add data
				$this->mOrder->addCustomer($data);
				$id_cus = $this->mOrder->getCustomer($data['id_kode']);

				// session bawa nama dan kode nya
				// create session
				$order_data = array(
					'id_order' => $id_cus['id_order'],
					'kode' => $data['id_kode'],
					'nama' => $this->input->post('nama'),
					'no_meja' => $this->input->post('noMeja'),
					'customer' => true
				);

					// Session terset
				$this->session->set_userdata($order_data);

					// set pesan
				$this->session->set_flashdata('cus_ordering', "Silahkan memilih menu yang akan dipesan.");

					// update status code
				$this->mCode->updateCode($data['id_kode']);


				redirect(base_url('cmenus'));
				// redirect('')
			}else{
				// error message kode tidak tersedia
				$this->session->set_flashdata('failed', 'Maaf Kode yang Anda Masukkan Salah, Hubungi Pelayan Kami untuk Mendapatkan Kode yang Benar');
				redirect('');
			}
		}
	}

	public function order($id_menu){
		// ambil harga menu
		$data = $this->mMenu->getMenu($id_menu);

		// insert data ke detail order
		$this->mOrder->addOrder($data);		

		$this->session->set_flashdata('flash', 'Pesanan Berhasil Ditambahkan');

		redirect('cmenus');
	}

	public function cart($pilihan = null){

		$data = $this->data;

		if($pilihan === null){		
			$data['pilihan'] = "cart";
			$data['pesanan'] = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));
		}
		else{
			$data['pilihan'] = "cartDone";
			$data['pesanan'] = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'), 2);
		}

		$totalBayar = 0;
		foreach ($data['pesanan'] as $pesanan) {
			$totalBayar += $pesanan['subtotal_order'];
		}

		$data['total_bayar'] = $totalBayar;

		$this->load->view('templates/header', $data);
		$this->load->view('orders/index', $data);
		$this->load->view('templates/footer');
	}

	public function done($id, $new_stat){
		
		// ambil data detail ordernya dulu
		$pesanan = $this->mOrder->getDetailOrder($id);
		$masihAda = 0;


		foreach ($pesanan as $p) {
			if($p['status_detail_order'] == 1){
				$masihAda++;
			}
		}

		if(!$this->session->userdata('id_akun') == 1){


			if($masihAda == 0){
				foreach ($pesanan as $p) {
					if($p['status_detail_order'] == 0){
						// hapus yang statusnya masih 0
						$this->mOrder->delete_DO($p['id_detail_order']);
					}
				}

				// ganti status ke berakhir
				$this->mOrder->updateStatusDO_byID($id, $new_stat);
				
				// Unset user data
				$this->session->unset_userdata('id_order');
				$this->session->unset_userdata('kode');
				$this->session->unset_userdata('nama');
				$this->session->unset_userdata('no_meja');
				$this->session->unset_userdata('customer');
				$this->session->unset_userdata('terbayar');

				// 	// set message
				$this->session->set_flashdata('customer_done', 'Terima Kasih Telah Berkunjung');

				redirect('');
			}else{

				// masih ada pesanan yang belum selesai
				$this->session->set_flashdata('flash', 'Pesanan belum dapat diselesaikan karena masih ada makanan dalam proses pembuatan.');

				redirect('corders/cart/Done');
			}
		}else{

			if($masihAda == 0){
				foreach ($pesanan as $p) {
					if($p['status_detail_order'] == 0){
						$this->mOrder->delete_DO($p['id_detail_order']);
					}
				}

				$this->mOrder->updateStatusDO_byID($id, $new_stat);

				$this->mOrder->updateOrder($id, 0, 0);

				$this->session->unset_userdata('terbayarAdmin');
				// 	// set message
				$this->session->set_flashdata('customer_done', 'Terima Kasih Telah Berkunjung');

				redirect('cmenus');
			}else{
				// masih ada pesanan yang belum selesai
				$this->session->set_flashdata('flash', 'Pesanan belum dapat diselesaikan karena masih ada makanan dalam proses pembuatan.');

				redirect('corders/cart/Done');
			}
		}

	}

	public function tambah($id_detail_order){

		// ambil data
		$pesanan = $this->mOrder->getDetailOrderBY_IDO($id_detail_order);

		$data = [
			'jumlah_order'	=> $pesanan['jumlah_order'] + 1,
			'subtotal_order'	=> $pesanan['subtotal_order'] + $pesanan['harga_menu']
		];


		$this->mOrder->updateDO($id_detail_order, $data);

		redirect('corders/cart');
	}

	public function kurang($id_detail_order){

		// ambil data
		$pesanan = $this->mOrder->getDetailOrderBY_IDO($id_detail_order);

		if($pesanan['jumlah_order'] >= 2){	
			$data = [
				'jumlah_order'	=> $pesanan['jumlah_order'] - 1,
				'subtotal_order'	=> $pesanan['subtotal_order'] - $pesanan['harga_menu']
			];
			
			$this->mOrder->updateDO($id_detail_order, $data);
	
		}

		redirect('corders/cart');
	}

	public function deleteDetailOrder($id_detail_order){

		$hasil = $this->mOrder->delete_DO($id_detail_order);

		if($hasil){
			$this->session->set_flashdata('flash', "Pesanan berhasil dihapus.");
		}

		redirect('corders/cart');
	}

	public function bayar($id_order, $new_stat){

		$this->mOrder->updateJenisPembayaran($id_order);

		$pesanan = $this->mOrder->getDetailOrder($id_order);
		
		$total = 0;
		foreach ($pesanan as $p) {
			$total += $p['subtotal_order'];
		}

		
		$hasil = $this->mOrder->updateOrder($id_order, $total);

		if($hasil){

			// ganti status detail order
			$this->mOrder->updateStatusDO_byID($id_order, $new_stat);

			$this->session->set_flashdata('flash', "Pembayaran selesai.");
		}

		if($this->session->userdata('customer')){
			$this->session->set_userdata('terbayar', true);
		}else if($this->session->userdata('logged_in')){
			$this->session->set_userdata('terbayarAdmin', true);
		}


		redirect('corders/cart/Done');
	}
}
