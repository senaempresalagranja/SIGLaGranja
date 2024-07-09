<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM plaga_especie");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_plagaespecie/js/jsListadoPlagaEspecie.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_PlagaEspecie">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>ESPECIE</th>
      <th>PLAGA</th>
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
    $res=pg_query($con, "SELECT * FROM plaga_especie ORDER BY peskidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $especie= utf8_decode($reg [2]);
        $res1=pg_query($con, "SELECT * FROM especie WHERE espid='$especie' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun=$reg1[3];
        }
        $plaga= utf8_decode($reg [3]);
        $res1=pg_query($con, "SELECT * FROM plaga WHERE plaid='$plaga' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun1=$reg1[2];
        }
        $codigo=$reg[1];
        $pesdescripci=$reg[4];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($codigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($pesdescripci, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
