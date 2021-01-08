<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xcrud_ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

      
     /*   $this->load->library('session');
        $this->load->helper(array('url', 'xcrud'));
        Xcrud_config::$scripts_url = base_url('').'vendor/xcrud/';
        
        
        $this->output->set_output(Xcrud::get_requested_instance());
    */



        /*include(FCPATH.'/xcrud/xcrud.php');
        Xcrud::import_session($this->session->userdata('xcrud_sess'));
        Xcrud::get_requested_instance();
        $this->session->set_userdata(array('xcrud_sess'=>Xcrud::export_session()));
*/

    }
}

/* End of file xcrud_ajax.php */
/* Location: ./application/controllers/xcrud_ajax.php */
