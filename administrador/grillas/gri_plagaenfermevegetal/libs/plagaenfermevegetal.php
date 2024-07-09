<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM plagaenferme_vegetal");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_plagaenfermevegetal/js/jsListadoPlaEnfVegetal.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_PlaEnfVegetal">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>VEGETAL</th>
      <th>PLAGA/ENFERMEDAD</th>
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
    while($reg=  pg_fetch_array($listado))
    {
      $plagaenfer= utf8_decode($reg [2]);
        $res1=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$plagaenfer' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun=$reg1[2];
        }
        $vegetal= utf8_decode($reg [3]);
        $res1=pg_query($con, "SELECT * FROM vegetal WHERE vegid='$vegetal' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun1=$reg1[1];
        }
        $codigo=$reg[1];
        $descripcion=$reg[4];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($codigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($descripcion, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
