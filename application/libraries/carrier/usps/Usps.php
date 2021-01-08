<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usps 
{	

	function __construct()
	{
		$this->CI =& get_instance();
        //$this->CI->load->helper('email');
	}


	/***********************************************************************************/
	/*Address validation for USPS  */
	/*	array key format  
		'addr1'  -> address line one
		'addr2'-> address line two
		'city' -> city
		'state' -> state
		'zip5' -> zip5
		'zip4' -> zip4
	*/
	/*******************************************************************************/
function address_validation(&$addess)
  {
		$isError = false;
		$rtn = array();
		$message = "";

		$recv_addr1 = $addess['addr1'];
		$recv_addr2 = $addess['addr2'];
		$recv_city = $addess['city'];
		$recv_state = $addess['state'];
		$recv_zip_code = $addess['zip5'];
		$recv_zip4_code = $addess['zip4'];

    $request_doc_template = <<<EOT
    <?xml version="1.0"?>
    <AddressValidateRequest USERID="101INFIN5857"><Revision>1</Revision>
    <Address ID="0"><Address1>$recv_addr1</Address1><Address2>$recv_addr2</Address2>
    <City>$recv_city</City><State>$recv_state</State><Zip5>$recv_zip_code</Zip5><Zip4>$recv_zip4_code</Zip4></Address>
    </AddressValidateRequest>
    EOT;

    	 // prepare xml doc for query string
    $doc_string = preg_replace('/[\t\n]/', '', $request_doc_template);
    $doc_string = urlencode($doc_string);
    $ext_api_url = "http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=" . $doc_string;
    // perform the get
    $response = file_get_contents($ext_api_url);
  	  
    $xml=@simplexml_load_string($response) ;
    if(!$xml)
    	{ 	
    		$isError = TRUE;
    		$rtn=array('status'=>0, 'message'=> trans('l_e_usps_addr') );  	 	
    	}
    else 
    	{
    		if($xml->Address->Error)
		     {
		        $status = false;     
		        $rtn=array('status'=>0, 'message'=> trans('l_e_recv_invalid') );

		     }
		    else 
		     {    
		        /*echo 'xBefore Addr1-> '.$recv_addr1.'<br/>';
		        echo 'xBefore Addr2-> '.$recv_addr2.'<br/>';
		        echo 'xBefore City-> '.$recv_city.'<br/>';
		        echo 'xBefore State-> '.$recv_state.'<br/>';
		        echo 'xBefore Zip-> '.$recv_zip_code.'<br/>';
		        echo 'xBefore Zip4-> <br/>';*/
		        $recv_addr1 = (string)$xml->Address->Address1;
		        $recv_addr2 = (string)$xml->Address->Address2;
		        $recv_city = (string)$xml->Address->City;
		        $recv_state = (string)$xml->Address->State;
		        $recv_zip_code = (string)$xml->Address->Zip5;
		        $recv_zip4_code = (string)$xml->Address->Zip4;
		        /*echo 'xAfter Addr1-> '.$recv_addr1.'<br/>';
		        echo 'xAfter Addr2-> '.$recv_addr2.'<br/>';
		        echo 'xAfter City-> '.$recv_city.'<br/>';
		        echo 'xAfter State-> '.$recv_state.'<br/>';
		        echo 'xAfter Zip-> '.$recv_zip_code.'<br/>';
		        echo 'xAfter Zip4-> '.$recv_zip4_code.'<br/>';*/
		        $result = array( 'addr1'=>$recv_addr1,	'addr2'=>$recv_addr2,		
		        		'city'=>$recv_city,			'state'=>$recv_state,
		        		'zip5'=>$recv_zip_code,		'zip4'=>$recv_zip4_code,
		    		);

  		        $rtn=array('status'=>1, 'result'=> $result );

		     }
		    

    	}	
    return $rtn;	

  }


}	