<?php
	class Role_model extends CI_Model{

		public function add_role($data){
			$this->db->insert('gb_roles', $data);
			return true;
		}

		//---------------------------------------------------
		// get all roles for server-side datatable processing (ajax based)
		public function get_all_roles(){
			$this->db->select('*');
			//$this->db->where('is_admin',1);
			return $this->db->get('gb_roles')->result_array();
		}


		//---------------------------------------------------
		// Get role detial by ID
		public function get_role_by_id($id){
			$query = $this->db->get_where('gb_roles', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit role Record
		public function edit_role($data, $id){
			$this->db->where('id', $id);
			$this->db->update('gb_roles', $data);
			return true;
		}

		//---------------------------------------------------
		// Change role status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('rec_status', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('gb_roles');
		} 

	}

?>