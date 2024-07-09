<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Area.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
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
			<th width="1000" colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: AREA </font></div></th>
			<th colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RESPONSABLE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM area ORDER BY areidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$umeid= $reg [4];
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad=$reg1[1];
				}
				$areidcodigo=$reg[1];
				$arenombre=$reg[2];
				$areextension=$reg[3];
				$arecoordinad=$reg[5];
				$arelatitud=$reg[6];
				$areorientlat=$reg[7];
				$arelongitud=$reg[8];
				$areorientlon=$reg[9];
				$aredescripci=$reg[10];
				$fecha=$reg[11];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$areidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$arenombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$areextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$arecoordinad</td>
					<td bgcolor=\"#fff\" align=\"right\">$arelatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$areorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$arelongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$areorientlon</td>
					<td bgcolor=\"#fff\" align=\"left\">$aredescripci</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>