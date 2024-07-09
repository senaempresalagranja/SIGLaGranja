<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadesCanales.xls");
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
    <th width="1000" colspan="7">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: UNIDADES CON CANALES</font></div></th>
    <th colspan="16">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE</th>    
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CLASE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">USO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO</th> 
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">PROFUNDIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">ANCHO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">PENDIENTE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">DISTANCIA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD INICIAL</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD INICIAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LATITUD FINAL</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">LONGITUD FINAL</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$CodArea=$_SESSION['CodArea'];

 $consulta= pg_query($con,"SELECT
            area.arenombre,
            unidad.uninombre,
            canal.canidcodigo,
            canal.cannombre,
            canal.canclase,
            canal.canuso,
            canal.cantipo,
            canal.canprofundid,
            canal.canunimedpro,
            canal.canancho,
            canal.canunimedanc,
            canal.canpendiente,
            canal.canunimedpen,
            canal.candistancia,
            canal.canunimedist,
            canal.canlatitudi,
            canal.canorienlati,
            canal.canlongitudi,
            canal.canorienloni,
            canal.canlatitudf,
            canal.canorienlatf,
            canal.canlongitudf,
            canal.canorienlonf
            FROM unidad_canal
            INNER JOIN unidad ON unidad.uniid = unidad_canal.cununidad
            INNER JOIN area ON area.areid = unidad.uniarea                
            INNER JOIN canal ON canal.canid = unidad_canal.cuncanal where uniarea = '$CodArea' order by uninombre ASC");
 
               while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $canunimedpro=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $canunimedanc=$reg[10];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedanc'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
                        }

                        $canunimedpen=$reg[12];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedpen'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre2=$reg1[2];
                        }

                        $canunimedist=$reg[14];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedist'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre3=$reg1[2];
                        }
                        
                        echo "<tr>
                        <td align=\"left\">$reg[1]</td>
                        <td align=\"left\">$reg[0]</td>
                        <td align=\"left\">$reg[2]</td>
                        <td align=\"left\">$reg[3]</td>                        
                        <td align=\"left\">$reg[4]</td>
                        <td align=\"left\">$reg[5]</td>
                        <td align=\"left\">$reg[6]</td>
                        <td align=\"rigth\">$reg[7]</td>
                        <td align=\"left\">$nombre</td>
                        <td align=\"rigth\">$reg[9]</td>
                        <td align=\"left\">$nombre1</td>
                        <td align=\"rigth\">$reg[11]</td>
                        <td align=\"left\">$nombre2</td>
                        <td align=\"rigth\">$reg[13]</td>
                        <td align=\"left\">$nombre3</td>
                        <td align=\"rigth\">$reg[15]</td>
                        <td align=\"left\">$reg[16]</td>
                        <td align=\"rigth\">$reg[17]</td>
                        <td align=\"left\">$reg[18]</td>
                        <td align=\"rigth\">$reg[19]</td>
                        <td align=\"left\">$reg[20]</td>
                        <td align=\"rigth\">$reg[21]</td>
                        <td align=\"left\">$reg[22]</td>
                        </tr>";                    
                      }
?>
</table></center>
</body>
</html>