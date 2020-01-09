<script type="text/javascript">
	
	/*$(document).ready(function() {
                
        $("#tipo_mov").change(function(event) {        	
            
           var modulo = $('#id_modulo').val();
            var tipo_vehiculo = $('#tipo_vehiculo').val();
            var tipo_movimiento = $('#tipo_mov').val();
                    //alert($('#sistema').val());
            $("#container_numerocaja").load('<?php //echo base_url(); ?>index.php/Controlcajas/muestraCajas/'+modulo+'/'+tipo_vehiculo+'/'+tipo_movimiento);
                
        });

    }); */

</script>


						<div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="tipo_mov" class="control-label">Tipo de Movimiento</label>
                                <select class="form-control form-control-lg" id="tipo_mov" name="tipo_mov">
                                	<option value="" selected="true">SELECCIONE</option>
                                	
									<?php 
									/*echo "<pre>";
									print_r($cajasMostrar);*/
									foreach ($movimientosMostrar as $movimiento) {

										echo "<option value='".$movimiento['id_tipo_movimiento']."'>".$movimiento['nombre_tipo_movimiento']."</option>";

										# code...
									}
									?>
                                                                                                             
                                </select>                    
                            </div>


                           <!-- <div id = 'container_datosNecesarios' name = 'container_datosNecesarios'>
                            
                            </div> -->