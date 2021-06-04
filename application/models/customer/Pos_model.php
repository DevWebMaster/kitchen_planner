
<?php
class Pos_model extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	public function add_pos($data){
		// Inserting in Table(students) of Database(college)
		$this->db->select('*');
	    $this->db->where('email',$data['email']);
	    $query = $this->db->get('tbl_pos');
		if($query->num_rows() > 0){
			return 2;
		}
		$this->db->insert('tbl_pos', $data);
		if ($this->db->affected_rows() > 0) {
	      return 1;
	    }else{
	      return 0;
	    }
	}
	public function do_login_pos($email, $password){
		$this->db->select('*');
	    $this->db->where('email',$email);
	    $this->db->where('password',$password);
	    $this->db->where('is_blocked', 0);


	    $query = $this->db->get('tbl_pos');
	    
	    if($query->num_rows() > 0)
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
	    }
	}
	public function get_row_p1($email, $password)
	{ 
	   $this->db->where('email',$email);
	   $this->db->where('password',$password);
	   $query = $this->db->get('tbl_pos');
	  return $query->row();
	}
	public function get_pos_info($current_email)
	{
	   $this->db->where('email',$current_email);

	   $query = $this->db->get('tbl_pos');
	   return $query->row();
	}
	public function get_pos_info_by_id($pos_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_pos');
		$this->db->where('pos_id', $pos_id);
		$query = $this->db->get()->result_array();
		return $query[0];
	}
	public function is_exist($email)
	{
		$this->db->select('*');
	    $this->db->where('email',$email);

	    $query = $this->db->get('tbl_pos');
	    
	    if($query->num_rows() > 0)
	    {
	      return 1;
	    }
	    else
	    {
	      return 0;
	    }
	}
	public function get_pos_id($email)
	{
		$this->db->select('pos_id');
		$this->db->from('tbl_pos');
		$this->db->where('email', $email);
		$query = $this->db->get()->result_array();

		return $query[0];
	}
	public function get_all_pos_order_count($pos_id) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->join('tbl_customers as a3', 'a3.id = a1.customer_id', 'left');
		$this->db->where('a1.pos_id', $pos_id);
		$this->db->where('a1.check_flag <>', 0);

		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_all_pos_order_count_with_filter($pos_id, $search_key) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a3.customer_name');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
		$this->db->where('a1.pos_id', $pos_id);
		$this->db->where('a1.check_flag <>', 0);
		if($search_key != ''){
			$this->db->like('a2.product_name', $search_key);
		}
		
		$query = $this->db->get();

		return $query->num_rows();
	}
	public function get_pos_orderlist($pos_id, $start, $rowperpage, $search_key) {
		$this->db->select('a1.*, a2.product_name, a2.estimated_countertio_cost, a2.estimated_furniture_cost, a2.pdf_file, a3.customer_name');
		$this->db->from('tbl_order as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.product_id = a2.product_id', 'left');
		$this->db->join('tbl_customers as a3', 'a1.customer_id = a3.id', 'left');
		$this->db->where('a1.pos_id', $pos_id);
		// $this->db->where('a1.check_flag <>', 0);
		if($search_key != ''){
			$this->db->like('a2.product_name', $search_key);
		}
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function set_check_flag($order_no)
	{
		$data = array(
			'check_flag' => 2,
			'status' => 'Confirmed',
		);
		return $this->db->update('tbl_order',$data, array('order_no' => $order_no ) );
	}
	public function get_all_customer_count($pos_id) {
		$this->db->select('a1.*');
		$this->db->from('tbl_customers as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.id = a2.customer_id', 'left');
		$this->db->where('a2.pos_id', $pos_id);
		$this->db->group_by('a1.id');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_all_customer_count_with_filter($pos_id, $search_key) {
		$this->db->select('a1.*');
		$this->db->from('tbl_customers as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.id = a2.customer_id', 'left');
		$this->db->where('a2.pos_id', $pos_id);
		if($search_key != ''){
			$this->db->like('a2.product_name', $search_key);
		}
		$this->db->group_by('a1.id');
		$query = $this->db->get();

		return $query->num_rows();
	}
	public function get_pos_customerlist($pos_id, $start, $rowperpage, $search_key) {
		$this->db->select('a1.*');
		$this->db->from('tbl_customers as a1');
		$this->db->join('tbl_product_history_log as a2', 'a1.id = a2.customer_id', 'left');
		$this->db->where('a2.pos_id', $pos_id);
		// $this->db->where('a1.check_flag <>', 0);
		if($search_key != ''){
			$this->db->like('a1.customer_name', $search_key);
		}
		$this->db->group_by('a1.id');
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get()->result_array();
		return $query;
	}
}
?>