<?php
	class Point_setting_model extends CI_Model{

        public function get_furniture_cube_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.cube_id, a1.name');
			$this->db->from('tbl_furniture_cube as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_furniture_cube_all_count() {
			$this->db->select('a1.cube_id, a1.name');
			$this->db->from('tbl_furniture_cube as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_furniture_cube_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.cube_id, a1.name');
			$this->db->from('tbl_furniture_cube as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_furniture_cube($furniture_cube_name){
			$data = array(
				'name' => $furniture_cube_name
			);
			$this->db->insert('tbl_furniture_cube', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_furniture_cube($furniture_cube_id)
		{
		 	$this->db->where('cube_id', $furniture_cube_id);
			return $this->db->delete('tbl_furniture_cube');
		}

		public function get_model_point_list($search_key, $start, $rowperpage, $furniture_cube_id) {
			$this->db->select('a1.*, a2.name as cube_type');
			$this->db->from('tbl_model_point_list as a1');
			$this->db->join('tbl_furniture_cube as a2', 'a1.cube = a2.cube_id', 'left');
			$this->db->where('a1.cube', $furniture_cube_id);
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_model_point_list_all_count($furniture_cube_id) {
			$this->db->select('a1.id');
			$this->db->from('tbl_model_point_list as a1');
			$this->db->join('tbl_furniture_cube as a2', 'a1.cube = a2.cube_id', 'left');
			$this->db->where('a1.cube', $furniture_cube_id);
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_model_point_list_all_count_with_filter($search_key, $start, $rowperpage, $furniture_cube_id) {
			$this->db->select('a1.id');
			$this->db->from('tbl_model_point_list as a1');
			$this->db->join('tbl_furniture_cube as a2', 'a1.cube = a2.cube_id', 'left');
			$this->db->where('a1.cube', $furniture_cube_id);
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_model_point($furniture_cube_id, $model_width, $model_length, $level1, $level2, $level3){
			$data = array(
				'cube' => $furniture_cube_id,
				'width' => $model_width,
				'length' => $model_length,
				'level1' => $level1,
				'level2' => $level2,
				'level3' => $level3
			);
			$this->db->insert('tbl_model_point_list', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_model_point($id)
		{
		 	$this->db->where('id', $id);
			return $this->db->delete('tbl_model_point_list');
		}

		public function edit_model_point($id, $model_width, $model_length, $level1, $level2, $level3)
		{
			$data = array(
				'width' => $model_width,
				'length' => $model_length,
				'level1' => $level1,
				'level2' => $level2,
				'level3' => $level3
			);
			return $this->db->update('tbl_model_point_list',$data, array('id' => $id ) );
		}
		
	}
?>