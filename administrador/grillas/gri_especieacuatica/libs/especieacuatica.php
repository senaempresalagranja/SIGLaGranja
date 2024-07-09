<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from especieacuatica");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_especieacuatica/js/jsListadoEspecieAcuatica.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_EspecieAcuatica">
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
         $res=pg_query($con, "SELECT * FROM especieacuatica ORDER BY eactipespeci ASC");
            while($reg=pg_fetch_array($res))
            {
                $uniid= utf8_decode($reg [1]);
                $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$uniid'");
                while($reg1=pg_fetch_array($res1))
                {
                    $nomunidad=utf8_decode($reg1[2]);
                }
                $eacid=$reg[0];
                $eactipespeci=$reg[2];
                $eacnomcomun=$reg[3];
                $eacnomcienti=$reg[4];
           echo '<tr>';
           echo '<td>'.mb_convert_encoding($eacid, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nomunidad, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($eactipespeci, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($eacnomcomun, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($eacnomcienti, "UTF-8").'</td>'; 
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
