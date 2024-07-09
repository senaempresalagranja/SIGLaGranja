<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from raza");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_raza/js/jsListadoRaza.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Raza">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>NOMBRE</th>
      <th>ORIGEN</th>
      <th>LUGAR ORIGEN</th>
      <th>PROPOSITO</th>
      <th>PRODUCCION</th>
      <th>UND-MEDIDA</th>
      <th>FENOTIPO</th>
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
    $res=pg_query($con, "SELECT * FROM raza ORDER BY raznombre ASC");
while($reg=pg_fetch_array($res))
{
    $razunimedpro= utf8_decode($reg [6]);       
    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro' ");
    while($reg1=pg_fetch_array($res1))
    {
        $nombre=$reg1[1];
    }
                        $razid=$reg[0];
                        $raznombre=$reg[1];
                        $razorigen=$reg[2];
                        $razlugorigen=$reg[3];                  
                        $razproposito=$reg[4];
                        $razproducion=$reg[5];
                        $razcarfenoti=$reg[7];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($razid, "UTF-8").'</td>';
      echo '<td>'.$raznombre.'</td>';      
      echo '<td>'.mb_convert_encoding($razorigen, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($razlugorigen, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($razproposito, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($razproducion, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
      echo '<td>'.$razcarfenoti.'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
