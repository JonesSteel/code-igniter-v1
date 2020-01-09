<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        $this->load->model('adminusuario_model');
        $this->load->model('control_cajas_model');
        $this->load->library('session');
    }

    public function index(){
        $modulos = $this->control_cajas_model->getModulos();
        $this->load->view('usuarios',array('modulos' => $modulos));
    }

    public function enMayusculas($infoFormatoUsuario){
        
        foreach ($infoFormatoUsuario as $key => $value) {
            $infoFormatoUsuario[$key] = strtoupper($value);
        }

        return $infoFormatoUsuario;
    }

    public function generaUsuario($apellido_uno,$modulo,$sistema,$atributo){

        $inicioUsuario = substr($apellido_uno, 0,1).substr($apellido_uno, strlen($apellido_uno) - 1 ,1);
        $moduloUsuario = str_pad($modulo, 3, "0", STR_PAD_LEFT);
        $sistemaUsuario = str_pad($sistema, 2, "0", STR_PAD_LEFT);
        $atributoUsuario = str_pad($atributo, 2, "0", STR_PAD_LEFT);
        

        $digito = rand(0, 35);

        $digitofinal = base_convert($digito, 10, 36);

        return  $inicioUsuario.$moduloUsuario.$sistemaUsuario.$atributoUsuario.strtoupper($digitofinal);

    }

    public function agregaUsuario(){
        $datosUsuario = $this->input->post();

        if(trim($datosUsuario['rfc']) == '' || trim($datosUsuario['atributo']) == '' || trim($datosUsuario['id_modulo']) == '' || trim($datosUsuario['id_sistema']) == '' || trim($datosUsuario['password']) == '' || trim($datosUsuario['nombre']) == ''  || trim($datosUsuario['primer_apellido']) == ''){
            echo "FALTAN DATOS "; 
            exit(); 
        }else {

            $datosUsuario['usuario'] = $this->generaUsuario($datosUsuario['primer_apellido'], $datosUsuario['id_modulo'], $datosUsuario['id_sistema'], $datosUsuario['atributo']);

            $datosUsuarioAlta = array('usuario' => strtoupper($datosUsuario['usuario']), 'password' => md5($datosUsuario['password']), 'nombre' => strtoupper($datosUsuario['nombre']), 'primer_apellido' => strtoupper($datosUsuario['primer_apellido']), 'segundo_apellido' => strtoupper($datosUsuario['segundo_apellido']), 'rfc' => strtoupper($datosUsuario['rfc']), 'atributo' => strtoupper($datosUsuario['atributo']), 'id_modulo' => strtoupper($datosUsuario['id_modulo']), 'id_sistema' => strtoupper($datosUsuario['id_sistema']));

            $resGuardado = $this->adminusuario_model->insertaUsuario($datosUsuarioAlta);

            if ($resGuardado == true) {

                $this->load->view('usuarios', array('mensaje' => 'SE GUARDO CON EXITO EL USUARIO ' . $datosUsuarioAlta['usuario']));
            } else {

                $this->load->view('usuarios', array('mensajeError' => 'NO SE PUDO GUARDAR EL USUARIO ' . $datosUsuarioAlta['usuario']));
            }
        }
    }
}

?>