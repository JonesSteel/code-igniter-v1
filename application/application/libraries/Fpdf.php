<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');  
//echo APPPATH."/libraries/PHPExcel.php";
require_once APPPATH."/libraries/fpdf181/fpdf.php";
 
class Fpdfu extends FPDF {
    public function __construct() {
        parent::__construct();
    }
}

?>