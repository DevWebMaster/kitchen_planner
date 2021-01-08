<?php
	class Permission_model extends CI_Model{

		public function add_permission($data){
			$this->db->insert('gb_roles_permissions', $data);
			return true;
		}

		//---------------------------------------------------
		// get all permissions for server-side datatable processing (ajax based)
		public function get_all_permissions(){
			$this->db->select('*');
			//$this->db->where('is_admin',1);
			return $this->db->get('gb_roles_permissions')->result_array();
		}

		//---------------------------------------------------
		// Get permission detial by ID
		public function get_permission_by_id($id){
			$query = $this->db->get_where('gb_roles_permissions', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit permission Record
		public function edit_permission($data, $id){
			$this->db->where('id', $id);
			$this->db->update('gb_roles_permissions', $data);
			return true;
		}

		//---------------------------------------------------
		// Change permission status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('rec_status', $this->input->post('rec_status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('gb_roles_permissions');
		} 
	}
?>