<script type="text/javascript">

    $("#id_registro_caja").change(function(event) {


        var tipo_vehiculo = $('#tipo_vehiculo').val();

        $("#container_movimientos").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraMovimientos/'+tipo_vehiculo);

    });

</script>

<div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="id_registro_caja" class="control-label">Numero de Caja</label>
                                <select class="form-control form-control-lg" id="id_registro_caja" name="id_registro_caja">
                                    <option value="" selected="true">SELECCIONE</option>
						<?php 

						foreach ($cajasMostrar as $caja) {

							echo "<option value='".$caja['id_registro_caja']."'>".$caja['numero_caja']."</option>";

							# code...
						}
						?>

                                </select>                    
                        </div>