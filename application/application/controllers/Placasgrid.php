<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placasgrid extends CI_Controller
{

	public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('control_cajas_model');
        $this->load->library('session');       

    }

    public function indexReporteModificacionesExp(){

        $this->load->view('inicioReporteModificacionesExp');

    }

    public function gridPlacas(){

        $infoGrid = $this->control_cajas_model->obtenPlacasGrid($_POST['id_modulo'],$_POST['tipo_vehiculo'],$_POST['id_registro_remesa'],$_POST['id_registro_caja']);

        $infoModulo = $this->control_cajas_model->getInfoModulo($_POST['id_modulo']);
        $nombreRemesa = $this->control_cajas_model->getNombreRemesa($_POST['id_registro_remesa']);
        $numeroCaja = $this->control_cajas_model->getNumeroCaja($_POST['id_registro_caja']);

        $this->load->view('gridplacas_x_caja',array('infoGrid' => $infoGrid,'nombreModulo' => $infoModulo[0]['nombre_modulo'],'nombreRemesa' => $nombreRemesa[0]['nombre_remesa'], 'numeroCaja' => $numeroCaja[0]['numero_caja']));
    }

    public function gridEditaPlacas(){

	    // Falta agregar el campo de tipo_movimiento
        $infoGrid = $this->control_cajas_model->obtenPlacasGrid($_POST['id_modulo'],$_POST['tipo_vehiculo'],$_POST['id_registro_remesa'],$_POST['id_registro_caja']);

        $infoModulo = $this->control_cajas_model->getInfoModulo($_POST['id_modulo']);
        $nombreRemesa = $this->control_cajas_model->getNombreRemesa($_POST['id_registro_remesa']);
        $numeroCaja = $this->control_cajas_model->getNumeroCaja($_POST['id_registro_caja']);
        $tipoMovimiento = $this->control_cajas_model->getNombreMovimiento($_POST['idtipo_mov']);

        $this->load->view('gridplacas_x_editar',array('infoGrid' => $infoGrid,'nombreModulo' => $infoModulo[0]['nombre_modulo'],'nombreRemesa' => $nombreRemesa[0]['nombre_remesa'], 'numeroCaja' => $numeroCaja[0]['numero_caja'], 'nombreMovimiento' => $tipoMovimiento[0]['nombre_movimiento']));
    }

    public function reporteMovimientosExp(){
        $infoGridModificaciones = $this->control_cajas_model->obtenModificacionesExp($_REQUEST['fecha_inicial'],$_REQUEST['fecha_final'],'registro_expediente');
        $this->load->view('gridModificacionesExp',array('infoGridModificaciones' => $infoGridModificaciones));
    }



    public function imprimeDetalle(){
	    header("Pragma: public");
        header("Expires: 0");
        $filename = "expedientes_x_caja_".date('Ymd').".xls";
        header("Content-type: application/x-msdownload");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        echo "<table id='infoModulo' name='infoModulo'>
                <tr><th>Modulo:</th><th>".$_POST['nombreModulo']."</th></tr>
                <tr><th>Remesa:</th><th>".$_POST['nombreRemesa']."</th></tr>
                <tr><th>No. Caja:</th><th>".$_POST['numeroCaja']."</th></tr>
             </table>";

        echo base64_decode($_POST['tabla']);
    }

    public function editaExpediente($idExpediente){
        if(isset($this->session->userdata['idUsuario']) && trim($this->session->userdata['idUsuario']) != ''){

            $datosExpediente = $this->control_cajas_model->getDatosExpediente($idExpediente);

            if($datosExpediente > 0){
                $datosCaja = $this->control_cajas_model->getDatosCaja($datosExpediente[0]['id_registro_caja']);

                if($datosCaja >0){
                    $cajasDisponibles = $this->control_cajas_model->obtenCajas($datosCaja[0]['id_modulo'],$datosCaja[0]['tipo_vehiculo'],$datosCaja[0]['id_registro_remesa']);
                }
            }
            $tiposMovimiento = $this->control_cajas_model->obtenMovimientos($datosCaja[0]['tipo_vehiculo']);
            $tiposVehiculos = $this->control_cajas_model->getTipoVehiculo();

            $this->load->view('editaExpediente',array('tiposVehiculos' => $tiposVehiculos,'datosExpediente' => $datosExpediente,'datosCaja' => $datosCaja, 'cajasMostrar' => $cajasDisponibles, 'movimientosMostrar' => $tiposMovimiento));
       }else{
            echo "NO TIENE SESIÓN INICIADA DIRÍJASE AL ";
            echo "<a href=".base_url()." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>INICIO</a></center>";
        }
    }


    public function guardarCambios(){

	    $datosExpediente = $this->control_cajas_model->getDatosExpediente($_POST['id_registro_expediente']);
        $banderaCambios = 0;

        foreach ($_POST as $key => $value) {
            if($_POST[$key] != $datosExpediente[0][$key]){
                $banderaCambios = $banderaCambios + 1;
                if($this->control_cajas_model->actualizaDato('registro_expediente',$key,$datosExpediente[0][$key],$_POST[$key]) == true){
                    if($this->control_cajas_model->guardaHistorialCambios('registro_expediente',$key,$datosExpediente[0][$key],$_POST[$key],$this->session->userdata['idUsuario']) == true){
                            echo "<p id='profile-name' class='profile-name-card'><font color='blue'>SE MODIFICO ".$key." A ".$value."</font></p>";
                        }else{
                            //echo "<p id='profile-name' class='profile-name-card'><font color='blue'>SE MODIFICO ".$key." A ".$value."</font></p>";
                            echo "<p id='profile-name' class='profile-name-card'><font color='red'>ERROR AL GUARDAR EN EL HISTORIAL DE CAMBIOS</font></p>";
                        }
                }else{
                    echo "<p id='profile-name' class='profile-name-card'><font color='red'>ERROR AL ACTUALIZAR ".$key."</font></p>";
                }
            }
        }

        if($banderaCambios == 0){
             echo "<p id='profile-name' class='profile-name-card'><font color='red'>NO SE ENCUENTRAN MODIFICACIONES EN LOS DATOS ORIGINALES</font></p>";
            exit();
        }
    }
}
?>