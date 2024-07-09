<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RedLogica.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor postgres
		  
//realizamos la consulta
include ('../conexion.php');

date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y/H:i:s",time());
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<center><table width="1000" border="0">
	<tr>
		<th width="1000" colspan="8">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RED LOGICA</font>
			</div>
		</th>
		<th width="1000" colspan="9">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONSTRUCCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ZONA WIFI</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ACCES POINT</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">RED ALAMBRICA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LONGITUD CANALETAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">RJ-45</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FIBRA OPTICA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CABLE UTP</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TOPOLOGIA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">DISTRIBUCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">RACK</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">SWITCH</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">REGLETAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UPS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM redlogica ORDER BY rloid ASC");
    while($reg=pg_fetch_array($res))
    {
      $rsaconstrucc= utf8_decode($reg [1]);   
      $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[3];
      }

      $rlounimedcca= utf8_decode($reg [6]);   
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rlounimedcca' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }
                $rloid=$reg[0];
                $rlozonawifi=$reg[2];
                $rlocantacces=$reg[3];         
                $rloredalambr=$reg[4];
                $rlocantanale=$reg[5];
                $rlocantrj=$reg[7];
                $rlocantfibop=$reg[8];
                $rlocategoutp=$reg[9];
                $rlotopologia=$reg[10];
                $rlodistribuc=$reg[11];
                $rlorack=$reg[12];
                $rlocantswitc=$reg[13];
                $rlocantregle=$reg[14];
                $rlocantups=$reg[15];
                $rlofecha=$reg[16];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$rloid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$rlozonawifi</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantacces</td>
					<td bgcolor=\"#fff\" align=\"left\">$rloredalambr</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantanale</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantrj</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantfibop</td>
					<td bgcolor=\"#fff\" align=\"left\">$rlocategoutp</td>
					<td bgcolor=\"#fff\" align=\"left\">$rlotopologia</td>
					<td bgcolor=\"#fff\" align=\"left\">$rlodistribuc</td>
					<td bgcolor=\"#fff\" align=\"left\">$rlorack</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantswitc</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantregle</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlocantups</td>
					<td bgcolor=\"#fff\" align=\"right\">$rlofecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>