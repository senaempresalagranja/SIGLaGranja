<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM unidad_medida");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_unidadmedida/js/jsListadoUnidadMedida.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_UnidadMedida">
  <thead>
    <tr>
      <th><strong>MAGNITUD</strong></th>
      <th><strong>CODIGO</strong></th>
      <th><strong>NOMBRE</strong></th>
      <th><strong>SIMBOLO</strong></th>   
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
  $res=pg_query($con, "SELECT * FROM unidad_medida order by umetipunimed");
while($reg=pg_fetch_array($res))
{
  $umeid=$reg[0];
  $umerepreset=$reg[1];
  $umenombre=$reg[2];
  $umetipunimed=$reg[4];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($umetipunimed, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($umeid, "UTF-8").'</td>';
      echo '<td>'.$umenombre.'</td>';
      echo '<td>'.$umerepreset.'</td>';     
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
