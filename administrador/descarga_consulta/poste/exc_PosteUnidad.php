<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadPoste.xls");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: UNIDAD CON POSTES</font></div></th>
    <th colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">MATERIAL</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">ALTURA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO TENSION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ALUMBRADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TRASNFORMADOR</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ESTADO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">RUTA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$CodUnidad=$_SESSION['CodUnidad'];

 $consulta= pg_query($con,"SELECT
            area.arenombre,
            unidad.uninombre,
            poste.posidcodigo,
            poste.postipmateri,
            poste.posestado,
            poste.posaltura,
            poste.posunimedi,
            poste.postiptensio,
            poste.posalumbrado,
            poste.posestalumbr,
            poste.postransform,
            poste.posesttransf,
            poste.posruta,
            poste.poslatitud,
            poste.posorientlat,
            poste.poslongitud,
            poste.posorientlon
            FROM poste
            INNER JOIN unidad ON unidad.uniid = poste.posunidad
            INNER JOIN area ON area.areid = unidad.uniarea where uniid = '$CodUnidad' ORDER BY uninombre ASC");
 
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $posunimedi=$reg[6];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$posunimedi'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $posruta=$reg[12];
                        $res1=pg_query($con, "SELECT * FROM ruta WHERE rutid='$posruta'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
                        }
                        
                        echo "
                      <tr>
                        <td align=\"left\">$reg[1]</td>
                        <td align=\"left\">$reg[0]</td>
                        <td align=\"left\">$reg[2]</td>
                        <td align=\"left\">$reg[3]</td>
                        <td align=\"left\">$reg[4]</td>
                        <td align=\"right\">$reg[5]</td>
                        <td align=\"left\">$nombre</td>
                        <td align=\"left\">$reg[7]</td>
                        <td align=\"left\">$reg[8]</td>
                        <td align=\"left\">$reg[9]</td>
                        <td align=\"left\">$reg[10]</td>
                        <td align=\"left\">$reg[11]</td>
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