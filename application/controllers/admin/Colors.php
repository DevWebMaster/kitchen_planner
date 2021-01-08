<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Colors extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/colors_model', 'colors_model');
	}
	public function index()
	{

		$data['title'] = 'Model Colors';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/colors/colors');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_color_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->colors_model->get_color_all_count();
        $totalRecordwithFilter = $this->colors_model->get_color_all_count_with_filter($search_key, $start, $rowperpage);
        $colors = $this->colors_model->get_color_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($colors as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "price"=>$value['price'],
              "action"=>'<a id="'.$value['color_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#color_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['color_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function save_color()
	{
		$color_name = $this->input->post('color_name');
		$price = $this->input->post('price');

		$result = $this->colors_model->save_color($color_name, $price);

		$response = array('status' => $result);
		echo json_encode($response);
	}

	public function delete_color_record()
	{
		$color_id = $this->input->post('color_id');
		$result = $this->colors_model->delete_color($color_id);

		echo json_encode($result);
	}

	
	public function edit_color_record()
	{
		$color_id = $this->input->post('color_id');
		$edit_color_name = $this->input->post('edit_color_name');
		$edit_price = $this->input->post('edit_price');
		$result = $this->colors_model->edit_color($color_id, $edit_color_name, $edit_price);

		echo json_encode($result);
	}

	

}
?>	