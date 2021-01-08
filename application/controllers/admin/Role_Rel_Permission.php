<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Role_Rel_Permission extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('admin/rolerelpermission_model', 'rolerelpermission_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
            $data['roles'] = $this->rolerelpermission_model->get_all_roles();
            $data['permissions'] = $this->rolerelpermission_model->get_all_permissions();
            
            foreach ($data['roles'] as $role) {
                foreach ($data['permissions'] as $permission) {
                    $chkboxId = $role['id']."_".$permission['id'];
                    $k = $this->rolerelpermission_model->get_permissions_by_id($role['id'],$permission['id']);
                    if($k)
                    {
                        
                        $data['chkbox'][$chkboxId] = 1;
                    }
                    else {
                        $data['chkbox'][$chkboxId] = 0;
                    }
                }
            }
            
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/role_rel_permission/role_rel_permission',$data);
            $this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->permission_model->get_all_permissions();
       
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['rec_status'] == 1)? 'checked': '';
			$data[]= array(
                                $row['id'],		
                                $row['title'],
				$row['description'],
				'<input class="tgl_checkbox tgl-ios" data-id="'.$row['id'].'" 				id="cb_'.$row['id'].'" type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/permission/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/permission/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/permission/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function update_role_permission()
	{   
            $this->rolerelpermission_model->update_role_permission();
            
            $this->db->empty_table('gb_roles_rel_permissions');
            
            $roles = $this->rolerelpermission_model->get_all_roles();
            $permissions = $this->rolerelpermission_model->get_all_permissions();

            foreach ($roles as $role) 
            {
                foreach ($permissions as $permission) 
                {
                    $field = $role['id']."_".$permission['id'];
        
                    if(isset($_POST[$field]))
                    {
                        $data = array(
				'roles_id' => $role['id'],
				'permission_id' => $permission['id'],
				'created_at' => date('Y-m-d : h:m:s'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->rolerelpermission_model->add_role_rel_permission($data);
                    }
                }
            }
            if($result){
            	// Activity Log 
            	$this->activity_model->add_log(1);
		$this->session->set_flashdata('success', 'Roels and Permission has been updated successfully!');
                redirect(base_url('admin/Role_Rel_Permission'));
            }

	}

	public function add(){
		
		//$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/permission/add'),'refresh');
			}
			else{
				$data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->permission_model->add_permission($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Permission has been added successfully!');
					redirect(base_url('admin/permission'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/permission/Permission_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('rec_status', 'Status', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/permission/permission_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'rec_status' => $this->input->post('rec_status'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->permission_model->edit_permission($data, $id);
                                
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Permission has been updated successfully!');
					redirect(base_url('admin/permission'));
				}
			}
		}
		else{
                        $data['permission'] = $this->permission_model->get_permission_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/permission/permission_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('gb_roles_permissions', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Permission has been deleted successfully!');
		redirect(base_url('admin/permission'));
	}

}


?>