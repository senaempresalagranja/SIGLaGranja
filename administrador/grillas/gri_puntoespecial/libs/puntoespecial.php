<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM puntoespecial");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_puntoespecial/js/jsListadoPuntoEspecial.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_PuntoEspecial">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>NOMBRE </th>
      <th>UNIDAD</th>
      <th>TIPO PUNTO</th>      
      <th>LATITUD</th>
      <th>ORIENTACION</th>
      <th>LONGITUD</th>
      <th>ORIENTACION</th>
      <th>DESCRIPCION</th>     
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
    $res=pg_query($con, "SELECT * FROM puntoespecial ORDER BY pesid ASC");
while($reg=pg_fetch_array($res))
{
  $pesunidad= utf8_decode($reg [1]);    
  $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$pesunidad' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre=$reg1[2];
  }
  
            $pesid=$reg[0];
            $pesnombre=$reg[2];
            $pestippunto=$reg[3];
            $peslatitud=$reg[4];
            $pesorientlat=$reg[5];            
            $peslongitud=$reg[6];
            $pesorientlog=$reg[7];
            $pesdescripci=$reg[8];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($pesid, "UTF-8").'</td>';
      echo '<td>'.$pesnombre.'</td>';
      echo '<td>'.$nombre.'</td>';
      echo '<td>'.mb_convert_encoding($pestippunto, "UTF-8").'</td>';      
      echo '<td>'.mb_convert_encoding($peslatitud, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($pesorientlat, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($peslongitud, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($pesorientlog, "UTF-8").'</td>';
      echo '<td>'.$pesdescripci.'</td>';      
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
