<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('customer/Customer_model', 'customer_model');
        $this->load->model('customer/Pos_model', 'pos_model');
        $this->load->helper('url');

    }
    public function index()
    {
        $data['data'] = 'index';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/index');

        $this->load->view('customer/include/footer.php');
    }

    public function project()
    {
        $data['data'] = 'project';
        $this->load->view('customer/include/header1.php', $data);
        $this->load->view('customer/project');
        $this->load->view('customer/include/footer1.php');
    }
    public function contact()
    {
        $data['data'] = 'contact';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/contact');

        $this->load->view('customer/include/footer.php');
    }
    public function about()
    {
        $data['data'] = 'about';
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/about');

        $this->load->view('customer/include/footer.php');
    }
    
    public function account()
    {
        $data['data'] = 'account';
     
        $current_email = $this->session->userdata('email');
        $role = $this->session->userdata('user_role');

        if($role == 1) {
            $pdata['user_info'] = $this->customer_model->get_customer_info($current_email);
        }
        $this->load->view('customer/include/header1.php', $data);
        $this->load->view('customer/account', $pdata);

        $this->load->view('customer/include/footer.php');
    }
    public function budget()
    {
        $data['data'] = 'budget';
     
        $data['pos_list'] = $this->customer_model->get_pos_list();

        // $invoice_info = $this->customer_model->get_invoice_info(78);
        // print_r($invoice_info);return;

        // $role = $this->session->userdata('user_role');

        // if($role == 1) {
        //     $pdata['user_info'] = $this->customer_model->get_customer_budget($current_email);
        // }
        $this->load->view('customer/include/header.php', $data);
        // $this->load->view('customer/account', $pdata);
        $this->load->view('customer/budget', $data);

        $this->load->view('customer/include/footer.php');
    }
    public function order()
    {
        $data['data'] = 'order';
     
        // $role = $this->session->userdata('user_role');

        // if($role == 1) {
        //     $pdata['user_info'] = $this->customer_model->get_customer_budget($current_email);
        // }
        $this->load->view('customer/include/header.php', $data);
        // $this->load->view('customer/account', $pdata);
        $this->load->view('customer/order', $data);

        $this->load->view('customer/include/footer.php');
    }
    public function pos_order_list()
    {
        $data['data'] = 'order_list';
     
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/pos_order_list', $data);

        $this->load->view('customer/include/footer.php');
    }
    public function pos_product_list()
    {
        $data['data'] = 'product_list';
        $customer_list = $this->customer_model->get_customers();
        $data['customer_list'] = $customer_list;
     
        $this->load->view('customer/include/header.php');
        $this->load->view('customer/pos_product_list', $data);

        $this->load->view('customer/include/footer.php');
    }
    public function c_list()
    {
        $data['data'] = 'c_list';
     
        $current_email = $this->session->userdata('email');
        $role = $this->session->userdata('user_role');

        if($role == 2){
            $pdata['user_info'] = $this->pos_model->get_pos_info($current_email);
        }
        $this->load->view('customer/include/header.php', $data);
        $this->load->view('customer/pos_customer_list', $pdata);

        $this->load->view('customer/include/footer.php');
    }
    public function get_pos_customer_list()
    {
        $pos_id = $this->session->userdata('user_id');
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
              "phone_num"=>$value['phone_num'],
              "delivery_direction"=>$value['delivery_direction'],
              "status"=>$value['is_blocked'] ? "blocked" : "actived",
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
    public function updateaccount()
    {
        $form_data = $this->input->post();
        $email = $form_data['dzEmail'];
        $data = array(
            'customer_name' => $form_data['dzName'],
            'last_name1' => $form_data['dzLastname1'],
            'last_name2' => $form_data['dzLastname2'],
            'DNI' => $form_data['dzDNI'],
            // 'transaction' => '', 
            'phone' => $form_data['dzPhone'],
            'delivery_direction' => $form_data['dzd_location'],
            'Zip_code' => $form_data['dzZipcode'],
        );
        $result = $this->customer_model->update_customer($data, $email);

        if($result){
            $res_data = array(
                'status' => 1,
                'msg' => "Update is successed!",
                'type' => 'update'
            );
        }else{
            $res_data = array(
                'status' => 0,
                'msg' => "Update is failed!",
                'type' => 'update'
            );
        }
        echo json_encode($res_data);

        redirect('customer/index','refresh');
    }
    public function set_confirm()
    {
        $product_id = $this->input->post('product_id');
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        if($user_role == 1){
            $customer_id = $user_id;
            $pos_id = 0;
        }else if($user_role == 2){
            $pos_id = $user_id;
            $customer_id = $this->customer_model->get_customer($product_id);
        }
        $timestamp = time();
        $order_num = $customer_id.$product_id.$timestamp.rand(0, 9999);
        $result = $this->customer_model->confirmed_order($product_id, $customer_id, $order_num, $pos_id);
        if($result){
            $this->customer_model->set_order_flag($product_id, 2);
        }
        $is_pdf = $this->customer_model->check_pdf($product_id); 
        if($is_pdf['pdf_file'] == NULL || $is_pdf['pdf_file'] == ''){
            $budgets = $this->calculate_budget_pdf($product_id, $customer_id, $pos_id, $user_role);
            $this->customer_model->update_pdf($budgets['pdf_file'], $product_id);
        }
        if($user_role == 1){
            $this->customer_model->set_check_flag($order_num);
        }
        echo json_encode($result);
    }
    public function set_budget()
    {
        $online_mode = 0;
        $check_order = 1;
        $product_id = $this->input->post('product_id');
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role'); // 1: online_customer, 2: pos
        if($user_role == 1){  
            $online_mode = 1;
            $pos_id = 0;
            $customer_id = $user_id;
        }else if($user_role == 2){
            $pos_id = $user_id;
            $customer_id = $this->input->post('customer_id');
        }
        $result = $this->customer_model->update_products($product_id, $online_mode, $user_id, $customer_id, $user_role);  
        $budgets = $this->calculate_budget_pdf($product_id, $customer_id, $pos_id, $user_role);
        if($result){ //set the order_flag and budgets.
            $this->customer_model->set_order_flag($product_id, $check_order);
            $this->customer_model->save_budget($product_id, $budgets);
        }
        echo json_encode($result);
    }
    public function gen_pdf()
    {

        $product_id = $this->input->post('product_id');
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role'); // 1: online_customer, 2: pos
        if($user_role == 1){  
            // $online_mode = 1;
            $pos_id = 0;
            $customer_id = $user_id;
        }else if($user_role == 2){
            $pos_id = $user_id;
            $customer_id = $this->input->post('customer_id');
        }
        // $result = $this->customer_model->update_products($product_id, $online_mode, $user_id, $customer_id, $user_role);  
        
        $is_pdf = $this->customer_model->check_pdf($product_id); 
        if($is_pdf['pdf_file'] == NULL || $is_pdf['pdf_file'] == ''){
            $budgets = $this->calculate_budget_pdf($product_id, $customer_id, $pos_id, $user_role);
            $this->customer_model->update_pdf($budgets['pdf_file'], $product_id);
        }else{
            $budgets['pdf_file'] = $this->customer_model->get_pdf_file($product_id);
        }


        echo json_encode($budgets['pdf_file']);
    }
    public function get_productlist()
    {
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        if($user_role == 1){  //customer
            $pos_id = 0;
            $customer_id = $user_id;
        }else if($user_role == 2){  //pos
            $pos_id = $user_id;
            $customer_id = 0;
        }

        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->customer_model->get_all_product_count($customer_id, $pos_id);
        $totalRecordwithFilter = $this->customer_model->get_all_product_count_with_filter($customer_id, $pos_id, $search_key);
        $product_lists = $this->customer_model->get_productlist($customer_id, $pos_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($product_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);
            if($value['check_order'] == 3){ //canceled by a admin
                $act_str = 'Canceled it by a admin user.';
                $status_str = 'Canceled';
            }
            else if($value['check_order'] == 2){  //comfirmed
                // $act_str = '<a disabled  style="background: green; color: white;" h_id="'.$value['product_id'].'" id="confirmed'.$value['product_id'].'" class="btn btn-confirm">Confirmed</a>';
                $act_str = '';
                $status_str = 'Ordered';
            }else if($value['check_order'] == 1){  //confirm
                $status_str ='Budget';
                if($user_role == 1){
                    $act_str = '<div style="display:inline-flex;"><a h_id="'.$value['product_id'].'" id="confirm'.$value['product_id'].'" class="btn btn-confirm mr-1">Confirmar</a><a h_id="'.$value['product_id'].'" id="pdf'.$value['product_id'].'" class="btn btn-pdf mr-1">PDF</a><a h_id="'.$value['product_id'].'" id="email'.$value['product_id'].'" class="btn btn-email mr-1">Enviar a mi email</a><a href="../planner/load_design/'.['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';

                }else if($user_role == 2){
                    $act_str = '<div style="display:inline-flex;"><a h_id="'.$value['product_id'].'" id="confirm'.$value['product_id'].'" class="btn btn-confirm mr-1">Confirmar</a><a h_id="'.$value['product_id'].'" id="pdf'.$value['product_id'].'" class="btn btn-pdf mr-1">PDF</a><a h_id="'.$value['product_id'].'" id="email'.$value['product_id'].'" class="btn btn-email mr-1">Enviar a mi email</a><a href="http://207.154.243.81:8081/?designpkitchen'.$user_id.'planner'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
                }
            }else{  // 0: budget
                $status_str = 'Pre-budget';
                if($user_role == 1){
                    $act_str = '<div style="display:inline-flex;"><a h_id="'.$value['product_id'].'" id="budget'.$value['product_id'].'" class="btn btn-budget mr-1">Presupuesto</a><a href="../planner/load_design/'.['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
                }else if($user_role == 2){
                    $act_str = '<div style="display:inline-flex;"><a h_id="'.$value['product_id'].'" id="budget'.$value['product_id'].'" class="btn btn-budget mr-1">Presupuesto</a><a href="http://207.154.243.81:8081/?designpkitchen'.$user_id.'planner'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
                }
                
            }
            if($user_role == 1){
                $data[] = array( 
                  "no"=>$row_inx,
                  "product_name"=>$value['product_name'],
                  "furniture_cost"=>$value['estimated_furniture_cost'],
                  "other_cost"=>($value['estimated_countertio_cost']-$value['estimated_furniture_cost']),
                  "status"=>$status_str,
                  "action"=>$act_str
                );
            }else if($user_role == 2){
                $data[] = array( 
                  "no"=>$row_inx,
                  "product_name"=>$value['product_name'],
                  "customer"=>$value['customer_name'],
                  "furniture_cost"=>$value['estimated_furniture_cost'],
                  "other_cost"=>($value['estimated_countertio_cost']-$value['estimated_furniture_cost']),
                  "action"=>$act_str
                );
            }
            

            
        }

        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordwithFilter,
          "aaData" => $data
        );

        echo json_encode($response);
    }
    private function calculate_budget_pdf($product_id, $customer_id, $pos_id, $user_role)
    {
        $pdf_data = array();
        $result = array();   
        $total_furniture_cost = 0;
        $total_extra_cost = 0;
        $point_rate = $this->customer_model->get_point_rate($pos_id);

        $selected_models = $this->customer_model->get_selected_models($product_id); //get the model id and dimensions

         foreach ($selected_models as $key => $value) {
            $furniture_cost = 0;
            $value['width'] = $value['width'] - $value['width']%10;
            if($value['width'] > 80)
                $value['width'] = 80;
            $value['length'] = $value['length'] - $value['length']%10;
            if($value['length'] > 120)
                $value['length'] = 120;

            $furniture_point = $this->customer_model->get_model_point($value['model_id'], $value['width'], $value['length'], $value['model_level']);
            if($value['model_level'] == 'level1'){
                $f_point = $furniture_point[0]['level1'];
            }else if($value['model_level'] == 'level2'){
                $f_point = $furniture_point[0]['level2'];
            }else if($value['model_level'] == 'level3'){
                $f_point = $furniture_point[0]['level3'];
            }
            
            if($f_point < $point_rate[0]['max']){
                $furniture_cost = intval($f_point)*$point_rate[0]['price'];
            }if($point_rate[1]['max'] > $f_point && $f_point > $point_rate[1]['min']){
                $furniture_cost = intval($f_point)*$point_rate[1]['price'];
            }if($point_rate[2]['min'] < $f_point){
                $furniture_cost = intval($f_point)*$point_rate[2]['price'];
            }
            $total_furniture_cost += $furniture_cost;
            //extra price
            $extra_cost = $this->customer_model->get_extra_cost($value['model_id']);
            $total_extra_cost += $extra_cost['extra_price'];
            $pdf_temp = array('model_id' => $value['model_id'], 'furniture_cost' => $furniture_cost, 'extra_cost' => $extra_cost['extra_price']);
            
            //data to generate the pdf
            array_push($pdf_data, $pdf_temp);
            
         }
         $pdf_file = $this->generate_pdf($pdf_data, $product_id, $total_extra_cost, $total_furniture_cost, $user_role, $pos_id);
         //get margin/spread by pos_id
         if($user_role == 1){  // online_customer method
            $customer_margin_spread = $this->customer_model->get_customer_margin_spread();
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$customer_margin_spread['customer_margin']/100 + $customer_margin_spread['customer_spread'];

         }else if($user_role == 2){  //pos method
            $pos_margin_spread = $this->customer_model->get_pos_margin_spread($pos_id);
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$pos_margin_spread['pos_margin']/100 + $pos_margin_spread['pos_spread'];
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$pos_margin_spread['pos_customer_margin']/100 + $pos_margin_spread['pos_customer_spread'];
         }
         $result['total_cost'] = $total_furniture_cost+$total_extra_cost;
         $result['furniture_cost'] = $total_furniture_cost;
         $result['pdf_file'] = $pdf_file;
         return $result;
    }

    private function generate_pdf($pdf_data, $product_id, $total_extra_cost, $total_furniture_cost, $user_role, $pos_id)
    {
        $invoice_data = array();
        $sel_models = $this->customer_model->get_sel_models($product_id);
        for($i = 0; $i < count($sel_models); $i++){
            for($j = 0; $j < count($pdf_data); $j++){
                if($pdf_data[$j]['model_id'] == $sel_models[$i]['model_id']){
                    $tmp = array('model_id' => $sel_models[$i]['model_id'], 'quantity' => $sel_models[$i]['model_count'], 'furniture_cost' => $pdf_data[$j]['furniture_cost'], 'extra_cost' => $pdf_data[$j]['extra_cost']);
                    array_push($invoice_data, $tmp);
                    break;
                }
            }
            
        }
        $invoice_info = $this->customer_model->get_invoice_info($product_id);
        $timestamp = time();
        $today = date('Y-m-d');
        $path = FCPATH . 'vendor'.DIRECTORY_SEPARATOR.'FPDI'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR;
        require($path.'invoice.php');

        $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
        $pdf->AddPage();
        $pdf->addSociete( $invoice_info['pos_name'],
                          $invoice_info['pos_direction']."\n" .
                          $invoice_info['pos_zipcode']."\n".
                          "Madrid\n" .
                          "Spain");

        $pdf->addClientAdresse( $invoice_info['customer_name'],
                          $invoice_info['customer_direction']."\n" .
                          $invoice_info['customer_zipcode']."\n".
                          "Madrid\n" .
                          "Spain" );
        if($user_role == 1){
            $content = 'Telefono: 664 679 143    Correo electronico: contablilidad@roure.es    Sitio web: http://www.roure.es/';
            $nif = 'NIF: ESB42699256';
        }if($user_role == 2){
            $pos_info = $this->pos_model->get_pos_info_by_id($pos_id);
            $content = 'Telefono: '.$pos_info['phone_num'].'   Correo electronico: '.$pos_info['email'].'   Sitio web: http://www.roure.es/';
            $nif = 'CIF: '.$pos_info['CIF'];
        }
        
        $pdf->set_footer($content, $nif);
        // $pdf->addClientAdresse("Ste\nM. XXXX\n3ème étage\n33, rue d'ailleurs\n75000 PARIS");
        // Begin with regular font
        $pdf->SetFont('Arial','',18);
        $pdf->SetTextColor(0,0,0);
        $pdf->Write(20,'Presupuesto '.$invoice_info['product_id'].$timestamp);

        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(0,0,0);
        $pdf->Write(9,'Fecha');
        $pdf->Ln(4);
        $pdf->Write(9, 'presupuesto');
        $pdf->Ln(4);
        $pdf->SetFont('Arial','',9);
        $pdf->Write(9, $today);

        $cols=array( "Descripcion"    => 94,
             "Cantidad"  => 20,
             "Unitary Cost"     => 30,
             "Amount"      => 30,
             "Unit"          => 16);
        $pdf->addCols( $cols);
        $cols=array( "Descripcion"    => "L",
                     "Cantidad"  => "R",
                     "Unitary Cost"     => "R",
                     "Amount"      => "C",
                     "Unit"          => "C");
        $pdf->addLineFormat( $cols);
        //filtering the countertop
        $countertop_data = array();
        $skirting_data = array();
        for($i = 0; $i < count($invoice_data); $i++){
            if(count($countertop_data) == 0){
                array_push($countertop_data, $invoice_data[$i]);
            }else{
                for($j = 0; $j < count($countertop_data); $j++){
                    if(($countertop_data[$j]['countertop_type'] == $invoice_data[$i]['countertop_type']) && ($countertop_data[$j]['countertop_color'] == $invoice_data[$i]['countertop_color'])){
                        $countertop_data[$j]['quantity'] += 1;
                    }else{
                        array_push($countertop_data, $invoice_data[$i]);
                    }
                }
            }
            if(count($skirting_data) == 0){
                array_push($skirting_data, $invoice_data[$i]);
            }else{
                for($j = 0; $j < count($skirting_data); $j++){
                    if(($skirting_data[$j]['skirting_type'] == $invoice_data[$i]['skirting_type']) && ($skirting_data[$j]['skirting_color'] == $invoice_data[$i]['skirting_color'])){
                        $skirting_data[$j]['quantity'] += 1;
                    }else{
                        array_push($skirting_data, $invoice_data[$i]);
                    }
                }
            }

        }
        $start    = 109;
        $delta_y = 0;
        for($i = 0; $i < count($invoice_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($invoice_data[$i]['model_id'], $product_id);
            if($furniture_detail['summary']){
                $summary = 'Summary: '.$furniture_detail['summary'];
            }else{
                $summary = '';
            }
            $line = array( "Descripcion"    => $furniture_detail['furniture_name'].' chracteristics (interior color:'.$furniture_detail['interior_color'].', exterio color: '.$furniture_detail['exterio_color'].', dooropen type: '.$furniture_detail['dooropen_type'].', door thickness: '.$furniture_detail['door_thickness'].'), '.$summary,
                           "Cantidad"  => $invoice_data[$i]['quantity'],
                           "Unitary Cost"     => ($invoice_data[$i]['furniture_cost']+$invoice_data[$i]['interior_color_price']+$invoice_data[$i]['exterio_color_price']+$invoice_data[$i]['dooropen_type_price']+$invoice_data[$i]['door_thickness_price']),
                           "Amount"      => ($invoice_data[$i]['furniture_cost']+$invoice_data[$i]['interior_color_price']+$invoice_data[$i]['exterio_color_price']+$invoice_data[$i]['dooropen_type_price']+$invoice_data[$i]['door_thickness_price'])*$invoice_data[$i]['quantity'],
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        // $start = $start+2;        
        for($i = 0; $i < count($countertop_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($countertop_data[$i]['model_id'], $product_id);
            $line = array( "Descripcion"    => 'countertop: '.$furniture_detail['countertop_type'].', '.$furniture_detail['countertop_color'],
                           "Cantidad"  => $countertop_data[$i]['quantity'],
                           "Unitary Cost"     => ($furniture_detail['countertop_type_price']+$furniture_detail['countertop_color_price']),
                           "Amount"      => ($furniture_detail['countertop_type_price']+$furniture_detail['countertop_color_price'])*$countertop_data[$i]['quantity'],
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        for($i = 0; $i < count($skirting_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($skirting_data[$i]['model_id'], $product_id);
            $line = array( "Descripcion"    => 'skirting: caracteristics('.$furniture_detail['skirting_type'].', '.$furniture_detail['skirting_color'].')',
                           "Cantidad"  => $skirting_data[$i]['quantity'],
                           "Unitary Cost"     => ($furniture_detail['skirting_type_price']+$furniture_detail['skirting_color_price']),
                           "Amount"      => ($furniture_detail['skirting_type_price']+$furniture_detail['skirting_color_price'])*$skirting_data[$i]['quantity'],
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        $pdf->Ln(55);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->setLeftMargin(135);
        $pdf->Write(9,'Subtotal Cost: ');
        $pdf->Write(9, ($total_furniture_cost+$total_extra_cost));
        $pdf->Write(9, EURO);
        $pdf->Ln(5);
        $pdf->Write(9,'Taxes: ');
        $pdf->Write(9, ($total_furniture_cost+$total_extra_cost)*0.21);
        $pdf->Write(9, EURO);
        $pdf->Ln(5);
        $pdf->Write(9, 'Total Cost: ');
        $pdf->Write(9, ($total_furniture_cost+$total_extra_cost)+($total_furniture_cost+$total_extra_cost)*0.21);
        $pdf->Write(9, EURO);
        
        $pdf->setLeftMargin(0);
        $save_path = FCPATH.SAVE_PDF_PATH;
        $pdf->Output($save_path.$invoice_info['product_id'].'.pdf', 'F');

        return SAVE_PDF_PATH.$invoice_info['product_id'].'.pdf';
    }

    public function get_orderlist()
    {
        $customer_id = $this->session->userdata('user_id');
        // $pos_id = $this->input->post('pos_id');
        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->customer_model->get_all_order_count($customer_id);
        $totalRecordwithFilter = $this->customer_model->get_all_order_count_with_filter($customer_id, $search_key);
        $order_lists = $this->customer_model->get_orderlist($customer_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($order_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);
            if($value['check_flag'] == 2){
                $action_str = '<div style="display: inline-flex;"><!--a disabled  style="background: green; color: white;" h_id="'.$value['id'].'" id="confirmed'.$value['id'].'" class="btn btn-confirm mr-1">Confirmed</a--><a href="'.base_url().$value['pdf_file'].'" class="btn btn-pdf mr-1">See Order</a><a href="../planner/load_design/'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
            }
            else if($value['check_flag'] == 1){
                $action_str = '<div style="display: inline-flex;"><a disabled  style="background: green; color: white;" h_id="'.$value['id'].'" id="confirm'.$value['id'].'" class="btn btn-confirm mr-1">Pedido Confirmado</a><a href="../planner/load_design/'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
            }else if($value['check_flag'] == 0){
                $action_str = '<div style="display:inline-flex;"><a h_id="'.$value['id'].'" id="order'.$value['id'].'" class="btn btn-order mr-1" data-toggle="modal" data-target="#ordermodal">Order</a></div>';
            }
            $data[] = array( 
              "no"=>$row_inx,
              "order_no"=>$value['order_no'],
              "product_name"=>$value['product_name'],
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
    public function set_order()
    {
        $id = $this->input->post('id');
        $order_no = $this->input->post('order_no');

        $customer_id = $this->session->userdata('user_id');
        $this->customer_model->set_check_flag($order_no);
        
        echo json_encode($result);
    }
    // public function load_design()
    // {
    //     $product_id = $this->input->post('product_id');

    //     $product_info = $this->customer_model->get_product_info($product_id);
        
    //     echo json_encode($product_info);
    // }
    public function get_orderlist_pos()
    {
        $pos_id = $this->session->userdata('user_id');
        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->pos_model->get_all_pos_order_count($pos_id);
        $totalRecordwithFilter = $this->pos_model->get_all_pos_order_count_with_filter($pos_id, $search_key);
        $order_lists = $this->pos_model->get_pos_orderlist($pos_id, $start, $rowperpage, $search_key);
        $data = array();
        $inx = 0;
        foreach ($order_lists as $value) {
            $inx++;
            $row_inx = $inx + intval($start);
            if($value['check_flag'] == 2){
                $action_str = '<div style="display:inline-flex;"><!--a disabled  style="background: green; color: white;" h_id="'.$value['id'].'" id="confirmed'.$value['id'].'" class="btn btn-confirmed mr-1">Confirmed</a--><a href="'.base_url().$value['pdf_file'].'" class="btn btn-pdf mr-1" target="_blank">See Order</a><a href="http://207.154.243.81:8081/?designpkitchen'.$pos_id.'planner'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
            }else if($value['check_flag'] == 1){
                $action_str = '<div style="display:inline-flex;"><a h_id="'.$value['id'].'" id="confirm'.$value['id'].'" class="btn btn-confirm mr-1" data-toggle="modal" data-target="#ordermodal">Confirmar</a><a target="_black" href="'.base_url().$value['pdf_file'].'" class="btn btn-pdf mr-1">See Order</a><a href="http://207.154.243.81:8081/?designpkitchen'.$pos_id.'planner'.$value['product_id'].'" target="_blank" class="btn btn-design">Diseño 3D</a></div>';
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
    public function set_order_confirm_pos()
    {
        $order_no = $this->input->post('order_no');

        $pos_id = $this->session->userdata('user_id');
        $result = $this->pos_model->set_check_flag($order_no);
        
        echo json_encode($result);
    }
    public function send_email()
    {
        $product_id = $this->input->post('product_id');
        $user_role = $this->session->userdata('user_role');

        $email_info = $this->customer_model->get_emails($product_id);
        // if($user_role == 1){
        //     $from = $email_info['customer_email'];
        //     // $to = 'infoweb@roure.es';
        // }else if($user_role == 2){
        //     $from = $email_info['pos_email'];

        // }
        
        $path = FCPATH . 'vendor'.DIRECTORY_SEPARATOR.'PHPMailer'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;
        require($path."Exception.php");
        require($path."PHPMailer.php");
        require($path."SMTP.php");

        $email = new PHPMailer\PHPMailer\PHPMailer();

        $to = "bozokrkeljas0504@gmail.com";
        $from = "infoweb@roure.es";

        $email->isSMTP();
        $email->Host = 'smtp.ionos.es';
        $email->Port = 587;
        $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
        );
     	$email->SMTPSecure = false;
        $email->SMTPAutoTLS = false;
        $email->SMTPAuth = true;
        $email->Username = 'infoweb@roure.es';
        $email->Password = '#R0ure2021#';
        $email->setFrom($from, 'infoweb@roure.es');
        $email->addAddress($to, 'bozokrkeljas0504@gmail.com');
        $email->Subject = 'Kitchen Planner';
        $email->Body = 'Send the invoice file as a pdf attachment file.';
        $file_to_attach = site_url().$email_info['pdf_file'];
        $email->addAttachment( $file_to_attach , 'invoice.pdf' );

        // $email->send();
        // $email->SetFrom($email_address['customer_email'], $email_address['customer_name']); //Name is optional
        // $email->SetFrom('kitchenplanner@site.com', 'bozo');
        // $email->Subject   = 'Message Subject';
        // $email->Body      = 'Send the invoice file as a pdf attachment file.';
        // // $email->AddAddress($email_address['pos_email']);
        // $email->AddAddress('bozokrkeljas0504@gmail.com');

        // $file_to_attach = site_url().$email_address['pdf_file'];

        // $email->AddAttachment( $file_to_attach , 'invoice.pdf' );

        try {
            $email->send();
            $str = "Message has been sent successfully";
            $status = 'S';
        } catch (Exception $e) {
            $str =  "Mailer Error: " . $mail->ErrorInfo;
            $status = 'E';
        }

        $response = array('status' => $status, 'message' => $str);
        echo json_encode($response);

    }
    public function get_pos_locations()
    {
        $location_data = $this->customer_model->get_pos_locations();
        echo json_encode($location_data);
    }
    public function verify()
    {
        $email = $_GET['email'];
        $hash = $_GET['hash'];

        $check = $this->customer_model->check_verification($email, $hash);
        if($check > 0){
            $data = array(
                'verified' => 1
            );
            $this->customer_model->set_activity($data, $email, $hash);
            $data['msg'] = 'Tu cuenta ha sido validada, ya puede diseñar su propia cocina.';
            $data['status'] = 'S';
        }else{
            $data['msg'] = 'Verification is failed. Try it again!';
            $data['status'] = 'E';
        }
        
        $this->load->view('customer/include/header1.php', $data);
        $this->load->view('customer/verify', $data);
        $this->load->view('customer/include/footer.php');
    }
}
?>