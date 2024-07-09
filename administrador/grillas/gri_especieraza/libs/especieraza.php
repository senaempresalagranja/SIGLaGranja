<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM especie_raza");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_especieraza/js/jsListadoEspecieRaza.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_EspecieRaza">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>ESPECIE</th>
      <th>RAZA</th>
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
    $res=pg_query($con, "SELECT * FROM especie_raza ORDER BY erakidcodigo ASC");
    while($reg=pg_fetch_array($res))
    {
      $eraespecie= utf8_decode($reg [2]);
      $res1=pg_query($con, "SELECT * FROM especie WHERE espid='$eraespecie' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nomcomun=utf8_decode($reg1[3]);
      }
      $raza= utf8_decode($reg [3]);
      $res1=pg_query($con, "SELECT * FROM raza WHERE razid='$raza' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nomcomun1=utf8_decode($reg1[1]);
      }
      $codigo=$reg[1];
      $descripcion=$reg[4];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($codigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($descripcion, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
