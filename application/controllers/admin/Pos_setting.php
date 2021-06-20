<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Pos_setting extends My_Controller {

  public function __construct(){

    parent::__construct();

    auth_check(); // check login auth

    $this->rbac->check_module_access();

    $this->load->model('admin/pos_model', 'pos_model');
  }

  public function save_pos()
  {
    $req_data = $this->input->post();
    $data = array(
      'pos_name' => $req_data['pos_name'],
      'company_name' => $req_data['company_name'],
      'email' => $req_data['email'],
      'password' => $req_data['password'],
      'CIF' => $req_data['cif'],
      'phone_num' => $req_data['phone_num'],
      'zipcode' => $req_data['zipcode'],
      'address' => $req_data['address'],
      'description' => $req_data['description'],
      'planner_count' => $req_data['plan_count'],
      'lat' => $req_data['position_lat'],
      'lon' => $req_data['position_lon']
    );

    $result = $this->pos_model->save_pos($data);

    $response = array('status' => $result);
    echo json_encode($response);
  }
  public function edit_pos()
  {
    $req_data = $this->input->post();
    $data = array(
      'pos_name' => $req_data['edit_pos_name'],
      'company_name' => $req_data['edit_company_name'],
      'email' => $req_data['edit_email'],
      'password' => $req_data['edit_password'],
      'CIF' => $req_data['edit_cif'],
      'phone_num' => $req_data['edit_phone_num'],
      'zipcode' => $req_data['edit_zipcode'],
      'address' => $req_data['edit_address'],
      'description' => $req_data['edit_description'],
      'planner_count' => $req_data['edit_plan_count'],
      'lat' => $req_data['edit_position_lat'],
      'lon' => $req_data['edit_position_lon']
    );

    $result = $this->pos_model->edit_pos($req_data['edit_pos_id'], $data);

    $response = array('status' => $result);
    echo json_encode($response);
  }

  public function pos_management()
  {
    $data['title'] = 'Tiendas Gestión de';

    $this->load->view('admin/includes/_header', $data);

      $this->load->view('admin/pos_setting/pos_management');

      $this->load->view('admin/includes/_footer');
  }

  public function get_pos_list()
  {
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->pos_model->get_pos_list_all_count();
    $totalRecordwithFilter = $this->pos_model->get_pos_list_all_count_with_filter($search_key, $start, $rowperpage);
    $pos_list = $this->pos_model->get_pos_list($search_key, $start, $rowperpage);
    //echo $this->db->last_query();

    $data = array();

    foreach ($pos_list as $value) {
        $extra_data = array(
          'password'=>$value['password']
        );
        $json_data = json_encode($extra_data);
        if($value['is_blocked'] == 1){
          $toggle_btn = '<input class="tgl_checkbox tgl-ios" id="'.$value['pos_id'].'" type="checkbox" checked><label for="'.$value['pos_id'].'"></label>';
        }else{
          $toggle_btn = '<input class="tgl_checkbox tgl-ios" id="'.$value['pos_id'].'" type="checkbox"><label for="'.$value['pos_id'].'"></label>';
        }
        
        $data[] = array( 
          "pos_name"=>$value['pos_name'],
          "company_name"=>$value['company_name'],
          "address"=>$value['address'],
          "email"=>$value['email'],
          "CIF"=>$value['CIF'],
          "phone_num"=>$value['phone_num'],
          "position_lat"=>$value['position_lat'],
          "position_lon"=>$value['position_lon'],
          "zipcode"=>$value['zipcode'],
          "description"=>$value['description'],
          "plan_count"=>$value['planner_count'],
          "block"=>$toggle_btn,
          "action"=>'<div style="display: inline-flex;"><a id="'.$value['pos_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#edit_pos_modal" json_data="'.htmlentities($json_data, ENT_QUOTES, 'UTF-8').'"><i class="fa fa-edit"></i></a><a id="'.$value['pos_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a></div>'
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

  public function delete_pos_record()
  {
    $id = $this->input->post('id');
    $result = $this->pos_model->delete_pos($id);

    echo json_encode($result);
  }

  public function set_block_pos()
  {
    $selected_pos_id = $this->input->post('selected_pos_id');
    $b_flag = $this->input->post('flag');

    $result = $this->pos_model->set_block_pos($selected_pos_id, $b_flag);
    if($result){
      echo json_encode($b_flag);
    }
    
  }
  public function point_rate()
  {

    $data['title'] = 'Tiendas Precio por punto Listado';

    $data['pos_arr'] = $this->pos_model->get_pos();

    $this->load->view('admin/includes/_header', $data);

      $this->load->view('admin/pos_setting/point_rate');

      $this->load->view('admin/includes/_footer');

  }

  public function get_point_rate_list()
  {
    $pos_rate = $this->input->post('pos_id');

    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->pos_model->get_point_rate_all_count($pos_rate);
    $totalRecordwithFilter = $this->pos_model->get_point_rate_all_count_with_filter($search_key, $start, $rowperpage, $pos_rate);
    $point_list = $this->pos_model->get_point_rate_list($search_key, $start, $rowperpage, $pos_rate);
    //echo $this->db->last_query();

    $data = array();

    foreach ($point_list as $value) {
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
    $pos_rate = $this->input->post('pos_id');

    $result = $this->pos_model->save_point_rate($min_point, $max_point, $price, $pos_rate);

    $response = array('status' => $result);
    echo json_encode($response);
  }

  public function edit_point_rate()
  {
    $id = $this->input->post('point_rate_id');
    $edit_min_point = $this->input->post('edit_min_point');
    $edit_max_point = $this->input->post('edit_max_point');
    $edit_price = $this->input->post('edit_price');
    $result = $this->pos_model->edit_point_rate($id, $edit_min_point, $edit_max_point, $edit_price);

    echo json_encode($result);
  }

  public function delete_point_rate()
  {
    $id = $this->input->post('id');
    $result = $this->pos_model->delete_point_rate($id);

    echo json_encode($result);
  }

  public function margin_spread()
  {
    $data['title'] = 'Margen and Margen Fijo';

    $data['pos_arr'] = $this->pos_model->get_pos();

    $this->load->view('admin/includes/_header', $data);

    $this->load->view('admin/pos_setting/margin_spread', $data);

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

    $totalRecords = $this->pos_model->get_margin_spread_all_count();
    $totalRecordwithFilter = $this->pos_model->get_margin_spread_all_count_with_filter($search_key, $start, $rowperpage);
    $margin_spread = $this->pos_model->get_margin_spread_list($search_key, $start, $rowperpage);
    //echo $this->db->last_query();

    $data = array();

    foreach ($margin_spread as $value) {
        $data[] = array( 
          "id"=>$value['id'],
          "pos_name"=>$value['pos_name'],
          "pos_margin"=>$value['pos_margin'],
          "pos_spread"=>$value['pos_spread'],
          "pos_customer_margin"=>$value['pos_customer_margin'],
          "pos_customer_spread"=>$value['pos_customer_spread'],
          "action"=>'<a id="'.$value['pos_id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#margin_spread_edit_modal"><i class="fa fa-edit"></i></a>'
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
    $pos_id = $this->input->post('pos_id');
    $pos_margin = $this->input->post('pos_margin');
    $pos_spread = $this->input->post('pos_spread');
    $pos_customer_margin = $this->input->post('pos_customer_margin');
    $pos_customer_spread = $this->input->post('pos_customer_spread');

    $result = $this->pos_model->save_margin_spread($pos_id, $pos_margin, $pos_spread, $pos_customer_margin, $pos_customer_spread);
   

    $response = array('status' => $result);
    echo json_encode($response);
  }
  public function update_margin_spread()
  {
    $edit_pos_id = $this->input->post('edit_pos_id');
    $pos_margin = $this->input->post('edit_pos_margin');
    $pos_spread = $this->input->post('edit_pos_spread');
    $pos_customer_margin = $this->input->post('edit_pos_customer_margin');
    $pos_customer_spread = $this->input->post('edit_pos_customer_spread');

    $result = $this->pos_model->update_margin_spread($edit_pos_id, $pos_margin, $pos_spread, $pos_customer_margin, $pos_customer_spread);   

    $response = array('status' => $result);
    echo json_encode($response);
  }
  public function customer_list_by_pos()
  {
    $data['title'] = 'Customer list';

    $data['pos_arr'] = $this->pos_model->get_pos();

    $this->load->view('admin/includes/_header');

    $this->load->view('admin/pos_setting/customer_list', $data);

    $this->load->view('admin/includes/_footer');
  }
  public function get_customer_list_by_pos()
  {
    $pos_id = $this->input->post('pos_id');
    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $search_key = $_POST['search']['value'];

    $totalRecords = $this->pos_model->get_all_customer_count($pos_id);
    $totalRecordwithFilter = $this->pos_model->get_all_customer_count_with_filter($pos_id, $search_key);
    $customer_lists = $this->pos_model->get_pos_customerlist($pos_id, $start, $rowperpage, $search_key);
    $data = array();
    $inx = 0;
    foreach ($customer_lists as $value) {
        $inx++;
        $row_inx = $inx + intval($start);
        $data[] = array( 
          "no"=>$row_inx,
          "customer_name"=>$value['customer_name'].$value['last_name1'].$value['last_name2'],
          "email"=>$value['email'],
          "phone_num"=>$value['phone_num'],
          "delivery_direction"=>$value['delivery_direction'],
          "zipcode"=>$value['zipcode'],
          "pos_name"=>$value['pos_name'],
          "planner_count"=>$value['planner_count'],
          "status"=>$value['is_blocked'] ? '<h6><span class="badge badge-pill badge-danger">blocked</span></h6>' : '<h6><span class="badge-pill badge-success">actived</span></h6>',
       );
    }

    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );

    echo json_encode($response);
  }

}
?>  