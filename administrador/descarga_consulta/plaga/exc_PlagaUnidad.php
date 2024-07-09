<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadPlaga.xls");
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
    <th width="1000" colspan="6">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: UNIDAD CON PLAGAS</font></div></th>
    <th colspan="6">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>

  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>

  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIGEN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LUGAR ORIGEN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AGENTE CAUSAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TRATAMIENTO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO ESPECIE</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$sessionUnidad=$_SESSION['CodUnidad'];

 $Consultar= pg_query("SELECT 
                    area.arenombre,
                    unidad.uninombre,
                    plaga.plaidcodigo,
                    plaga.planomcomun,
                    plaga.planomcienti,
                    plaga.plaorigen,
                    plaga.plalugarorig,
                    plaga.platipagecau,
                    plaga.platratamien, 
                    especie.esptipespeci,
                    especie.espnomcomun,
                    especie.espnomcienti                
                  FROM plaga_especie
                    INNER JOIN especie ON especie.espid = plaga_especie.pesespecie
                    INNER JOIN plaga ON plaga.plaid = plaga_especie.pesplaga
                    INNER JOIN unidad ON unidad.uniid = especie.espunidad
                    INNER JOIN area ON area.areid = unidad.uniarea WHERE espunidad='$sessionUnidad' order by uninombre asc");
              while ($reg=pg_fetch_array($Consultar)) 
              {
                echo "
                      <tr>
                        <td>$reg[1]</td>
                        <td>$reg[0]</td>
                        <td>$reg[2]</td>
                        <td>$reg[3]</td>
                        <td>$reg[4]</td> 
                        <td>$reg[5]</td>                
                        <td>$reg[6]</td>
                        <td>$reg[7]</td>
                        <td>$reg[8]</td>
                        <td>$reg[9]</td>
                        <td> $reg[10]</td>
                        <td> $reg[11]</td>
                    </tr>";
              }
?>
</table></center>
</body>
</html>