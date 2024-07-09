<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from redlogica");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_redlogica/js/jsListadoRedLogica.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_RedLogica">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>CONSTRUCCION</th>
      <th>ZONA WIFI</th>
      <th>ACCES POINT</th>
      <th>RED ALAMBRICA</th>
      <th>LONGITUD CANALETAS</th>
      <th>UND-MEDIDA</th>
      <th>RJ-45</th>
      <th>FRIBRA OPTICA</th>
      <th>CABLE UTP</th>
      <th>TOPOLOGIA</th>
      <th>DISTRIBUCION</th>
      <th>RACK</th>
      <th>SWITCH</th>
      <th>REGLETAS</th>
      <th>UPS</th>
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
    $res=pg_query($con, "SELECT * FROM redlogica ORDER BY rloid ASC");
    while($reg=pg_fetch_array($res))
    {
      $rsaconstrucc= utf8_decode($reg [1]);   
      $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[3];
      }

      $rlounimedcca= utf8_decode($reg [6]);   
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rlounimedcca' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }
                $rloid=$reg[0];
                $rlozonawifi=$reg[2];
                $rlocantacces=$reg[3];         
                $rloredalambr=$reg[4];
                $rlocantanale=$reg[5];
                $rlocantrj=$reg[7];
                $rlocantfibop=$reg[8];
                $rlocategoutp=$reg[9];
                $rlotopologia=$reg[10];
                $rlodistribuc=$reg[11];
                $rlorack=$reg[12];
                $rlocantswitc=$reg[13];
                $rlocantregle=$reg[14];
                $rlocantups=$reg[15];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($rloid, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($rlozonawifi, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantacces, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rloredalambr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantanale, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantrj, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantfibop, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocategoutp, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlotopologia, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlodistribuc, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlorack, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantswitc, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantregle, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rlocantups, "UTF-8").'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
