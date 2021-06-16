<?php 

class mCode extends CI_model{

	// Method add customer
	public function getIdFromCode(){

		$ada = 0;

		return $this->db->get_where('tb_kode', [
			'kodeUnik' => $this->input->post('kode', true),
			'statusKode' => $ada

		])->row_array();
	}

	public function getCode(){

		$query = $this->db->get('tb_kode');
		return $query->result_array();
	}

	// method update code
	public function updateCode($id){
		$new_stat = 1;

		$data = ['statusKode' => $new_stat];

		$this->db->where('id_kode', $id);
		$this->db->update('tb_kode', $data);
	}

	public function add($length){

		for ($i = 0; $i < $length; $i++) {
			$randomString = bin2hex(random_bytes(3));

			$data = [
				"kodeUnik" => $randomString,
				"statusKode" => 0
			];

			$this->db->insert('tb_kode', $data);
		}
	}
}
