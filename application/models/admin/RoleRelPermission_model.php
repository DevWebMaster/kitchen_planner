<?php
	class RoleRelPermission_model extends CI_Model{

		public function add_role_rel_permission($data){
			$this->db->insert('gb_roles_rel_permissions', $data);
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
		// get all permissions for server-side datatable processing (ajax based)
		public function get_all_permissions(){
			$this->db->select('*');
			//$this->db->where('is_admin',1);
			return $this->db->get('gb_roles_permissions')->result_array();
		}


		//---------------------------------------------------
		// Get permission detial by ID
		public function get_permissions_by_id($role_id, $permission_id){
			$this->db->select('permission_id');
			$this->db->where('roles_id',$role_id);
                        $this->db->where('permission_id',$permission_id);
			return $this->db->get('gb_roles_rel_permissions')->result_array();                    
//			$query = $this->db->get_where('gb_roles_rel_permissions', array('roles_id' => $id));
//			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Change permission status
		//-----------------------------------------------------
		function update_role_permission()
		{
                    $this->db->delete('gb_roles_permissions');

                    $data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'created_at' => date('Y-m-d : h:m:s'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
				$data = $this->security->xss_clean($data);
				$result = $this->permission_model->add_permission($data);                    
                    $this->db->set('rec_status', $this->input->post('rec_status'));
                    $this->db->where('id', $this->input->post('id'));
                    $this->db->update('gb_roles_permissions');
		} 
	}
?>