<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='(()()())' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");
$listado=  pg_query($con,"SELECT * from clima");
  ?>

  <script type="text/javascript" language="javascript" src="grillas/gri_clima/js/jsListadoClima.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Clima">
    <thead>
      <tr>
        <th>CODIGO</th>
        <th>HORA</th>
        <th>FECHA</th>
        <th>RAD_SOLAR</th>
        <th>MEDIDA</th><!--Estado-->
        <th>TEMP_AIRE</th><!--Estado-->
        <th>MEDIDA</th><!--Estado--> 
        <th>HUM_RELATIVA</th>
        <th>MEDIDA</th>
        <th>PRECIPITACION</th>
        <th>MEDIDA</th>
        <th>VEL_VIENTO</th> 
        <th>MEDIDA</th>
        <th>DIR_VIENTO</th>
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
          $CliRadSol= $reg[4];
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$CliRadSol' ");
          while($reg1=pg_fetch_array($res1))
          {
            $representacion1=$reg1[1];
          }
          $CliTempAir= $reg[6];
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$CliTempAir' ");
          while($reg1=pg_fetch_array($res1))
          {
            $representacion2=$reg1[1];
          }
          $CliHumRel= $reg[8];
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$CliHumRel' ");
          while($reg1=pg_fetch_array($res1))
          {
            $representacion3=$reg1[1];
          }
          $CliPrecipita= $reg[10];
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$CliPrecipita' ");
          while($reg1=pg_fetch_array($res1))
          {
            $representacion4=$reg1[1];
          }
          $CliVelViento= $reg[12];
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$CliVelViento' ");
          while($reg1=pg_fetch_array($res1))
          {
            $representacion5=$reg1[1];
          }
         echo '<tr>';
         echo '<td>'.$reg[0].'</td>';
         echo '<td>'.$reg[1].'</td>';
         echo '<td>'.$reg[2].'</td>';
         echo '<td>'.$reg[3].'</td>';
         echo '<td>'.$representacion1.'</td>';
         echo '<td>'.$reg[5].'</td>';
         echo '<td>'.$representacion2.'</td>';
         echo '<td>'.$reg[7].'</td>';
         echo '<td>'.$representacion3.'</td>';
         echo '<td>'.$reg[9].'</td>';
         echo '<td>'.$representacion4.'</td>';
         echo '<td>'.$reg[11].'</td>';
         echo '<td>'.$representacion5.'</td>';
         echo '<td>'.$reg[13].'</td>';
         echo '</tr>';
       }
       ?>
       <tbody>
       </table>
