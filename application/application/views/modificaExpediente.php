<style>
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

<h1 style="text-align: center">Modificación de Expedientes</h1>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <form id='formFormato' name='formFormato' class="col-8 form-horizontal">
            <div class="form-group">
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

            <div id='container_remesas' name='container_remesas'>
            </div>


            <div class="form-group">
                <font color='red'>*</font><label for="tipo_vehiculo" class="control-label">Tipo de Vehiculo</label>
                <select class="form-control form-control-lg" id="tipo_vehiculo" name="tipo_vehiculo">
                    <option value="" selected="true">SELECCIONE</option>
                    <?php
                        foreach ($tiposVehiculos as $tipo) {
                            echo "<option value='".$tipo['id_tipo_vehiculo']."'>".$tipo['nombre_tipo_vehiculo']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div id='container_numerocaja' name='container_numerocaja'>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" id='boton' name='boton' class="btn btn-success btn-lg" onclick = "validaDatos();">Consultar</button>
                </div>
            </div>
            <br>
            <div id='grid' name='grid'>

            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#id_modulo").change(function (event) {
            var modulo = $('#id_modulo').val();
            $("#container_remesas").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraRemesas/' + modulo);
        });

        $("#tipo_vehiculo").change(function (event) {
            var modulo = $('#id_modulo').val();
            var tipo_vehiculo = $('#tipo_vehiculo').val();
            var remesa = $('#id_registro_remesa').val();

            $("#container_numerocaja").load('<?php echo base_url(); ?>index.php/Controlcajas/muestraCajas/' + modulo + '/' + tipo_vehiculo + '/' + remesa);
        });
    });
</script>

<script>
    function validaDatos(){
        var modulo = document.getElementById("id_modulo").value;
        var tipo_vehiculo = document.getElementById("tipo_vehiculo").value;

        if(modulo > 0 && tipo_vehiculo > 0){
            var remesa = document.getElementById("id_registro_remesa").value;
            if(remesa > 0){
                var numero_caja = document.getElementById("id_registro_caja").value;
                if(numero_caja > 0){
                    $.ajax({
                        url: "<?php echo base_url()?>index.php/Placasgrid/gridEditaPlacas",
                        type: "post",
                        data: "id_modulo="+modulo+"&tipo_vehiculo="+tipo_vehiculo+"&id_registro_remesa="+remesa+"&id_registro_caja="+numero_caja,
                        success: function(data){
                            var htmlOpcion = data;
                            $("#grid").html(htmlOpcion);
                        }
                    });
                }else{
                    if(numero_caja == '' || numero_caja < 1){
                        alert('Seleccione el numero de caja');
                        return false;
                    }
                }
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
        }
    }
</script>