<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Canal.xls");
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
		<th width="1000" colspan="11">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: CANAL</font>
			</div>
		</th>
		<th width="1000" colspan="11">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">NOMBRE </th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CLASE</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TIPO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">USO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PROFUNDIDAD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ANCHO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PENDIENTE</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">DISTANCIA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LAT INICIAL</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LONG INICIAL</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LAT FINAL</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LONG FINAL</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM canal ORDER BY canidcodigo ASC");
while($reg=pg_fetch_array($res))
{
	$canunimedpro= utf8_decode($reg [7]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
	$UnidadAncho=utf8_decode($reg[9]);	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadAncho' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1=$reg1[1];
	}
	$UnidadPendiente=utf8_decode($reg[11]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadPendiente' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=$reg1[1];
	}
	$UnidadDistancia=utf8_decode($reg[13]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadDistancia' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre3=$reg1[1];
	}
						$CodigoCanal=$reg[1];
						$Nombre=$reg[2];
						$Clase=$reg[3];
						$Uso=$reg[4];
						$Tipo=$reg[5];						
						$Profundidad=$reg[6];
						$Ancho=$reg[8];
						$Pendiente=$reg[10];
						$Distancia=$reg[12];
						$LatitudInicial=$reg[14];
						$posinici=$reg[15];
						$LongitudInicial=$reg[16];
						$posini=$reg[17];
						$LatitudFinal =$reg[18];
						$posfinal=$reg[19];
						$LongitudFinal=$reg[20];
						$posfin=$reg[21];
						$fecha=$reg[22];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"left\">$CodigoCanal</td>
					<td bgcolor=\"#fff\" align=\"left\">$Nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$Clase</td>
					<td bgcolor=\"#fff\" align=\"left\">$Uso</td>
					<td bgcolor=\"#fff\" align=\"left\">$Tipo</td>
					<td bgcolor=\"#fff\" align=\"right\">$Profundidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$Ancho</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$Pendiente</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"right\">$Distancia</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre3</td>
					<td bgcolor=\"#fff\" align=\"right\">$LatitudInicial</td>
					<td bgcolor=\"#fff\" align=\"left\">$posinici</td>
					<td bgcolor=\"#fff\" align=\"right\">$LongitudInicial</td>
					<td bgcolor=\"#fff\" align=\"left\">$posini</td>
					<td bgcolor=\"#fff\" align=\"right\">$LatitudFinal</td>
					<td bgcolor=\"#fff\" align=\"left\">$posfinal</td>
					<td bgcolor=\"#fff\" align=\"right\">$LongitudFinal</td>
					<td bgcolor=\"#fff\" align=\"left\">$posfin</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>