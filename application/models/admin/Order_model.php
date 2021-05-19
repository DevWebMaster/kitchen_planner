<?php
	class Order_model extends CI_Model{

	    public function get_all_order_count($pos_id) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a3.id = a1.customer_id', 'left');
			$this->db->where('a1.pos_id', $pos_id);
			$this->db->where('a1.check_flag <>', 0);

			$query = $this->db->get();
			return $query->num_rows();
		}
		public function get_all_order_count_with_filter($pos_id, $search_key) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
			$this->db->where('a1.pos_id', $pos_id);
			$this->db->where('a1.check_flag <>', 0);
			if($search_key != ''){
				$this->db->like('a2.product_name', $search_key);
			}
			
			$query = $this->db->get();

			return $query->num_rows();
		}
		public function get_orderlist($pos_id, $start, $rowperpage, $search_key) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a2.pdf_file, a2.product_name, a3.customer_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
			$this->db->where('a1.pos_id', $pos_id);
			$this->db->where('a1.check_flag <>', 0);
			if($search_key != ''){
				$this->db->like('a2.product_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get()->result_array();
			return $query;
		}
		public function set_check_flag($order_no)
		{
			$data = array(
				'check_flag' => 2,
				'status' => 'Confirmed',
			);
			return $this->db->update('tbl_order',$data, array('order_no' => $order_no ) );
		}
		public function remove_order($id)
		{
			$this->db->select('product_id');
			$this->db->from('tbl_order');
			$this->db->where('id', $id);
			$rtn = $this->db->get()->result_array()[0];

			$data = array(
				'check_order' => 3
			);
			$this->db->update('tbl_product_history_log', $data, array('product_id' => $rtn['product_id']));

			$this->db->where('id', $id);
			return $this->db->delete('tbl_order');
		}
		public function return_order($id)
		{
			$this->db->select('check_flag');
			$this->db->from('tbl_order');
			$this->db->where('id', $id);
			$rtn = $this->db->get()->result_array()[0];

			$status = '';
			if($rtn['check_flag'] == 1)
				$status = 'no-confirm';
			else if($rtn['check_flag'] == 2)
				$status = 'Pre-confirm';
			if($rtn['check_flag'] != 0){
				$data = array(
					'check_flag' => $rtn['check_flag'] - 1,
					'status' => $status
				);
				return $this->db->update('tbl_order', $data, array('id' => $id));
			}else{
				return false;
			}
		}
		public function get_pos_list()
		{
			$this->db->select('*');
			$this->db->from('tbl_pos');
			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_all_pos_order_count($pos_id) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a3.id = a1.customer_id', 'left');
			$this->db->where('a1.pos_id <>', 0);
			if($pos_id != 0){
				$this->db->where('a1.pos_id', $pos_id);
			}
			$this->db->where('a1.check_flag <>', 0);

			$query = $this->db->get();
			return $query->num_rows();
		}
		public function get_all_pos_order_count_with_filter($pos_id, $search_key) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
			$this->db->where('a1.pos_id <>', 0);
			if($pos_id != 0){
				$this->db->where('a1.pos_id', $pos_id);
			}
			$this->db->where('a1.check_flag <>', 0);
			if($search_key != ''){
				$this->db->like('a2.product_name', $search_key);
			}
			
			$query = $this->db->get();

			return $query->num_rows();
		}
		public function get_pos_orderlist($pos_id, $start, $rowperpage, $search_key) {
			$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a2.pdf_file, a2.product_name, a3.customer_name, a4.pos_name');
			$this->db->from('tbl_order as a1');
			$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
			$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
			$this->db->join('tbl_pos as a4', 'a1.pos_id = a4.pos_id', 'left');
			$this->db->where('a1.pos_id <>', 0);
			if($pos_id != 0){
				$this->db->where('a1.pos_id', $pos_id);
			}
			$this->db->where('a1.check_flag <>', 0);
			if($search_key != ''){
				$this->db->like('a2.product_name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_product_info($product_id)
		{
			$this->db->select('product_name');
			$this->db->from('tbl_product_history_log');
			$this->db->where('product_id', $product_id);

			$query = $this->db->get()->result_array();
			return $query[0];
		}
		
		
	}
?>