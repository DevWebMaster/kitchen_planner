<?php
	class Materials_model extends CI_Model{

        public function get_material_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.material_id, a1.name, a1.price');
			$this->db->from('tbl_material as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_material_all_count() {
			$this->db->select('a1.material_id, a1.name');
			$this->db->from('tbl_material as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_material_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.material_id, a1.name');
			$this->db->from('tbl_material as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_material($material_name, $material_price){
			$data = array(
				'name' => $material_name,
				'price' => $material_price
			);
			$this->db->insert('tbl_material', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_material($material_id)
		{
		 	$this->db->where('material_id', $material_id);
			return $this->db->delete('tbl_material');
		}

		public function edit_material($material_id, $edit_material_name, $edit_price)
		{
			$data = array(
				'name' => $edit_material_name,
				'price' => $edit_price
			);
			return $this->db->update('tbl_material',$data, array('material_id' => $material_id ) );
		}

		
		
	}
?>