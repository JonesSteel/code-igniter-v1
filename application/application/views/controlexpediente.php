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

<h1 style="text-align: center">Registro de Expedientes</h1>

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

            <div id= 'container_remesas' name= 'container_remesas'>
            </div>

            <div class="form-group"> <!-- State Button -->
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

            <div id = 'container_numerocaja' name= 'container_numerocaja'>
            </div>

            <div id= 'container_movimientos' name= 'container_movimientos'>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-credit-card"></i></span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="folio_placa" style="text-transform: uppercase" name="folio_placa" type="text" placeholder="Folio o Placa" class="form-control form-control-lg">
                </div>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-book"></i></span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="numero_hojas" style="text-transform: uppercase" name="numero_hojas" type="number" min="1"  max="250" placeholder="Numero de Hojas" class="form-control form-control-lg">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success btn-lg" onclick = "validaDatos();">Guardar</button>
                </div>
            </div>

            <div id='resGuardado' name='resGuardado'>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript Section -->

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
        });
    });
</script>

<script>

    function validaDatos(){
        var modulo = document.getElementById("id_modulo").value;
        var folio_placa = document.getElementById("folio_placa").value;
        var tipo_vehiculo = document.getElementById("tipo_vehiculo").value;
        var numero_hojas = document.getElementById("numero_hojas").value;

        if(modulo > 0 && folio_placa !== '' && tipo_vehiculo > 0  && numero_hojas > 0){
            var remesa = document.getElementById("id_registro_remesa").value;
            if(remesa > 0){
                var numero_caja = document.getElementById("id_registro_caja").value;
                var tipo_movimiento = document.getElementById("tipo_mov").value;

                if(numero_caja > 0 && tipo_movimiento > 0){
                    $.ajax({
                        url: "<?php echo base_url('index.php/Controlcajas/guardaRegistroExpediente')?>",
                        type: "post",
                        data: "id_modulo="+modulo+"&folio_placa="+folio_placa+"&tipo_vehiculo="+tipo_vehiculo+"&id_registro_caja="+numero_caja+"&tipo_mov="+tipo_movimiento+"&numero_hojas="+numero_hojas,
                        success: function(data){
                            var htmlOpcion = data;
                            $("#resGuardado").html(htmlOpcion);
                        }
                    });
                }else{
                    if(numero_caja == '' || numero_caja < 1){
                        alert('Ingrese el numero de caja');
                        document.getElementById("numero_caja").focus();
                        return false;
                    }

                    if(tipo_movimiento == '' || tipo_movimiento < 1){
                        alert('Seleccione el tipo de movimiento');
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

            if(folio_placa == ''){
                alert('Ingrese el folio o placa');
                document.getElementById("folio_placa").focus();
                return false;
            }

            if(tipo_vehiculo == '' || tipo_vehiculo < 1){
                alert('Seleccione el tipo de vehiculo');
                return false;
            }

            if(numero_hojas == '' || numero_hojas < 1){
                alert('Ingrese el numero de hojas');
                document.getElementById("numero_hojas").focus();
                return false;
            }
        }
    }
</script>