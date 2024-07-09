<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from zonaverde");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_zonaverde/js/jsListadoZonaVerde.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_ZonaVerde">
    <thead>
      <tr>
        <th>CODIGO</strong></th>
        <th>UNIDAD</strong></th>
        <th>EXTENSION</strong></th>
        <th>UND-MEDIDA</strong></th>
        <th>TIPO RIEGO</strong></th>
        <th>LATITUD</strong></th>       
        <th>ORIENTACION</strong></th>
        <th>LONGITUD</strong></th>
        <th>ORIENTACION</strong></th>
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
         $res=pg_query($con, "SELECT * FROM zonaverde ORDER BY zveidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $unidad=$reg[2];
          $con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
          while($reg1=pg_fetch_array($con2))
          {
            $NomUnidad=utf8_decode($reg1[2]);
          }

          $unidadmedida= utf8_decode($reg [5]);
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
          while($reg1=pg_fetch_array($res1))
          {
            $nombre=$reg1[1];
          }

        $zveidcodigo=$reg[1];
        $zvetipriego=$reg[3];
        $zveextension=$reg[4];
        $zvelatitud=$reg[6];
        $zveorientlat=$reg[7];
        $zvelongitud=$reg[8];
        $zveorientlon=$reg[9];

           echo '<tr>';
           echo '<td>'.$zveidcodigo.'</td>';
           echo '<td>'.$NomUnidad.'</td>';
           echo '<td>'.$zveextension.'</td>';
           echo '<td>'.$nombre.'</td>';
           echo '<td>'.$zvetipriego.'</td>';
           echo '<td>'.$zvelatitud.'</td>';
           echo '<td>'.$zveorientlat.'</td>';
           echo '<td>'.$zvelongitud.'</td>';
           echo '<td>'.$zveorientlon.'</td>';
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
