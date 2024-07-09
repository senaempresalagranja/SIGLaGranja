<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT area.areidcodigo, area.arenombre,area.areextension,unidad_medida.umerepreset,area.arecoordinad,area.arelatitud,area.areorientlat,area.arelongitud,area.areorientlon,area.aredescripci,area.arefecha 
 from area   INNER JOIN unidad_medida  ON unidad_medida.umeid = area.areunimedida");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_area/js/jsListadoArea.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Area">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>EXTENSION</th>
        <th>UNIDAD MEDIDA</th>
        <th>RESPONSABLE</th>
        <th>LATITUD</th>
        <th>ORIENTACION</th>
        <th>LONGITUD</th>
        <th>ORIENTACION</th>
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
           echo '<td>'.$reg[2].'</td>';
           echo '<td>'.$reg[3].'</td>';
           echo '<td>'.$reg[4].'</td>';
           echo '<td>'.$reg[5].'</td>';
           echo '<td>'.$reg[6].'</td>';
           echo '<td>'.$reg[7].'</td>';
           echo '<td>'.$reg[8].'</td>';
           echo '<td>'.$reg[9].'</td>'; 
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
