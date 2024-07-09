<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * from unidad");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_unidad/js/jsListadoUnidad.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Unidad">
    <thead>
      <tr>
        <th>AREA</strong></th>
        <th>NOMBRE</strong></th>
        <th>EXTENCION</strong></th>
        <th>UND-MEDIDA</strong></th>
        <th>RESPONSABLE</strong></th>
        <th>LATITUD</strong></th>
        <th>ORIENTACION</strong></th>
        <th>LONGITUD</strong></th>
        <th>ORIENTACION</strong></th>
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
         $res=pg_query($con, "SELECT * FROM unidad ORDER BY uniarea ASC");
      while($reg=pg_fetch_array($res))
      {
        $uniarea= $reg [1];
        $res1=pg_query($con, "SELECT * FROM area WHERE areid='$uniarea' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nombre=$reg1[2];
        }

        $uniunimedida= $reg [4];
        $res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$uniunimedida' ");
        while($reg2=pg_fetch_array($res2))
        {
          $nombre1=$reg2[1];
        }

        $uninombre=$reg[2];
        $uniextension=$reg[3];
        $uniresponsab=$reg[5];
        $unilatitud=$reg[6];
        $uniorientlat=$reg[7];
        $unilongitud=$reg[8];
        $uniorientlon=$reg[9];
        $unidescripci=$reg[10];
           echo '<tr>';
           echo '<td>'.$nombre.'</td>';
           echo '<td>'.$uninombre.'</td>';
           echo '<td>'.$uniextension.'</td>';
           echo '<td>'.$nombre1.'</td>';
           echo '<td>'.$uniresponsab.'</td>';
           echo '<td>'.$unilatitud.'</td>';
           echo '<td>'.$uniorientlat.'</td>';
           echo '<td>'.$unilongitud.'</td>';
           echo '<td>'.$uniorientlon.'</td>';
           echo '<td>'.$unidescripci.'</td>';            
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
