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
    public function index()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $is_exist = $this->planner_model->get_planner_status($user_id, $user_role);
        if($user_role == 2){
            $planner_count = $this->planner_model->get_planner_count($user_id);
            if($planner_count['planner_count'] > 0 && $is_exist['status'] == 0){
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
                //customer is logged in the planner
                $this->planner_model->start_planner($data);

                $this->load->view('customer/planner');
            }else if($is_exist['status'] == 1){
                $this->load->view('duplicate_planner');
            }else{
                $this->load->view('access_denied');
            }
        }else if($user_role == 1){
            $planner_count = $this->planner_model->get_planner_count_for_user($user_id);
            if($planner_count['planner_count'] > 0 && $is_exist['status'] == 0){
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

                $this->load->view('customer/planner');
            }else if($is_exist['status'] == 1){
                $this->load->view('duplicate_planner');
            }else{
                $this->load->view('access_denied');
            }
        }
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
    public function validation_count()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
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
            $rtn = true;
        }else{
            $rtn = false;
        }
        echo json_encode($rtn);
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
    	$main_id = $this->input->post('main_id');
    	$sub_id = $this->input->post('sub_id');
    	$search_str = $this->input->post('search_str');

    	$result = $this->planner_model->get_thumbnail_menu($main_id, $sub_id, $search_str);

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
            'contents' => $data,
            'check_order' => $product_info[0]['check_order']
        );

        echo json_encode($result);
    }
    public function save_product()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        $req_data = $this->input->post('req_data');
        $filename = $this->input->post('filename');

        $handle = fopen(PRODUCT_PATH.$filename, 'w+');

        fwrite($handle, $req_data);

        fclose($handle);

        if($user_role == 1){
            $pos_id = 0;
            $data = array(
                'product_name' => $filename,
                'customer_id' => $user_id,
                'pos_id' => $pos_id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $user_id
            );
        }else{
            $data = array(
                'product_name' => $filename,
                'pos_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $user_id
            );
        }


        $product_id = $this->planner_model->save_planner($data);
        if($product_id){
            $items = json_decode($req_data)->items;
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

        echo json_encode($product_id);
    }
    public function load_design($product_id = '')
    {
        $this->load->view('customer/planner', ['product_id' => $product_id]);
    }
}
?>