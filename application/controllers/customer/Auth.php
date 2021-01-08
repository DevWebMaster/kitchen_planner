<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('customer/customer_model', 'customer_model');
        $this->load->model('customer/pos_model', 'pos_model');
        $this->load->helper('url');

    }
    public function index()
    {
        $data['data'] = 'index';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/index');

        $this->load->view('customer/include/footer.php');
    }
    public function login()
    {   
        $data['data'] = 'register';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/login');

        $this->load->view('customer/include/footer.php');
    }
    public function register()
    {
        $data['data'] = 'login';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/register');

        $this->load->view('customer/include/footer.php');
    }
    public function add_register()
    {

        $reg_data = $this->input->post();
         // print_r($reg_data);
        $data = array(
            'customer_name' => $reg_data['name'],
            'last_name1' => $reg_data['lastname1'],
            'last_name2' => $reg_data['lastname2'],
            'DNI' => $reg_data['dni'],
            'transaction' => '',
            'email' => $reg_data['email'], 
            'phone_num' => $reg_data['phone'],
            'password' => $reg_data['password'],
            'delivery_direction' => $reg_data['d_location'],
            'zipcode' => $reg_data['zipcode'],
            'LOPD' => $reg_data['lopd'],
            'created_date'=>date('Y-m-d H:i:s'),
            'updated_date'=>date('Y-m-d H:i:s'),
        );
        $result = $this->customer_model->add_customer($data);
        
        echo json_encode($result);
    }
    public function valid_email()
    {

        $email = $this->input->post('email');
        $is_check = $this->input->post('is_check');
         // print_r($reg_data);
        if($is_check == 1){
            $result = $this->customer_model->is_exist($email);
        }else if($is_check == 2){
            $result = $this->pos_model->is_exist($email);
        }
        
        
        echo json_encode($result);
    }
    public function login_user()
    {

    // if admin loggedin redirect to admin dashboard
        
        // if($this->session->userdata('is_customer_logged'))
        // {
        //     // redirect('customer/index');        
        // }       
        // else
        // {   
            if($_POST)
            {
                //print_r($_POST); exit;
                // $this->form_validation->set_rules('username','Username','required');    
                // $this->form_validation->set_rules('password','Password','required');    
                // if($this->form_validation->run()==FALSE)
                // {                                       
                //     $this->load->view('customer/login');                    
                // }
                // else
                // {
                        $role = trim($this->input->post('dzRole'));

                        $email = trim($this->input->post('dzEmail'));
                        // $password = md5(trim($this->input->post('password')));
                        $password = trim($this->input->post('dzPassword'));
                        if($role == 'customer'){
                            $is_user_logged = $this->customer_model->do_login_customer($email, $password); 
                        }else if($role == 'pos'){
                            $is_user_logged = $this->pos_model->do_login_pos($email, $password); 
                        }
                        
                        if($is_user_logged)
                        {                    
                            if($role == 'customer'){
                                $row = $this->customer_model->get_row_c1($email, $password);
                                $username = $row->customer_name . $row->last_name1 . $row->last_name2; 
                                $customer_id = $this->customer_model->get_customer_id($row->email);
                                // set session data 
                                $session_data = array(                                      
                                'userfname'                =>$username,
                                'email'                    =>$email,
                                'user_id'              =>$customer_id['id'],
                                'is_customer_logged'       =>TRUE,                 
                                'user_role'                =>1,  //customer:1, POS:2
                              
                                );
                                $this->session->set_userdata($session_data);
                                $res_data = array(
                                    'status' => 1,
                                    'msg' => "Login is successed!",
                                    'type' => 'login'
                                );
                            }     
                            if($role == 'pos'){
                                $row = $this->pos_model->get_row_p1($email, $password); 
                                $username = $row->pos_name;
                                $pos_id = $this->pos_model->get_pos_id($row->email);
                                // set session data 
                                $session_data = array(                                      
                                'userfname'                =>$username,
                                'email'                    =>$email,
                                'user_id'                   =>$pos_id['pos_id'],
                                'is_pos_logged'            =>TRUE,                 
                                'user_role'                =>2,  //customer:1, POS:2
                              
                                );
                                $this->session->set_userdata($session_data);
                                $res_data = array(
                                    'status' => 1,
                                    'msg' => "Login is successed!",
                                    'type' => 'login'
                                );
                            }                                      
                        }
                        else
                        {
                            $this->session->set_flashdata('error','Username or Password is wrong ! ');
     
                            $res_data = array(
                                'status' => 0,
                                'msg' => "Username and Password are incorrect! Or blocked by the admin user.",
                                'type' => 'login'
                            ); 
                        }
                // }
            }   
            else
            {
                $res_data = array(
                    'status' => 0,
                    'msg' => "Username and Password are incorrect!",
                    'type' => 'login'
                );
            }   
  
        echo json_encode($res_data);            
    }
    public function logout()
    {           
        $this->session->unset_userdata('is_customer_logged');  
        $this->session->unset_userdata('is_pos_logged');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('userfname');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        redirect('customer','refresh');
    }
}
?>