
<?php
class Planner_model extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	public function get_wall_floor() {
		$this->db->select('name, concat("'.PREFIX_IMAGE_PATH.'", image) as image');
		$this->db->from('tbl_wall_texture');
		$wall = $this->db->get()->result_array();

		$this->db->select('name, concat("'.PREFIX_IMAGE_PATH.'", image) as image');
		$this->db->from('tbl_floor_texture');
		$floor = $this->db->get()->result_array();

		$wall_floor = array(
			'wall_data' => $wall,
			'floor_data' => $floor
		);
		return $wall_floor;
	}
	public function get_main_menu() {
		$this->db->select('id, name, concat("'.PREFIX_IMAGE_PATH.'", image) as image');
		$this->db->from('tbl_main_menu');
		$rtn = $this->db->get()->result_array();

		return $rtn;
	}
	public function get_sub_menu($main_menu_id){
		$this->db->select('id, main_id, name, concat("'.PREFIX_IMAGE_PATH.'", image) as image');
		$this->db->from('tbl_sub_menu');
		$this->db->where('main_id', $main_menu_id);
		$rtn = $this->db->get()->result_array();

		return $rtn;
	}
	public function get_sub_menu_for_search($main_menu_id, $search_str){
		$this->db->select('id, main_id, name, concat("'.PREFIX_IMAGE_PATH.'", image) as image');
		$this->db->from('tbl_sub_menu');
		$this->db->where('main_id', $main_menu_id);
		$this->db->like('name', $search_str);
		$rtn = $this->db->get()->result_array();

		return $rtn;
	}
	public function get_shortkey_menu($main_id, $sub_id) {
		$this->db->select('a1.model_id, a1.main_id, a1.sub_id, a1.name, concat("'.PREFIX_IMAGE_PATH.'", a1.image) as image, concat("'.PREFIX_IMAGE_PATH.'", a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type');
		$this->db->from('tbl_model_list as a1');
		$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
		$this->db->join('tbl_sub_menu as a3', 'a1.sub_id = a3.id', 'left');
		$this->db->join('tbl_material as a4', 'a1.countertop_type = a4.material_id', 'left');
		$this->db->join('tbl_material as a5', 'a1.skirting_type = a5.material_id', 'left');
		$this->db->join('tbl_color as a6', 'a1.countertop_color = a6.color_id', 'left');
		$this->db->join('tbl_color as a7', 'a1.exterio_color = a7.color_id', 'left');
		$this->db->join('tbl_color as a8', 'a1.interior_color = a8.color_id', 'left');
		$this->db->join('tbl_color as a9', 'a1.skirting_color = a9.color_id', 'left');
		$this->db->join('tbl_door_style as a10', 'a1.dooropen_type = a10.style_id', 'left');
		$this->db->join('tbl_door_thickness as a11', 'a1.door_thickness = a11.thickness_id');
		$this->db->join('tbl_model_type as a12', 'a1.type = a12.type');
		$this->db->where('a1.main_id', $main_id);
		$this->db->where('a1.sub_id', $sub_id);

		$rtn = $this->db->get()->result_array();

		return $rtn;
	}
	public function get_thumbnail_menu($main_id, $sub_id, $search_str, $search_countertop_type, $search_countertop_color, $search_exterio_color, $search_interior_color, $search_skirting_type, $search_skirting_color) {
		$this->db->select('a1.model_id, a1.main_id, a1.sub_id, a1.name, concat("'.PREFIX_IMAGE_PATH.'", a1.image) as image, concat("'.PREFIX_IMAGE_PATH.'", a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type');
		$this->db->from('tbl_model_list as a1');
		$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
		$this->db->join('tbl_sub_menu as a3', 'a1.sub_id = a3.id', 'left');
		$this->db->join('tbl_material as a4', 'a1.countertop_type = a4.material_id', 'left');
		$this->db->join('tbl_material as a5', 'a1.skirting_type = a5.material_id', 'left');
		$this->db->join('tbl_color as a6', 'a1.countertop_color = a6.color_id', 'left');
		$this->db->join('tbl_color as a7', 'a1.exterio_color = a7.color_id', 'left');
		$this->db->join('tbl_color as a8', 'a1.interior_color = a8.color_id', 'left');
		$this->db->join('tbl_color as a9', 'a1.skirting_color = a9.color_id', 'left');
		$this->db->join('tbl_door_style as a10', 'a1.dooropen_type = a10.style_id', 'left');
		$this->db->join('tbl_door_thickness as a11', 'a1.door_thickness = a11.thickness_id', 'left');
		$this->db->join('tbl_model_type as a12', 'a1.type = a12.type', 'left');
		$this->db->where('a1.main_id', $main_id);
		$this->db->where('a1.sub_id', $sub_id);
		$this->db->like('a1.name', $search_str);
		if($search_countertop_type != ''){
			$this->db->where('a4.material_id', $search_countertop_type);
		}
		if($search_countertop_color != ''){
			$this->db->where('a6.color_id', $search_countertop_color);
		}
		if($search_exterio_color != ''){
			$this->db->where('a7.color_id', $search_exterio_color);
		}
		if($search_interior_color != ''){
			$this->db->where('a8.color_id', $search_interior_color);
		}
		if($search_skirting_type != ''){
			$this->db->where('a5.material_id', $search_skirting_type);
		}
		if($search_skirting_color != ''){
			$this->db->where('a9.color_id', $search_skirting_color);
		}

		$rtn = $this->db->get()->result_array();
			
		return $rtn;
	}
	public function get_observation($user_role, $user_id, $product_id) {
		$this->db->select('a1.model_id, a1.main_id, a1.sub_id, a1.name, concat("'.PREFIX_IMAGE_PATH.'", a1.image) as image, concat("'.PREFIX_IMAGE_PATH.'", a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type');
		$this->db->from('tbl_model_select_log as a2');
		$this->db->join('tbl_model_list as a1', 'a1.model_id = a2.model_id', 'left');
		$this->db->join('tbl_material as a4', 'a1.countertop_type = a4.material_id', 'left');
		$this->db->join('tbl_material as a5', 'a1.skirting_type = a5.material_id', 'left');
		$this->db->join('tbl_color as a6', 'a1.countertop_color = a6.color_id', 'left');
		$this->db->join('tbl_color as a7', 'a1.exterio_color = a7.color_id', 'left');
		$this->db->join('tbl_color as a8', 'a1.interior_color = a8.color_id', 'left');
		$this->db->join('tbl_color as a9', 'a1.skirting_color = a9.color_id', 'left');
		$this->db->join('tbl_door_style as a10', 'a1.dooropen_type = a10.style_id', 'left');
		$this->db->join('tbl_door_thickness as a11', 'a1.door_thickness = a11.thickness_id', 'left');
		$this->db->join('tbl_model_type as a12', 'a1.type = a12.type', 'left');
		$this->db->where('a2.product_id', $product_id);
		$this->db->group_by('a2.model_id');

		return $this->db->get()->result_array();

	}
	public function get_customer() {
		$this->db->select('id, concat(customer_name, last_name1, last_name2) as name');
		$this->db->from('tbl_customers');
		$this->db->where('is_deleted', 0);

		return $this->db->get()->result_array();
	}
	public function get_budget($user_role, $user_id, $items, $product_id, $customer_id, $summary_arr) {
		if(count($summary_arr) > 0){
			foreach ($summary_arr as $key => $value) {
				$data = array(
					'summary' => $value['summary'],
				);
				$this->db->where('model_id', $value['model_id']);
				$this->db->where('product_id', $product_id);
				$this->db->update('tbl_model_select_log', $data);
			}
		}
		if(count($items) > 0 && is_array($items)){
			foreach ($items as $key => $item) {
				$furniture_cost = 0;
				$item['width'] = $item['width']-$item['width']%10;
				if($item['width'] > 80)
					$item['width'] = 80;
				if($item['width'] < 60)
					$item['width'] = 60;
				$item['depth'] = $item['depth']-$item['depth']%10;
				if($item['depth'] > 120)
					$item['depth'] = 120;
				if($item['depth'] < 60)
					$item['depth'] = 60;

				$this->db->select('a1.level1, a1.level2, a1.level3');
				$this->db->from('tbl_model_point_list as a1');
				$this->db->join('tbl_model_list as a2', 'a1.cube = a2.cube_id', 'left');
				$this->db->where('a2.model_id', $item['model_id']);
				$this->db->where('a1.width', $item['width']);
				$this->db->where('a1.length', $item['depth']);
				$f_point = $this->db->get()->result_array()[0]['level1'];

				if($user_role == 1){
					$user_id = 0;
				}

				$this->db->select('*');
				$this->db->from('tbl_point_rate');
				$this->db->where('pos_rate', $user_id);
				$point_rate = $this->db->get()->result_array();

				if($f_point < $point_rate[0]['max'])
					$furniture_cost = $f_point*$point_rate[0]['price'];
				if(($point_rate[1]['max'] > $f_point) && ($f_point > $point_rate[1]['min']))
					$furniture_cost = $f_point*$point_rate[1]['price'];
				if($point_rate[2]['min'] < $f_point)
					$furniture_cost = $f_point*$point_rate[2]['price'];

				$total_furniture_cost += $furniture_cost;

				$this->db->select('a1.model_id, SUM(a2.price+a3.price+a4.price+a5.price+a6.price+a7.price+a8.price+a9.price) as extra_cost');
				$this->db->from('tbl_model_list as a1');
				$this->db->join('tbl_material as a2', 'a1.countertop_type = a2.material_id', 'left');
				$this->db->join('tbl_material as a3', 'a1.skirting_type = a3.material_id', 'left');
				$this->db->join('tbl_color as a4', 'a1.countertop_color = a4.color_id', 'left');
				$this->db->join('tbl_color as a5', 'a1.exterio_color = a5.color_id', 'left');
				$this->db->join('tbl_color as a6', 'a1.interior_color = a6.color_id', 'left');
				$this->db->join('tbl_color as a7', 'a1.skirting_color = a7.color_id', 'left');
				$this->db->join('tbl_door_style as a8', 'a1.dooropen_type = a8.style_id', 'left');
				$this->db->join('tbl_door_thickness as a9', 'a1.door_thickness = a9.thickness_id', 'left');
				$this->db->where('a1.model_id', $item['model_id']);

				$extra_cost = $this->db->get()->result_array()[0]['extra_cost'];

				$this->db->select('*');
				if($user_role == 2){
					$this->db->from('tbl_pos_margin_spread');
					$this->db->where('pos_id', $user_id);
				}else if($user_role == 1){
					$this->db->from('tbl_customer_margin_spread');
				}
				$margin_spread = $this->db->get()->result_array()[0];

				if($user_role == 2){
					$extra_cost = $extra_cost+$extra_cost*$margin_spread['pos_margin']/100;
					$extra_cost = $extra_cost+$extra_cost*$margin_spread['pos_customer_margin']/100;
				}else if($user_role == 1){
					$extra_cost = $extra_cost+$extra_cost*$margin_spread['customer_margin']/100;
				}
				$total_extra_cost += $extra_cost;
			}
			$budgets = array(
				'total_furniture_cost' => $total_furniture_cost,
				'total_extra_cost' => $total_extra_cost
			);

			$online_mode = 0;
			if($user_role == 1){
				$online_mode = 1;
				$data = array(
					'estimated_furniture_cost' => $total_furniture_cost,
					'estimated_countertio_cost' => ($total_furniture_cost+$total_extra_cost),
					'check_order' => 1,
					'online_mode' => $online_mode,
					'updated_by' => $user_id
				);
				$this->db->where('product_id', $product_id);
				$this->db->update('tbl_product_history_log', $data);
			}else if($user_role == 2){
				$data = array(
					'estimated_furniture_cost' => $total_furniture_cost,
					'estimated_countertio_cost' => ($total_furniture_cost+$total_extra_cost),
					'customer_id' => $customer_id,
					'check_order' => 1,
					'online_mode' => $online_mode,
					'updated_by' => $user_id,
				);
				$this->db->where('product_id', $product_id);
				$this->db->update('tbl_product_history_log', $data);
			}

			return $budgets;
		}

	}
	public function load_product($product_id) {
		$this->db->select('product_name, check_order');
		$this->db->from('tbl_product_history_log');
		$this->db->where('product_id', $product_id);

		return $this->db->get()->result_array();
	}
	public function save_planner($data) {
		$this->db->insert('tbl_product_history_log', $data);
		$insertId = $this->db->insert_id();

		return $insertId;
	}
	public function update_planner($data, $exist_product_id)
	{
		return $this->db->update('tbl_product_history_log', $data, array('product_id' => $exist_product_id));
	}
	public function bulk_delete_models($product_id){
		$this->db->where('product_id', $product_id);
		return $this->db->delete('tbl_model_select_log');
	}
	public function save_models($data) {
		$this->db->insert('tbl_model_select_log', $data);
		$insertId = $this->db->insert_id();

		return $insertId;
	}
	public function start_planner($data) {
		$this->db->insert('tbl_planner_status', $data);
		$insertId = $this->db->insert_id();

		return $insertId;
	}
	public function get_planner_status($user_id, $user_role) {
		$this->db->select('status');
		$this->db->from('tbl_planner_status');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_role', $user_role);
		$this->db->order_by('start_date', 'desc');
		$rtn = $this->db->get()->result_array();

		return $rtn[0];
	}
	public function end_planner($user_role, $user_id, $updated_data)
	{
		$this->db->where('user_role', $user_role);
		$this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
		return $this->db->update('tbl_planner_status', $updated_data);
	}
	public function detect_planner($user_role, $user_id, $updated_data)
	{
		$this->db->select('id');
		$this->db->from('tbl_planner_status');
		$this->db->where('user_role', $user_role);
		$this->db->where('user_id', $user_id);
		$this->db->order_by('end_date', 'DESC');
		$rtn = $this->db->get()->result_array()[0];

		return $this->db->update('tbl_planner_status', $updated_data, array('id' => $rtn['id']));
	}
	public function get_planner_count($user_id) {
		$this->db->select('planner_count');
		$this->db->from('tbl_pos');
		$this->db->where('pos_id', $user_id);
		$rtn = $this->db->get()->result_array();

		return $rtn[0];
	}
	public function updated_planner_count($updated_data, $user_id) {
		$this->db->where('pos_id', $user_id);
		return $this->db->update('tbl_pos', $updated_data);
	}
	public function get_planner_count_for_user($user_id) {
		$this->db->select('planner_count');
		$this->db->from('tbl_customers');
		$this->db->where('id', $user_id);
		$rtn = $this->db->get()->result_array();

		return $rtn[0];
	}
	public function updated_planner_count_for_user($updated_data, $user_id) {
		$this->db->where('id', $user_id);
		return $this->db->update('tbl_customers', $updated_data);
	}
	public function get_material_list() {
		$this->db->select('material_id, name');
		$this->db->from('tbl_material');
		return $this->db->get()->result_array();
	}
	public function get_color_list() {
		$this->db->select('color_id, name');
		$this->db->from('tbl_color');
		return $this->db->get()->result_array();
	}
	public function check_product($filename, $user_role, $user_id, $product_id)
	{
		$this->db->select('product_id, product_name');
		$this->db->from('tbl_product_history_log');
		// $this->db->where('product_name', $filename);
		if($user_role == 1){
			$this->db->where('customer_id', $user_id);
		}else if($user_role == 2){
			$this->db->where('pos_id', $user_id);
		}
		if($product_id){
			$this->db->where('product_id', $product_id);
		}
		$this->db->order_by('created_at', 'DESC');
		$result = $this->db->get()->result_array()[0];

		if(!$product_id){
			$exist_file = explode('-', $result['product_name']);
			if($exist_file[0] == $filename)
				return $result;
		}else{
			if($product_id){
				return $result;
			}else{
				return 0;
			}
		}
	}
	public function get_all_product_count($user_role, $user_id){
		$this->db->select('*');
		$this->db->from('tbl_product_history_log');
		if($user_role == 1)
			$this->db->where('customer_id', $user_id);
		else if($user_role == 2)
			$this->db->where('pos_id', $user_id);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_all_product_count_with_filter($user_role, $user_id, $search_key){
		$this->db->select('*');
		$this->db->from('tbl_product_history_log');
		if($user_role == 1)
			$this->db->where('customer_id', $user_id);
		else if($user_role == 2)
			$this->db->where('pos_id', $user_id);

		$this->db->like('product_name', $search_key);

		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_productlist($user_role, $user_id, $start, $rowperpage, $search_key){
		$this->db->select('product_id, product_name, created_at');
		$this->db->from('tbl_product_history_log');
		if($user_role == 1)
			$this->db->where('customer_id', $user_id);
		else if($user_role == 2)
			$this->db->where('pos_id', $user_id);

		$this->db->like('product_name', $search_key);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get()->result_array();
		return $query;
	}
}
?>