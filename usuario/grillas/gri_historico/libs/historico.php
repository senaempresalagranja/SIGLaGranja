<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from regact_lotcultivo");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_historico/js/jsListadoHistorico.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Historico">
  <thead>
    <tr>
      <th>USUARIO</th>
      <th>ACTIVIDAD</th>
      <th>LOTE</th>
      <th>CULTIVO</th>
      <th>UNIDAD</th>
      <th>CANAL</th>
      <th>PLAGA/ENFERMEDAD</th>
      <th>FECHA SIEMBRA</th>
      <th>FECHA COSECHA</th>
      <th>PRODUCCION ESTIMADA</th>
      <th>UND-MEDIDA</th>
      <th>PRODUCCION REAL</th>
      <th>UND-MEDIDA</th>
      <th>COSTO PRODUCCION ESTIMADA</th>
      <th>UND-MEDIDA</th>
      <th>COSTO PRODUCCION REAL</th>
      <th>UND-MEDIDA</th>
      <th>RESPONSABLE</th>
      <th>FECHA MOVIMIENTO</th>
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
    $res=pg_query($con, "SELECT * FROM regact_lotcultivo ORDER BY raclcuid ASC");
    while($reg=pg_fetch_array($res))
    {
      $raclcuusua=$reg[1];
      $con1=pg_query($con, "SELECT * FROM usuario WHERE usuid='$raclcuusua' ");
      while($reg1=pg_fetch_array($con1))
      {
        $nombre=utf8_decode($reg1[8]);
      }

      $raclculote=$reg[3];
      $con1=pg_query($con, "SELECT * FROM lote WHERE lotid='$raclculote' ");
      while($reg1=pg_fetch_array($con1))
      {
        $nombre1=$reg1[1];
      }

      $raclcucult=$reg[4];
      $con2=pg_query($con, "SELECT * FROM cultivo WHERE culid='$raclcucult' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre2=$reg1[2];
      }

      $raclcuunid=$reg[5];
      $con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$raclcuunid' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre3=$reg1[2];
      }

      $raclcuunie=$reg[9];
      $con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$raclcuunie' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre4=$reg1[1];
      }

      $raclcuunir=$reg[11];
      $con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$raclcuunir' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre5=$reg1[1];
      }

      $raclcuuncr=$reg[13];
      $con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$raclcuuncr' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre6=$reg1[1];
      }

      $raclcuunce=$reg[15];
      $con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$raclcuunce' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre7=$reg1[1];
      }

      $raclcucana=$reg[17];
      $con2=pg_query($con, "SELECT * FROM canal WHERE canid='$raclcucana' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre8=$reg1[2];
      }

      $raclcupenf=$reg[18];
      $con2=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$raclcupenf' ");
      while($reg1=pg_fetch_array($con2))
      {
        $nombre9=$reg1[2];
      }

      $raclcuacti=$reg[2];
      $raclcufesi=$reg[6];
      $raclcufeco=$reg[7];
      $raclcupest=$reg[8];
      $raclcuprea=$reg[10];
      $raclcucosr=$reg[12];
      $raclcucose=$reg[14];
      $raclcuresp=$reg[16];
      $raclcufecha=$reg[19];

      echo '<tr>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcuacti, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre2, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre3, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre8, "UTF-8").'</td>'; 
      echo '<td>'.mb_convert_encoding($nombre9, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcufesi, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcufeco, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcupest, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre4, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcuprea, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre5, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcucosr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre6, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcucose, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre7, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($raclcuresp, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($raclcufecha, "UTF-8").'</td>';            
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
