<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once(APPPATH . 'libraries/htmlpdf/html2pdf/html2pdf.class.php');

class Htmlpdf {
    var $ci;
    public function __construct(){
        $this->ci =& get_instance();
    }
    
    public function convert($data){
        $width = 8.5 * 25.4; $height = 11 * 25.4;
        $html = new HTML2PDF('P',array($width,$height),'en');
        $html->writeHTML($data);
        $html->Output('resume.pdf');
    }
}