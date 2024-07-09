<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM zonaverde_vegetal");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_zonaverdevegetal/js/jsListadoZonaverdeVegetal.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_ZonaverdeVegetal">
  <thead>
    <tr>
      <th>CODIGO</strong></th>
      <th>ZONA VERDE</strong></th>
      <th>VEGETAL</strong></th>
      <th>DESCRIPCION</strong></th>  
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
    $res=pg_query($con, "SELECT * FROM zonaverde_vegetal ORDER BY zovkidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $ZonaVerde= $reg [2];
        $res1=pg_query($con, "SELECT * FROM zonaverde WHERE zveid='$ZonaVerde' ");
        while($reg1=pg_fetch_array($res1))
        {
          $zveidcodigo=$reg1[1];
        }
        $vegetal= $reg [3];
        $res1=pg_query($con, "SELECT * FROM vegetal WHERE vegid='$vegetal' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun1=$reg1[1];
        }
        $codigo=$reg[1];
        $descripcion=$reg[4];
      echo '<tr>';
      echo '<td>'.$codigo.'</td>';
      echo '<td>'.$zveidcodigo.'</td>';
      echo '<td>'.$nomcomun1.'</td>';
      echo '<td>'.$descripcion.'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
