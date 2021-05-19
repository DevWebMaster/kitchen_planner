
<?php
class Customer_model extends CI_Model{
	function __construct() {
		parent::__construct();
	}

	public function add_customer($data){
		// Inserting in Table(students) of Database(college)
		$this->db->select('*');
	    $this->db->where('email',$data['email']);
	    $query = $this->db->get('tbl_customers');
		if($query->num_rows() > 0){
			return 2;
		}
		$this->db->insert('tbl_customers', $data);
		if ($this->db->affected_rows() > 0) {
	      return 1;
	    }else{
	      return 0;
	    }
	}
	public function do_login_customer($email, $password){
		$this->db->select('*');
	    $this->db->where('email',$email);
	    $this->db->where('password',$password);
	    $this->db->where('is_blocked', 0);
	    $this->db->where('verified', 1);


	    $query = $this->db->get('tbl_customers');
	    
	    if($query->num_rows() > 0)
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
	    }
	}
	public function get_row_c1($email, $password)
	{ 
	   $this->db->where('email',$email);
	   $this->db->where('password',$password);
	   $query = $this->db->get('tbl_customers');
	   return $query->row();
	}
	public function get_customer_info($current_email)
	{
	   $this->db->where('email',$current_email);

	   $query = $this->db->get('tbl_customers');
	   return $query->row();
	}
	public function update_customer($data, $email)
	{
		$this->db->where('email',$email);
	    $this->db->update('tbl_customers',$data);
	    if ($this->db->affected_rows() > 0) 
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
	    }
	}
	public function is_exist($email)
	{
		$this->db->select('*');
	    $this->db->where('email',$email);

	    $query = $this->db->get('tbl_customers');
	    
	    if($query->num_rows() > 0)
	    {
	      return 1;
	    }
	    else
	    {
	      return 0;
	    }
	}
	public function get_customer_id($email)
	{
		$this->db->select('id');
		$this->db->from('tbl_customers');
		$this->db->where('email', $email);
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_pos_id($pos_name)
	{
		$this->db->select('pos_id');
		$this->db->from('tbl_pos');
		$this->db->where('pos_name', $pos_name);
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_product_list($customer_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_history_log');
		$this->db->where('customer_id', $customer_id);

		$query = $this->db->get()->result_array();
		return $query;
	}
	public function get_customer($product_id)
	{
		$this->db->select('customer_id');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();

		return $query[0]['customer_id'];
	}

	public function confirmed_order($product_id, $customer_id, $order_num, $pos_id)
	{
		$data = array(
			'order_no' => $order_num,
			'product_id' => $product_id,
			'status' => 'Order',
			'customer_id' => $customer_id,
			'pos_id' => $pos_id,
			'check_flag' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_order', $data);
		$insertId = $this->db->insert_id();

		return $insertId;
	}

	public function get_pos_list()
	{
		$this->db->select('*');
		$this->db->from('tbl_pos');

		$query = $this->db->get()->result_array();
		return $query;
	}
	public function set_order_flag($product_id, $check_order)
	{
		$data = array(
			'check_order' => $check_order
		);
		return $this->db->update('tbl_product_history_log',$data, array('product_id' => $product_id ) );
	}
	public function get_all_product_count($customer_id, $pos_id) {
		$this->db->select('a1.*, a2.pos_name');
		$this->db->from('tbl_product_history_log as a1');
		$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
		if($customer_id != 0){
			$this->db->where('a1.customer_id', $customer_id);
		}
		$this->db->where('a1.pos_id', $pos_id);

		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_all_product_count_with_filter($customer_id, $pos_id, $search_key) {
		$this->db->select('a1.*, a2.pos_name');
		$this->db->from('tbl_product_history_log as a1');
		$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
		if($customer_id != 0){
			$this->db->where('a1.customer_id', $customer_id);
		}
		$this->db->where('a1.pos_id', $pos_id);
		if($search_key != ''){
			$this->db->like('product_name', $search_key);
		}
		
		$query = $this->db->get();

		return $query->num_rows();
	}
	public function get_productlist($customer_id, $pos_id, $start, $rowperpage, $search_key) {
		$this->db->select('a1.*, a2.pos_name, concat(a3.customer_name, a3.last_name1, a3.last_name2) as customer_name');
		$this->db->from('tbl_product_history_log as a1');
		$this->db->join('tbl_pos as a2', 'a1.pos_id = a2.pos_id', 'left');
		$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
		if($customer_id != 0){
			$this->db->where('customer_id', $customer_id);
		}
		$this->db->where('a1.pos_id', $pos_id);
		if($search_key != ''){
			$this->db->like('product_name', $search_key);
		}
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function get_selected_models($product_id)
	{
		$this->db->select('model_id, width, length, model_level');
		$this->db->from('tbl_model_select_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();

		return $query;
	}
	public function get_sel_models($product_id)
	{
		$this->db->select('count(model_id) as model_count, model_id');
		$this->db->from('tbl_model_select_log');
		$this->db->where('product_id', $product_id);
		$this->db->group_by('model_id');
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function get_model_point($model_id, $width, $length, $model_level)
	{
		$this->db->select('a1.level1, a1.level2, a1.level3');
		$this->db->from('tbl_model_point_list as a1');
		$this->db->join('tbl_model_list as a2', 'a2.cube_id = a1.cube', 'left');
		$this->db->where('a2.model_id', $model_id);
		$this->db->where('a1.width', $width);
		$this->db->where('a1.length', $length);
		$query = $this->db->get()->result_array();

		return $query;
	}

	public function get_point_rate($pos_id)
	{
		$this->db->select('a1.*');
		$this->db->from('tbl_point_rate as a1');
		$this->db->where('a1.pos_rate', $pos_id);
		$query = $this->db->get()->result_array();

		return $query;
	}
	public function get_extra_cost($model_id)
	{

		$this->db->select('a1.model_id, SUM(a2.price+a3.price+a4.price+a5.price+a6.price+a7.price+a8.price+a9.price) as extra_price');
		$this->db->from('tbl_model_list as a1');
		$this->db->join('tbl_material as a2', 'a2.material_id = a1.countertop_type', 'left');
		$this->db->join('tbl_material as a3', 'a3.material_id = a1.skirting_type', 'left');
		$this->db->join('tbl_color as a4', 'a4.color_id = a1.countertop_color', 'left');
		$this->db->join('tbl_color as a5', 'a5.color_id = a1.exterio_color', 'left');
		$this->db->join('tbl_color as a6', 'a6.color_id = a1.interior_color', 'left');
		$this->db->join('tbl_color as a7', 'a7.color_id = a1.skirting_color', 'left');
		$this->db->join('tbl_door_style as a8', 'a8.style_id = a1.dooropen_type', 'left');
		$this->db->join('tbl_door_thickness as a9', 'a9.thickness_id = a1.door_thickness', 'left');
		$this->db->where('a1.model_id', $model_id);
		$query = $this->db->get()->result_array();
		return $query[0];
	}
	public function get_furniture_details($model_id, $product_id)
	{
		$this->db->select('a1.model_id, a1.name as furniture_name, a2.name as countertop_type, a2.price as countertop_type_price, a3.name as skirting_type, a3.price as skirting_type_price, a4.name as countertop_color, a4.price as countertop_color_price, a5.name as exterio_color, a5.price as exterio_color_price, a6.name as interior_color, a6.price as interior_color_price, a7.name as skirting_color, a7.price as skirting_color_price, a8.name as dooropen_type, a8.price as dooropen_type_price, a9.name as door_thickness, a9.price as door_thickness_price, a10.summary');
		$this->db->from('tbl_model_list as a1');
		$this->db->join('tbl_material as a2', 'a2.material_id = a1.countertop_type', 'left');
		$this->db->join('tbl_material as a3', 'a3.material_id = a1.skirting_type', 'left');
		$this->db->join('tbl_color as a4', 'a4.color_id = a1.countertop_color', 'left');
		$this->db->join('tbl_color as a5', 'a5.color_id = a1.exterio_color', 'left');
		$this->db->join('tbl_color as a6', 'a6.color_id = a1.interior_color', 'left');
		$this->db->join('tbl_color as a7', 'a7.color_id = a1.skirting_color', 'left');
		$this->db->join('tbl_door_style as a8', 'a8.style_id = a1.dooropen_type', 'left');
		$this->db->join('tbl_door_thickness as a9', 'a9.thickness_id = a1.door_thickness', 'left');
		$this->db->join('tbl_model_select_log as a10', 'a10.model_id = a1.model_id', 'left');
		$this->db->where('a1.model_id', $model_id);
		$this->db->where('a10.product_id', $product_id);
		$query = $this->db->get()->result_array();
		return $query[0];
	}
	public function update_products($product_id, $online_mode, $user_id, $customer_id, $user_role)
	{
		if($user_role == 1){
			$data = array(
				'online_mode' => $online_mode,
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $user_id,
			);
		}else if($user_role == 2){
			$data = array(
				'customer_id' => $customer_id,
				'online_mode' => $online_mode,
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $user_id,
			);
		}
		
		return $this->db->update('tbl_product_history_log',$data, array('product_id' => $product_id ) );
	}
	public function save_budget($product_id,$budgets)
	{
		$data = array(
			'estimated_furniture_cost' => $budgets['furniture_cost'],
			'estimated_countertio_cost' => $budgets['total_cost'],
			'is_pdf' => 1,
			'pdf_file' => $budgets['pdf_file'],
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $customer_id,
		);
		return $this->db->update('tbl_product_history_log',$data, array('product_id' => $product_id ) );
	}
	public function get_customer_margin_spread()
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_margin_spread');
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_pos_margin_spread($pos_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_pos_margin_spread');
		$this->db->where('pos_id', $pos_id);
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_pos_id_from_name($pos_name)
	{
		$this->db->select('pos_id');
		$this->db->from('tbl_pos');
		$this->db->where('pos_name', $pos_name);
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_all_order_count($customer_id) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->where('a1.customer_id', $customer_id);
		// $this->db->where('a2.pos_id', 0);

		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_all_order_count_with_filter($customer_id, $search_key) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->where('a1.customer_id', $customer_id);
		// $this->db->where('a2.pos_id', 0);
		if($search_key != ''){
			$this->db->like('a2.product_name', $search_key);
		}
		
		$query = $this->db->get();

		return $query->num_rows();
	}
	public function get_orderlist($customer_id, $start, $rowperpage, $search_key) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a2.pdf_file');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->where('a1.customer_id', $customer_id);
		// $this->db->where('a1.pos_id', 0);
		if($search_key != ''){
			$this->db->like('a2.product_name', $search_key);
		}
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function get_product_info($product_id)
	{
		$this->db->select('product_name');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);

		$query = $this->db->get()->result_array();
		return $query[0];
	}
	public function get_customers() {
		$this->db->select('*');
		$this->db->from('tbl_customers as a1');
		$this->db->where('a1.is_deleted', 0);

		$query = $this->db->get()->result_array();

		
		  return $query;
	}
	public function set_check_flag($order_no)
	{
		$data = array(
			'check_flag' => 1,
			'status' => 'Pre-confirmed',
		);
		return $this->db->update('tbl_order',$data, array('order_no' => $order_no ) );
	}
	public function get_invoice_info($product_id)
	{
		$this->db->select('pos_id');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();
		if($query[0]['pos_id'] == 0){
			$this->db->select('a1.product_id, a2.customer_name, a2.delivery_direction as customer_direction, a2.zipcode as customer_zipcode, a3.username as pos_name, a3.email as pos_direction, a3.mobile_no as pos_zipcode');
			$this->db->from('tbl_product_history_log as a1');
			$this->db->join('tbl_customers as a2', 'a1.customer_id = a2.id', 'left');
			$this->db->join('gb_admin as a3', 'a1.pos_id = a3.id', ' left');
			$this->db->where('product_id', $product_id);
			$query1 = $this->db->get()->result_array();
			return $query1[0];
		}else{
			$this->db->select('a1.product_id, a2.customer_name, a2.delivery_direction as customer_direction, a2.zipcode as customer_zipcode, a3.pos_name, a3.address as pos_direction, a3.zipcode as pos_zipcode');
			$this->db->from('tbl_product_history_log as a1');
			$this->db->join('tbl_customers as a2', 'a1.customer_id = a2.id', 'left');
			$this->db->join('tbl_pos as a3', 'a1.pos_id = a3.pos_id', ' left');
			$this->db->where('product_id', $product_id);
			$query2 = $this->db->get()->result_array();
			return $query2[0];
		}
		
		
	}
	public function get_emails($product_id)
	{
		$this->db->select('pos_id');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();
		if($query[0]['pos_id'] == 0){
			$this->db->select('a1.product_id, a1.pdf_file, a2.email as customer_email, a2.customer_name, a3.email as pos_email');
			$this->db->from('tbl_product_history_log as a1');
			$this->db->join('tbl_customers as a2', 'a1.customer_id = a2.id', 'left');
			$this->db->join('gb_admin as a3', 'a1.pos_id = a3.id', ' left');
			$this->db->where('product_id', $product_id);
			$query1 = $this->db->get()->result_array();
			return $query1[0];
		}else{
			$this->db->select('a1.product_id, a1.pdf_file, a2.email as customer_email, a2.customer_name, a3.email as pos_email');
			$this->db->from('tbl_product_history_log as a1');
			$this->db->join('tbl_customers as a2', 'a1.customer_id = a2.id', 'left');
			$this->db->join('tbl_pos as a3', 'a1.pos_id = a3.pos_id', ' left');
			$this->db->where('product_id', $product_id);
			$query2 = $this->db->get()->result_array();
			return $query2[0];
		}
		
		
	}
	public function check_pdf($product_id){
		$this->db->select('pdf_file');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();
		return $query[0];
	}
	public function update_pdf($pdf_file, $product_id)
	{
		$data = array(
			'pdf_file' => $pdf_file,
			'is_pdf' => 1
		);
		return $this->db->update('tbl_product_history_log',$data, array('product_id' => $product_id ) );
	}
	public function get_pdf_file($product_id)
	{
		$this->db->select('pdf_file');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get()->result_array();
		return $query[0]['pdf_file'];
	}
	public function get_pos_locations()
	{
		$this->db->select('pos_name as name, address, description, lat, lon');
		$this->db->from('tbl_pos');
		$this->db->where('is_deleted', 0);
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function check_verification($email, $hash)
	{
		$this->db->select('id');
		$this->db->from('tbl_customers');
		$this->db->where('email', $email);
		$this->db->where('hash', $hash);
		$query = $this->db->get()->result_array();

		return count($query);
	}
	public function set_activity($data, $email, $hash)
	{
		$this->db->where('email', $email);
		$this->db->where('hash', $hash);
		$this->db->update('tbl_customers', $data);
	}
}
?>