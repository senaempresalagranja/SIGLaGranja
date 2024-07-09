<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from especie");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_especie/js/jsListadoEspecie.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Especie">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>UNIDAD</th>
        <th>TIPO ESPECIE</th>
        <th>NOMBRE COMUN</th>
        <th>NOMBRE CIENTIFICO</th>
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
         $res=pg_query($con, "SELECT * FROM especie ORDER BY esptipespeci ASC");
            while($reg=pg_fetch_array($res))
            {
                $uniid= utf8_decode($reg [1]);
                $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$uniid'");
                while($reg1=pg_fetch_array($res1))
                {
                    $nomunidad=utf8_decode($reg1[2]);
                }
                $espid=$reg[0];
                $esptipespeci=$reg[2];
                $espnomcomun=$reg[3];
                $espnomcienti=$reg[4];
           echo '<tr>';
           echo '<td>'.mb_convert_encoding($espid, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nomunidad, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($esptipespeci, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($espnomcomun, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($espnomcienti, "UTF-8").'</td>'; 
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
