<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_CosechasFecha.xls");
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
    <th width="1000" colspan="10">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: FECHAS DE LAS COSECHAS</font></div></th>
    <th colspan="10">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA SIEMBRA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA COSECHA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th> 
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NONBRE CIENTIFICO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIGEN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LUGAR ORIGEN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CLIMA FAVORABLE</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">DISTANCIA SIEMBRA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">VIDA UTIL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">EXTENSION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD</th>                          
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
  $Siembra1=$_SESSION['ExcelSiembra1'];
  $Cosecha1=$_SESSION['ExcelCosecha1'];

 $consulta= pg_query($con,"SELECT 
                              lote_cultivo.lcufechsiemb,
                              lote_cultivo.lcufechcosec,
                              area.arenombre,
                              unidad.uninombre,
                              cultivo.culidcodigo,
                              cultivo.culnomcomun,
                              cultivo.culnomcienti,
                              cultivo.culorigen,
                              cultivo.cullugarorig,
                              cultivo.culclimafavo,
                              cultivo.culdistsiemb,
                              cultivo.culunimedsie,
                              cultivo.culvidautil,
                              cultivo.cultiempvida,
                              cultivo.culextension,
                              cultivo.culunimedida,
                              cultivo.cullatitud,
                              cultivo.culorientlat,
                              cultivo.cullongitud,
                              cultivo.culorientlon
                      FROM lote_cultivo
                      INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo
                      INNER JOIN unidad ON unidad.uniid = lote_cultivo.lcuunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where lcufechcosec between '$Siembra1' and '$Cosecha1' order by lcufechcosec asc");
              while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $culunimedsie=$reg[11];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedsie'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $culunimedida=$reg[15];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedida'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
                        echo "<td>$reg[18]</td>";
                        echo "<td>$reg[19]</td>";
                        echo "</tr>";
                      }
?>
</table></center>
</body>
</html>