<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from redgas");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_redgas/js/jsListadoRedGas.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_RedGas">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>CONSTRUCCION</th>
      <th>TIPO MATERIAL</th>
      <th>CONEXIONES</th>
      <th>CONTADORES</th>
      <th>VALVULAS</th>
      <th>SOPORTES</th>
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
    $res=pg_query($con, "SELECT * FROM redgas ORDER BY rgaid ASC");
    while($reg=pg_fetch_array($res))
    {
      $rgaconstrucc= utf8_decode($reg [1]);   
      $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rgaconstrucc' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[3];
      }
            $rgaid=$reg[0];
            $rgatipmateri=$reg[2];
            $rganumvalvul=$reg[3];          
            $rganumconexi=$reg[4];
            $rganumcontad=$reg[5];
            $rganumsoport=$reg[6];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($rgaid, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($rgatipmateri, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($rganumconexi, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rganumcontad, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rganumvalvul, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($rganumsoport, "UTF-8").'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
