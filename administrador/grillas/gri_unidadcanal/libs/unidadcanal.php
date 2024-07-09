<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM unidad_canal");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_unidadcanal/js/jsListadoUnidadCanal.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_UnidadCanal">
  <thead>
    <tr>
      <th>CODIGO</strong></th>
      <th>UNIDAD</strong></th>
      <th>CANAL</strong></th>
      <th>DISTANCIA</strong></th>
      <th>UND-MEDIDA</strong></th>
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
    $res=pg_query($con, "SELECT * FROM unidad_canal ORDER BY cunkidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $cununidad= utf8_decode($reg [2]);
        $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$cununidad' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nombre=$reg1[2];
        }

        $canal= utf8_decode($reg [3]);
        $res1=pg_query($con, "SELECT * FROM canal WHERE canid='$canal' ");
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

        $codigo=$reg[1];
        $distancia=$reg[4];
        $descripcion=$reg[6];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($codigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($distancia, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre2, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($descripcion, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
