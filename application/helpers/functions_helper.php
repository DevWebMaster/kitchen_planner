<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   
    // -----------------------------------------------------------------------------
    // select single option
    if (!function_exists('select_option_multiple')) {
    
        function select_option_multiple($table,$field_id, $field_value,$value=array(),$where=array(),$order=""):array
         {      
                $CI =& get_instance();
                $o='';
                $o.='select '.$field_id.' as ID, '.$field_value.' as NAME  from '.$table.' ';
                
                if( count($where) > 0 )
                  {
                        $o.=' where  1=1 ';
                        foreach( $where as $w1 => $w2 )  
                          $o.= ' && '.$w1.' = '.$CI->db->escape($w2).' ';
                  }  

                if($order!="") $o.=' order by  '.$CI->db->escape($order).' ';
                $o.=' ;';
                
                $query = $CI->db->query($o);
                $rtn = array(); 
                if( count($query->result_array())>0 ) 
                   {
                        foreach ($query->result_array() as $key=>$fmtarr)
                          {   
                                if( in_array($fmtarr['ID'], $value)  )
                                    $rtn[] = array('selected'=> 1, 'value'=>$fmtarr['ID'], 'text'=>$fmtarr['NAME']);
                                else 
                                    $rtn[] = array('selected'=> 0, 'value'=>$fmtarr['ID'], 'text'=>$fmtarr['NAME']);
                          }  

                        return $rtn;  
                   } 
                else 
                    return $rtn;

         }
    }   
	
    // -----------------------------------------------------------------------------
    // select single option
    if (!function_exists('select_option_single')) {
    
        function select_option_single($table,$field_id, $field_value,$value,$where=array(),$order=""):array
         {      
                $CI =& get_instance();
                $o='';
                $o.='select '.$field_id.' as ID, '.$field_value.' as NAME  from '.$table.' ';
                
                if( count($where) > 0 )
                  {
                        $o.=' where  1=1 ';
                        foreach( $where as $w1 => $w2 )  
                          $o.= ' && '.$w1.' = '.$CI->db->escape($w2).' ';
                  }  

                if($order!="") $o.=' order by  '.$CI->db->escape($order).' ';
                $o.=' ;';
                
                $query = $CI->db->query($o);
                $rtn = array(); 
                if( count($query->result_array())>0 ) 
                   {
                        if($value=="")
                          {   
                              $rtn[] = array('selected'=> 0, 'value'=>0, 'text'=>'');
                          }
                        foreach ($query->result_array() as $key=>$fmtarr)
                          {   
                                if( $value==$fmtarr['ID'] )
                                    $rtn[] = array('selected'=> 1, 'value'=>$fmtarr['ID'], 'text'=>$fmtarr['NAME']);
                                else 
                                    $rtn[] = array('selected'=> 0, 'value'=>$fmtarr['ID'], 'text'=>$fmtarr['NAME']);
                          }  

                        return $rtn;  
                   } 
                else 
                    return $rtn;

         }
    }    


    // -----------------------------------------------------------------------------
    // check is the field and valud exist in particular table
    if (!function_exists('chk_field_table')) {
    
        function chk_field_table($table,$field,$value,$where)
         {      
                $CI =& get_instance();
                $o='';
                $o.='select * from '.$table.' where '.$field.' = '.$CI->db->escape($value).' ' ;
                
                if($where!="") $o.=' && '.$where.' ;';
                $query = $CI->db->query($o  );
               
                if( count($query->result_array())>0 ) 
                    return true;
                else 
                    return false;
         }
    }     
    // -----------------------------------------------------------------------------
    // format price 
    if (!function_exists('get_price_rate')) {
        // must pass in big to small array 
        function get_price_rate($price)
        {   
            $rtn = array();
            foreach ( $price as $key=>$item)
              { // cost
                if($item['rate_type']==2 && $item['customer_level_id']==0)
                    $rtn['cost']=$item['zone'];      
                //contract
                if($item['rate_type']==1 && $item['customer_level_id']==0)
                    $rtn['contract']=$item['zone'];      
                //customer L0
                if($item['rate_type']==3 && $item['customer_level_id']==1)
                    $rtn['1']=$item['zone'];      
                //customer L1
                if($item['rate_type']==3 && $item['customer_level_id']==2)
                    $rtn['2']=$item['zone'];      
                //customer L2
                if($item['rate_type']==3 && $item['customer_level_id']==3)
                    $rtn['3']=$item['zone'];      
                //customer L3
                if($item['rate_type']==3 && $item['customer_level_id']==4)
                    $rtn['4']=$item['zone'];      
                //customer L4
                if($item['rate_type']==3 && $item['customer_level_id']==5)
                    $rtn['5']=$item['zone'];      



              } 
            return $rtn;
        }
    }

    // -----------------------------------------------------------------------------
    //measure unit 
    if (!function_exists('get_dimension_info')) {
        // must pass in big to small array 
        function get_dimension_info($dim,$dimension_unit)
        {
            return array(
                    'length'=> array('cm'=>length_convert($dim[0],$dimension_unit,'cm'), 
                                     'in'=>length_convert($dim[0],$dimension_unit,'in'),
                                     'ft'=>length_convert($dim[0],$dimension_unit,'ft') ),    
                    'width'=>  array('cm'=>length_convert($dim[1],$dimension_unit,'cm'), 
                                     'in'=>length_convert($dim[1],$dimension_unit,'in'),
                                     'ft'=>length_convert($dim[1],$dimension_unit,'ft') ),    
                    'height'=> array('cm'=>length_convert($dim[2],$dimension_unit,'cm'), 
                                     'in'=>length_convert($dim[2],$dimension_unit,'in'),
                                     'ft'=>length_convert($dim[2],$dimension_unit,'ft') )    
                           ); 
        }
    }

    if (!function_exists('length_convert')) {
        function length_convert($length,$unit,$converto)
        {
            if($unit == $converto)   
                return $length;
            else if ($unit=="cm" && $converto=="in")
                return $length/2.54;
            else if ($unit=="cm" && $converto=="ft")
                return ($length/2.54)/12;
            else if ($unit=="in" && $converto=="cm")
                return $length*2.54;
            else if ($unit=="in" && $converto=="ft")
                return $length/12;
            else if ($unit=="ft" && $converto=="cm")
                return $length*12*2.54;
            else if ($unit=="ft" && $converto=="in")
                return $length*12;
            else 
                return $length;
        }
    }
    // -----------------------------------------------------------------------------
    //weight unit 
    if (!function_exists('get_mass_info')) {
        function get_mass_info($weight,$unit)
        {   
            return array(  'kg' =>mass_convert($weight,$unit,'kg'),
                           'g'  =>mass_convert($weight,$unit,'g'),
                           'lbs'=>mass_convert($weight,$unit,'lbs'),
                           'oz' =>mass_convert($weight,$unit,'oz')   
                        );
        }
    }

    if (!function_exists('mass_convert')) {
        function mass_convert($weight,$unit,$converto)
        {   

            if($unit == $converto)  return $weight;
            else if ($unit=="g" && $converto=="kg")     return $weight/1000;
            else if ($unit=="g" && $converto=="lbs")    return $weight/454;
            else if ($unit=="g" && $converto=="oz")     return $weight/28.35;
            else if ($unit=="kg" && $converto=="g")     return $weight*1000;
            else if ($unit=="kg" && $converto=="lbs")   return $weight*2.205;
            else if ($unit=="kg" && $converto=="oz")    return $weight*35.274;
            else if ($unit=="lbs" && $converto=="g")    return $weight*454;
            else if ($unit=="lbs" && $converto=="kg")   return $weight/2.205;
            else if ($unit=="lbs" && $converto=="oz")   return $weight*16;
            else if ($unit=="oz" && $converto=="g")     return $weight*28.35;
            else if ($unit=="oz" && $converto=="kg")    return $weight/35.274;
            else if ($unit=="oz" && $converto=="lbs")   return $weight/16;
            else return $weight;
        }
    }


    
    // -----------------------------------------------------------------------------
    //check auth
    if (!function_exists('auth_check')) {
        function auth_check()
        {
            // Get a reference to the controller object
            $ci =& get_instance();
            if(!$ci->session->has_userdata('is_admin_login'))
            {
                redirect('admin/auth/login', 'refresh');
            }
        }
    }


    // -----------------------------------------------------------------------------
    // Get General Setting
    if (!function_exists('get_general_settings')) {
        function get_general_settings()
        {
            $ci =& get_instance();
            $ci->load->model('admin/setting_model');
            return $ci->setting_model->get_general_settings();
        }
    }

     // -----------------------------------------------------------------------------
    // Generate Admin Sidebar Sub Menu
    if (!function_exists('get_sidebar_sub_menu')) {
        function get_sidebar_sub_menu($parent_id)
        {
            $ci =& get_instance();
            $ci->db->select('*');
            $ci->db->where('parent',$parent_id);
            $ci->db->order_by('sort_order','asc');
            return $ci->db->get('gb_menu_submenu')->result_array();
        }
    }


    // -----------------------------------------------------------------------------
    // Generate Admin Sidebar Menu
    if (!function_exists('get_sidebar_menu')) {
        function get_sidebar_menu()
        {
            $ci =& get_instance();
            /*$ci->db->select('*');
            $ci->db->order_by('sort_order','asc');
            return $ci->db->get('module')->result_array();
            */
            $ci->db->select('*');
            $ci->db->order_by('sort_order','asc');
            return $ci->db->get('gb_menu')->result_array();
        }
    }

     // -----------------------------------------------------------------------------
    // Make Slug Function    
    if (!function_exists('make_slug'))
    {
        function make_slug($string)
        {
            $lower_case_string = strtolower($string);
            $string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $lower_case_string);
            return strtolower(preg_replace('/\s+/', '-', $string1));        
        }
    }

    // -----------------------------------------------------------------------------
    //get recaptcha
    if (!function_exists('generate_recaptcha')) {
        function generate_recaptcha()
        {
            $ci =& get_instance();
            if ($ci->recaptcha_status) {
                $ci->load->library('recaptcha');
                echo '<div class="form-group mt-2">';
                echo $ci->recaptcha->getWidget();
                echo $ci->recaptcha->getScriptTag();
                echo ' </div>';
            }
        }
    }

    // ----------------------------------------------------------------------------
    //print old form data
    if (!function_exists('old')) {
        function old($field)
        {
            $ci =& get_instance();
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }

    // --------------------------------------------------------------------------------
    if (!function_exists('date_time')) {
        function date_time($datetime) 
        {
           return date('F j, Y',strtotime($datetime));
        }
    }

    // --------------------------------------------------------------------------------
    // limit the no of characters
    if (!function_exists('text_limit')) {
        function text_limit($x, $length)
        {
          if(strlen($x)<=$length)
          {
            echo $x;
          }
          else
          {
            $y=substr($x,0,$length) . '...';
            echo $y;
          }
        }
    }

?>