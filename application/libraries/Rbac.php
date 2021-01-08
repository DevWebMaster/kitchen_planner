<?php
class RBAC 
{	
	private $module_access;
	function __construct()
	{
		$this->obj =& get_instance();
		$this->obj->module_access = $this->obj->session->userdata('module_access');
                $this->obj->permission_id = $this->obj->session->userdata('permission_id');
		$this->obj->is_super = $this->obj->session->userdata('is_super');
	}

	//----------------------------------------------------------------
	function set_access_in_session()
	{
            	$this->obj->db->select('
	    			gb_roles_rel_module.roles_id,
	    			gb_roles_rel_module.module_id,
	    			gb_module.module_name,
                                gb_module.controller_name,'
	    	);
	    	$this->obj->db->from('gb_roles_rel_module');
	    	$this->obj->db->join('gb_module', 'gb_roles_rel_module.module_id = gb_module.module_id ', 'left');
	    	$query = $this->obj->db->get();					 
		$data=array();
		foreach($query->result_array() as $v)
		{
                    $data[$v['module_name']] = '';
		}
	
		$this->obj->session->set_userdata('module_access',$data);

                $this->obj->db->from('gb_roles_rel_permissions');
		$this->obj->db->where('roles_id',$this->obj->session->userdata('admin_role_id'));
		$query=$this->obj->db->get();
		$data=array();
		foreach($query->result_array() as $v)
		{
			$data[$v['permission_id']] = '';
		}
	
		$this->obj->session->set_userdata('permission_id',$data);
                
	}

	
	//--------------------------------------------------------------	
	function check_module_access()
	{	

		if($this->obj->is_super){
			return 1;
		}
		elseif(!$this->check_module_permission($this->obj->uri->segment(2))) //sending controller name
		{
			$back_to = $_SERVER['REQUEST_URI'];
			$back_to = $this->obj->functions->encode($back_to);
			redirect('access_denied/index/'.$back_to);
		}
	}

	//--------------------------------------------------------------	
	function check_module_permission($module) // $module is controller name
	{
		$access = false;
		
                //return true;
		if($this->obj->is_super)
			return true;
		elseif(isset($this->obj->module_access[$module])){
                    return 1;
//			foreach($this->obj->module_access[$module] as $key => $value)
//			{
//			  if($key == 'access') {
//			  	$access = true;
//			  }
//			}
//
//			if($access)
//				return 1;
//			else 
//			 	return 0;
		}
                else{
                    return 0;
                }
	}

	//--------------------------------------------------------------	
//	function check_operation_access()
//	{
//		if($this->obj->is_super){
//			return 1;
//		}
//		elseif(!$this->check_operation_permission($this->obj->uri->segment(3)))
//		{
//
//			$back_to =$_SERVER['REQUEST_URI'];
//			$back_to = $this->obj->functions->encode($back_to);
//			redirect('access_denied/index/'.$back_to);
//		}
//	}

      	function check_operation_access($permission_id = 0)
	{
		if($this->obj->is_super){
			return 1;
		}
		elseif(!$this->check_operation_permission($permission_id))
		{
			$back_to =$_SERVER['REQUEST_URI'];
			$back_to = $this->obj->functions->encode($back_to);
			redirect('access_denied/index/'.$back_to);
		}
	}

	//--------------------------------------------------------------	
	function Check_operation_permission($permission_id)
	{
		if(isset($this->obj->permission_id[$permission_id])) 
			return 1;
		else 
		 	return 0;
	}
}
?>