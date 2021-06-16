<?php 

class mMenu extends CI_model{

	// Method add customer
	public function getMenu($id = null){


		if($id === null){
			$query = $this->db->get('tb_menu');
			return $query->result_array();
			
		}else{
			return $this->db->get_where('tb_menu', ['id_menu' => $id])->row_array();
		}
	}

	public function add($menu_image){

		$data = [
			// Mengambil data
			'nama_menu' => $this->input->post('namaM'),
			'kategori_menu' => $this->input->post('kategoriM'),
			'harga_menu' => $this->input->post('hargaM'),
			'foto_menu' => $menu_image,
			'status_menu' => $this->input->post('statusM')

		];

		$this->db->insert('tb_menu', $data);

	}
	public function edit($id, $menu_image){

		$data = [
			// Mengambil data
			'nama_menu' => $this->input->post('namaM'),
			'kategori_menu' => $this->input->post('kategoriM'),
			'harga_menu' => $this->input->post('hargaM'),
			'foto_menu' => $menu_image,
			'status_menu' => $this->input->post('statusM')
		];

		$this->db->where('id_menu', $id);
		$this->db->update('tb_menu', $data);

	}

	public function delete($id){
		$image_file_name = $this->db->select('foto_menu')->get_where('tb_menu', array('id_menu' => $id))->row()->foto_menu;

		unlink($image_file_name);

		$this->db->where('id_menu', $id);
		$this->db->delete('tb_menu');
	}
}
