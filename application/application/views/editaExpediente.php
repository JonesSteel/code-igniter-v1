<title>Modificaciòn de Expedientes | Sistema de Control de Cajas - SEMOVI</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#id_modulo").change(function(event) {
            var modulo = $('#id_modulo').val();
            $("#container_remesas").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraRemesas/'+modulo);
        });
        $("#tipo_vehiculo").change(function(event) {
            var modulo = $('#id_modulo').val();
            var tipo_vehiculo = $('#tipo_vehiculo').val();
            var remesa = $('#id_registro_remesa').val();
            $("#container_numerocaja").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraCajas/'+modulo+'/'+tipo_vehiculo+'/'+remesa);
        })
    });
</script>

<script>
    function validaDatos(){
        var tipo_vehiculo = document.getElementById("tipo_vehiculo").value;
        var numero_caja = document.getElementById("id_registro_caja").value;
        var folio_placa = document.getElementById("folio_placa").value;
        //var numero_hojas = document.getElementById("numero_hojas").value;
        var tipo_movimiento = document.getElementById("tipo_mov").value;
        var id_registro_expediente = document.getElementById("id_registro_expediente").value;

        if(tipo_vehiculo > 0 && numero_caja > 0 && folio_placa != '' && tipo_movimiento > 0){
            $.ajax({
                url: "<?php echo base_url()?>index.php/Placasgrid/guardarCambios",
                type: "post",
                data: "tipo_vehiculo="+tipo_vehiculo+"&folio_placa="+folio_placa+"&id_registro_caja="+numero_caja+"&id_registro_expediente="+id_registro_expediente,
                success: function(data){
                    var htmlOpcion = data;
                    alert(htmlOpcion);
                    $("#resCambios").html(htmlOpcion);
                }
            });
        }else{
            if(tipo_vehiculo == '' || tipo_vehiculo < 1){
                alert('Seleccione el tipo de vehiculo');
                return false;
            }
            if(numero_caja == '' || numero_caja < 1){
                alert('Seleccione el numero de caja');
                return false;
            }
            if(folio_placa == ''){
                alert('Ingrese el folio o placa');
                document.getElementById("folio_placa").focus();
                return false;
            }

            /*if(numero_hojas == '' || numero_hojas < 1){
                alert('Ingrese el numero de hojas');
                document.getElementById("numero_hojas").focus();
                return false;
            }*/
            if(tipo_movimiento == '' || tipo_movimiento < 1){
                alert('Seleccione el tipo de movimiento');
                return false;
            }
        }
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form id='formFormato' name='formFormato' class="form-horizontal">
                    <fieldset>
                        <legend class="text-center header">Modificación de Expedientes</div></legend>

            <div id= 'container_remesas' name= 'container_remesas'>
            </div>

            <div class="form-group"> <!-- State Button -->
                <font color='red'>*</font><label for="tipo_vehiculo" class="control-label">Tipo de Vehiculo</label>
                <select class="form-control" id="tipo_vehiculo" name="tipo_vehiculo" disabled>
                    <?php
                    foreach ($tiposVehiculos as $tipo) {
                        if($tipo['id_tipo_vehiculo'] == $datosExpediente[0]['tipo_vehiculo']){
                            echo "<option value='".$tipo['id_tipo_vehiculo']."' selected='true'>".$tipo['nombre_tipo_vehiculo']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <font color='red'>*</font><label for="id_registro_caja" class="control-label">Numero de Caja</label>
                <select class="form-control" id="id_registro_caja" name="id_registro_caja" disabled>
                    <?php
                        foreach ($cajasMostrar as $caja) {
                            if($caja['id_registro_caja'] == $datosExpediente[0]['id_registro_caja']){
                                echo "<option value='".$caja['id_registro_caja']."' selected='true'>".$caja['numero_caja']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <font color='red'>*</font><label for="tipo_mov" class="control-label">Tipo de Movimiento</label>
                <select class="form-control" id="tipo_mov" name="tipo_mov" disabled>
                    <?php
                    foreach ($movimientosMostrar as $movimiento) {
                        if($movimiento['id_tipo_movimiento'] == $datosExpediente[0]['tipo_mov']){
                            echo "<option value='".$movimiento['id_tipo_movimiento']."'>".$movimiento['nombre_tipo_movimiento']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-credit-card"></i> Folio o Placa</span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="folio_placa" style="text-transform: uppercase" name="folio_placa" type="text" placeholder="Folio o Placa" class="form-control" value="<?php echo $datosExpediente[0]['folio_placa']; ?>">
                </div>
            </div>

            <!-- <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-book"></i> Numero de Hojas</span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="numero_hojas" style="text-transform: uppercase" name="numero_hojas" type="number" placeholder="Numero de Hojas" class="form-control" value="<?php echo $datosExpediente[0]['numero_hojas']; ?>">
                </div>
            </div> -->

            <input type="hidden" name="id_registro_expediente" id='id_registro_expediente' value='<?php echo $datosExpediente[0]['id_registro_expediente'] ?>'>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <!-- <a href='<?php //echo base_url(); ?>index.php/Controlcajas/menu' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>REGRESAR</a> -->
                    <button type="button" id='boton' name='boton' class="btn btn-primary btn-lg" onclick = "validaDatos();">Guardar Cambios</button>
                    <!-- <a href='<?php //echo base_url(); ?>' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>SALIR</a> -->
                </div>
            </div>

            <div id='resCambios' name='resCambios'>
            </div>
            </fieldset>
            </form>
        </div> <!-- FIN DIV well -->
    </div> <!-- FIN DIV col-md-12 -->
</div> <!-- FIN DIV row -->
</div> <!-- FIN DIV container --> 
