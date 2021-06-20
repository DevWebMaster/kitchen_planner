<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Materials extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/materials_model', 'materials_model');
	}
	public function index()
	{

		$data['title'] = 'Materiales';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/materials/materials');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_material_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->materials_model->get_material_all_count();
        $totalRecordwithFilter = $this->materials_model->get_material_all_count_with_filter($search_key, $start, $rowperpage);
        $materials = $this->materials_model->get_material_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($materials as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "price"=>$value['price'],
              "action"=>'<a id="'.$value['material_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#material_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['material_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function save_material()
	{
		$material_name = $this->input->post('material_name');
		$price = $this->input->post('price');

		$result = $this->materials_model->save_material($material_name, $price);

		$response = array('status' => $result);
		echo json_encode($response);
	}

	public function delete_material_record()
	{
		$material_id = $this->input->post('material_id');
		$result = $this->materials_model->delete_material($material_id);

		echo json_encode($result);
	}

	
	public function edit_material_record()
	{
		$material_id = $this->input->post('material_id');
		$edit_material_name = $this->input->post('edit_material_name');
		$edit_price = $this->input->post('edit_price');
		$result = $this->materials_model->edit_material($material_id, $edit_material_name, $edit_price);

		echo json_encode($result);
	}

	

}
?>	