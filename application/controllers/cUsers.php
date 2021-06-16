<?php 

class cUsers extends CI_Controller{

		// Konstruktor
	public function __construct(){
		parent:: __construct();
		$pesanan = $this->mOrder->getDetailOrderBY_ID($this->session->userdata('id_order'));
		

		$this->data['notif_pesanan'] = 0;
		
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['jumlah_order'];
		}
	}

		// Log in users
	public function login(){

		$data = $this->data;

			// Mengisi array data title dengan tulisan Sign In
		$data['title'] = 'SIGN IN';

			// form validation, username dan password harus terisi
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
			// Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){
				// Memanggil view
			$this->load->view('templates/header', $data);
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');

			// Jika terisi, maka TRUE
		}else{
			
				// Mengambil data username
			$username = $this->input->post('username');

				// Mengambil data username dan di enkripsi
			$password = $this->input->post('password');

				// Memanggil model (mUser), masuk ke function login dengan membawa parameter username, password
				// Return value dari model
			$user = $this->mUser->login($username, $password);

				// jika ada user_id nya
			if($user){
					// create session
				$user_data = array(
					'user_id' => $user['id_user'],
					'id_akun' => $user['id_akun'],
					'id_order' => 0,
					'username' => $username,
					'logged_in' => true
				);

					// Session terset
				$this->session->set_userdata($user_data);

					// set pesan
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');

				if($user['id_akun'] == 1){
					redirect('cmenus');
				}
				else{
					redirect('ckasir/index');
				}

			}else{
					// set pesan
				$this->session->set_flashdata('login_failed', 'Username / password salah');
				redirect('cusers/login');

			}
		}
	}

		// Log user out
	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('id_akun');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('terbayarAdmin');

			// set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');

				// dialihkan ke controller users, fungsi login	
		redirect('cusers/login');
	}

	public function listUsers(){

		$data = $this->data;

		$data['users'] = $this->mUser->getUser();
		$data['pilihan'] = "list";


			// Memuat tampilan
		$this->load->view('templates/header', $data);
		$this->load->view('users/listUser', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		$data = $this->data;

			// form validation
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
		
			// Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){

				// Memuat tampilan
			$data['users'] = $this->mUser->getUser();
			$data['pilihan'] = "list";

			$this->load->view('templates/header', $data);
			$this->load->view('users/listUser', $data);
			$this->load->view('templates/footer');
			// Jika terisi, maka TRUE
		}else{
			$this->mUser->add();

			redirect('cusers/listUsers');
		}
	}

		// Pengecekan username udah ada / belum
	public function check_username_exists($username){
		// Set pesan
		$this->form_validation->set_message('check_username_exists', 'Username sudah dipakai.');

			// Memanggil model (mUser) dengan fungsi check_username_exists yg melempar data username
		if($this->mUser->check_username_exists($username)){
				return true; // melempar true
			}else{
				return false; // melempar false
			}
		}

	public function edit($id_user){
		$data = $this->data;
		$data['users'] = $this->mUser->getUser();
		$data['user'] = $this->mUser->getUser($id_user);
		$data['pilihan'] = "edit";

		// form validation
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
		
		// Form validation awalnya otomatis false
		if($this->form_validation->run() === FALSE){
			// Memuat tampilan
			$this->load->view('templates/header', $data);
			$this->load->view('users/listUser', $data);
			$this->load->view('templates/footer');
		// Jika terisi, maka TRUE
		}else{
			$this->mUser->edit($id_user);

			redirect('cusers/listUsers');
		}
	}
	
	public function delete($id_user){
		
		$this->mUser->delete($id_user);

		redirect('cusers/listUsers');
	}
}