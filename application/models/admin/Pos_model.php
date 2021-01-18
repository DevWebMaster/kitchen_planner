<?php
	class Pos_model extends CI_Model{

		public function save_pos($data){
			$this->db->insert('tbl_pos', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function edit_pos($id, $data)
		{
			return $this->db->update('tbl_pos', $data, array('pos_id'=>$id));
		}

		public function delete_pos($id)
		{
			$data = array(
				'is_deleted' => 1
			);
		 	$this->db->where('pos_id', $id);
			return $this->db->update('tbl_pos', $data);
		}

		public function set_block_pos($selected_pos_id, $b_flag)
		{
			$data = array(
				'is_blocked' => $b_flag
			);
		 	$this->db->where('pos_id', $selected_pos_id);
			return $this->db->update('tbl_pos', $data);
		}

		public function get_pos_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.pos_id, a1.pos_name, a1.company_name, a1.CIF, a1.phone_num, a1.zipcode, a1.coordinates, a1.is_blocked, a1.address, a1.lat as position_lat, a1.lon as position_lon, a1.password, a1.email, a1.description');
			$this->db->from('tbl_pos as a1');
			$this->db->where('a1.is_deleted', 0);
			if($search_key != ''){
				$this->db->like('a1.pos_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_pos_list_all_count() {
			$this->db->select('a1.pos_id');
			$this->db->from('tbl_pos as a1');
			$this->db->where('a1.is_deleted', 0);
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_pos_list_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.pos_id');
			$this->db->from('tbl_pos as a1');
			$this->db->where('a1.is_deleted', 0);
			if($search_key != ''){
				$this->db->like('a1.pos_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_point_rate_list($search_key, $start, $rowperpage, $pos_rate) {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', $pos_rate);
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_point_rate_all_count($pos_rate) {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', $pos_rate);
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_point_rate_all_count_with_filter($search_key, $start, $rowperpage, $pos_rate) {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', $pos_rate);
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_point_rate($min_point, $max_point, $price, $pos_rate){
			$data = array(
				'min' => $min_point,
				'max' => $max_point,
				'price' => $price,
				'pos_rate' => $pos_rate
			);
			$this->db->insert('tbl_point_rate', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_point_rate($id)
		{
		 	$this->db->where('id', $id);
			return $this->db->delete('tbl_point_rate');
		}

		public function edit_point_rate($id, $edit_min_point, $edit_max_point, $edit_price)
		{
			$data = array(
				'min' => $edit_min_point,
				'max' => $edit_max_point,
				'price' => $edit_price
			);
			return $this->db->update('tbl_point_rate',$data, array('id' => $id ) );
		}
		public function edit_pos_location($id, $data)
		{
			return $this->db->update('tbl_pos_locations', $data, array('id'=>$id));
		}

		public function get_margin_spread_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.*, a2.pos_name');
			$this->db->from('tbl_pos_margin_spread as a1');
			$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_margin_spread_all_count() {
			$this->db->select('a1.*, a2.pos_name');
			$this->db->from('tbl_pos_margin_spread as a1');
			$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_margin_spread_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.*, a2.pos_name');
			$this->db->from('tbl_pos_margin_spread as a1');
			$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		
		}	
		public function update_margin_spread($pos_id, $pos_margin, $pos_spread, $pos_customer_margin, $pos_customer_spread)	
		{
			$data = array(
				'pos_margin' => $pos_margin,
				'pos_spread' => $pos_spread,
				'pos_customer_margin' => $pos_customer_margin,
				'pos_customer_spread' => $pos_customer_spread,
			);

			$this->db->where('pos_id', $pos_id);
			return $this->db->update('tbl_pos_margin_spread', $data);

		}

		public function save_margin_spread($pos_id, $pos_margin, $pos_spread, $pos_customer_margin, $pos_customer_spread)	
		{
			$data = array(
				'pos_id' => $pos_id,
				'pos_margin' => $pos_margin,
				'pos_spread' => $pos_spread,
				'pos_customer_margin' => $pos_customer_margin,
				'pos_customer_spread' => $pos_customer_spread,
			);
			$this->db->insert('tbl_pos_margin_spread', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}

		public function get_pos()
		{
			$this->db->select('*');
			$this->db->from('tbl_pos');

			$query = $this->db->get()->result_array();
			return $query;
		}
	}
?>