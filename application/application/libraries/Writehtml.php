<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');  
//echo APPPATH."/libraries/PHPExcel.php";
require_once APPPATH."/libraries/fpdf181/writeHTML.php";
 
class Writehtml extends PDF_HTML {
    public function __construct() {
        parent::__construct();
    }
}

?>