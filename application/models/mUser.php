<?php 
class mUser extends CI_Model{


	public function login($username, $password){
		// Pengecekan apakah username dan passwordnya sudah ada di database
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		// Mengambil data dari tabel user
		$result = $this->db->get('tb_user');

		// jika user dan pass nya match dengan yg ditabel
		if($result->num_rows() == 1){
			return $result->row_array(); // jika match, melemparkan nilai id nya
		}else{
			return false; // jika tidak
		}
	}

	// Check username udah ada belum
	public function check_username_exists($username){

		// Mengakses database, dan mencari data username yg sama
		$query = $this->db->get_where('tb_user', array('username' => $username));

		// jika tidak ada
		if(empty($query->row_array())){
			return true; // melempar true

		// jika ada
		}else{
			// melempar false
			return false;
		}
	}

	// Method add customer
	public function getUser($id = null){

		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->join('tb_akun', 'tb_akun.id_akun = tb_user.id_akun');

		if($id === null){
			$query = $this->db->get();
			return $query->result_array();

		}else{
			$this->db->where('id_user', $id);
			return $this->db->get()->row_array();
		}
	}

	public function add(){

		$data = [
		// Mengambil data
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'id_akun' => $this->input->post('hak_akses'),

		];

		$this->db->insert('tb_user', $data);

	}
	public function edit($id){

		$data = [
			// Mengambil data
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'id_akun' => $this->input->post('hak_akses'),

		];

		$this->db->where('id_user', $id);
		$this->db->update('tb_user', $data);

	}
	public function delete($id){
		$this->db->where('id_user', $id);
		$this->db->delete('tb_user');
	}
}