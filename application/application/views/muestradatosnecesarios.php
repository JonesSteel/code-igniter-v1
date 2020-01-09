<script type="text/javascript">
    
    $(document).ready(function() {
        
        $("#agregaSerie").click(function(event) {
            //alert(<?php //echo $this->session->userdata['controlSerie'] ?>);

            var numero = $('#controlserie').val();
            var numeroDiv = '#nuevaSerie_'+numero;
            var nuevoNumero = ++numero;


            //alert(numeroDiv);
                               
            $(numeroDiv).load('<?php echo base_url(); ?>index.php/Controlcajas/nuevaSerie/'+nuevoNumero);

            $('#controlserie').val(nuevoNumero);
                
        });
        

    });

</script>


<?php
//echo $tipo_vehiculo." ".$tipo_vehiculo;

if($tipo_vehiculo >= 2 && $tipo_vehiculo <= 4){

	if($tipo_mov == 9){
       


	?>
                   
						<div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-credit-card"></i></span>
                            <div class="row">
                                <div class="col-md-4">
                                <font color='red'>*</font><input id="iniSerie_1" style="text-transform: uppercase" name="iniSerie_1" type="text" placeholder="Inicio de la Serie" class="form-control">
                                </div>
                                <div class="col-md-4">
                                <font color='red'>*</font><input id="finSerie_1" style="text-transform: uppercase" name="finSerie_1" type="text" placeholder="Fin de la Serie" class="form-control">
                                </div>
                            </div>
                        </div>

                     <div name='nuevaSerie_1' id='nuevaSerie_1'>
                        
                    </div>

                    <input type="hidden" name="controlserie" id="controlserie" value=1>

                    <div class="form-group">
                        <div class="col-md-12 text-center">

                            <button type="button" name='agregaSerie' id='agregaSerie' class="btn btn-primary btn-lg">Agregar Serie</button>

                        </div>
                    </div>
						

<?php
	}	
}

?>