<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM ruta_unidad");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_rutaunidad/js/jsListadoRutaUnidad.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_RutaUnidad">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>RUTA</th>
      <th>UNIDAD</th>
      <th>DISTANCIA</th>
      <th>UND-MEDIDA</th> 
      <th>TIEMPO RECORRIDO</th> 
      <th>UND-MEDIDA</th> 
      <th>TIPO RUTA</th>    
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
    $res=pg_query($con, "SELECT * FROM ruta_unidad ORDER BY runkidcodigo ASC");
    while($reg=pg_fetch_array($res))
    {
      $runruta= utf8_decode($reg [3]);
      $res1=pg_query($con, "SELECT * FROM ruta WHERE rutid='$runruta' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[2];
      }
      $unidad= utf8_decode($reg [2]);
      $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }

      $unidad_medida= utf8_decode($reg [5]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre2=$reg1[1];
      }

      $unidad_medida1= utf8_decode($reg [7]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida1' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre3=$reg1[2];
      }
      $runkidcodigo=$reg[1];
      $rundistancia=$reg[4];
      $runtierecorr=$reg[6];
      $runtipruta=$reg[8];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($runkidcodigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rundistancia, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre2, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($runtierecorr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre3, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($runtipruta, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
