<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Planner extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('customer/planner_model', 'planner_model');
        $this->load->model('customer/Customer_model', 'customer_model');
        $this->load->helper('url');

    }
    public function index($product_id = 0, $flag = 0)
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
            $this->load->view('customer/planner', ['search_list' => $search_list, 'product_id' => $product_id, 'flag' => $flag]);
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
        // $customer_id = $this->input->post('customer_id');
        $summary_arr = $this->input->post('summary_arr');

        if($user_role == 1){  
            $online_mode = 1;
            $pos_id = 0;
            $customer_id = $user_id;
        }else if($user_role == 2){
            $pos_id = $user_id;
            $customer_id = $this->input->post('customer_id');
        }

        $result = $this->planner_model->get_budget($user_role, $user_id, $req_data['items'], $product_id, $customer_id, $summary_arr);

        $is_pdf = $this->customer_model->check_pdf($product_id); 
        // if($is_pdf['pdf_file']){
            $budgets = $this->calculate_budget_pdf($product_id, $customer_id, $pos_id, $user_role);
            $this->customer_model->update_pdf($budgets['pdf_file'], $product_id);
        // }

        echo json_encode($result);
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
            if($value['width'] < 60)
                $value['width'] = 60;
            $value['length'] = $value['length'] - $value['length']%10;
            if($value['length'] > 120)
                $value['length'] = 120;
            if($value['length'] < 60)
                $value['length'] = 60;

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
            $price_countertop_skirting = $this->customer_model->get_price_countertop_skirting($value['model_id']);
            $skirting_price = $value['length']*$value['width']*($price_countertop_skirting['skirting_type_price'] + $price_countertop_skirting['skirting_color_price'])/1000000;
            $countertop_price = $value['length']*$value['width']*($price_countertop_skirting['countertop_type_price'] + $price_countertop_skirting['countertop_color_price'])/1000000;

            $extra_cost = $this->customer_model->get_extra_cost($value['model_id']);
            $total_extra_cost += ($extra_cost['extra_price'] + $skirting_price + $countertop_price);
            $pdf_temp = array('model_id' => $value['model_id'], 'furniture_cost' => $furniture_cost, 'extra_cost' => $extra_cost['extra_price'], 'countertop_price' => $countertop_price, 'skirting_price' => $skirting_price, 'id' => $value['id']);
            
            //data to generate the pdf
            array_push($pdf_data, $pdf_temp);
            
         }
         // $margin_spread = 0;
         //get margin/spread by pos_id
         if($user_role == 1){  // online_customer method
            $customer_margin_spread = $this->customer_model->get_customer_margin_spread();
            $margin_spread = $customer_margin_spread;
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$customer_margin_spread['customer_margin']/100;

         }else if($user_role == 2){  //pos method
            $pos_margin_spread = $this->customer_model->get_pos_margin_spread($pos_id);
            $margin_spread = $pos_margin_spread;
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$pos_margin_spread['pos_margin']/100 ;
            $total_extra_cost = $total_extra_cost + $total_extra_cost*$pos_margin_spread['pos_customer_margin']/100;
         }
         $pdf_file = $this->generate_pdf($pdf_data, $product_id, $total_extra_cost, $total_furniture_cost, $user_role, $pos_id, $margin_spread);
         $result['total_cost'] = $total_furniture_cost+$total_extra_cost;
         $result['furniture_cost'] = $total_furniture_cost;
         $result['pdf_file'] = $pdf_file;
         return $result;
    }

    private function generate_pdf($pdf_data, $product_id, $total_extra_cost, $total_furniture_cost, $user_role, $pos_id, $margin_spread)
    {
        $invoice_data = array();
        $sel_models = $this->customer_model->get_sel_models($product_id);
        for($i = 0; $i < count($sel_models); $i++){
            for($j = 0; $j < count($pdf_data); $j++){
                if($pdf_data[$j]['id'] == $sel_models[$i]['id']){
                    $tmp = array('model_id' => $sel_models[$i]['model_id'], 'quantity' => $sel_models[$i]['model_count'], 'furniture_cost' => $pdf_data[$j]['furniture_cost'], 'extra_cost' => $pdf_data[$j]['extra_cost'], 'countertop_price' => $pdf_data[$j]['countertop_price'], 'skirting_price' => $pdf_data[$j]['skirting_price'], 'width' => $sel_models[$i]['width'], 'depth' => $sel_models[$i]['length']);
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

        $start    = 109;
        $delta_y = 0;
        for($i = 0; $i < count($invoice_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($invoice_data[$i]['model_id'], $product_id);
            if($furniture_detail['summary']){
                $summary = 'Summary: '.$furniture_detail['summary'];
            }else{
                $summary = '';
            }
            $line = array( "Descripcion"    => $furniture_detail['furniture_name'].'('.$invoice_data[$i]['width'].'*'.$invoice_data[$i]['depth'].')'.' chracteristics (interior color:'.$furniture_detail['interior_color'].', exterio color: '.$furniture_detail['exterio_color'].', dooropen type: '.$furniture_detail['dooropen_type'].', door thickness: '.$furniture_detail['door_thickness'].'), '.$summary,
                           "Cantidad"  => $invoice_data[$i]['quantity'],
                           "Unitary Cost"     => $user_role == 1 ? $invoice_data[$i]['furniture_cost']+$furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price']+($furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price'])*$margin_spread['customer_margin']/100 : $invoice_data[$i]['furniture_cost']+($furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price'])*(1+$margin_spread['pos_margin']/100+$margin_spread['pos_customer_margin']/100+$margin_spread['pos_margin']/100*$margin_spread['pos_customer_margin']/100),
                           "Amount"      => $user_role == 1 ? ($invoice_data[$i]['furniture_cost']+$furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price']+($furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price'])*$margin_spread['customer_margin']/100)*$invoice_data[$i]['quantity'] : ($invoice_data[$i]['furniture_cost']+($furniture_detail['interior_color_price']+$furniture_detail['exterio_color_price']+$furniture_detail['dooropen_type_price']+$furniture_detail['door_thickness_price'])*(1+($margin_spread['pos_margin']/100)+($margin_spread['pos_customer_margin']/100)+($margin_spread['pos_margin']/100)*($margin_spread['pos_customer_margin']/100)))*$invoice_data[$i]['quantity'],
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        // $start = $start+2;        
        for($i = 0; $i < count($invoice_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($invoice_data[$i]['model_id'], $product_id);
            $line = array( "Descripcion"    => 'countertop: '.'('.$invoice_data[$i]['width'].'*'.$invoice_data[$i]['depth'].')'.$furniture_detail['countertop_type'].', '.$furniture_detail['countertop_color'],
                           "Cantidad"  => $invoice_data[$i]['quantity'],
                           "Unitary Cost"     => $user_role == 1 ? number_format($invoice_data[$i]['countertop_price']+($invoice_data[$i]['countertop_price'])*$margin_spread['customer_margin']/100, 2): number_format(($invoice_data[$i]['countertop_price'])*(1+$margin_spread['pos_margin']/100+$margin_spread['pos_customer_margin']/100+$margin_spread['pos_margin']/100*$margin_spread['pos_customer_margin']/100), 2),
                           "Amount"      => $user_role == 1 ? number_format(($invoice_data[$i]['countertop_price']+($invoice_data[$i]['countertop_price'])*$margin_spread['customer_margin']/100)*$invoice_data[$i]['quantity'], 2) : number_format((($invoice_data[$i]['countertop_price'])*(1+$margin_spread['pos_margin']/100+$margin_spread['pos_customer_margin']/100+$margin_spread['pos_margin']/100*$margin_spread['pos_customer_margin']/100))*$invoice_data[$i]['quantity'], 2),
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        for($i = 0; $i < count($invoice_data); $i++){
            $furniture_detail = $this->customer_model->get_furniture_details($invoice_data[$i]['model_id'], $product_id);
            $line = array( "Descripcion"    => 'skirting:'.'('.$invoice_data[$i]['width'].'*'.$invoice_data[$i]['depth'].')'.' caracteristics('.$furniture_detail['skirting_type'].', '.$furniture_detail['skirting_color'].')',
                           "Cantidad"  => $invoice_data[$i]['quantity'],
                           "Unitary Cost"     => $user_role == 1 ? number_format($invoice_data[$i]['skirting_price']+($invoice_data[$i]['skirting_price'])*$margin_spread['customer_margin']/100, 2) : number_format(($invoice_data[$i]['skirting_price'])*(1+$margin_spread['pos_margin']/100+$margin_spread['pos_customer_margin']/100+$margin_spread['pos_margin']/100*$margin_spread['pos_customer_margin']/100), 2),
                           "Amount" => $user_role == 1 ? number_format(($invoice_data[$i]['skirting_price']+($invoice_data[$i]['skirting_price'])*$margin_spread['customer_margin']/100)*$invoice_data[$i]['quantity'], 2) : number_format((($invoice_data[$i]['skirting_price'])*(1+$margin_spread['pos_margin']/100+$margin_spread['pos_customer_margin']/100+$margin_spread['pos_margin']/100*$margin_spread['pos_customer_margin']/100))*$invoice_data[$i]['quantity'], 2),
                           "Unit" => EURO);
            $size = $pdf->addLine( $start, $line );
            $start += $size+2;
        }
        $pdf->Ln(55);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->setLeftMargin(135);
        $pdf->Write(9,'Subtotal: ');
        $pdf->Write(9, number_format($total_furniture_cost+$total_extra_cost, 2));
        $pdf->Write(9, EURO);
        $pdf->Ln(5);
        $pdf->Write(9,'Impuestos: ');
        $pdf->Write(9, number_format(($total_furniture_cost+$total_extra_cost)*0.21, 2));
        $pdf->Write(9, EURO);
        $pdf->Ln(5);
        $pdf->Write(9, 'Precio Total: ');
        $pdf->Write(9, number_format(($total_furniture_cost+$total_extra_cost)+($total_furniture_cost+$total_extra_cost)*0.21, 2));
        $pdf->Write(9, EURO);
        
        $pdf->setLeftMargin(0);
        $save_path = FCPATH.SAVE_PDF_PATH;
        if (file_exists($save_path.$invoice_info['product_id'].'.pdf')) {
            unlink($save_path.$invoice_info['product_id'].'.pdf');
        }
        $pdf->Output($save_path.$invoice_info['product_id'].'.pdf', 'F');

        return SAVE_PDF_PATH.$invoice_info['product_id'].'.pdf';
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