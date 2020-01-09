<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<style type="text/css">
    body, h1 {
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 10%;
    }

    .control-label, .btn{
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 1.25em;
        font-weight: 500;
    }
</style>

<script type="text/javascript">

    function validaDatos(){

        var modulo = document.getElementById("id_modulo").value;
        var tipo_vehiculo = document.getElementById("tipo_vehiculo").value;
        var numero_caja = document.getElementById("numero_caja").value;
        var numero_expedientes = document.getElementById("numero_expedientes").value;

        if(modulo > 0 && tipo_vehiculo > 0 && numero_caja > 0 && numero_expedientes > 0 ){
            var remesa = document.getElementById("id_registro_remesa").value;

            if(remesa > 0){
                window.open("<?php echo base_url()?>index.php/Controlcajas/registraCaja?id_modulo="+modulo+"&tipo_vehiculo="+tipo_vehiculo+"&numero_caja="+numero_caja+"&numero_expedientes="+numero_expedientes+"&id_registro_remesa="+remesa, '_blank');
            }else{

                if(remesa == '' || remesa < 1){
                    alert('Seleccione la remesa');

                    return false;
                }
            }
        }else{

            if(modulo == '' || modulo < 1){
                alert('Seleccione el modulo');

                return false;
            }
            if(tipo_vehiculo == '' || tipo_vehiculo < 1){
                alert('Seleccione el tipo de vehiculo');

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

    $(document).ready(function() {
        $("#id_modulo").change(function(event) {
            var modulo = $('#id_modulo').val();
            $("#container_remesas").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraRemesas/'+modulo);
        });
    });
</script>

<h1 style="text-align: center">Registro de Cajas</h1>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <form name='formRegCaja' id='formRegCaja' class="col-8 form-horizontal">
            <div class="form-group"> <!-- State Button -->
                <font color='red'>*</font><label for="id_modulo" class="control-label">Modulo</label>
                <select class="form-control form-control-lg" id="id_modulo" name="id_modulo">
                    <option value="" selected="true">SELECCIONE</option>
                    <?php
                    foreach ($modulos as $modulo) {
                        echo "<option value='".$modulo['id_modulo']."'>".$modulo['nombre_modulo']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div id= 'container_remesas' name= 'container_remesas'>

            </div>

            <div class="form-group">
                <font color='red'>*</font><label for="tipo_vehiculo" class="control-label">Tipo de Vehiculo</label>
                <select class="form-control form-control-lg" id="tipo_vehiculo" name="tipo_vehiculo">
                    <option value="" selected="true">SELECCIONE</option>
                    <?php
                    print_r($tiposVehiculos);

                    foreach ($tiposVehiculos as $tipo) {
                        echo "<option value='".$tipo['id_tipo_vehiculo']."'>".$tipo['nombre_tipo_vehiculo']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-stop"></i></span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="numero_caja" style="text-transform: uppercase" name="numero_caja" type="number" placeholder="Numero de Caja" class="form-control form-control-lg">
                </div>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-book"></i></span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="numero_expedientes" style="text-transform: uppercase" name="numero_expedientes" type="number" placeholder="Numero de Expedientes" class="form-control form-control-lg">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success btn-lg" onclick = "validaDatos();">Guardar</button>
                </div>
            </div>

            <div id='resRegistro' name='resRegistro'>

            </div>
        </form>
    </div>
</div>
