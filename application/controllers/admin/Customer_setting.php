<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Customer_setting extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/customer_model', 'customer_model');
	}

	public function customer_management()
	{
		$data['title'] = 'Customer Management';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/customer_setting/customer_management');

    	$this->load->view('admin/includes/_footer');
	}

  public function get_customer_list()
  {
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->customer_model->get_customer_list_all_count();
    $totalRecordwithFilter = $this->customer_model->get_customer_list_all_count_with_filter($search_key, $start, $rowperpage);
    $customer_list = $this->customer_model->get_customer_list($search_key, $start, $rowperpage);
    //echo $this->db->last_query();

    $data = array();

    foreach ($customer_list as $value) {
        if($value['is_blocked'] == 1){
          $toggle_btn = '<input class="tgl_checkbox tgl-ios" id="'.$value['id'].'" type="checkbox" checked><label for="'.$value['id'].'"></label>';
        }else{
          $toggle_btn = '<input class="tgl_checkbox tgl-ios" id="'.$value['id'].'" type="checkbox"><label for="'.$value['id'].'"></label>';
        }
        
        $data[] = array( 
          "customer_name"=>$value['customer_name'],
          "last_name1"=>$value['last_name1'],
          "last_name2"=>$value['last_name2'],
          "DNI"=>$value['DNI'],
          "email"=>$value['email'],
          "transaction"=>$value['transaction'],
          "phone_num"=>$value['phone_num'],
          "delivery_direction"=>$value['delivery_direction'],
          "zipcode"=>$value['zipcode'],
          "LOPD"=>$value['LOPD'],
          "block"=>$toggle_btn,
          "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

  public function delete_customer_record()
  {
    $id = $this->input->post('id');
    $result = $this->customer_model->delete_customer($id);

    echo json_encode($result);
  }

  public function set_block_customer()
  {
    $selected_customer_id = $this->input->post('selected_customer_id');
    $b_flag = $this->input->post('flag');

    $result = $this->customer_model->set_block_customer($selected_customer_id, $b_flag);
    if($result){
      echo json_encode($b_flag);
    }
    
  }

  public function point_rate()
  {

    $data['title'] = 'Online Customer Point Rate List';

    $this->load->view('admin/includes/_header', $data);

      $this->load->view('admin/customer_setting/point_rate');

      $this->load->view('admin/includes/_footer');

  }

  public function get_point_rate_list()
  {
    // $search_key = $this->input->post('search_key');

    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->customer_model->get_point_rate_all_count();
    $totalRecordwithFilter = $this->customer_model->get_point_rate_all_count_with_filter($search_key, $start, $rowperpage);
    $pos_location = $this->customer_model->get_point_rate_list($search_key, $start, $rowperpage);
    //echo $this->db->last_query();

    $data = array();

    foreach ($pos_location as $value) {
        $data[] = array( 
          "id"=>$value['id'],
          "min_point"=>$value['min_point'],
          "max_point"=>$value['max_point'],
          "price"=>$value['price'],
          "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#point_rate_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

  public function save_point_rate()
  {
    $min_point = $this->input->post('min_point');
    $max_point = $this->input->post('max_point');
    $price = $this->input->post('price');

    $pos_rate = 0;

    $result = $this->customer_model->save_point_rate($min_point, $max_point, $price, $pos_rate);

    $response = array('status' => $result);
    echo json_encode($response);
  }

  public function edit_point_rate()
  {
    $id = $this->input->post('point_rate_id');
    $edit_min_point = $this->input->post('edit_min_point');
    $edit_max_point = $this->input->post('edit_max_point');
    $edit_price = $this->input->post('edit_price');
    $result = $this->customer_model->edit_point_rate($id, $edit_min_point, $edit_max_point, $edit_price);

    echo json_encode($result);
  }

  public function delete_point_rate()
  {
    $id = $this->input->post('id');
    $result = $this->customer_model->delete_point_rate($id);

    echo json_encode($result);
  }

  public function margin_spread()
  {
    $data['title'] = 'Maring and Spread';

    $data['is_exist'] = $this->customer_model->check_exist_row();

    $this->load->view('admin/includes/_header', $data);

    $this->load->view('admin/customer_setting/margin_spread');

    $this->load->view('admin/includes/_footer');
  }

  public function get_margin_spread_list()
  {
    // $search_key = $this->input->post('search_key');

    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->customer_model->get_margin_spread_all_count();
    $totalRecordwithFilter = $this->customer_model->get_margin_spread_all_count_with_filter($search_key, $start, $rowperpage);
    $margin_spread = $this->customer_model->get_margin_spread_list($search_key, $start, $rowperpage);
    //echo $this->db->last_query();

    $data = array();

    foreach ($margin_spread as $value) {
        $data[] = array( 
          "id"=>$value['id'],
          "pos_margin"=>$value['pos_margin'],
          "pos_spread"=>$value['pos_spread'],
          "pos_customer_margin"=>$value['pos_customer_margin'],
          "pos_customer_spread"=>$value['pos_customer_spread'],
          "customer_margin"=>$value['customer_margin'],
          "customer_spread"=>$value['customer_spread'],
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

  public function save_margin_spread()
  {
    $customer_margin = $this->input->post('customer_margin');
    $customer_spread = $this->input->post('customer_spread');

    $is_exist = $this->customer_model->check_exist_row();
    if($is_exist > 0){
      $result = $this->customer_model->update_margin_spread($customer_margin, $customer_spread);
    }else{
      $result = $this->customer_model->save_margin_spread($customer_margin, $customer_spread);
    }
   

    $response = array('status' => $result);
    echo json_encode($response);
  }

}
?>	