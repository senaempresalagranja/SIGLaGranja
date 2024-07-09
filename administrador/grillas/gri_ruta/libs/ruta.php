<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from ruta");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_ruta/js/jsListadoRuta.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Ruta">
  <thead>
    <tr>
        <th>CODIGO</strong></th>
        <th>NOMBRE</strong></th>
        <th>ESTADO</strong></th>
        <th>DISTANCIA</strong></th>
        <th>UND-MEDIDA</strong></th>
        <th>TIEMPO RECORRIDO</strong></th>
        <th>UND-MEDIDA</strong></th>
        <th>LATITUD INICIAL</strong></th>
        <th>ORIENTACION</strong></th>
        <th>LONGITUD INICIAL</strong></th>
        <th>ORIENTACION</strong></th>
        <th>LATITUD FINAL</strong></th>
        <th>ORIENTACION</strong></th>
        <th>LONGITUD FINAL</strong></th>
        <th>ORIENTACION</strong></th>
        <th>DESCRIPCION</strong></th>
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
    $res=pg_query($con, "SELECT * FROM ruta ORDER BY rutidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $rununimeddis= utf8_decode($reg [5]);
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimeddis' ");
          while($reg1=pg_fetch_array($res1))
          {
            $nombre=$reg1[1];
          }
      
          $rununimedtie=$reg[7];
          $con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedtie' ");
          while($reg1=pg_fetch_array($con2))
          {
            $nombre1=$reg1[2];
          }

        $rutidcodigo=$reg[1];
        $rutnombre=$reg[2];
        $rutestado=$reg[3];
        $rutdistancia=$reg[4];
        $ruttierecorr=$reg[6];
        $rutlatitudi=$reg[8];
        $rutorienlati=$reg[9];
        $rutlongitudi=$reg[10];
        $rutorienloni=$reg[11];
        $rutlatitudf=$reg[12];
        $rutorienlatf=$reg[13];
        $rutlongitudf=$reg[14];
        $rutorienlonf=$reg[15];
        $rutdescripci=$reg[16];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($rutidcodigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutnombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutestado, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutdistancia, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($ruttierecorr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutlatitudi, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutorienlati, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutlongitudi, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutorienloni, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutlatitudf, "UTF-8").'</td>'; 
      echo '<td>'.mb_convert_encoding($rutorienlatf, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutlongitudf, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutorienlonf, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rutdescripci, "UTF-8").'</td>';
      echo '</tr>';                     
   }
   ?>
   <tbody>
   </table>
