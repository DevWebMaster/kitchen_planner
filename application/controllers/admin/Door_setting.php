<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Door_setting extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/door_setting_model', 'door_setting_model');
	}
	public function dooropen_style()
	{

		$data['title'] = 'Door Open Style';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/door_setting/door_open_style');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_door_open_style_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->door_setting_model->get_door_open_style_all_count();
        $totalRecordwithFilter = $this->door_setting_model->get_door_open_style_all_count_with_filter($search_key, $start, $rowperpage);
        $main_menu = $this->door_setting_model->get_door_open_style_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($main_menu as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "price"=>$value['price'],
              "action"=>'<a id="'.$value['style_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#style_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['style_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
           );
        }

        $result = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordwithFilter,
          "aaData" => $data
        );

        echo json_encode($result);
	}

	public function save_door_open_style()
	{
		$door_open_style_name = $this->input->post('door_open_style_name');
		$price = $this->input->post('price');

		$result = $this->door_setting_model->save_door_open_style($door_open_style_name, $price);

		$response = array('status' => $result);
		echo json_encode($response);
	}

	public function delete_door_open_style_record()
	{
		$style_id = $this->input->post('style_id');
		$result = $this->door_setting_model->delete_door_open_style($style_id);

		echo json_encode($result);
	}

	
	public function edit_door_open_style_record()
	{
		$style_id = $this->input->post('style_id');
		$edit_style_name = $this->input->post('edit_style_name');
		$edit_price = $this->input->post('edit_price');
		$result = $this->door_setting_model->edit_door_open_style($style_id, $edit_style_name, $edit_price);

		echo json_encode($result);
	}

	public function door_thickness()
	{

		$data['title'] = 'Door Thickness';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/door_setting/door_thickness');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_door_thickness_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->door_setting_model->get_door_thickness_all_count();
        $totalRecordwithFilter = $this->door_setting_model->get_door_thickness_all_count_with_filter($search_key, $start, $rowperpage);
        $main_menu = $this->door_setting_model->get_door_thickness_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($main_menu as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "price"=>$value['price'],
              "action"=>'<a id="'.$value['thickness_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#thickness_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['thickness_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
           );
        }

        $result = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordwithFilter,
          "aaData" => $data
        );

        echo json_encode($result);
	}

	public function save_door_thickness()
	{
		$door_thickness_name = $this->input->post('door_thickness_name');
		$price = $this->input->post('price');

		$result = $this->door_setting_model->save_door_thickness($door_thickness_name, $price);

		$response = array('status' => $result);
		echo json_encode($response);
	}

	public function delete_door_thickness_record()
	{
		$thickness_id = $this->input->post('thickness_id');
		$result = $this->door_setting_model->delete_door_thickness($thickness_id);

		echo json_encode($result);
	}

	
	public function edit_door_thickness_record()
	{
		$thickness_id = $this->input->post('thickness_id');
		$edit_thickness_name = $this->input->post('edit_thickness_name');
		$edit_price = $this->input->post('edit_price');
		$result = $this->door_setting_model->edit_door_thickness($thickness_id, $edit_thickness_name, $edit_price);

		echo json_encode($result);
	}

}
?>	