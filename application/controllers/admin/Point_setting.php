<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Point_setting extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/point_setting_model', 'point_setting_model');
    $this->load->model('admin/menu_setting_model', 'menu_setting_model');
	}
	
  public function furniture_cube()
  {

    $data['title'] = 'Nombre del Cubo de precios';

    $this->load->view('admin/includes/_header', $data);

      $this->load->view('admin/point_setting/furniture_cube');

      $this->load->view('admin/includes/_footer');

  }

  public function get_furniture_cube_list()
  {
    // $search_key = $this->input->post('search_key');

    $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->point_setting_model->get_furniture_cube_all_count();
        $totalRecordwithFilter = $this->point_setting_model->get_furniture_cube_all_count_with_filter($search_key, $start, $rowperpage);
        $furniture_cubes = $this->point_setting_model->get_furniture_cube_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($furniture_cubes as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "action"=>'<a id="'.$value['cube_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

  public function save_furniture_cube()
  {
    $furniture_cube_name = $this->input->post('furniture_cube_name');

    $result = $this->point_setting_model->save_furniture_cube($furniture_cube_name);

    $response = array('status' => $result);
    echo json_encode($response);
  }

  public function delete_furniture_cube_record()
  {
    $furniture_cube_id = $this->input->post('furniture_cube_id');
    $result = $this->point_setting_model->delete_furniture_cube($furniture_cube_id);

    echo json_encode($result);
  }

  
  public function edit_furniture_cube_record()
  {
    $furniture_cube_id = $this->input->post('furniture_cube_id');
    $edit_furniture_cube_name = $this->input->post('edit_furniture_cube_name');
    $edit_price = $this->input->post('edit_price');
    $result = $this->point_setting_model->edit_furniture_cube($furniture_cube_id, $edit_furniture_cube_name, $edit_price);

    echo json_encode($result);
  }


	public function model_point()
	{
		$data['title'] = 'Definir Cubo de precios';

    $data['furniture_cube'] = $this->menu_setting_model->get_furniture_cube();

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/point_setting/model_point');

    	$this->load->view('admin/includes/_footer');
	}

  public function get_model_point_list()
  {
    $furniture_cube_id = $this->input->post('furniture_cube_id');
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->point_setting_model->get_model_point_list_all_count($furniture_cube_id);
    $totalRecordwithFilter = $this->point_setting_model->get_model_point_list_all_count_with_filter($search_key, $start, $rowperpage, $furniture_cube_id);
    $model_point_list = $this->point_setting_model->get_model_point_list($search_key, $start, $rowperpage, $furniture_cube_id);
    //echo $this->db->last_query();

    $data = array();

    foreach ($model_point_list as $value) {
        $data[] = array( 
          "id"=>$value['id'],
          "cube_type"=>$value['cube_type'],
          "model_width"=>$value['width'],
          "model_length"=>$value['length'],
          "level1"=>$value['level1'],
          "level2"=>$value['level2'],
          "level3"=>$value['level3'],
          "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#model_point_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

  public function save_model_point()
  {
    $furniture_cube_id = $this->input->post('furniture_cube_id');
    $model_width = $this->input->post('model_width');
    $model_length = $this->input->post('model_length');
    $level1 = $this->input->post('level1');
    $level2 = $this->input->post('level2');
    $level3 = $this->input->post('level3');

    $result = $this->point_setting_model->save_model_point($furniture_cube_id, $model_width, $model_length, $level1, $level2, $level3);

    $response = array('status' => $result);
    echo json_encode($response);
  }

  public function edit_model_point()
  {
    $id = $this->input->post('model_point_id');
    $edit_model_width = $this->input->post('edit_model_width');
    $edit_model_length = $this->input->post('edit_model_length');
    $edit_level1 = $this->input->post('edit_level1');
    $edit_level2 = $this->input->post('edit_level2');
    $edit_level3 = $this->input->post('edit_level3');
    $result = $this->point_setting_model->edit_model_point($id, $edit_model_width, $edit_model_length, $edit_level1, $edit_level2, $edit_level3);

    echo json_encode($result);
  }

  public function delete_model_point()
  {
    $id = $this->input->post('id');
    $result = $this->point_setting_model->delete_model_point_row($id);

    echo json_encode($result);
  }

  

}
?>	