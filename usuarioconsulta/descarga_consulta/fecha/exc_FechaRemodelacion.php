<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RemodelacionesFecha.xls");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: FECHAS DE LAS REMODELACIONES</font></div></th>
    <th colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA CONSTRUCCION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA REMODELACION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th> 
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">EXTENSION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO AMBIENTE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO CONSTRUCCION</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO CUBIERTA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO PISO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO MURO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD</th>                          
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
  $Construccion1=$_SESSION['ExcelConstruccion1'];
  $Remodelacion1=$_SESSION['ExcelRemodelacion1'];

 $consulta= pg_query($con,"SELECT 
                              construccion.confecconstr,
                              construccion.confecremode,
                              area.arenombre,
                              unidad.uninombre,
                              construccion.conidcodigo,
                              construccion.connombre,
                              construccion.conextension,
                              construccion.conunimedcon,
                              construccion.contipambien,
                              construccion.contipconstr,
                              construccion.conestado,
                              construccion.contipcubiert,
                              construccion.contippiso,
                              construccion.contipmuro,
                              construccion.conlatitud,
                              construccion.conorientlat,
                              construccion.conlongitud,
                              construccion.conorientlon
                      FROM construccion 
                      INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where confecremode between '$Construccion1' and '$Remodelacion1' order by confecremode asc");
              while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $conunidad=$reg[3];
                        $res1=pg_query($con, "SELECT * FROM unidad WHERE uninombre='$conunidad'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $conunimedcon=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$conunimedcon'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
                        echo "</tr>";
                      }
?>
</table></center>
</body>
</html>