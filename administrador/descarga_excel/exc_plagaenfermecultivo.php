<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_PlagaEnfermedadCultivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM plagaenferme_cultivo");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PLAGAENFERMEDAD CULTIVO</font></div></th>
			<th colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PLAGA/ENFERMEDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CULTIVO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM plagaenferme_cultivo ORDER BY pcukidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$plagaenfer= utf8_decode($reg [2]);
				$res1=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$plagaenfer' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun=$reg1[2];
				}
				$cultivo= utf8_decode($reg [3]);
				$res1=pg_query($con, "SELECT * FROM cultivo WHERE culid='$cultivo' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun1=$reg1[2];
				}
				$codigo=$reg[1];
				$descripcion=$reg[4];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$codigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun1</td>
					<td bgcolor=\"#fff\" align=\"left\">$descripcion</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>