<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM plagaenferme_cultivo");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_plagaenfermecultivo/js/jsListadoPlaEnfCultivo.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_PlaEnfCultivo">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>PLAGA/ENFERMEDAD</th>
      <th>CULTIVO</th>
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
      $plagaenfer= $reg [2];
        $res1=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$plagaenfer' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun=$reg1[2];
        }
        $cultivo= $reg [3];
        $res2=pg_query($con, "SELECT * FROM cultivo WHERE culid='$cultivo' ");
        while($reg2=pg_fetch_array($res2))
        {
          $nomcomun1=$reg2[2];
        }
        $codigo=$reg[1];
        $descripcion=$reg[4];
      echo '<tr>';
      echo '<td>'.$reg[1].'</td>';
      echo '<td>'.$nomcomun.'</td>';
      echo '<td>'.$nomcomun1.'</td>';
      echo '<td>'.$reg[4].'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
