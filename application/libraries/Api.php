<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api 
{
    function __construct()
    {

        $this->CI =& get_instance();

        //$this->CI->load->helper('email');
    }

    function check_header():array 
    {
    	$header = getallheaders();
      $header = array_change_key_case($header,CASE_LOWER);

    	$p_code = ( !empty($header['pcode']) ) ? trim($header['pcode']) : ''; 
    	$api_key = ( !empty( $header['apikey'] ) ) ? trim($header['apikey']) : ''; 
    	$branch = ( !empty( $header['branch'] ) ) ? trim($header['branch']) : ''; 
   		$lang = ( !empty( $header['lang'] ) ) ? trim($header['lang']) : 'en';
   		$status = true;
   		$message = array();
   		if( empty($p_code)  )
	      {
	        $status=false;     
	        $message[] = trans('l_e_api_p_code_require');
	      }
	    if( empty($branch) )
	      {
	      	$status=false;     
	        $message[] = trans('l_e_api_branch_require');
	      }  
	    if( empty($api_key) )
	      {
	      	$status=false;     
	        $message[] = trans('l_e_api_key_require');
	      } 

   		$rtn = array(  
   			'status'=>$status,
   			'message'=>$message, 
   		  	'data'=>array('p_code'=>$p_code,'api_key'=>$api_key, 'branch'=>$branch, 'lang'=>$lang )
   		  );

   		return $rtn;
    }
    function log_in( $header,$message ):int
     {
        $CI =& get_instance();
        
        $data = array( 'log_id'=>0, 'remote_addr'=>$CI->input->ip_address(), 'request_uri'=>base_url(uri_string()),
              'header'=>json_encode($header),   'request'=>json_encode($message), 'repond'=>json_encode(""),  'log_in_date'=>date('Y-m-d H:i:s'), 'log_out_date'=>NULL   );

        $CI->db->insert('gb_api_log', $data); 
        $insertId = $CI->db->insert_id();
        return  $insertId;
     }

    function log_out( $log_id,$respond ):void
     {
        $CI =& get_instance();
        
        $data = array( 'repond'=>json_encode($respond),  'log_out_date'=>date('Y-m-d H:i:s')   );
        $CI->db->update('gb_api_log',$data, array('log_id' => $log_id));
            
     } 


    function get_zone($recv_zip_code)
     {

        
     }  

}
