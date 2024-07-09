<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from redsanitaria");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_redsanitaria/js/jsListadoRedSani.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_RedSani">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>CONSTRUCCION</th>
      <th>BATERIAS SANITARIAS</th>
      <th>DUCHAS</th>
      <th>LAVAMANOS</th>
      <th>GRIFOS</th>
      <th>SIFONES</th>
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
    $res=pg_query($con, "SELECT * FROM redsanitaria ORDER BY rsaid ASC");
    while($reg=pg_fetch_array($res))
    {
      $rsaconstrucc= utf8_decode($reg [1]);   
      $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[3];
      }
                $rsaid=$reg[0];
                $rsannumbater=$reg[2];
                $rsanumducha=$reg[3];         
                $rsanumlavama=$reg[4];
                $sannumgrifos=$reg[5];
                $sannumsifon=$reg[6];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($rsaid, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($rsannumbater, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rsanumducha, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rsanumlavama, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($sannumgrifos, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($sannumsifon, "UTF-8").'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
