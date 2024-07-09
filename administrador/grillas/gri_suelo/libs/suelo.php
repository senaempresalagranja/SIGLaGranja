<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from suelo");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_suelo/js/jsListadoSuelo.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Suelo">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>HUMEDAD </th>
        <th>UND-MEDIDA</th>
        <th>TEXTURA</th>
        <th>POROCIDAD</th>
        <th>UND-MEDIDA</th>
        <th>CONSISTENCIA</th>
        <th>UND-MEDIDA</th>
        <th>COLOR</th>
        <th>CONDUCTIVIDAD ELECTRICA</th>
        <th>UND-MEDIDA</th>
        <th>NITROGENO</th>
        <th>UND-MEDIDA</th>
        <th>FOSFORO</th>
        <th>UND-MEDIDA</th>
        <th>POTACIO</th>
        <th>UND-MEDIDA</th>
        <th>ELEMENTOS MENORES</th>
        <th>ELEMENTOS INTERCAMBIO</th>
        <th>PH</th>
        <th>UND-MEDIDA</th>
        <th>ACTIVIDAD MICROBIANA</th>
        <th>UND-MEDIDA</th>
        <th>MASA MICROBIANA</th>
        <th>UND-MEDIDA</th>
        <th>MATERIA ORGANICA</th>
        <th>UND-MEDIDA</th>
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
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM suelo ORDER BY sueid ASC");
while($reg=pg_fetch_array($res))
{
  $sueunimedhu= utf8_decode($reg [2]);    
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedhu' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre=$reg1[1];
  }
  $sueunimedpo=utf8_decode($reg[5]);  
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpo' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre1=$reg1[1];
  }
  $sueunimedco=utf8_decode($reg[7]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedco' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre2=$reg1[1];
  }
  $sueunimedel=utf8_decode($reg[10]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedel' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre3=$reg1[1];
  }
  $sueunimedni=utf8_decode($reg[12]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedni' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre4=$reg1[1];
  }
  $sueunimedfo=utf8_decode($reg[14]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedfo' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre5=$reg1[1];
  }
  $sueunimedpt=utf8_decode($reg[16]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpt' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre6=$reg1[1];
  }
  $sueunimedph=utf8_decode($reg[20]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedph' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre7=$reg1[1];
  }
  $sueunimedma=utf8_decode($reg[22]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedma' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre8=$reg1[1];
  }
  $sueunimedam=utf8_decode($reg[24]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedam' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre9=$reg1[1];
  }
  $sueunimedmm=utf8_decode($reg[26]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedmm' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre10=$reg1[1];
  }

  $sueid= $reg[0];
  $suefhumedad= $reg[1];
  $sueftextura= $reg[3];
  $suefporocida= $reg[4];
  $suefconsiste= $reg[6];
  $suefcolorter= $reg[8];
  $suefcondelet= $reg[9];
  $sueqnitrogen= $reg[11];
  $sueqfosforo= $reg[13];
  $sueqpotacio= $reg[15];
  $sueqelemmeno= $reg[17];
  $sueqeleminte= $reg[18];
  $sueqph= $reg[19];
  $suebmateorga= $reg[21];
  $suebactimicr= $reg[23];
  $suebmasmicro= $reg[25];
           echo '<tr>';
           echo '<td>'.mb_convert_encoding($sueid, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suefhumedad, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueftextura, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suefporocida, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suefconsiste, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre2, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suefcolorter, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suefcondelet, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre3, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqnitrogen, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre4, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqfosforo, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre5, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqpotacio, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre6, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqelemmeno, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqeleminte, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($sueqph, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre7, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suebactimicr, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre9, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suebmasmicro, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre10, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($suebmateorga, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nombre8, "UTF-8").'</td>'; 
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
