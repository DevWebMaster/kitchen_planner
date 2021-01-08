<?php
class Customer_model extends CI_Model{

	public function delete_customer($id)
		{
			$data = array(
				'is_deleted' => 1
			);
		 	$this->db->where('id', $id);
			return $this->db->update('tbl_customers', $data);
		}

		public function set_block_customer($selected_customer_id, $b_flag)
		{
			$data = array(
				'is_blocked' => $b_flag
			);
		 	$this->db->where('id', $selected_customer_id);
			return $this->db->update('tbl_customers', $data);
		}
		public function get_customer_list($search_key, $start, $rowperpage) {
			$this->db->select('*');
			$this->db->from('tbl_customers as a1');
			$this->db->where('a1.is_deleted', 0);
			if($search_key != ''){
				$this->db->like('a1.customer_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_customer_list_all_count() {
			$this->db->select('a1.id');
			$this->db->from('tbl_customers as a1');
			$this->db->where('a1.is_deleted', 0);
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_customer_list_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.id');
			$this->db->from('tbl_customers as a1');
			$this->db->where('a1.is_deleted', 0);
			if($search_key != ''){
				$this->db->like('a1.customer_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_point_rate_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', 0);
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_point_rate_all_count() {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', 0);
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_point_rate_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.min as min_point, a1.max as max_point, a1.price');
			$this->db->from('tbl_point_rate as a1');
			$this->db->where('a1.pos_rate', 0);
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_point_rate($min_point, $max_point, $price, $pos_rate){
			$this->db->select('*');
			$this->db->from('tbl_point_rate');
			$this->db->where('pos_rate', $pos_rate);
			$query = $this->db->get()->result_array();
			if(count($query) > 0){
				return false;
			}else{
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

		public function get_margin_spread_list($search_key, $start, $rowperpage) {
			$this->db->select('*');
			$this->db->from('tbl_customer_margin_spread as a1');
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_margin_spread_all_count() {
			$this->db->select('*');
			$this->db->from('tbl_customer_margin_spread as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_margin_spread_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('*');
			$this->db->from('tbl_customer_margin_spread as a1');
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		
		}
		public function check_exist_row()
		{
			$this->db->select('*');
			$this->db->from('tbl_customer_margin_spread');
			$query = $this->db->get();
			return $query->num_rows();
		}	
		public function update_margin_spread($customer_margin, $customer_spread)	
		{
			$data = array();
			if($customer_margin != '')
				$data['customer_margin'] = $customer_margin;
			if($customer_spread != '')
				$data['customer_spread'] = $customer_spread;

			$this->db->where('id', 1);
			return $this->db->update('tbl_customer_margin_spread', $data);

		}

		public function save_margin_spread($customer_margin, $customer_spread)	
		{
			$data = array(
				'customer_margin' => $customer_margin,
				'customer_spread' => $customer_spread,
			);
			$this->db->insert('tbl_customer_margin_spread', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
	
}

?>