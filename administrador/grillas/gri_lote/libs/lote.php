<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM lote");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_lote/js/jsListadoLote.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Lote">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>SUELO</th>
      <th>EXTENSION</th>
      <th>UND-MEDIDA</th>
      <th>LATITUD</th>
      <th>ORIENTACION</th>
      <th>LONGITUD</th>
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
    $res=pg_query($con, "SELECT * FROM lote ORDER BY lotidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $lotsuelo= $reg [2];
        $res1=pg_query($con, "SELECT * FROM suelo WHERE sueid='$lotsuelo' ");
        while($reg1=pg_fetch_array($res1))
        {
          $sueftextura=$reg1[3];
        }
        $lotunimedlot= $reg [4];
        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lotunimedlot' ");
        while($reg1=pg_fetch_array($res1))
        {
          $umerepreset=$reg1[1];
        }
        $lotidcodigo=$reg[1];
        $lotextension=$reg[3];
        $lotlatitud=$reg[5];
        $lotorientlat=$reg[6];
        $lotlongitud=$reg[7];
        $lotorientlon=$reg[8];
      echo '<tr>';
      echo '<td>'.$lotidcodigo.'</td>';
      echo '<td>'.$sueftextura.'</td>';
      echo '<td>'.$lotextension.'</td>';
      echo '<td>'.$umerepreset.'</td>';
      echo '<td>'.$lotlatitud.'</td>';
      echo '<td>'.$lotorientlat.'</td>';
      echo '<td>'.$lotlongitud.'</td>';
      echo '<td>'.$lotorientlon.'</td>';
      echo '</tr>';
    }
    ?>
    <tbody>
    </table>
