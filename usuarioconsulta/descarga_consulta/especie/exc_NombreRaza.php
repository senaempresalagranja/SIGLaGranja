<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_NombreRaza.xls");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: NOMBRES RAZAS</font></div></th>
    <th colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE RAZA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIGEN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LUGAR ORIGEN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">PROPOSITO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">PRODUCCION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO ESPECIE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>
</tr>
<?php
$RazaNom=$_SESSION['NomRazaExcel'];
 $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              raza.raznombre,
                              raza.razorigen,
                              raza.razlugorigen,
                              raza.razproposito,
                              raza.razproducion,
                              raza.razunimedpro,
                              especie.esptipespeci,
                              especie.espnomcomun,
                              especie.espnomcienti
                      FROM especie_raza
                      INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                      INNER JOIN raza ON raza.razid = especie_raza.eraraza
                      INNER JOIN unidad ON unidad.uniid = especie.espunidad
                      INNER JOIN area ON area.areid = unidad.uniarea WHERE raznombre LIKE '%$RazaNom%' order by raznombre asc");

            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $razunimedpro=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr>";
                        
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td align=\"right\">$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";                      
                        echo "</tr>";                   
                      }
?>
</table></center>
</body>
</html>