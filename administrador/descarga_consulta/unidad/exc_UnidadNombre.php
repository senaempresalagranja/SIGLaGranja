<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_NombreUnidad.xls");
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
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: NOMBRES DE UNIDADES</font></div></th>
    <th colspan="8">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">RESPONSABLE</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">EXTENSION</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LATITUD UNIDAD</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LONGITUD UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">COORDINADOR</th>            
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">EXTENSION</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LATITUD AREA</th>  
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LONGITUD AREA</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$NomUnidad=$_SESSION['NombreUnidad'];

 $consulta= pg_query($con,"SELECT 
            unidad.uniid,
            area.arenombre, 
            area.arecoordinad,
            area.areextension, area.areunimedida,
            unidad.uninombre,    
            unidad.uniresponsab,
            unidad.uniextension, unidad.uniunimedida,
            unidad.unilatitud, unidad.uniorientlat, 
            unidad.unilongitud, unidad.uniorientlon, 
            area.arelatitud,
            area.areorientlat,
            area.arelongitud,
            area.areorientlon,
            unidad.unilatitud,
            unidad.uniorientlat,
            unidad.unilongitud,
            unidad.uniorientlon
            FROM unidad
            INNER JOIN area ON area.areid = unidad.uniarea WHERE uninombre LIKE '%$NomUnidad%' order by uninombre asc");
 
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $uniunimedida=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$uniunimedida'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $areunimedida=$reg[4];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$areunimedida'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "
                      <tr>                        
                        <td align=\"center\">$reg[0]</td>
                        <td align=\"left\">$reg[5]</td>
                        <td align=\"left\">$reg[6]</td>
                        <td align=\"right\">$reg[7]</td>
                        <td align=\"left\">$nombre</td>
                        <td align=\"right\">$reg[9]</td>
                        <td align=\"left\">$reg[10]</td>
                        <td align=\"right\">$reg[11]</td>
                        <td align=\"left\">$reg[12]</td>
                        <td align=\"left\">$reg[1]</td>
                        <td align=\"left\">$reg[2]</td>
                        <td align=\"right\">$reg[3]</td>                        
                        <td align=\"left\">$nombre1</td>
                        <td align=\"right\">$reg[13]</td> 
                        <td align=\"left\">$reg[14]</td>                
                        <td align=\"right\">$reg[15]</td>
                        <td align=\"left\">$reg[16]</td>                       
                    </tr>";                   
                      }
?>
</table></center>
</body>
</html>