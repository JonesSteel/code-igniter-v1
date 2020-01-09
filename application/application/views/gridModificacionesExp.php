 <!--<script src="<?php //echo base_url(); ?>DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>

<link href="<?php //echo base_url(); ?>DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function() {
        $('#infoGrid').DataTable();
    } );
</script> -->

<?php

 header("Pragma: public");
        header("Expires: 0");
        $filename = "reporte_expedientes_modificados_".date('Ymd').".xls";
        header("Content-type: application/x-msdownload");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

 $tabla = '
 <table id="infoGrid" name="infoGrid" class="display" border="1" style="width:100%">
        <thead>
            <tr>
                <th>ID MODIFICACION</th>
                <th>USUARIO</th>               
                <th>TABLA</th>                
                <th>CAMPO ACTUALIZADO</th>
                <th>DATO ANTIGUO</th>
                <th>DATO NUEVO</th>
                <th>FECHA ACTUALIZACION</th>               
            </tr>
        </thead>
        <tbody>';

            
$numeroExp = 1;

            foreach ($infoGridModificaciones as $valorGrid) {

                /* echo "<pre>";
            print_r($valorGrid); */

                $tabla .= "<tr>";
                $tabla .= "<td>".$valorGrid['id_registro_modificacion']."</td>";                
                $tabla .= "<td>".$valorGrid['usuario']."</td>";                
                $tabla .= "<td>".$valorGrid['tabla_actualizada']."</td>";                
                $tabla .= "<td>".$valorGrid['campo_actualizado']."</td>";
                $tabla .= "<td>".$valorGrid['valor_antiguo']."</td>"; 
                $tabla .= "<td>".$valorGrid['valor_nuevo']."</td>";
                $tabla .= "<td>".$valorGrid['fecha_hora_alta']."</td>";                               
                $tabla .= "</tr>";

                $numeroExp = $numeroExp + 1;
                
            }

        
            
      $tabla .=  '</tbody>
        <tfoot>

            <tr>
                <th>ID MODIFICACION</th>
                <th>USUARIO</th>               
                <th>TABLA</th>                
                <th>CAMPO ACTUALIZADO</th>
                <th>DATO ANTIGUO</th>
                <th>DATO NUEVO</th>
                <th>FECHA ACTUALIZACION</th>
            </tr>            
        </tfoot>
    </table>';

    echo $tabla;

    ?>

<!-- <form id='formFormato' name='formFormato' class="form-horizontal" method="post" target="_blank" action="<?php //echo base_url(); ?>index.php/Placasgrid/imprimeDetalle/">
    <div class="form-group">
                            <div class="col-md-12 text-center">

                                <input type="hidden" name="nombreModulo" id = 'nombreModulo' value = "<?php //echo $nombreModulo; ?>">

                                <input type="hidden" name="nombreRemesa" id = 'nombreRemesa' value = "<?php //echo $nombreRemesa; ?>">

                                <input type="hidden" name="numeroCaja" id = 'numeroCaja' value = "<?php //echo $numeroCaja; ?>">

                                <input type="hidden" name="tabla" id="tabla" value="<?php //echo base64_encode($tabla); ?>">

                                <button type="submit" class="btn btn-primary btn-lg">Imprimir</button>
                               

                            </div>
                        </div>
</form> -->