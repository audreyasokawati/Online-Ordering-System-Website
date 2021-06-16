<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cMenus extends CI_Controller{

	// Konstruktor
	public function __construct(){
		parent:: __construct();
		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

	public function index(){
		$data = $this->data;
		
		$data['menu'] = $this->mMenu->getMenu();

		// Memuat tampilan
		$this->load->view('templates/header', $data);
		$this->load->view('menus/index', $data);
		$this->load->view('templates/footer');
	}

	public function list(){
		$data = $this->data;

		$data['menu'] = $this->mMenu->getMenu();

			// Memuat tampilan
		$this->load->view('templates/header', $data);
		$this->load->view('menus/listMenu', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		$data = $this->data;

		// form validation, username dan password harus terisi
		$this->form_validation->set_rules('namaM', 'Nama', 'required');
		$this->form_validation->set_rules('hargaM', 'Harga', 'required');
		$this->form_validation->set_rules('kategoriM', 'Kategori', 'required');
		$this->form_validation->set_rules('statusM', 'Status', 'required');

		if (empty($_FILES['userfile']['name']))
		{
			$this->form_validation->set_rules('userfile', 'Foto', 'required');
		}
		
		// Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){
			// Memuat tampilan
			$this->load->view('templates/header', $data);
			$this->load->view('menus/createMenu');
			$this->load->view('templates/footer');
		// Jika terisi, maka TRUE
		}else{
			// Upload Image
			$config['upload_path'] = './assets/img/menu';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('userfile', FALSE)){
				$errors = array('error' => $this->upload->display_errors());
				$post_image = 'noimage.jpg';
			}else {
				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}

			$this->mMenu->add($post_image);
			redirect('cmenus/list');
		}
	}

	public function edit($id_menu){
		$data = $this->data;
		$data['menu'] = $this->mMenu->getMenu($id_menu);

		// Memuat tampilan
		$this->load->view('templates/header', $data);
		$this->load->view('menus/editMenu', $data);
		$this->load->view('templates/footer');
		
	}

	public function delete($id_menu){
		
		$this->mMenu->delete($id_menu);

		redirect('cmenus/list');
	}

	public function update($id_menu){
		$data = $this->data;
		$data['menu'] = $this->mMenu->getMenu($id_menu);

		// form validation, username dan password harus terisi
		$this->form_validation->set_rules('namaM', 'Nama', 'required');

		// Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){
			// Memuat tampilan
			$this->load->view('templates/header', $data);
			$this->load->view('menus/editMenu', $data);
			$this->load->view('templates/footer');
		// Jika terisi, maka TRUE
		}else{

			// Upload Image
			$config['upload_path'] = './assets/img/menu';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('userfile', FALSE)){
				$errors = array('error' => $this->upload->display_errors());
				$post_image = 'noimage.jpg';
			}else {
				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}
			
			$this->mMenu->edit($id_menu, $post_image);
			redirect('cmenus/list');
		}
	}
}