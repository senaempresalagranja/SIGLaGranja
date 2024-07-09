<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from plagaenfermedad");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_plagaenfermedad/js/jsListadoPlagaEnfermedad.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_PlagaEnfermedad">
    <thead>
      <tr>                   
                        <th>CODIGO</th>
                         <th>DAÑO</th><!--Estado-->
                         <th>AGENTE CAUSAL</th>
                        <th>NOM/COMUN</th>
                         <th>NOM/CIENTI</th><!--Estado-->
                        <th>TIPO MANEJO</th>
                         <th colspan="5">ZONA AFECTADA (FRUTA, TALLO, FLOR, RAIZ, HOJA)</th>
                        <th>DESCRIPCION</th>                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

     
                   while($reg=  pg_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td>'.$reg[0].'</td>';
                               echo '<td>'.$reg[1].'</td>';
                               echo '<td>'.$reg[4].'</td>';
                               echo '<td>'.$reg[2].'</td>';
                               echo '<td>'.$reg[3].'</td>';
                               echo '<td>'.$reg[5].'</td>';
                               echo '<td>'.$reg[6].'</td>';
                               echo '<td>'.$reg[7].'</td>';
                               echo '<td>'.$reg[8].'</td>';
                               echo '<td>'.$reg[9].'</td>';
                               echo '<td>'.$reg[10].'</td>';
                               echo '<td>'.$reg[11].'</td>';             
                               echo '</tr>';                    
                        }
                    ?>
                <tbody>
            </table>
