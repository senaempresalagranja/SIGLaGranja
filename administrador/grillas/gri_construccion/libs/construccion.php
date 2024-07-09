<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from construccion");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_construccion/js/jsListadoConstruccion.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Construccion">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>UNIDAD</th>
      <th>NOMBRE</th>
      <th>EXTENSION</th>
      <th>UNIDAD MEDIDA</th>
      <th>TIPO AMBIENTE</th>
      <th>TIPO CONSTRUCCION</th>
      <th>ESTADO</th>
      <th>TIPO CUBIERTA</th>
      <th>TIPO PISO</th>
      <th>TIPO MURO</th>
      <th>FECHA CONSTRUCCION</th>
      <th>FECHA REMODELACION</th>
      <th>LATITUD</th>
      <th>ORIENTACION</th>
      <th>LONGITUD</th>
      <th>ORIENTACION</th>
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
      $unidadmedida= utf8_decode($reg [5]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[1];
      }

      $unidad=$reg[2];
      $con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
      while($reg1=pg_fetch_array($con2))
      {
        $NomUnidad=$reg1[2];
      }
      echo '<tr>';
      echo '<td>'.$reg[1].'</td>';
      echo '<td>'.$NomUnidad.'</td>';
      echo '<td>'.$reg[3].'</td>';
      echo '<td>'.$reg[4].'</td>';
      echo '<td>'.$nombre.'</td>';
      echo '<td>'.$reg[6].'</td>';
      echo '<td>'.$reg[7].'</td>';
      echo '<td>'.$reg[8].'</td>';
      echo '<td>'.$reg[9].'</td>';
      echo '<td>'.$reg[10].'</td>'; 
      echo '<td>'.$reg[11].'</td>';
      echo '<td>'.$reg[12].'</td>';
      echo '<td>'.$reg[13].'</td>';
      echo '<td>'.$reg[14].'</td>';
      echo '<td>'.$reg[15].'</td>';
      echo '<td>'.$reg[16].'</td>';
      echo '<td>'.$reg[17].'</td>';
      echo '</tr>';                     
   }
   ?>
   <tbody>
   </table>
