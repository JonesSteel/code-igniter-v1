<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminusuario_model extends CI_Model {
	
	function __construct(){

		parent::__construct();

	}

	function insertaUsuario($datosUsuario){
		
		/*echo "DATOS PARA USUARIO ";
		print_r($datosUsuario);
		exit();*/

		//$datosUsuarioAlta = array('idusuario_digital' => $idusuario, 'nombre_archivo' => $archivo, 'placa' => $placa,'fecha_sube_archivo' => date('Y-m-d'));

		$this->db->trans_start();
		$this->db->insert('usuarios', $datosUsuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {

        	return false;

    	}else{

    		return true;

    	}		
		
	}
	
}
?>