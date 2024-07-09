<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from poste");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_poste/js/jsListadoPoste.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Poste">
  <thead>
    <tr>
        <th>CODIGO</th>
        <th>UNIDAD</th>
        <th>TIPO MATERIAL</th>
        <th>ESTADO</th>
        <th>ALTURA</th>
        <th>UND-MEDIDA</th>
        <th>TIPO TENSION</th>
        <th>ILUMINACION</th>
        <th>ESTADO ILUMINACION</th>
        <th>TRANSFORMADOR</th>
        <th>ESTADO TRANSFORMADOR</th>
        <th>RUTA</th>
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
    $res=pg_query($con, "SELECT * FROM poste ORDER BY posidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $unidadmedida= utf8_decode($reg [6]);
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

          $ruta=$reg[12];
          $con2=pg_query($con, "SELECT * FROM ruta WHERE rutid='$ruta' ");
          while($reg1=pg_fetch_array($con2))
          {
            $NomRuta=$reg1[2];
          }
          $posidcodigo=$reg[1];
          $postipmateri=$reg[3];
          $posestado=$reg[4];
          $posaltura=$reg[5];
          $postiptensio=$reg[7];
          $posalumbrado=$reg[8];
          $posestalumbr=$reg[9];
          $postransform=$reg[10];
          $posesttransf=$reg[11];
          $poslatitud=$reg[13];
          $posorientlat=$reg[14];
          $poslongitud=$reg[15];
          $posorientlon=$reg[16];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($posidcodigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($NomUnidad, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($postipmateri, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posestado, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posaltura, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($postiptensio, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posalumbrado, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posestalumbr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($postransform, "UTF-8").'</td>'; 
      echo '<td>'.mb_convert_encoding($posesttransf, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($NomRuta, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($poslatitud, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posorientlat, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($poslongitud, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($posorientlon, "UTF-8").'</td>'; 
      echo '</tr>';                     
   }
   ?>
   <tbody>
   </table>
