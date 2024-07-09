<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from vegetal");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_vegetal/js/jsListadoVegetal.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Vegetal">
    <thead>
      <tr>
        <th>CODIGO</strong></th>
        <th>NOMBRE COMUN</strong></th>
        <th>NOMBRE CIENTIFICO</strong></th>
        <th>ORIGEN</strong></th>
        <th>LUGAR ORIGEN</strong></th>
        <th>TIPO</strong></th>        
        <th>CLIMA</strong></th>
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
         $res=pg_query($con, "SELECT * FROM vegetal ORDER BY vegid ASC");
      while($reg=pg_fetch_array($res))
      {
        $vegid=$reg[0];
        $vegnomcomun=$reg[1];
        $vegnomcienti=$reg[2];
        $vegorigen=$reg[3];
        $veglugorigen=$reg[4];
        $vegclima=$reg[5];
        $vegtipo=$reg[6];
        $vegdescripci=$reg[7];

           echo '<tr>';
           echo '<td>'.mb_convert_encoding($vegid, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($vegnomcomun, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($vegnomcienti, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($vegorigen, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($veglugorigen, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($vegtipo, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($vegclima, "UTF-8").'</td>';
           echo '<td>'.$vegdescripci.'</td>';
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
