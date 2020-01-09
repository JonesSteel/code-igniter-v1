<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

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

<script type="text/javascript">

    function validaDatos(){

        var modulo = document.getElementById("id_modulo").value;
        var numero_remesa = document.getElementById("numero_remesa").value;

        if(modulo > 0 && numero_remesa > 0){
            $.ajax({
                url: "<?php echo base_url()?>index.php/Controlcajas/guardaRegistroRemesa",
                type: "post",
                data: "id_modulo="+modulo+"&numero_remesa="+numero_remesa,
                success: function(data){
                    var htmlOpcion = data;
                    $("#resRegistro").html(htmlOpcion);
                }
            });
        }else{

            if(modulo == '' || modulo < 1){
                alert('Seleccione el modulo');
                return false;
            }

            if(numero_remesa == '' || numero_remesa < 1){
                alert('Ingrese el numero de remesa');
                document.getElementById("numero_remesa").focus();
                return false;
            }
        }
    }
</script>

<h1 style="text-align: center">Registro de Remesas</h1>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <form name='formRegRemesa' id='formRegRemesa' class="col-8 form-horizontal">
            <div class="form-group">
                <font color='red'>*</font><label for="id_modulo" class="control-label">Módulo</label>
                <select class="form-control form-control-lg" id="id_modulo" name="id_modulo">
                    <option value="" selected="true">SELECCIONE</option>
                    <?php
                    foreach ($modulos as $modulo) {
                        echo "<option value='".$modulo['id_modulo']."'>".$modulo['nombre_modulo']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-stop"></i></span>
                <div class="col-md-8">
                    <font color='red'>*</font><input id="numero_remesa" style="text-transform: uppercase" name="numero_remesa" type="number" min="0" placeholder="Numero de Remesa" class="form-control form-control-lg">
                </div>
            </div>

            <br/>
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
