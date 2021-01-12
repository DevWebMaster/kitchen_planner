<?php
	class Menu_setting_model extends CI_Model{

        public function get_main_menu_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name, a1.image');
			$this->db->from('tbl_main_menu as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_all_count() {
			$this->db->select('a1.name, a1.image');
			$this->db->from('tbl_main_menu as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.name, a1.image');
			$this->db->from('tbl_main_menu as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_main_menu($menu_name, $menu_image){
			$data = array(
				'name' => $menu_name,
				'image' => $menu_image
			);
			$this->db->insert('tbl_main_menu', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function get_main_menu_ids(){
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_main_menu as a1');

			$query = $this->db->get()->result_array();
			
			  return $query;
		}

		public function get_sub_menu_ids($main_id){
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_sub_menu as a1');
			$this->db->where('main_id', $main_id);

			$query = $this->db->get()->result_array();
			
			return $query;
		}

		public function save_sub_menu($menu_name, $parent_id, $menu_image){
			$data = array(
				'name' => $menu_name,
				'main_id' => $parent_id,
				'image' => $menu_image
			);
			$this->db->insert('tbl_sub_menu', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function get_parent_menu($sub_menu_id){
			$this->db->select('a1.name, a2.name as parent');
			$this->db->from('tbl_sub_menu as a1');
			$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
			$this->db->where('a1.id', $sub_menu_id);
			$query = $this->db->get()->result_array();
			return $query[0];
		}
		public function update_sub_menu($menu_name, $menu_id, $menu_image){
			$data = array(
				'name' => $menu_name,
				'image' => $menu_image
			);
			return $this->db->update('tbl_sub_menu', $data, array('id' => $menu_id)); 
		}
		public function get_sub_menu_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name, a1.image, a2.name as parent');
			$this->db->from('tbl_sub_menu as a1');
			$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_sub_menu_all_count() {
			$this->db->select('a1.name, a1.image');
			$this->db->from('tbl_sub_menu as a1');
			$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_sub_menu_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.name, a1.image, a2.name as parent');
			$this->db->from('tbl_sub_menu as a1');
			$this->db->join('tbl_main_menu as a2', 'a1.main_id = a2.id', 'left');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function delete_sub_menu($id)
		{
		 	$this->db->where('id', $id);
			return $this->db->delete('tbl_sub_menu');
		}
		public function delete_main_menu($id)
		{
		 	$this->db->where('id', $id);
			return $this->db->delete('tbl_main_menu');
		}

		public function get_model_type()
		{
			$this->db->select('type, name');
			$this->db->from('tbl_model_type');

			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_model_style()
		{
			$this->db->select('material_id, name');
			$this->db->from('tbl_material');

			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_model_color()
		{
			$this->db->select('color_id, name');
			$this->db->from('tbl_color');

			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_dooropen_type()
		{
			$this->db->select('style_id, name');
			$this->db->from('tbl_door_style');

			$query = $this->db->get()->result_array();
			return $query;
		}

		public function get_door_thickness()
		{
			$this->db->select('thickness_id, name');
			$this->db->from('tbl_door_thickness');

			$query = $this->db->get()->result_array();
			return $query;
		}
		public function get_furniture_cube()
		{
			$this->db->select('cube_id, name');
			$this->db->from('tbl_furniture_cube');

			$query = $this->db->get()->result_array();
			return $query;
		}
		public function delete_model_record($model_id)
		{
			$this->db->where('model_id', $model_id);
			return $this->db->delete('tbl_model_list');
		}

		public function get_model_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.model_id, a1.name, a1.image, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.name as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type, a13.name as cube_name');
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
			$this->db->join('tbl_furniture_cube as a13', 'a1.cube_id = a13.cube_id', 'left');

			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_model_list_all_count() {
			$this->db->select('a1.name, a1.image');
			$this->db->from('tbl_model_list as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_model_list_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.model_id, a1.name, a1.image, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.name as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type, a13.name as cube_name');
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
			$this->db->join('tbl_model_type as a12', 'a1.type = a12.name', 'left');
			$this->db->join('tbl_furniture_cube as a13', 'a1.cube_id = a13.cube_id', 'left');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}

		public function save_model($model_name, $model_type, $main_menu_id, $sub_menu_id, $target_image_file, $target_js_file, $target_texture_file, $countertop_color, $countertop_type, $exterio_color, $interior_color, $skirting_type, $skirting_color, $dooropen_type, $door_thickness, $furniture_cube_id){
			$data = array(
				'main_id' => $main_menu_id,
				'sub_id' => $sub_menu_id,
				'name' => $model_name,
				'image' => $target_image_file,
				'model' => $target_js_file,
				'type' => $model_type,
				'countertop_type' => $countertop_type,
				'countertop_color' => $countertop_color,
				'exterio_color' => $exterio_color,
				'interior_color' => $interior_color,
				'skirting_color' => $skirting_color,
				'skirting_type' => $skirting_type,
				'dooropen_type' => $dooropen_type,
				'door_thickness' => $door_thickness,
				'cube_id' => $furniture_cube_id
			);
			$this->db->insert('tbl_model_list', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}

		public function get_wall_texture_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name, a1.image');
			$this->db->from('tbl_wall_texture as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_wall_texture_all_count() {
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_wall_texture as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_wall_texture_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_wall_texture as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_wall_texture($wall_texture_name, $wall_texture_price, $image){
			$data = array(
				'name' => $wall_texture_name,
				'image' => $image,
			);
			$this->db->insert('tbl_wall_texture', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_wall_texture($wall_texture_id)
		{
		 	$this->db->where('id', $wall_texture_id);
			return $this->db->delete('tbl_wall_texture');
		}


		public function get_floor_texture_list($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name, a1.image');
			$this->db->from('tbl_floor_texture as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);

			$query = $this->db->get()->result_array();

			
			  return $query;
		}
		public function get_floor_texture_all_count() {
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_floor_texture as a1');
			
			// $this->db->order_by('created_at  DESC');

			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function get_floor_texture_all_count_with_filter($search_key, $start, $rowperpage) {
			$this->db->select('a1.id, a1.name');
			$this->db->from('tbl_floor_texture as a1');
			if($search_key != ''){
				$this->db->like('a1.name', $search_key);
			}
			$this->db->limit($rowperpage, $start);
			$query = $this->db->get();

		    return $query->num_rows();
		

		}
		public function save_floor_texture($floor_texture_name, $image){
			$data = array(
				'name' => $floor_texture_name,
				'image' => $image,
			);
			$this->db->insert('tbl_floor_texture', $data); 
		    $insertId = $this->db->insert_id();
	   		return  $insertId;
		}
		public function delete_floor_texture($floor_texture_id)
		{
		 	$this->db->where('id', $floor_texture_id);
			return $this->db->delete('tbl_floor_texture');
		}


	}
?>