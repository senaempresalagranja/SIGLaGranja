<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadesRuta.xls");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: UNIDADES CON RUTAS</font></div></th>
    <th colspan="12">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">RUTA</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">DISTANCIA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">TIEMPO RECORRIDO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO RUTA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD INICIAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD INICIAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD FINAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD FINAL</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$sessionArea=$_SESSION['uniarea'];

 $consulta= pg_query($con,"SELECT        
            ruta_unidad.runkidcodigo,
            area.arenombre,
            unidad.uninombre,
            ruta.rutnombre,
            ruta.rutestado,
            ruta_unidad.rundistancia,
            ruta_unidad.rununimeddis,
            ruta_unidad.runtierecorr,
            ruta_unidad.rununimedrec,
            ruta_unidad.runtipruta,
            ruta.rutlatitudi,
            ruta.rutorienlati,
            ruta.rutlongitudi,
            ruta.rutorienloni,
            ruta.rutlatitudf,
            ruta.rutorienlatf,
            ruta.rutlongitudf,
            ruta.rutorienlonf 
            FROM ruta_unidad
            INNER JOIN unidad ON unidad.uniid = ruta_unidad.rununidad
            INNER JOIN area ON area.areid = unidad.uniarea              
            INNER JOIN ruta ON ruta.rutid = ruta_unidad.runruta where uniarea = '$sessionArea' order by uninombre asc");
 
               while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $rununimeddis=$reg[6];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimeddis'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $rununimedrec=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedrec'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
                        }
                        
                        echo "<tr>";
                        echo "<td align=\"left\">$reg[2]</td>";
                        echo "<td align=\"left\">$reg[1]</td>";
                        echo "<td align=\"right\">$reg[0]</td>";                        
                        echo "<td align=\"left\">$reg[3]</td>";      
                        echo "<td align=\"left\">$reg[4]</td>";
                        echo "<td align=\"right\">$reg[5]</td>";
                        echo "<td align=\"left\">$nombre</td>";
                        echo "<td align=\"right\">$reg[7]</td>";
                        echo "<td align=\"left\">$nombre1</td>";
                        echo "<td align=\"left\">$reg[9]</td>";
                        echo "<td align=\"right\">$reg[10]</td>";
                        echo "<td align=\"left\">$reg[11]</td>";
                        echo "<td align=\"right\">$reg[12]</td>";
                        echo "<td align=\"left\">$reg[13]</td>";
                        echo "<td align=\"right\">$reg[14]</td>";
                        echo "<td align=\"left\">$reg[15]</td>";
                        echo "<td align=\"right\">$reg[16]</td>";
                        echo "<td align=\"left\">$reg[17]</td>";
                        echo "</tr>";                    
                      }
?>
</table></center>
</body>
</html>