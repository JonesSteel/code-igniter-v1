<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="<?php //echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php //echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<style type="text/css">
.header {
    color: #36A0FF;
    font-size: 27px;
    padding: 10px;
}

.bigicon {
    font-size: 35px;
    color: #36A0FF;
}
</style>

<script>

	function validaDatos(){
		var modulo = document.getElementById("id_modulo").value;
        var serie = document.getElementById("serie").value;
        var tipo_vehiculo = document.getElementById("tipo_vehiculo").value;
        var pasillo = document.getElementById("pasillo").value;
        var rack = document.getElementById("rack").value;
        var numero_caja = document.getElementById("numero_caja").value;
        var numero_expedientes = document.getElementById("numero_expedientes").value;

        if(modulo > 0 && serie > 0 && pasillo > 0 && rack > 0 && numero_caja > 0 && numero_expedientes > 0){       	

        	//document.getElementById("formFormato").submit();

            $.ajax({
                url: "<?php echo base_url()?>index.php/Controlcajas/guardaInfoCaja",
                type: "post",
                data: "id_modulo="+modulo+"&serie="+serie+"&tipo_vehiculo="+tipo_vehiculo+"&pasillo="+pasillo+"&rack="+rack+"&numero_caja="+numero_caja+"&numero_expedientes="+numero_expedientes,
                success: function(data){
                    var htmlOpcion = data;
                    $("#codigoQR").html(htmlOpcion);
                }
            });
        }else{

        	if(modulo == '' || modulo < 1){
                alert('Seleccione el modulo');
                
                return false;
            }
        	if(serie == '' || serie < 1){
                alert('Seleccione la Serie');
                
                return false;
            }
            if(tipo_vehiculo == '' || tipo_vehiculo < 1){
                alert('Seleccione el tipo de vehiculo');
                
                return false;
            }
            if(pasillo == '' || pasillo < 1){
                alert('Ingrese el numero de pasillo');
                document.getElementById("pasillo").focus();
                return false;
            }
            if(rack == '' || rack < 1){
                alert('Ingrese el numero de rack');
                document.getElementById("rack").focus();
                return false;
            }
            if(numero_caja == '' || numero_caja < 1){
                alert('Ingrese el numero de caja');
                document.getElementById("numero_caja").focus();
                return false;
            }
            if(numero_expedientes == '' || numero_expedientes < 1){
                alert('Ingrese el numero de expedientes');
                document.getElementById("numero_expedientes").focus();
                return false;
            }

        }
	}

		

</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">

            	<!-- <form id='formFormato' name='formFormato' class="form-horizontal" method="post" target="_blank" action="<?php //echo base_url(); ?>index.php/Controlcajas/guardaInfoCaja"> -->
                <form id='formFormato' name='formFormato' class="form-horizontal">

            		<fieldset>
            			<legend class="text-center header">Control de Ubicaci&oacute;n de Cajas</div></legend>

            			<div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="id_modulo" class="control-label">Modulo</label>
                            <select class="form-control" id="id_modulo" name="id_modulo">
                                <option value="" selected="true">SELECCIONE</option>
                                <?php

                                    foreach ($modulos as $modulo) {
                                    	echo "<option value='".$modulo['id_modulo']."'>".$modulo['nombre_modulo']."</option>";
                                    	
                                    	# code...
                                    }

                                ?>                                                                        
                            </select>                    
                        </div>

            			<div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="serie" class="control-label">Serie de las Placas</label>
                            <select class="form-control" id="serie" name="serie">
                                <option value="" selected="true">SELECCIONE</option>
                                <?php

                                    foreach ($series as $serie) {
                                    	echo "<option value='".$serie['id_serie']."'>".$serie['nombre_serie']."</option>";
                                    	
                                    	# code...
                                    }

                                ?>                                                                        
                            </select>                    
                        </div>


                        <div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="tipo_vehiculo" class="control-label">Tipo de Vehiculo</label>
                            <select class="form-control" id="tipo_vehiculo" name="tipo_vehiculo">
                                <option value="" selected="true">SELECCIONE</option>
                                <?php
                                print_r($tiposVehiculos);

                                    foreach ($tiposVehiculos as $tipo) {
                                    	echo "<option value='".$tipo['id_tipo_vehiculo']."'>".$tipo['nombre_tipo_vehiculo']."</option>";
                                    	
                                    	# code...
                                    }

                                ?>                                                                        
                            </select>                    
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-road"></i></span>
                            <div class="col-md-8">
                                <font color='red'>*</font><input id="pasillo" style="text-transform: uppercase" name="pasillo" type="number" placeholder="Pasillo" class="form-control">
                            </div>
                        </div>

                       <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-tasks"></i></span>
                            <div class="col-md-8">
                                <font color='red'>*</font><input id="rack" style="text-transform: uppercase" name="rack" type="number" placeholder="Rack" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-stop"></i></span>
                            <div class="col-md-8">
                                <font color='red'>*</font><input id="numero_caja" style="text-transform: uppercase" name="numero_caja" type="number" placeholder="Numero de Caja" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-book"></i></span>
                            <div class="col-md-8">
                                <font color='red'>*</font><input id="numero_expedientes" style="text-transform: uppercase" name="numero_expedientes" type="number" placeholder="Numero de Expedientes" class="form-control">
                            </div>
                        </div>
                        <div id='mensaje' name='mansaje'>

                            <?php
                               /* if(isset($mensaje) && trim($mensaje) != ''){
                                    echo "<p id='profile-name' class='profile-name-card'><font color='red'>".$mensaje."</font></p>";
                                }*/ 
                            ?>
                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                            	<!-- <a href='<?php //echo base_url(); ?>index.php/Controlcajas/menu' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>REGRESAR</a> -->
                                <button type="button" class="btn btn-primary btn-lg" onclick = "validaDatos();">Guardar</button>
                               
                               <!--  <a href='<?php //echo base_url(); ?>' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>SALIR</a> -->
                            </div>
                        </div>

                         <div id='codigoQR' name='codigoQR'>
                            
                        </div>

            		</fieldset>

            	</form>	
            </div> <!-- FIN DIV well -->
        </div> <!-- FIN DIV col-md-12 -->
    </div> <!-- FIN DIV row -->
</div> <!-- FIN DIV container -->

