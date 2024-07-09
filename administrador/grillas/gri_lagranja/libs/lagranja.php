<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");

$listado=  pg_query($con,"SELECT * FROM lagranja");
?>

<script type="text/javascript" language="javascript" src="grillas/gri_lagranja/js/jsListadoLagranja.js"></script>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Lagranja">
    <thead>
      <tr>
        <th>CODIGO (NIT)</th>
        <th>NOMBRE</th>
        <th>DIRECCION</th>
        <th>DEPARTAMENTO</th>
        <th>MUNICIPIO</th>
        <th>VEREDA</th>
        <th>CODIGO PREDIAL NUEVO</th>
        <th>CODIGO PREDIAL ANTERIOR</th>
        <th>MATRICULA INMOBILIARIA</th>
        <th>ACTIVIDAD ECONOMICA</th>
        <th>FECHA FUNDACION</th>
        <th>AREA DE TERRENO</th>
        <th>UND-MEDIDA</th>
        <th>AREA CONSTRUIDA</th>
        <th>UND-MEDIDA</th>
        <th>CANTIDAD CONSTRUCCIONES</th>
        <th>ALTITUD NIVEL MAR</th>
        <th>UND-MEDIDA</th>
        <th>NUMERO PLANCHA</th>
        <th>ESCALA</th>
        <th>LATITUD</th>
        <th>ORIENTACION</th>
        <th>LONGITUD</th>
        <th>ORIENTACION</th>
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
         $res=pg_query($con, "SELECT * FROM lagranja ORDER BY lagnit ASC");
      while($reg=pg_fetch_array($res))
      {
        $lagunimedat= utf8_decode($reg [13]);
        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedat' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomunidad1=utf8_decode($reg1[1]);
        }

        $lagunimedac= utf8_decode($reg [15]);
        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedac' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomunidad2=utf8_decode($reg1[1]);
        }

        $lagunimedam= utf8_decode($reg [18]);
        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedam' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomunidad3=utf8_decode($reg1[1]);
        }

        $lagnit=$reg[1];
        $lagnombre=$reg[2];
        $lagdepartam=$reg[3];
        $lagdireccio=$reg[4];
        $lagmunicipi=$reg[5];
        $lagvereda=$reg[6];
        $lagcodprenu=$reg[7];
        $lagcodprean=$reg[8];
        $lagmatriinm=$reg[9];
        $lagactiecon=$reg[10];
        $lagfecfunda=$reg[11];
        $lagareaterr=$reg[12];
        $lagareconst=$reg[14];
        $lagcanconst=$reg[16];
        $lagaltitud=$reg[17];
        $lagplancha=$reg[19];
        $lagescala=$reg[20];
        $laglatitud=$reg[21];
        $lagorientlat=$reg[22];
        $laglongitud=$reg[23];
        $lagorientlon=$reg[24];
           echo '<tr>';
           echo '<td>'.mb_convert_encoding($lagnit, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagnombre, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagdepartam, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagdireccio, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagmunicipi, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagvereda, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagcodprenu, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagcodprean, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagmatriinm, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagactiecon, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagfecfunda, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagareaterr, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nomunidad1, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagareconst, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nomunidad2, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagcanconst, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagaltitud, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($nomunidad3, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagplancha, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagescala, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($laglatitud, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagorientlat, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($laglongitud, "UTF-8").'</td>';
           echo '<td>'.mb_convert_encoding($lagorientlon, "UTF-8").'</td>';
           echo '</tr>';                     
          }
          ?>
      <tbody>
  </table>
