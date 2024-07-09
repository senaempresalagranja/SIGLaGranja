<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=pg_query($con, "SELECT * FROM estanque_especieacuatica");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_estanqueespacua/js/jsListadoEstanqueEspAcua.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_EstanqueEspAcua">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>ESTANQUE</th>
      <th>ESPECIE ACUATICA</th>
      <th>RESPONSABLE</th> 
      <th>FECHA SIEMBRA</th>  
      <th>FECHA COSECHA</th>  
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
    $res=pg_query($con, "SELECT * FROM estanque_especieacuatica ORDER BY eeapkcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $estanque= utf8_decode($reg [2]);
        $res1=pg_query($con, "SELECT * FROM estanque WHERE estid='$estanque' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun=utf8_decode($reg1[1]);
        }
        $especieacuatica= utf8_decode($reg [3]);
        $res1=pg_query($con, "SELECT * FROM especieacuatica WHERE eacid='$especieacuatica' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomcomun1=utf8_decode($reg1[3]);
        }
        $eeapkcodigo=$reg[1];
        $eearesponsab=$reg[4];
        $eeafecsiembr=$reg[5];
        $eeafeccosech=$reg[6];
        $eeadescripci=$reg[7];
      echo '<tr>';
      echo '<td>'.mb_convert_encoding($eeapkcodigo, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($nomcomun1, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($eearesponsab, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($eeafecsiembr, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($eeafeccosech, "UTF-8").'</td>';
      echo '<td>'.mb_convert_encoding($eeadescripci, "UTF-8").'</td>';
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
