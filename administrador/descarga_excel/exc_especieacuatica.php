<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Especieacuatica.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM especieacuatica");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ESPECIE ACUATICA</font></div></th>
			<th colspan="3">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO ESPECIE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM especieacuatica ORDER BY eacid ASC");
			while($reg=pg_fetch_array($res))
			{
				$uniid= utf8_decode($reg [1]);
				$res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$uniid'");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad=utf8_decode($reg1[2]);
				}
				$eacid=$reg[0];
				$eactipespeci=$reg[2];
				$eacnomcomun=$reg[3];
				$eacnomcienti=$reg[4];
				$eacfecha=$reg[5];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$eacid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$eactipespeci</td>
					<td bgcolor=\"#fff\" align=\"left\">$eacnomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$eacnomcienti</td>
					<td bgcolor=\"#fff\" align=\"right\">$eacfecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>