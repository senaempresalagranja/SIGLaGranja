<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from redelectrica");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_redelectrica/js/jsListadoRedElec.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_RedElectrica">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>CONSTRUCCION</th>
      <th>LAMPARAS</th>
      <th>TOMAR TRIFASICO</th>
      <th>TOMA NO REGULADO</th>
      <th>TOMA REGULADO</th>
      <th>INTERRUPTORES</th>
      <th>TIPO VENTILACION</th>
      <th>CANTIDAD</th>
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
    $res=pg_query($con, "SELECT * FROM redelectrica ORDER BY eleid ASC");
while($reg=pg_fetch_array($res))
{
  $eleconstrucc= utf8_decode($reg [1]);   
  $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$eleconstrucc' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre=$reg1[3];
  }
            $eleid=$reg[0];
            $elenumlampar=$reg[2];
            $elenumtomaco=$reg[3];          
            $elenuminterr=$reg[4];
            $eletipventil=$reg[5];
            $elecantidad=$reg[6];
            $tomar=$reg[8];
            $tomanr=$reg[9];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($eleid, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($elenumlampar, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($elenumtomaco, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($tomar, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($tomanr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($elenuminterr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($eletipventil, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($elecantidad, "UTF-8").'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
