<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graficas_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function cajas_por_vehiculo () {
        return $this->db->get('tipo_vehiculo_cajas')->result();
    }
}