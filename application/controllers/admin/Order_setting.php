<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Order_setting extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/order_model', 'order_model');
	}
	public function order_list()
	{

		$data['title'] = 'Clientes Online Listado de Pedidos';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/order_setting/order_list');

    	$this->load->view('admin/includes/_footer');

	}
	public function get_orderlist()
    {
        $pos_id = 0;  //admin user
        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->order_model->get_all_order_count($pos_id);
        $totalRecordwithFilter = $this->order_model->get_all_order_count_with_filter($pos_id, $search_key);
        $order_lists = $this->order_model->get_orderlist($pos_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($order_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);
            if($value['check_flag'] == 2){
                $action_str = '<div style="display: inline-flex;"><!--a style="color:white;" disabled h_id="'.$value['id'].'" id="confirmed'.$value['id'].'" class="mr-1 btn-sm btn btn-info btn-confirmed">Confirmed</a--><a href="'.base_url().$value['pdf_file'].'" target="_blank" style="color:white;" class="mr-1 btn-sm btn btn-info btn-pdf">Order</a><a style="color:white;" href="http://207.154.243.81:8081/?designckitchenadminplanner'.$value['product_id'].'" target="_blank" class="mr-1 btn btn-info btn-sm">3D Design</a><a style="color:white;" h_id="'.$value['id'].'" id="return'.$value['id'].'" class="mr-1 btn-sm btn btn-info btn-return">Return</a><a style="color:white;" h_id="'.$value['id'].'" id="remove'.$value['id'].'" class="btn-sm btn btn-info btn-remove">Remove</a></div>';
            }else if($value['check_flag'] == 1){
                $action_str = '<div style="display: inline-flex;"><a style="color:white;" h_id="'.$value['id'].'" id="confirm'.$value['id'].'" class="mr-1 btn-sm btn btn-info btn-confirm" data-toggle="modal" data-target="#ordermodal">Confirm</a><a style="color:white;" href="http://207.154.243.81:8081/?designckitchenadminplanner'.$value['product_id'].'" target="_blank" class="mr-1 btn btn-info btn-sm">3D Design</a><a style="color:white;" h_id="'.$value['id'].'" id="remove'.$value['id'].'" class="btn-sm btn btn-info btn-remove">Remove</a></div>';
            }
            $data[] = array( 
              "no"=>$row_inx,
              "order_no"=>$value['order_no'],
              "product_name"=>$value['product_name'],
              "customer"=>$value['customer_name'],
              "furniture_cost"=>$value['estimated_furniture_cost'],
              "other_cost"=>($value['estimated_countertio_cost']-$value['estimated_furniture_cost']),
              "status"=>$value['status'],
              "action"=>$action_str
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
  public function remove_order()
  {
    $id = $this->input->post('id');
    $result = $this->order_model->remove_order($id);
    echo json_encode($result);
  }
  public function return_order()
  {
    $id = $this->input->post('id');
    $result = $this->order_model->return_order($id);
    echo json_encode($result);
  }
  public function set_order_confirm_pos()
  {
      $order_no = $this->input->post('order_no');

      // $pos_id = $this->session->userdata('user_id');
      $result = $this->order_model->set_check_flag($order_no);

      echo json_encode($result);
  }

  public function pos_orders()
  {

    $data['title'] = 'Tiendas';

    $pos_list = $this->order_model->get_pos_list();

    $data['pos_list'] = $pos_list;

    $this->load->view('admin/includes/_header', $data);

      $this->load->view('admin/order_setting/pos_orders', $data);

      $this->load->view('admin/includes/_footer');

  }
  public function get_pos_orders()
    {
        $pos_id = $this->input->post('pos_id');  
        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->order_model->get_all_pos_order_count($pos_id);
        $totalRecordwithFilter = $this->order_model->get_all_pos_order_count_with_filter($pos_id, $search_key);
        $order_lists = $this->order_model->get_pos_orderlist($pos_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($order_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);

            $act_str = '';
            if($value['check_flag'] == 1){
              $act_str = '<div style="display: inline-flex;"><a style="color:white;" href="http://207.154.243.81:8081/?designckitchenadminplanner'.$value['product_id'].'" target="_blank" class="btn btn-info btn-sm mr-1">3D Design</a><a href="'.base_url().$value['pdf_file'].'" target="_blank" style="color:white;" class="mr-1 btn-sm btn btn-info btn-pdf">Order</a><a style="color:white;" h_id="'.$value['id'].'" id="remove'.$value['id'].'" class="btn-sm btn btn-info btn-remove">Remove</a></div>';
            }else if($value['check_flag'] == 2){
              $act_str = '<div style="display: inline-flex;"><a style="color:white;" href="http://207.154.243.81:8081/?designckitchenadminplanner'.$value['product_id'].'" target="_blank" class="btn btn-info btn-sm mr-1">3D Design</a><a href="'.base_url().$value['pdf_file'].'" target="_blank" style="color:white;" class="mr-1 btn-sm btn btn-info btn-pdf">Order</a><a style="color:white;" h_id="'.$value['id'].'" id="return'.$value['id'].'" class="mr-1 btn-sm btn btn-info btn-return">Return</a><a style="color:white;" h_id="'.$value['id'].'" id="remove'.$value['id'].'" class="btn-sm btn btn-info btn-remove">Remove</a></div>';
            }

            $data[] = array( 
              "no"=>$row_inx,
              "order_no"=>$value['order_no'],
              "product_name"=>$value['product_name'],
              "customer"=>$value['customer_name'],
              "pos"=>$value['pos_name'],
              "furniture_cost"=>$value['estimated_furniture_cost'],
              "other_cost"=>($value['estimated_countertio_cost']-$value['estimated_furniture_cost']),
              "status"=>$value['status'],
              "action"=>$act_str
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

    public function load_design()
    {
      $product_id = $this->input->post('product_id');
      $product_info = $this->order_model->get_product_info($product_id);

      echo json_encode($product_info);
    }

    
	
}
?>	