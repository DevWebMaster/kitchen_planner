<?php
	class Door_setting_model extends CI_Model{

        public function get_door_open_style_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.style_id, a1.name, a1.price');
			$this->db->from('tbl_door_style as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_door_open_style_all_count() {
			$this->db->select('a1.style_id, a1.name');
			$this->db->from('tbl_door_style as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_door_open_style_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.style_id, a1.name');
			$this->db->from('tbl_door_style as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_door_open_style($style_name, $style_price){
			$data = array(
				'name' => $style_name,
				'price' => $style_price
			);
			$this->db->insert('tbl_door_style', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_door_open_style($style_id)
		{
		 	$this->db->where('style_id', $style_id);
			return $this->db->delete('tbl_door_style');
		}

		public function edit_door_open_style($style_id, $edit_style_name, $edit_price)
		{
			$data = array(
				'name' => $edit_style_name,
				'price' => $edit_price
			);
			return $this->db->update('tbl_door_style',$data, array('style_id' => $style_id ) );
		}

		public function get_door_thickness_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.thickness_id, a1.name, a1.price');
			$this->db->from('tbl_door_thickness as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_door_thickness_all_count() {
			$this->db->select('a1.thickness_id, a1.name');
			$this->db->from('tbl_door_thickness as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_door_thickness_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.thickness_id, a1.name');
			$this->db->from('tbl_door_thickness as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_door_thickness($thickness_name, $thickness_price){
			$data = array(
				'name' => $thickness_name,
				'price' => $thickness_price
			);
			$this->db->insert('tbl_door_thickness', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_door_thickness($thickness_id)
		{
		 	$this->db->where('thickness_id', $thickness_id);
			return $this->db->delete('tbl_door_thickness');
		}

		public function edit_door_thickness($thickness_id, $edit_thickness_name, $edit_price)
		{
			$data = array(
				'name' => $edit_thickness_name,
				'price' => $edit_price
			);
			return $this->db->update('tbl_door_thickness',$data, array('thickness_id' => $thickness_id ) );
		}
		
	}
?>