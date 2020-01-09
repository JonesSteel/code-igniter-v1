<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_cajas_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertaInfo($infoCaja){
		
		$infoCaja = $this->enMayusculas($infoCaja);

		$this->db->trans_start();
		$this->db->insert('ubicacion_expediente', $infoCaja);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}

	function insertaRegExp($infoExp){
		
		$infoExp = $this->enMayusculas($infoExp);

		$this->db->trans_start();
		$this->db->insert('registro_expediente', $infoExp);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}

	function insertaInfoCaja($infoCaja){

		$infoCaja = $this->enMayusculas($infoCaja);
		
		$this->db->trans_start();
		$this->db->insert('ubicacion_caja', $infoCaja);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}

	function registraCaja($infoCaja){
		
		$infoCaja = $this->enMayusculas($infoCaja);

		$this->db->trans_start();
		$this->db->insert('registro_caja', $infoCaja);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}

	function registraRemesa($infoRemesa){

		$this->db->trans_start();
		$this->db->insert('registro_remesa', $infoRemesa);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}
	

	function getModulos(){
		$modulos = $this->db->query("select * from cat_modulo")->result_array();
		if(count($modulos) > 0){
			return $modulos;
		}else{
			return FALSE;
		}
	}

	function getSeries(){
		$seriesPlacas = $this->db->query("select * from cat_series")->result_array();
		if(count($seriesPlacas) > 0){
			return $seriesPlacas;
		}else{
			return FALSE;
		}
	}

	function getTipoVehiculo(){
		$tiposVehiculo = $this->db->query("select * from cat_tipo_vehiculo")->result_array();
		if(count($tiposVehiculo) > 0){
			return $tiposVehiculo;
		}else{
			return FALSE;
		}
	}

	function getNombreSerie($idserie){
		$seriesPlacas = $this->db->query("select nombre_serie from cat_series where id_serie = '".$idserie."'")->result_array();
		if(count($seriesPlacas) > 0){
			return $seriesPlacas;
		}else{
			return "ISNE";
		}
	}

	function getNombreVehiculo($idtipo_vehiculo){
		$tipoVehiculo = $this->db->query("select nombre_tipo_vehiculo from cat_tipo_vehiculo where id_tipo_vehiculo = '".$idtipo_vehiculo."'")->result_array();
		if(count($tipoVehiculo) > 0){
			return $tipoVehiculo;
		}else{
			return "IVNE";
		}
	}

	function getNombreRemesa($id_registro_remesa){
		$remesa = $this->db->query("select nombre_remesa from registro_remesa where id_registro_remesa = '".$id_registro_remesa."'")->result_array();
		if(count($remesa) > 0){
			return $remesa;
		}else{
			return "RNE";
		}
	}

	function getNumeroCaja($id_registro_caja){
		$numeroCaja = $this->db->query("select numero_caja from registro_caja where id_registro_remesa = '".$id_registro_caja."'")->result_array();
		if(count($numeroCaja) > 0){
			return $numeroCaja;
		}else{
			return "CNE";
		}
	}

	function getNombreMovimiento($idtipo_mov){
		$tipoMovimiento = $this->db->query("select nombre_tipo_movimiento from cat_tipo_movimiento where id_tipo_movimiento = '".$idtipo_mov."'")->result_array();
		if(count($tipoMovimiento) > 0){
			return $tipoMovimiento;
		}else{
			return "TMNE";
		}
	}

	function getInfoModulo($idmodulo){
		$infoModulo = $this->db->query("select * from cat_modulo where id_modulo = '".$idmodulo."'")->result_array();
		if(count($infoModulo) > 0){
			return $infoModulo;
		}else{
			return "IMNE";
		}
	}

	function getDatosExpediente($id_expediente){

		$infoExpediente = $this->db->query("select * from registro_expediente where id_registro_expediente = '".$id_expediente."'")->result_array();
		if(count($infoExpediente) > 0){
			return $infoExpediente;
		}else{
			return "ENE";
		}

	}

	function getDatosCaja($id_registro_caja){

		$infoCaja = $this->db->query("select * from registro_caja where id_registro_caja = '".$id_registro_caja."'")->result_array();
		if(count($infoCaja) > 0){
			return $infoCaja;
		}else{
			return "CNE";
		}

	}

	function obtenCajas($modulo,$tipo_vehiculo,$remesa){

		$infoCajas = $this->db->query("select * from registro_caja where id_modulo = '".$modulo."' and tipo_vehiculo= '".$tipo_vehiculo."' and id_registro_remesa = '".$remesa."'")->result_array();
		if(count($infoCajas) > 0){
			return $infoCajas;
		}else{
			return "CNE";
		}

	}
	function obtenRemesas($modulo){

		$infoRemesas = $this->db->query("select * from registro_remesa where id_modulo = '".$modulo."' and (anio_remesa= '2019' or anio_remesa= '2020')")->result_array();
		if(count($infoRemesas) > 0){
			return $infoRemesas;
		}else{
			return "RNE";
		}

	}

	function validaExisteCaja($infoCaja){

		$infoCaja = $this->enMayusculas($infoCaja);

		$modulo = $infoCaja['id_modulo'];
		$tipo_vehiculo  = $infoCaja['tipo_vehiculo'];
		$serie = $infoCaja['serie'];
		$numero_caja = $infoCaja['numero_caja']; 

		$existeCaja = $this->db->query("select * from ubicacion_caja where id_modulo = '".$modulo."' and numero_caja = '".$numero_caja."' and tipo_vehiculo= '".$tipo_vehiculo."' and serie = '".$serie."'")->result_array();

		if(count($existeCaja) > 0){
			return true;
		}else{
			return false;
		}
	}

	function validaExisteRegistroCaja($infoCaja){

		$infoCaja = $this->enMayusculas($infoCaja);

		$modulo = $infoCaja['id_modulo'];
		$tipo_vehiculo  = $infoCaja['tipo_vehiculo'];
		$remesa = $infoCaja['id_registro_remesa'];
		$numero_caja = $infoCaja['numero_caja']; 

		$existeCaja = $this->db->query("select * from registro_caja where id_modulo = '".$modulo."' and numero_caja = '".$numero_caja."' and tipo_vehiculo= '".$tipo_vehiculo."' and id_registro_remesa = '".$remesa."'")->result_array();

		if(count($existeCaja) > 0){
			return true;
		}else{
			return false;
		}
	}

	function validaExisteRegistroRemesa($infoRemesa){

		$infoRemesa = $this->enMayusculas($infoRemesa);

		$modulo = $infoRemesa['id_modulo'];		
		$numero_remesa = $infoRemesa['numero_remesa'];
		$anio_actual = date('Y');
		$existeRemesa = $this->db->query("select * from registro_remesa where id_modulo = '".$modulo."' and numero_remesa = '".$numero_remesa."' and anio_remesa= '".$anio_actual."'")->result_array();

		if(count($existeRemesa) > 0){
			return $existeRemesa;
		}else{
			return false;
		}
	}

	function validaExisteExp($infoExpediente){

		$infoExpediente = $this->enMayusculas($infoExpediente);

		$placa = $infoExpediente['placa'];
		$tipo_movimiento  = $infoExpediente['tipo_movimiento'];
		
		$existeExp = $this->db->query("select m.nombre_modulo, c.numero_caja, s.nombre_serie, t.nombre_tipo_vehiculo, v.nombre_tipo_movimiento, u.placa, u.numero_hojas from ubicacion_expediente u, ubicacion_caja c, cat_modulo m, cat_series s, cat_tipo_vehiculo t, cat_tipo_movimiento v where u.placa = '".$placa."' and u.tipo_movimiento = '".$tipo_movimiento."'and u.id_ubicacion_caja = c.id_ubicacion_caja and u.id_modulo = m.id_modulo and u.serie = s.id_serie and u.tipo_vehiculo = t.id_tipo_vehiculo and u.tipo_movimiento = v.id_tipo_movimiento")->result_array();
		
		if(count($existeExp) > 0){
			return $existeExp;
		}else{
			return false;
		}
	}

	function validaExisteRegExp($infoExpediente){

		$infoExpediente = $this->enMayusculas($infoExpediente);

		$folio_placa = $infoExpediente['folio_placa'];
		$tipo_movimiento  = $infoExpediente['tipo_mov'];
		$existeExp = $this->db->query("select m.nombre_modulo, c.numero_caja, t.nombre_tipo_vehiculo, v.nombre_tipo_movimiento, u.folio_placa, u.numero_hojas from registro_expediente u, registro_caja c, cat_modulo m, cat_tipo_vehiculo t, cat_tipo_movimiento v where u.folio_placa = '".$folio_placa."' and u.tipo_mov = '".$tipo_movimiento."' and u.id_registro_caja = c.id_registro_caja and u.id_modulo = m.id_modulo and u.tipo_vehiculo = t.id_tipo_vehiculo and u.tipo_mov = v.id_tipo_movimiento")->result_array();
		
		if(count($existeExp) > 0){
			return $existeExp;
		}else{
			return false;
		}
	}

	function obtenMovimientos($tipo_vehiculo){
		$infoMovimientos = $this->db->query("select * from cat_tipo_movimiento where id_tipo_vehiculo = '".$tipo_vehiculo."'")->result_array();

		if(count($infoMovimientos) > 0){
			return $infoMovimientos;
		}else{
			return "MNE";
		}

	}

	function obtenPlacasGrid($modulo,$tipo_vehiculo,$remesa,$id_registro_caja){
		$infoPlacasGrid = $this->db->query("select u.id_registro_expediente, m.nombre_modulo, c.numero_caja, t.nombre_tipo_vehiculo, v.nombre_tipo_movimiento, u.folio_placa, u.numero_hojas from registro_expediente u, registro_caja c, cat_modulo m, cat_tipo_vehiculo t, cat_tipo_movimiento v where u.id_modulo = '".$modulo."' and u.tipo_vehiculo = '".$tipo_vehiculo."' and u.id_registro_caja = '".$id_registro_caja."' and u.id_registro_caja = c.id_registro_caja and u.id_modulo = m.id_modulo and u.tipo_vehiculo = t.id_tipo_vehiculo and u.tipo_mov = v.id_tipo_movimiento")->result_array();

		if(count($infoPlacasGrid) > 0){
			return $infoPlacasGrid;
		}else{
			return "PNE";
		}

	}

	function obtenModificacionesExp($fecha_inicial,$fecha_final,$tabla){
		$infoModificacionesGrid = $this->db->query("select m.id_registro_modificacion, u.usuario, m.tabla_actualizada, m.campo_actualizado, m.valor_antiguo, m.valor_nuevo, m.fecha_hora_alta from modificaciones m, usuarios u where date(m.fecha_hora_alta) >= '".$fecha_inicial."' and date(m.fecha_hora_alta) <= '".$fecha_final."' and m.tabla_actualizada = '".$tabla."' and m.id_usuario = u.idusuario")->result_array();

		if(count($infoModificacionesGrid) > 0){
			return $infoModificacionesGrid;
		}else{
			return "MNE";
		}

	}

	function enMayusculas($infoFormatoUsuario){
		
		foreach ($infoFormatoUsuario as $key => $value) {
			$infoFormatoUsuario[$key] = strtoupper($value);
		}
		return $infoFormatoUsuario;
	}

	function actualizaDato($tabla,$campo,$datoOriginal,$datoNuevo){

		$datos_actualiza = array($campo => $datoNuevo);

		$this->db->trans_start();
		$this->db->where($campo, $datoOriginal);
	    $this->db->update($tabla, $datos_actualiza);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}

	function guardaHistorialCambios($tabla,$campo,$datoOriginal,$datoNuevo,$id_usuario){

		$arregloCambios = array('id_usuario' => $id_usuario, 'tabla_actualizada' => $tabla, 'campo_actualizado' => $campo, 'valor_antiguo' => $datoOriginal, 'valor_nuevo' => $datoNuevo);

		$this->db->trans_start();
		$this->db->insert('modificaciones', $arregloCambios);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	return false;
    	}else{
    		return true;
    	}
	}
}
?>