<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Menu_setting extends My_Controller {

	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		$this->load->model('admin/menu_setting_model', 'menu_setting_model');
	}
	public function index()
	{

		$data['title'] = 'Main Menu';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/menu_setting/main_menu');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_main_menu_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->menu_setting_model->get_all_count();
        $totalRecordwithFilter = $this->menu_setting_model->get_all_count_with_filter($search_key, $start, $rowperpage);
        $main_menu = $this->menu_setting_model->get_main_menu_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($main_menu as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "image"=>$value['image'],
              "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function upload_main_menu_image()
	{
		$res_str = '';
		$menu_name = $this->input->post('menu_name');

		$org_dir = BASEPATH;
        $temp = explode('system', $org_dir);
        $target_dir = $temp[0].PREFIX_MODEL_PATH.MAIN_MENU_PATH;
        // $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
		  if($check !== false) {
		    $res_str = "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    $res_str = "File is not an image.";
		    $uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  $res_str = "Sorry, file already exists.";
		  $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $res_str = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		if($uploadOk == 1) {
		  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
		    $res_str = "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been added.";
		  } else {
		    $res_str = "Sorry, there was an error adding your file.";
		  }
		}

		if($uploadOk == 1){
			$result = $this->menu_setting_model->save_main_menu($menu_name, MAIN_MENU_PATH.basename($_FILES["imageToUpload"]["name"]));
		}

		$response = array('status' => $result, 'message' => $res_str);
		echo json_encode($response);
	}

	public function sub_menu()
	{

		$data['title'] = 'Sub Menu';

		$data['main_menu_ids'] = $this->menu_setting_model->get_main_menu_ids();

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/menu_setting/sub_menu', $data);

    	$this->load->view('admin/includes/_footer');

	}

	public function upload_sub_menu_image()
	{
		$res_str = '';
		$sub_menu_name = $this->input->post('sub_menu_name');
		$parent_id = $this->input->post('main_menu_id');

		$org_dir = BASEPATH;
        $temp = explode('system', $org_dir);
        $target_dir = $temp[0].PREFIX_MODEL_PATH.SUB_MENU_PATH;
        // $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
		  if($check !== false) {
		    $res_str = "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    $res_str = "File is not an image.";
		    $uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  $res_str = "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $res_str = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  $res_str = "Sorry, your file was not added.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
		    $res_str = "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been added.";
		  } else {
		    $res_str = "Sorry, there was an error adding your file.";
		  }
		}

		if($uploadOk == 1){
			$result = $this->menu_setting_model->save_sub_menu($sub_menu_name, $parent_id, SUB_MENU_PATH.basename($_FILES["imageToUpload"]["name"]));
		}

		$response = array('status' => $uploadOk, 'message' => $res_str);
		echo json_encode($response);
	}
	public function get_sub_menu_list()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->menu_setting_model->get_sub_menu_all_count();
        $totalRecordwithFilter = $this->menu_setting_model->get_sub_menu_all_count_with_filter($search_key, $start, $rowperpage);
        $sub_menu = $this->menu_setting_model->get_sub_menu_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($sub_menu as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "parent"=>$value['parent'],
              "image"=>$value['image'],
              "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function delete_sub_menu_record()
	{
		$id = $this->input->post('id');
		$result = $this->menu_setting_model->delete_sub_menu($id);

		echo json_encode($result);
	}

	public function delete_main_menu_record()
	{
		$id = $this->input->post('id');
		$result = $this->menu_setting_model->delete_main_menu($id);

		echo json_encode($result);
	}

	public function model_list()
	{

		$data['title'] = 'Model List';

		$data['main_menu_ids'] = $this->menu_setting_model->get_main_menu_ids();
		$data['sub_menu_ids'] = $this->menu_setting_model->get_sub_menu_ids(1);
		$data['model_type'] = $this->menu_setting_model->get_model_type();
		$data['countertop_type'] = $data['skirting_type'] = $this->menu_setting_model->get_model_style();
		$data['countertop_color'] = $data['exterio_color'] = $data['interior_color'] = $data['skirting_color'] = $this->menu_setting_model->get_model_color();
		$data['dooropen_type'] = $this->menu_setting_model->get_dooropen_type();
		$data['door_thickness'] = $this->menu_setting_model->get_door_thickness();
		$data['furniture_cube'] = $this->menu_setting_model->get_furniture_cube();


		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/menu_setting/model_list', $data);

    	$this->load->view('admin/includes/_footer');

	}
	public function get_sub_menu_ids()
	{
		$main_id = $this->input->post('main_id');

		$sub_menu_ids = $this->menu_setting_model->get_sub_menu_ids($main_id);
		echo json_encode($sub_menu_ids);
	}

	public function upload_models()
	{
		$model_name = $this->input->post('model_name');
		$model_type = $this->input->post('model_type');
		$main_menu_id = $this->input->post('main_menu_id');
		$sub_menu_id = $this->input->post('sub_menu_id');
		$countertop_type = $this->input->post('countertop_type');
		$countertop_color = $this->input->post('countertop_color');
		$exterio_color = $this->input->post('exterio_color');
		$interior_color = $this->input->post('interior_color');
		$skirting_color = $this->input->post('skirting_color');
		$skirting_type = $this->input->post('skirting_type');
		$dooropen_type = $this->input->post('dooropen_type');
		$door_thickness = $this->input->post('door_thickness');
		$furniture_cube_id = $this->input->post('furniture_cube_id');


		$org_dir = BASEPATH;
        $temp = explode('system', $org_dir);
        // $target_dir = $temp[0].MAIN_MENU_PATH.PREFIX_MODEL_PATH;
        $target_dir_thumbnail = $temp[0].PREFIX_MODEL_PATH.THUMBNAIL_PATH;
        $target_dir_model = $temp[0].PREFIX_MODEL_PATH.MODEL_PATH;

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo(basename($_FILES["imageToUpload"]["name"]),PATHINFO_EXTENSION));

		$textureFileType = strtolower(pathinfo(basename($_FILES["textureToUpload"]["name"]),PATHINFO_EXTENSION));

		$jsFileType = strtolower(pathinfo(basename($_FILES["jsToUpload"]["name"]),PATHINFO_EXTENSION));

		$target_image_file = $target_dir_thumbnail.$model_name.'.'.$imageFileType;
		$save_image_file = THUMBNAIL_PATH.$model_name.'.'.$imageFileType;

        $target_texture_file = $target_dir_model.basename($_FILES["textureToUpload"]["name"]);
        $save_texture_file = MODEL_PATH.basename($_FILES["textureToUpload"]["name"]);

        $target_js_file = $target_dir_model.$model_name.'.'.$jsFileType;
        $save_js_file = MODEL_PATH.$model_name.'.'.$jsFileType;

		$message = array();
		// Check if file already exists
		if (file_exists($target_image_file)) {
		  $res_str = "Sorry, image file already exists.";
		  array_push($message, $res_str);
		  $uploadOk = 0;
		}

		if (file_exists($target_texture_file)) {
		  $res_str = "Sorry, texture file already exists.";
		  array_push($message, $res_str);
		  $uploadOk = 0;

		}
		if (file_exists($target_js_file)) {
		  $res_str = "Sorry, js file already exists.";
		  array_push($message, $res_str);
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif") || ($textureFileType != "jpg" && $textureFileType != "png" && $textureFileType != "jpeg"
				&& $textureFileType != "gif") ) {
		  $res_str = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  array_push($message, $res_str);
		  $uploadOk = 0;
		}

		if($jsFileType != "js") {
		  $res_str = "Sorry, it is not JS file.";
		  array_push($message, $res_str);
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error

	  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_image_file)) {
	    $res_str = "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been added.";
	    array_push($message, $res_str);
	  } else {
	    $res_str = "Sorry, there was an error adding image file.";
	    array_push($message, $res_str);
	    $uploadOk = 0;
	  }

	  if (move_uploaded_file($_FILES["textureToUpload"]["tmp_name"], $target_texture_file)) {
	    $res_str = "The file ". htmlspecialchars( basename( $_FILES["textureToUpload"]["name"])). " has been added.";
	    array_push($message, $res_str);
	  } else {
	    $res_str = "Sorry, there was an error adding texture file.";
	    array_push($message, $res_str);
	    $uploadOk = 0;
	  }

	  if (move_uploaded_file($_FILES["jsToUpload"]["tmp_name"], $target_js_file)) {
	    $res_str = "The file ". htmlspecialchars( basename( $_FILES["jsToUpload"]["name"])). " has been added.";
	    array_push($message, $res_str);
	  } else {
	    $res_str = "Sorry, there was an error adding js file.";
	    array_push($message, $res_str);
	    $uploadOk = 0;
	  }
		

		if($uploadOk == 1){
			$result = $this->menu_setting_model->save_model($model_name, $model_type, $main_menu_id, $sub_menu_id, $save_image_file, $save_js_file, $save_texture_file, $countertop_color, $countertop_type, $exterio_color, $interior_color, $skirting_type, $skirting_color, $dooropen_type, $door_thickness, $furniture_cube_id);
		}

		$response = array('status' => $uploadOk, 'message' => $message);
		echo json_encode($response);
	}
	public function delete_model_record()
	{
		$model_id = $this->input->post('model_id');
		$result = $this->menu_setting_model->delete_model_record($model_id);

		echo json_encode($result);
	}

	public function get_model_list()
	{
		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->menu_setting_model->get_model_list_all_count();
        $totalRecordwithFilter = $this->menu_setting_model->get_model_list_all_count_with_filter($search_key, $start, $rowperpage);
        $model_list = $this->menu_setting_model->get_model_list($search_key, $start, $rowperpage);

        $data = array();

        foreach ($model_list as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "model_type"=>$value['model_type'],
              "main_menu"=>$value['main_menu'],
              "sub_menu"=>$value['sub_menu'],
              "countertop_type"=>$value['countertop_type'],
              "countertop_color"=>$value['countertop_color'],
              "exterio_color"=>$value['exterio_color'],
              "interior_color"=>$value['interior_color'],
              "skirting_type"=>$value['skirting_type'],
              "skirting_color"=>$value['skirting_color'],
              "dooropen_type"=>$value['dooropen_type'],
              "door_thickness"=>$value['door_thickness'],
              "cube_name"=>$value['cube_name'],
              // "counterio_price"=>$value['countertop_color_price']+$value['countertop_type_price']+$value['exterio_color_price']+$value['interior_color_price']+$value['skirting_type_price']+$value['skirting_color_price']+$value['dooropen_type_price']+$value['door_thickness_price']+$value['furniture_price'],
              "image"=>$value['image'],
              "action"=>'<a id="'.$value['model_id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function wall_texture()
	{

		$data['title'] = 'Wall Textures';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/menu_setting/wall_texture');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_wall_texture()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->menu_setting_model->get_wall_texture_all_count();
        $totalRecordwithFilter = $this->menu_setting_model->get_wall_texture_all_count_with_filter($search_key, $start, $rowperpage);
        $wall_texture_list = $this->menu_setting_model->get_wall_texture_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($wall_texture_list as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "image"=>$value['image'],
              "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#wall_texture_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function save_wall_texture()
	{
		$res_str = '';
		$wall_texture_name = $this->input->post('wall_texture_name');

		$org_dir = BASEPATH;
        $temp = explode('system', $org_dir);
        $target_dir = $temp[0].PREFIX_MODEL_PATH.WALL_TEXTURE_PATH;
        // $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
		  if($check !== false) {
		    $res_str = "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    $res_str = "File is not an image.";
		    $uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  $res_str = "Sorry, file already exists.";
		  $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $res_str = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		if($uploadOk == 1) {
		  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
		    $res_str = "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been added.";
		  } else {
		    $res_str = "Sorry, there was an error adding your file.";
		  }
		}
		if($uploadOk == 1){
			$result = $this->menu_setting_model->save_wall_texture($wall_texture_name, WALL_TEXTURE_PATH.basename($_FILES["imageToUpload"]["name"]));
		}

		$response = array('status' => $result, 'message' => $res_str);
		echo json_encode($response);

	}

	public function delete_wall_texture_record()
	{
		$wall_texture_id = $this->input->post('wall_texture_id');
		$result = $this->menu_setting_model->delete_wall_texture($wall_texture_id);

		echo json_encode($result);
	}

	
	public function floor_texture()
	{

		$data['title'] = 'Floor Textures';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/menu_setting/floor_texture');

    	$this->load->view('admin/includes/_footer');

	}

	public function get_floor_texture()
	{
		// $search_key = $this->input->post('search_key');

		$draw = $_POST['draw'];
        $start = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $search_key = $_POST['search']['value'];

        $totalRecords = $this->menu_setting_model->get_floor_texture_all_count();
        $totalRecordwithFilter = $this->menu_setting_model->get_floor_texture_all_count_with_filter($search_key, $start, $rowperpage);
        $floor_texture_list = $this->menu_setting_model->get_floor_texture_list($search_key, $start, $rowperpage);
        //echo $this->db->last_query();

        $data = array();

        foreach ($floor_texture_list as $value) {
            $data[] = array( 
              "name"=>$value['name'],
              "image"=>$value['image'],
              "action"=>'<a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-info edit-row" data-toggle="modal" data-target="#floor_texture_edit_modal"><i class="fa fa-edit"></i></a><a id="'.$value['id'].'" class="mr-1 btn-sm btn btn-danger delete-row"><i class="fa fa-times"></i></a>'
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

	public function save_floor_texture()
	{
		$res_str = '';
		$floor_texture_name = $this->input->post('floor_texture_name');
		$price = $this->input->post('price');

		$org_dir = BASEPATH;
        $temp = explode('system', $org_dir);
        $target_dir = $temp[0].PREFIX_MODEL_PATH.FLOOR_TEXTURE_PATH;
        // $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
		  if($check !== false) {
		    $res_str = "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    $res_str = "File is not an image.";
		    $uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  $res_str = "Sorry, file already exists.";
		  $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $res_str = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		if($uploadOk == 1) {
		  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
		    $res_str = "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been added.";
		  } else {
		    $res_str = "Sorry, there was an error adding your file.";
		  }
		}
		if($uploadOk == 1){
			$result = $this->menu_setting_model->save_floor_texture($floor_texture_name, FLOOR_TEXTURE_PATH.basename($_FILES["imageToUpload"]["name"]));
		}

		$response = array('status' => $result, 'message' => $res_str);
		echo json_encode($response);

	}

	public function delete_floor_texture_record()
	{
		$floor_texture_id = $this->input->post('floor_texture_id');
		$result = $this->menu_setting_model->delete_floor_texture($floor_texture_id);

		echo json_encode($result);
	}

	

}
?>	