<?php
	class Colors_model extends CI_Model{

        public function get_color_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.color_id, a1.name, a1.price');
			$this->db->from('tbl_color as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_color_all_count() {
			$this->db->select('a1.color_id, a1.name');
			$this->db->from('tbl_color as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_color_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.color_id, a1.name');
			$this->db->from('tbl_color as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_color($color_name, $color_price){
			$data = array(
				'name' => $color_name,
				'price' => $color_price
			);
			$this->db->insert('tbl_color', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_color($color_id)
		{
		 	$this->db->where('color_id', $color_id);
			return $this->db->delete('tbl_color');
		}

		public function edit_color($color_id, $edit_color_name, $edit_price)
		{
			$data = array(
				'name' => $edit_color_name,
				'price' => $edit_price
			);
			return $this->db->update('tbl_color',$data, array('color_id' => $color_id ) );
		}

		
		
	}
?>