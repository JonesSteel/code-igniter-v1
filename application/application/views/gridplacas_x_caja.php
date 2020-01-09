<script src="<?php echo base_url(); ?>DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<link href="<?php echo base_url(); ?>DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function() {
        $('#infoGrid').DataTable();
    });
</script>

<?php
 $tabla = '
 <table id="infoGrid" name="infoGrid" class="display" border="1" style="width:100%">
        <thead>
            <tr>
                <th>NO. EXP</th>
                <th>TIPO MOVIMIENTO</th>               
                <th>TIPO VEHICULO</th>                
                <th>FOLIO O PLACA</th>
                <th>No. HOJAS</th>               
            </tr>
        </thead>
        <tbody>';

            
$numeroExp = 1;

            foreach ($infoGrid as $valorGrid) {
                $tabla .= "<tr>";
                $tabla .= "<td>".$numeroExp."</td>";
                $tabla .= "<td>".$valorGrid['nombre_tipo_movimiento']."</td>";                
                $tabla .= "<td>".$valorGrid['nombre_tipo_vehiculo']."</td>";                
                $tabla .= "<td>".$valorGrid['folio_placa']."</td>";
                $tabla .= "<td>".$valorGrid['numero_hojas']."</td>";                                
                $tabla .= "</tr>";

                $numeroExp = $numeroExp + 1;
            }
            
      $tabla .=  '</tbody>
        <tfoot>

            <tr>
                <th>NO. EXP</th>
                <th>TIPO MOVIMIENTO</th>               
                <th>TIPO VEHICULO</th>                
                <th>FOLIO O PLACA</th>
                <th>No. HOJAS</th>
            </tr>            
        </tfoot>
    </table>';

    echo $tabla;
    ?>

<form id='formFormato' name='formFormato' class="form-horizontal" method="post" target="_blank" action="<?php echo base_url();?>index.php/Placasgrid/imprimeDetalle/">
    <div class="form-group">
        <div class="col-md-12 text-center">
            <input type="hidden" name="nombreModulo" id='nombreModulo' value="<?php echo $nombreModulo;?>">
            <input type="hidden" name="nombreRemesa" id='nombreRemesa' value= "<?php echo $nombreRemesa;?>">
            <input type="hidden" name="numeroCaja" id = 'numeroCaja' value="<?php echo $numeroCaja;?>">
            <input type="hidden" name="tabla" id="tabla" value="<?php echo base64_encode($tabla);?>">
            <br/>
            <button type="submit" class="btn btn-primary btn-lg">Imprimir</button>
        </div>
    </div>
</form>