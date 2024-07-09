<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_EspecieRaza.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM especie_raza");
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
			<th width="1000" colspan="3">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ESPECIE RAZA</font></div></th>
			<th colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESPECIE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RAZA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM especie_raza ORDER BY erakidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$eraespecie= $reg [2];
				$res1=pg_query($con, "SELECT * FROM especie WHERE espid='$eraespecie' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun=$reg1[3];
				}
				$raza= $reg [3];
				$res1=pg_query($con, "SELECT * FROM raza WHERE razid='$raza' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun1=$reg1[1];
				}
				$codigo=$reg[1];
				$descripcion=$reg[4];
				$fecha1=$reg[5];//Esta es la fecha del día en que se hizo el registro, no la fecha del reporte generado por el sistema
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$codigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun1</td>
					<td bgcolor=\"#fff\" align=\"justify\">$descripcion</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha1</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>