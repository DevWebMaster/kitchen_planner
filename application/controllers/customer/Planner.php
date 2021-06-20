<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Planner extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('customer/planner_model', 'planner_model');
        $this->load->helper('url');

    }
    public function index($product_id = 0)
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $material_list = $this->planner_model->get_material_list();
        $color_list = $this->planner_model->get_color_list();

        $search_list = array(
            'countertop_type' => $material_list,
            'countertop_color' => $color_list,
            'exterio_color' => $color_list,
            'interior_color' => $color_list,
            'skirting_type' => $material_list,
            'skirting_color' => $color_list
        );
        $is_exist = $this->planner_model->get_planner_status($user_id, $user_role);
        if($product_id){
            $this->load->view('customer/planner', ['search_list' => $search_list, 'product_id' => $product_id]);
        }else {
            if($user_role == 2){
                $planner_count = $this->planner_model->get_planner_count($user_id);
                if($planner_count['planner_count'] > 0 && $is_exist['status'] == 0){
                    $planner_count = $this->planner_model->get_planner_count($user_id);
                    $updated_data = array(
                        'planner_count' => $planner_count['planner_count'] - 1
                    );
                    $result = $this->planner_model->updated_planner_count($updated_data, $user_id);
                    $data = array(
                        'user_id' => $user_id,
                        'user_role' => $user_role,
                        'start_date' => date('Y-m-d H:i:s'),
                        'status' => 1
                    );
                    //pos is logged in the planner
                    $this->planner_model->start_planner($data);
                    
                    $this->load->view('customer/planner', ['search_list' => $search_list]);
                }else{
                    $this->load->view('access_denied');
                }
            }else if($user_role == 1){
                $planner_count = $this->planner_model->get_planner_count_for_user($user_id);
                if($planner_count['planner_count'] > 0 && $is_exist['status'] == 0){
                    $planner_count = $this->planner_model->get_planner_count_for_user($user_id);
                    $updated_data = array(
                        'planner_count' => $planner_count['planner_count'] - 1
                    );
                    $result = $this->planner_model->updated_planner_count_for_user($updated_data, $user_id);
                    $data = array(
                        'user_id' => $user_id,
                        'user_role' => $user_role,
                        'start_date' => date('Y-m-d H:i:s'),
                        'status' => 1
                    );
                    //customer is logged in the planner
                    $this->planner_model->start_planner($data);
                    
                    $this->load->view('customer/planner', ['search_list' => $search_list]);
                }else {
                    $this->load->view('access_denied');
                }
            }
        }
    }
    public function check_duplicate_planner()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $is_exist = $this->planner_model->get_planner_status($user_id, $user_role);
        if($user_role == 1){
            $planner_count = $this->planner_model->get_planner_count_for_user($user_id);
        }else if($user_role == 2){
            $planner_count = $this->planner_model->get_planner_count($user_id);
        }
        $data = array(
            'status' => $is_exist['status'],
            'planner_count' => $planner_count['planner_count']
        );
        echo json_encode($data);
    }
    public function leave_planner()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        $updated_data = array(
            'end_date' => date('Y-m-d H:i:s'),
            'status' => 0,
        );
        $result = $this->planner_model->end_planner($user_role, $user_id, $updated_data);
        echo json_encode($result);
    }
    public function detect_planner()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        $updated_data = array(
            'end_date' => date('Y-m-d H:i:s'),
            'status' => 1,
        );
        $result = $this->planner_model->detect_planner($user_role, $user_id, $updated_data);
        echo json_encode($result);
    }
    public function validation_count()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        $content = $this->input->post('content');
        $filename = $this->input->post('filename');
        $product_id = $this->input->post('product_id');

        //save the current design
        $this->save_current_product($user_role, $user_id, $content, $filename, $product_id);
        if($user_role == 2){
            $planner_count = $this->planner_model->get_planner_count($user_id);
        }else if($user_role == 1){
            $planner_count = $this->planner_model->get_planner_count_for_user($user_id);
        }
        if($planner_count['planner_count'] > 0){
            $updated_data = array(
                'planner_count' => $planner_count['planner_count'] - 1
            );
            if($user_role == 2)
                $result = $this->planner_model->updated_planner_count($updated_data, $user_id);
            else if($user_role == 1)
                $result = $this->planner_model->updated_planner_count_for_user($updated_data, $user_id);
        }else{
            $result = false;
        }
        echo json_encode($result);
    }

    public function get_wall_floor()
    {
        $result = $this->planner_model->get_wall_floor();
        echo json_encode($result);
    }
    public function get_main_menu()
    {
    	$result = $this->planner_model->get_main_menu();
    	echo json_encode($result);
    }
    public function get_user_name()
    {
    	$data['user_role'] = $this->session->userdata('user_role');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['userfname'] = $this->session->userdata('userfname');

        echo json_encode($data);
    }
    public function get_sub_menu(){
    	$main_menu_id = $this->input->post('main_menu_id');

    	$result = $this->planner_model->get_sub_menu($main_menu_id);

    	echo json_encode($result);
    }
    public function get_shortkey_menu() {
    	$main_id = $this->input->post('main_id');
    	$sub_id = $this->input->post('sub_id');

    	$result = $this->planner_model->get_shortkey_menu($main_id, $sub_id);

    	echo json_encode($result);
    }
    public function get_thumbnail_menu()
    {
        $search_main = $this->input->post('search_main');
    	$main_id = $this->input->post('main_id');
    	$sub_id = $this->input->post('sub_id');
    	$search_str = $this->input->post('search_str');
        $advanced_filter_flag = $this->input->post('advanced_filter_flag');

        $search_countertop_type = $this->input->post('search_countertop_type') ? $this->input->post('search_countertop_type') : '';
        $search_countertop_color = $this->input->post('search_countertop_color') ? $this->input->post('search_countertop_color') : '';
        $search_exterio_color = $this->input->post('search_exterio_color') ? $this->input->post('search_exterio_color') : '';
        $search_interior_color = $this->input->post('search_interior_color') ? $this->input->post('search_interior_color') : '';
        $search_skirting_type = $this->input->post('search_skirting_type') ? $this->input->post('search_skirting_type') : '';
        $search_skirting_color = $this->input->post('search_skirting_color') ? $this->input->post('search_skirting_color') : '';

        if($advanced_filter_flag == 1){
            $result = $this->planner_model->get_thumbnail_menu($main_id, $sub_id, $search_str, $search_countertop_type, $search_countertop_color, $search_exterio_color, $search_interior_color, $search_skirting_type, $search_skirting_color);
        }else {
            if($search_main == 0){
                $result = $this->planner_model->get_main_menu_for_search($search_str);
            }else{
                $result = $this->planner_model->get_sub_menu_for_search($main_id, $search_str);
            }
        }

    	echo json_encode($result);
    }
    public function get_observation()
    {
    	$user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $product_id = $this->input->post('product_id');

        $result = $this->planner_model->get_observation($user_role, $user_id, $product_id);

        echo json_encode($result);
    }
    public function get_customer()
    {
    	$result = $this->planner_model->get_customer();

    	echo json_encode($result);
    }
    public function get_budget()
    {
    	$user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $req_data = $this->input->post('req_data');
        $product_id = $this->input->post('product_id');
        $customer_id = $this->input->post('customer_id');
        $summary_arr = $this->input->post('summary_arr');

        $result = $this->planner_model->get_budget($user_role, $user_id, $req_data['items'], $product_id, $customer_id, $summary_arr);

        echo json_encode($result);
    }
    public function load_product()
    {
        $product_id = $this->input->post('product_id');

        $product_info = $this->planner_model->load_product($product_id);

        $handle = fopen(PRODUCT_PATH.$product_info[0]['product_name'], 'r+');

        $data = fread($handle, filesize(PRODUCT_PATH.$product_info[0]['product_name']));

        fclose($handle);

        $result = array(
            'product_name' => $product_info[0]['product_name'],
            'contents' => $data,
            'check_order' => $product_info[0]['check_order']
        );

        echo json_encode($result);
    }
    public function check_product_duplication()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        $filename = $this->input->post('filename');
        $product_id = '';
        $exist_product = $this->planner_model->check_product($filename, $user_role, $user_id, $product_id);

        if($exist_product == 0){
            $rtn = false;
        }else{
            $rtn = true;
        }
        echo json_encode($rtn);
    }
    private function save_current_product($user_role, $user_id, $contents, $filename, $product_id)
    {
        $full_filename = $filename.'-'.date('YmdHis').'.kitchenplanner';

        $exist_product = $this->planner_model->check_product($filename, $user_role, $user_id, $product_id);
        if($exist_product == 0){
            $handle = fopen(PRODUCT_PATH.$full_filename, 'w+');

            fwrite($handle, $contents);

            fclose($handle);

            if($user_role == 1){
                $pos_id = 0;
                $data = array(
                    'product_name' => $full_filename,
                    'customer_id' => $user_id,
                    'pos_id' => $pos_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $user_id
                );
            }else{
                $data = array(
                    'product_name' => $full_filename,
                    'pos_id' => $user_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $user_id
                );
            }


            $product_id = $this->planner_model->save_planner($data);
        }else{
            $handle = fopen(PRODUCT_PATH.$exist_product['product_name'], 'w');
            //make the file as a empty

            fwrite($handle, $contents);

            fclose($handle);

            $data = array(
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id
            );
            $this->planner_model->update_planner($data, $exist_product['product_id']);
            $product_id = $exist_product['product_id'];

            //delete the models of exist_product_id
            $this->planner_model->bulk_delete_models($product_id);
        }

        
        if($product_id){
            $items = json_decode($contents)->items;
            foreach ($items as $key => $value) {
                $data = array(
                    'product_id' => $product_id,
                    'model_id' => $value->model_id,
                    'width' => $value->width,
                    'length' => $value->depth,
                    'model_level' => 'level1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $user_id
                );
                $this->planner_model->save_models($data);
            }
        }

        return $product_id;
    }
    public function save_product()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $req_data = $this->input->post('req_data');
        $filename = $this->input->post('filename');
        $product_id = $this->input->post('product_id');

        $result = $this->save_current_product($user_role, $user_id, $req_data, $filename, $product_id);

        echo json_encode($result);
    }
    public function load_design($product_id = '')
    {
        $this->load->view('customer/planner', ['product_id' => $product_id]);
    }
    public function get_product_list()
    {
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');

        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->planner_model->get_all_product_count($user_role, $user_id);
        $totalRecordwithFilter = $this->planner_model->get_all_product_count_with_filter($user_role, $user_id, $search_key);
        $product_lists = $this->planner_model->get_productlist($user_role, $user_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($product_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);
            $data[] = array( 
              "no"=>$row_inx,
              "product_name"=>$value['product_name'],
              "created_date"=>$value['created_at'],
              "action"=>'<div><a id="'.$value['product_id'].'" class="btn btn-primary btn-design" style="background-color: #ffa200; color: white; border-color: #ffa200;" data-dismiss="modal">View</a></div>'
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