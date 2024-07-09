<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from enfermedad");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_enfermedad/js/jsListadoEnfermedad.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Enfermedad">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>NOMBRE COMUN</th>
        <th>NOMBRE CIENTIFICO</th>
        <th>AGENTE CAUSAL</th>
        <th>MORTALIDAD</th>
        <th>SINTOMAS</th>
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
           echo '<td>'.mb_convert_encoding($reg[0], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[1], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[2], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[3], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[4], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[5], "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($reg[6], "UTF-8").'</td>';
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
