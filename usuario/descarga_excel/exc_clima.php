<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Clima.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor postgresql

//realizamos la consulta
include ('../conexion.php');

$res=pg_query($con, "SELECT * FROM clima");
?>
<?php
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y/H:i:s",time());
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<center>
		<table width="1000" border="0">
			<tr>
				<th width="1000" colspan="7">
					<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: CLIMA </font></div></th>
					<th colspan="7">
						<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
					</th>
				</tr>
			</table>
			<table width="641" border="1">
				<tr>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>HORA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>FECHA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>RADIACION SOLAR</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>MEDIDA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>TEMPREATURA AIRE</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>MEDIDA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>HUMEDAD RELATIVA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>MEDIDA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>PRECIPITACION</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>MEDIDA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>VELOCIDAD VIENTO</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>MEDIDA</strong></th>
					<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF"><strong>DIRECCION VIENTO</strong></th>
				</tr>
				<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
				$res=pg_query($con, "SELECT * FROM clima ORDER BY cliid ASC");
				while($reg=pg_fetch_array($res))
				{
					$cliunimedrad= utf8_decode($reg [4]);		
					$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedrad' ");
					while($reg1=pg_fetch_array($res1))
					{
						$nombre=$reg1[1];
					}
					$cliunimedtem=mb_convert_encoding($reg[6], "UTF-8");	
					$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedtem' ");
					while($reg1=pg_fetch_array($res1))
					{
						$nombre1=$reg1[1];
					}
					$cliunimedvel=utf8_decode($reg[8]);
					$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedvel' ");
					while($reg1=pg_fetch_array($res1))
					{
						$nombre2=$reg1[1];
					}
					$cliunimedhum=utf8_decode($reg[10]);
					$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedhum' ");
					while($reg1=pg_fetch_array($res1))
					{
						$nombre3=$reg1[1];
					}
					$cliunimedpre= utf8_decode($reg [12]);		
					$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedpre' ");
					while($reg1=pg_fetch_array($res1))
					{
						$nombre4=$reg1[1];
					}

					$Codigo=utf8_decode($reg[0]);

					$Hora=utf8_decode($reg[1]);

					$Fecha=utf8_decode($reg[2]);

					$Radiacion=utf8_decode($reg[3]);

					$Temperatura=utf8_decode($reg[5]);

					$Humedad=utf8_decode($reg[7]);

					$Precipitacion=utf8_decode($reg[9]);

					$Velocidad=utf8_decode($reg[11]);

					$Direccion=utf8_decode($reg[13]);

					echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$Codigo</td>
					<td bgcolor=\"#fff\" align=\"right\">$Hora</td>
					<td bgcolor=\"#fff\" align=\"right\">$Fecha</td>
					<td bgcolor=\"#fff\" align=\"right\">$Radiacion</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$Temperatura</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$Humedad</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"right\">$Precipitacion</td>				
					<td bgcolor=\"#fff\" align=\"left\">$nombre3</td>
					<td bgcolor=\"#fff\" align=\"right\">$Velocidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre4</td>
					<td bgcolor=\"#fff\" align=\"left\">$Direccion</td>
				</tr>";

			}
			?>
		</table></center>
	</body>
	</html>