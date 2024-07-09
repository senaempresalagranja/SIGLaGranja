<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadCanal.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM unidad_canal");
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
	<table width="1000" border="0">
		<tr>
			<th width="1000" colspan="4">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: UNIDAD CANAL</font></div></th>
			<th colspan="3">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM unidad_canal ORDER BY cunkidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$cununidad= utf8_decode($reg [2]);
				$res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$cununidad' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nombre=$reg1[2];
				}

				$canal= utf8_decode($reg [3]);
				$res1=pg_query($con, "SELECT * FROM canal WHERE canid='$canal' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nombre1=$reg1[2];
				}

				$unidad_medida= utf8_decode($reg [5]);
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nombre2=$reg1[1];
				}

				$codigo=$reg[1];
				$distancia=$reg[4];
				$descripcion=$reg[6];
				$fecha1=$reg[7];//Esta es la fecha del día en que se hizo el registro, no la fecha del reporte generado por el sistema
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$codigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$distancia</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"left\">$descripcion</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha1</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>