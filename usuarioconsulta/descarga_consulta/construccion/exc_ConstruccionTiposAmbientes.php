<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_TodosTiposAmbientes.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('conexion.php');
//realizamos la consulta

date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y/H:i:s",time());
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="8">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPOTRTE: TIPOS DE AMBIENTE</font></div></th>
    <th colspan="8">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO AMBIENTE</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>            
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CONSTRUCCION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO CONSTRUCCION</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO CUBIERTA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO PISO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO MURO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA CONSTRUCCION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA REMODELACION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LATITUD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIENTACION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LONGITUD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIENTACION</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$sessionUnidad=$_SESSION['conunidad'];

 $Consultar= pg_query($con,"SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                  INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                  INNER JOIN area ON area.areid = unidad.uniarea where conunidad = '$sessionUnidad' order by contipambien asc");
            while ($reg=pg_fetch_array($Consultar)) 
            {
              echo "
              <tr>
                <td>$reg[4]</td>
                <td>$reg[0]</td>
                <td>$reg[1]</td>
                <td>$reg[2]</td>
                <td>$reg[3]</td> 
                <td>$reg[5]</td>                
                <td>$reg[6]</td>
                <td>$reg[7]</td>
                <td>$reg[8]</td>
                <td>$reg[9]</td>
                <td> $reg[10]</td>
                <td> $reg[11]</td>
                <td> $reg[12]</td>
                <td> $reg[13]</td>
                <td> $reg[14]</td>
                <td> $reg[15]</td>
              </tr>";
            }
?>
</table></center>
</body>
</html>