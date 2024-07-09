<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM canal");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_canal/js/jsListadoCanal.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Canal">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>NOMBRE</th>
      <th>CLASE</th>
      <th>USO</th>
      <th>TIPO</th>
      <th>PROFUNDIDAD</th>
      <th>U/M</th>
      <th>ANCHO</th>
      <th>U/M</th>
      <th>PENDIENTE</th>
      <th>U/M</th>
      <th>DISTANCIA</th>
      <th>U/M</th>
      <th>LATITUD/INI</th>
      <th>ORIENTACION</th>
      <th>LONGITUD/INI</th>
      <th>ORIENTACION</th>
      <th>LATITUD/FIN</th> 
      <th>ORIENTACION</th>
      <th>LONGITUD/FIN</th>         
      <th>ORIENTACION</th>     
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
    while($reg=  pg_fetch_array($listado))
    {
      $canunimedpro= utf8_decode($reg [7]);   
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedpro' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre4=$reg1[1];
      }
      $UnidadAncho=utf8_decode($reg[9]);  
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadAncho' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[1];
      }
      $UnidadPendiente=utf8_decode($reg[11]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadPendiente' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre2=$reg1[1];
      }
      $UnidadDistancia=utf8_decode($reg[13]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadDistancia' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre3=$reg1[1];
      }
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($reg[1], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[2], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[3], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[4], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[5], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[6], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre4, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[8], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[10], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre2, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[12], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nombre3, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[14], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[15], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[16], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[17], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[18], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[19], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[20], "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($reg[21], "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
