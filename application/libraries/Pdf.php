<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . 'vendor\tcpdf_min\tcpdf.php';
class Pdf extends TCPDF
{
    function __construct($params)
    {

        parent::__construct($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */