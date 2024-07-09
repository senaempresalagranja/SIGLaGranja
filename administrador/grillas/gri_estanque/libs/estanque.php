<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from estanque");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_estanque/js/jsListadoEstanque.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Estanque">
  <thead>
    <tr>
      <th>NOMBRE</th>
      <th>CODIGO</th>      
      <th>TIPO</th>
      <th>PROFUNDIDAD</th>
      <th>UND-MEDIDA</th>
      <th>ESPEJO AGUA</th>
      <th>UND-MEDIDA</th>
      <th>VOLUMEN AGUA</th>
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
    $res=pg_query($con, "SELECT * FROM estanque ORDER BY estnombre ASC");
    while($reg=pg_fetch_array($res))
    {
      $estunimedpro= utf8_decode($reg [4]);   
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[1];
      }
      $estunimedesp=utf8_decode($reg[6]); 
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[1];
      }
      $estunimedvol=utf8_decode($reg[8]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre2=$reg1[1];
      }
      $estid=$reg[0];
      $estnombre=$reg[1];
      $esttipestanq=$reg[2];
      $estprofundid=$reg[3];          
      $estespejagua=$reg[5];
      $estvolumagua=$reg[7];
      echo '<tr>';
      echo '<td>'.$estnombre.'</td>';
      echo '<td>'.$estid.'</td>';      
      echo '<td>'.$esttipestanq.'</td>';
      echo '<td>'.$estprofundid.'</td>';
      echo '<td>'.$nombre.'</td>';
      echo '<td>'.$estespejagua.'</td>';
      echo '<td>'.$nombre1.'</td>';
      echo '<td>'.$estvolumagua.'</td>';
      echo '<td>'.$nombre2.'</td>';
      echo '</tr>';                     
    }
    ?>
    <tbody>
    </table>
