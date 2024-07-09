<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from plaga");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_plaga/js/jsListadoPlaga.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Plaga">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>NOMBRE COMUN</th>
        <th>NOMBRE CIENTIFICO</th>
        <th>ORIGEN</th>
        <th>LUGAR ORIGEN</th>
        <th>AGENTE CAUSAL</th>
        <th>TRATAMIENTO</th>
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
           echo '<td>'.$reg[1].'</td>';
           echo '<td>'.$reg[2].'</td>';
           echo '<td>'.$reg[3].'</td>';
           echo '<td>'.$reg[4].'</td>';
           echo '<td>'.$reg[5].'</td>';
           echo '<td>'.$reg[6].'</td>';
           echo '<td>'.$reg[7].'</td>';
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
