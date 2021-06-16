<?php 

class mOrder extends CI_model{

// ========================= ORDER
	// Method add customer
	public function addCustomer($input){

		$temp = 0;
		$tempS = "temp";

		$data = [
			"id_kode" => $input['id_kode'],
			"no_meja" => $this->input->post('noMeja', true),
			"nama_pembeli" => $this->input->post('nama', true),	
			"total_harga" => $temp,
			"status_order" => $temp,
			"jenisPembayaran" => $tempS
		];

		// insert ke database
		$this->db->insert('tb_order', $data);
	}	

	// Method get customer
	public function getCustomer($id = null){
		if($id === null){
			$query = $this->db->get('tb_order');
			return $query->result_array();

		}else{
			return $this->db->get_where('tb_order', ['id_kode' => $id])->row_array();
		}
	}

	public function updateOrder($id_order, $total, $status = 1){

		$data = [
			'total_harga'		=> $total,
			'status_order' => $status
		];

		$this->db->where('id_order', $id_order);
		return $this->db->update('tb_order', $data);
	}

	public function updateStatusOrder($new_stat, $id_order){
		$data = [
			'status_order' => $new_stat
		];

		$this->db->where('id_order', $id_order);
		$this->db->update('tb_order', $data);
	}

	public function updateJenisPembayaran($id_order){
		$data = [
			'jenisPembayaran' => $this->input->post('pembayaran')
		];

		$this->db->where('id_order', $id_order);
		$this->db->update('tb_order', $data);
	}

// DETAIL ORDER
	public function delete_DO($id_detail_order)
	{
		$this->db->where('id_detail_order', $id_detail_order);
		$this->db->delete('tb_detail_order');
	}

	// Method add order
	public function addOrder($dataMenu){

		// order tabel pesanan berdasarkan no_pesanan, descending
		$this->db->order_by('id_order', 'DESC');
		// ambil paling atas
		$this->db->limit(1);

		// ambil data pesanan yang sama dan belum dibayar
		$pesananSudahAda = $this->db->get_where('tb_detail_order', [
			'id_order' => $this->session->userdata('id_order'), 
			'id_menu' => $dataMenu['id_menu'],
			'status_detail_order' => 0
		])->row_array();


		// kalau sama menu id nya (dicek lagi)
		if ($pesananSudahAda) {
			$data = [
				'id_order'=> $this->session->userdata('id_order'), // id_order
				'id_menu'		=> $pesananSudahAda['id_menu'],
				'jumlah_order'	=> $pesananSudahAda['jumlah_order'] + 1, // ditambah quantitynya
				'subtotal_order'	=> $pesananSudahAda['subtotal_order'] + $dataMenu['harga_menu'], // ditambah harganya
				'status_detail_order' => 0
			];

			// di update jumlah pesanannya
			$this->db->where('id_order', $this->session->userdata('id_order'));
			$this->db->where('id_menu', $dataMenu['id_menu']);
			$this->db->where('status_detail_order', 0);
			$this->db->update('tb_detail_order', $data);

		// kalau null
		} else {
			$data = [
				'id_order'=> $this->session->userdata('id_order'), // id_order
				'id_menu'		=> $dataMenu['id_menu'],
				'jumlah_order'	=> 1, // diset 1
				'subtotal_order'	=> $dataMenu['harga_menu'], // ditambah harganya
				'status_detail_order' => 0
			];

			// di insert
			$this->db->insert('tb_detail_order', $data);
		}
	}

	// UPDATE status detail order by id order
	public function updateStatusDO_byID($id_order, $new_stat){

		$data = [
			'status_detail_order' => $new_stat
		];

		$this->db->where('id_order', $id_order);

		if($new_stat == 1){
			$this->db->where('status_detail_order', 0);
		}

		$this->db->update('tb_detail_order', $data);

	}

	// UPDATE status detail order by id detail order
	public function updateStatusDO_byIDO($id_detail_order, $new_stat){
		$data = [
			'status_detail_order' => $new_stat
		];

		$this->db->where('id_detail_order', $id_detail_order);
		$this->db->update('tb_detail_order', $data);
	}

	// Method Get Detail Order BY ID_Detail_Order
	public function getDetailOrderBY_IDO($id_detail_order)
	{
		$this->db->select('*');
		$this->db->from('tb_detail_order');
		$this->db->join('tb_menu', 'tb_menu.id_menu = tb_detail_order.id_menu');
		$this->db->where('id_detail_order', $id_detail_order);

		return $this->db->get()->row_array();
	}

	// Method Get Detail Order BY ID_Order
	public function getDetailOrderBY_ID($id, $status = null){

		$this->db->select('*');
		$this->db->from('tb_detail_order');
		$this->db->join('tb_menu', 'tb_menu.id_menu = tb_detail_order.id_menu');
		$this->db->where('id_order', $id);
		
		if($status === null){
			$this->db->where('status_detail_order', 0);
		}else{
			$this->db->where('status_detail_order !=', 0);
		}

		return $this->db->get()->result_array();		
	}

		// Method Get Detail Order BY ID_Order
	public function getDetailOrder($id_order, $status = null){

		$this->db->where('id_order', $id_order);

		if($status === null){
			return $this->db->get('tb_detail_order')->result_array();
			
		}else{		
			$this->db->where('status_detail_order', $status);
			return $this->db->get('tb_detail_order')->result_array();
		}
	}

	public function updateDO($id_detail_order, $data){
		$this->db->where('id_detail_order', $id_detail_order);
		$this->db->update('tb_detail_order', $data);
	}

}