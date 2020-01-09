<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlcajas extends CI_Controller
{

	public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->model('control_cajas_model');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }

    public function index($datosUsuario)
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != '' && trim($this->session->userdata['atributo']) == 1){
   
           $this->load->view('inicioControl', array('datosUsuario' => $datosUsuario));

        }elseif(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != '' && trim($this->session->userdata['atributo']) == 2){

            $this->load->view('inicioControl_Admin', array('datosUsuario' => $datosUsuario));

        } else {
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function indexExpediente()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $series = $this->control_cajas_model->getSeries();
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();
           

            $this->load->view('controlexpediente',array('idusuario' => $this->session->userdata['idUsuario'],'series' => $series,'tiposVehiculos' => $tiposVehiculos,'modulos' => $modulos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function indexRegistroCaja()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $series = $this->control_cajas_model->getSeries();
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();
           

            $this->load->view('registrocajas',array('idusuario' => $this->session->userdata['idUsuario'],'modulos' => $modulos,'series' => $series,'tiposVehiculos' => $tiposVehiculos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function indexRegistroRemesa()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $this->load->view('registroremesa',array('idusuario' => $this->session->userdata['idUsuario'],'modulos' => $modulos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function indexCaja()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $series = $this->control_cajas_model->getSeries();
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();
           

            $this->load->view('controlcajas',array('idusuario' => $this->session->userdata['idUsuario'],'modulos' => $modulos,'series' => $series,'tiposVehiculos' => $tiposVehiculos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function indexPlacasxCaja()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $series = $this->control_cajas_model->getSeries();
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();
           

            $this->load->view('placasxcaja',array('idusuario' => $this->session->userdata['idUsuario'],'modulos' => $modulos,'series' => $series,'tiposVehiculos' => $tiposVehiculos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }

    }


    public function indexModificaExpedientes ()
    {
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $modulos = $this->control_cajas_model->getModulos();
            $series = $this->control_cajas_model->getSeries();
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();
           

            $this->load->view('modificaExpediente',array('idusuario' => $this->session->userdata['idUsuario'],'modulos' => $modulos,'series' => $series,'tiposVehiculos' => $tiposVehiculos));
        }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }

    public function menu()
    {
          $this->index();
    }

    public function autentifica(){

        $datosLogin = $this->input->post();

        $this->usuario = strtoupper($datosLogin['inputUsuario']);
        $this->password = md5($datosLogin['inputPassword']);

        $datosUsuario = $this->login_model->autentifica($this->usuario,$this->password);
        if(is_array($datosUsuario) && count($datosUsuario) > 0){

            $newdata = array(
                   'idUsuario'          => $datosUsuario[0]['idusuario'],
                    'atributo'          => $datosUsuario[0]['atributo'],
            );

            $this->session->set_userdata($newdata);
            $this->index($datosUsuario);

        }else{
            $this->load->view('welcome_message',array('mensaje'=>'USUARIO NO ENCONTRADO'));
        }
    }

    public function muestraCajas($modulo,$tipo_vehiculo,$remesa){

        $cajasMostrar = $this->control_cajas_model->obtenCajas($modulo,$tipo_vehiculo,$remesa);
        $this->load->view('muestracajas',array('cajasMostrar'=>$cajasMostrar));

    }

    public function muestraRemesas($modulo){

        $remesasMostrar = $this->control_cajas_model->obtenRemesas($modulo);
        $this->load->view('muestraremesas',array('remesasMostrar' => $remesasMostrar));
    }

    public function datosNecesarios($modulo,$tipo_vehiculo,$tipo_mov){

        $this->load->view('muestradatosnecesarios',array('modulo'=>$modulo,'tipo_vehiculo'=>$tipo_vehiculo,'tipo_mov'=>$tipo_mov));
    }

    public function nuevaSerie($numeroControl){

        echo '<div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-credit-card"></i></span>
                    <div class="row">
                        <div class="col-md-4">
                        <font color="red">*</font><input id="iniSerie_'.$numeroControl.'" style="text-transform: uppercase" name="iniSerie_'.$numeroControl.'" type="text" placeholder="Inicio de la Serie" class="form-control">
                        </div>
                        <div class="col-md-4">
                        <font color="red">*</font><input id="finSerie_'.$numeroControl.'" style="text-transform: uppercase" name="finSerie_'.$numeroControl.'" type="text" placeholder="Fin de la Serie" class="form-control">
                        </div>
                    </div>
               </div>

            <div name="nuevaSerie_'.$numeroControl.'" id="nuevaSerie_'.$numeroControl.'">
                   
            </div>';

    }

    public function muestraMovimientos($tipo_vehiculo){

        $movimientosMostrar = $this->control_cajas_model->obtenMovimientos($tipo_vehiculo);
        $this->load->view('muestramovimientos',array('movimientosMostrar'=>$movimientosMostrar));

    }

    public function muestraGridPlacas($modulo,$tipo_vehiculo,$tipo_movimiento,$id_registro_caja){

        $placasParaGrid = $this->control_cajas_model->obtenPlacas_x_Caja($modulo,$tipo_vehiculo,$serie,$id_ubicacion_caja);
        $this->load->view('gridplacas_x_caja',array('movimientosMostrar'=>$movimientosMostrar));

    }

    public function guardaInfo(){

        if($this->validaExisteExp($_POST) == false){
        
            $resInsertExpediente = $this->control_cajas_model->insertaInfo($_POST);
            if($resInsertExpediente == true){
                echo "<p id='profile-name' class='profile-name-card'><font color='blue'>SE GUARDO LA INFORMACION CON EXITO</font></p>";
               
            }else{
                echo "NO SE PUDO GUARDAR LA INFORMACION DEL EXPEDIENTE";
            }
        }
    }

     public function guardaRegistroExpediente(){

        if($this->validaExisteRegistroExp($_POST) == false){

            $_POST['id_usuario'] = $this->session->userdata['idUsuario'];
        
            $resInsertExpediente = $this->control_cajas_model->insertaRegExp($_POST);
            if($resInsertExpediente == true){
                echo "<p id='profile-name' class='profile-name-card'><font color='blue'>SE GUARDO LA INFORMACION CON EXITO</font></p>";
                
            }else{
                echo "NO SE PUDO GUARDAR LA INFORMACION DEL EXPEDIENTE";
            }
        }
    }

    public function guardaRegistroRemesa(){

        if($this->validaExisteRegistroRemesa($_POST) == false){

            $_POST['id_usuario'] = $this->session->userdata['idUsuario'];

            $_POST['anio_remesa'] = date('Y');
        
            $infoRemesa = $this->enMayusculas($_POST);

            $infoRemesa['nombre_remesa'] = $this->generaNombre($infoRemesa);
        
            $resInsertRemesa = $this->control_cajas_model->registraRemesa($infoRemesa);

            if($resInsertRemesa == true) {
                echo "<p id='profile-name' class='profile-name-card'><font color='blue'>LA REMESA <h2>".$infoRemesa['nombre_remesa']."</h2> SE REGISTRO CON EXITO</font></p>";
            } else {
                echo "NO SE PUDO GUARDAR LA INFORMACION DEL EXPEDIENTE";
            }
        }
    }

    public function generaNombre($infoRemesa){

        //$nombreRemesa = $infoRemesa['id_modulo']."_REMESA_".$infoRemesa['numero_remesa']."_".$infoRemesa['anio_remesa'];
        $nombreRemesa = "R".$infoRemesa['numero_remesa']."-".$infoRemesa['anio_remesa'];
        return $nombreRemesa;
    }

    function enMayusculas($info){
        
        foreach ($info as $key => $value) {
            $info[$key] = strtoupper($value);
        }
        return $info;
    }

    public function guardaInfoCaja(){

        if($this->validaExisteCaja($_POST) == false){

            $_POST['id_usuario'] = $this->session->userdata['idUsuario'];

            $resInsertCaja = $this->control_cajas_model->insertaInfoCaja($_POST);
            if($resInsertCaja == true){
                $this->generaQR($_POST);
            }else{
                echo "NO SE PUDO GUARDAR LA INFORMACION DE LA CAJA";
            }
        }
    }

    public function registraCaja(){

        if($this->validaExisteRegistroCaja($_REQUEST) == false){

            $_REQUEST['id_usuario'] = $this->session->userdata['idUsuario'];

            $resInsertCaja = $this->control_cajas_model->registraCaja($_REQUEST);
            if($resInsertCaja == true){
                $this->generaQRregistro($_REQUEST);
            }else{
                echo "NO SE PUDO GUARDAR LA INFORMACION DE LA CAJA";
            }
        }
    }

    public function validaExisteCaja($info){
        $resExisteCaja = $this->control_cajas_model->validaExisteCaja($_POST);
        
        if($resExisteCaja == true){

            echo "<p id='profile-name' class='profile-name-card'><font color='red'>YA EXISTE ESTA CAJA</font></p>";
            exit();
        }else{
            return false;
        }
    }

    public function validaExisteRegistroCaja($info){
        $resExisteCaja = $this->control_cajas_model->validaExisteRegistroCaja($_REQUEST);
        
        if($resExisteCaja == true){
            echo "<p id='profile-name' class='profile-name-card'><font color='red'>YA EXISTE ESTA CAJA</font></p>";
            exit();
        }else{
            return false;
        }
    }

    public function validaExisteExp($info){
        $resExisteExp = $this->control_cajas_model->validaExisteExp($_POST);
        
        if($resExisteExp != false){

            echo "<p id='profile-name' class='profile-name-card'><font color='red'>YA EXISTE ESTE EXPEDIENTE</font></p>";
            echo "<pre>";
            print_r($resExisteExp);
            exit();

        }else{
            return false;
        }
    }

    public function validaExisteRegistroExp($info){
        $resExisteExp = $this->control_cajas_model->validaExisteRegExp($_POST);
        
        if($resExisteExp != false){

            echo "<p id='profile-name' class='profile-name-card'><font color='red'>YA EXISTE ESTE EXPEDIENTE</font></p>";
            echo "<pre>";
            print_r($resExisteExp);
            exit();
        }else{
            return false;
        }
    }

    public function validaExisteRegistroRemesa($info){
        $resExisteRem = $this->control_cajas_model->validaExisteRegistroRemesa($_POST);
        
        if($resExisteRem != false){

            echo "<p id='profile-name' class='profile-name-card'><font color='red'>YA EXISTE ESTA REMESA</font></p>";
            echo "<pre>";
            print_r($resExisteRem);
            exit();
        }else{
            return false;
        }
    }

    public function generaQRregistro($info){

        $infoFinal = '';

        $infoModulo = $this->control_cajas_model->getInfoModulo($info['id_modulo']);
        $infoTipoVehi = $this->control_cajas_model->getNombreVehiculo($info['tipo_vehiculo']);
        $infoRemesa = $this->control_cajas_model->getNombreRemesa($info['id_registro_remesa']);


        $info['remesa'] = $infoRemesa[0]['nombre_remesa'];
        $info['tipo_vehiculo'] = $infoTipoVehi[0]['nombre_tipo_vehiculo'];
        $info['modulo'] = $infoModulo[0]['nombre_modulo'].', '.$infoModulo[0]['calle'].', '.$infoModulo[0]['num_ext'].', '.$infoModulo[0]['num_int'].', '.$infoModulo[0]['colonia'].' '.$infoModulo[0]['cp'].', '.$infoModulo[0]['alcaldia'].', '.$infoModulo[0]['estado'];

        foreach ($info as $key => $dato) {
            $infoFinal .= $key.': '.$dato."||";
        }

        $ruta =  base_url()."assets/js/qrcode.js";
        $download = base_url('assets/js/download.js');

        echo '<script src="'.base_url("assets/js/jquery_v3.min.js").'"></script>
              <script src="'.$ruta.'">
              </script>
              <script src="'.$download.'"></script>
            
              <script>
                    $(document).ready(function() {
                        var qrcode = new QRCode("test", {
                        text: "'.$infoFinal.'",
                        width: 320,
                        height: 320,
                        colorDark : "#000000",
                        colorLight : "#ffffff",
                        correctLevel : QRCode.CorrectLevel.L
                    });
                });
              </script>

              <div>
                <div>
                    <h1 align="center">Este es el QR generado para tu caja</h1>
                    <div id="test" style="margin-left: 40%; margin-top: 10%;"></div>
                </div>
              </div>';
    }
}
?>