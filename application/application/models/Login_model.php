<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	function __construct(){

		parent::__construct();

	}

	function autentifica($usuario,$password){

		$datosUsuario = $this->db->query("SELECT idusuario,usuario, nombre, primer_apellido, segundo_apellido, atributo FROM usuarios WHERE usuario = '".$usuario."' AND password = '".$password."'")->result_array();
		if(count($datosUsuario) > 0){
			return $datosUsuario;
		}else{
			return "1UNE";
		}
	}
}
?>