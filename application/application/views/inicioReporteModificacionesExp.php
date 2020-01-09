<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
        alert("ENTRE 1");
        
		var fecha_inicial = document.getElementById("fecha_inicial").value;
        var fecha_final = document.getElementById("fecha_final").value;

        if(fecha_inicial != '' && fecha_inicial.length == 10 && fecha_final != '' && fecha_final.length == 10){
            window.open("<?php echo base_url()?>index.php/Placasgrid/reporteMovimientosExp?fecha_inicial="+fecha_inicial+"&fecha_final="+fecha_final, '_blank');
        }else{

        	if(fecha_inicial.length != 10){
                alert('Fecha Inicial Incorrecta');
                document.getElementById("fecha_inicial").focus();
                return false;
            }

            if(fecha_final.length != 10){
                alert('Fecha Final Incorrecta');
                document.getElementById("fecha_final").focus();
                return false;
            }
        }
	}

    $(function() {

        $('#datetimepicker1').datetimepicker({            
            format: 'yyyy-mm-dd'
        });

        $('#datetimepicker2').datetimepicker({            
            format: 'yyyy-mm-dd'
        });
    });

</script>

<h1 style="text-align: center">Expedientes Modificados</h1>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <form name='formRegCaja' id='formRegCaja' class="col-8 form-horizontal">
            <div class="form-group"> <!-- State Button -->
                <font color='red'>*</font><label for="id_modulo" class="control-label"> Fecha Inicial</label>
                <div class='input-group date' id='datetimepicker1' name='datetimepicker1'>
                    <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control form-control-lg" placeholder="YYYY-MM-DD" />
                </div>
            </div>

            <div class="form-group"> <!-- State Button -->
                <font color='red'>*</font><label for="id_modulo" class="control-label"> Fecha Final</label>
                <div class='input-group date' id='datetimepicker2'>
                    <input type="date" name="fecha_final" id="fecha_final" class="form-control form-control-lg" placeholder="YYYY-MM-DD"/>
                </div>
            </div>

            <div id= 'grid' name= 'grid'>
            </div>

            <br/>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success btn-lg" onclick = "validaDatos();">Consultar</button>
                </div>
            </div>

            <div id='resGrid' name='resGrid'>
            </div>
        </form>
    </div>
</div>
