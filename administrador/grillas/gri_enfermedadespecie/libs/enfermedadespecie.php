<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM enfermedad_especie");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_enfermedadespecie/js/jsListadoEnfermedadEspecie.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_EnfermedadEspecie">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>ENFERMEDAD</th>
      <th>ESPECIE</th>
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
      $enfermedad= utf8_decode($reg [2]);
        $res1=pg_query($con, "SELECT * FROM enfermedad WHERE enfid='$enfermedad' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun=utf8_decode($reg1[1]);
        }
        $especie= utf8_decode($reg [3]);
        $res1=pg_query($con, "SELECT * FROM especie WHERE espid='$especie' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun1=utf8_decode($reg1[3]);
        }
        $codigo=$reg[1];
        $descripcion=$reg[4];
      echo '<tr>';
      echo '<td>'.$codigo.'</td>';
      echo '<td>'.$nomcomun.'</td>';
      echo '<td>'.$nomcomun1.'</td>';
      echo '<td>'.$descripcion.'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
