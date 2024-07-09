<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Vegetal.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM vegetal");
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
			<th width="1000" colspan="5">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: VEGETAL </font></div></th>
				<th colspan="4">
					<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
				</th>
			</tr>
		</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIGEN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO</strong></th>				
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CLIMA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM vegetal ORDER BY vegid ASC");
			while($reg=pg_fetch_array($res))
			{
				$vegid=$reg[0];
				$vegnomcomun=$reg[1];
				$vegnomcienti=$reg[2];
				$vegorigen=$reg[3];
				$veglugorigen=$reg[4];
				$vegclima=$reg[5];
				$vegtipo=$reg[6];
				$vegdescripci=$reg[7];
				$vegfecha=$reg[8];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$vegid</td>
					<td bgcolor=\"#fff\" align=\"left\">$vegnomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$vegnomcienti</td>
					<td bgcolor=\"#fff\" align=\"left\">$vegorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$veglugorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$vegtipo</td>
					<td bgcolor=\"#fff\" align=\"left\">$vegclima</td>					
					<td bgcolor=\"#fff\" align=\"left\">$vegdescripci</td>
					<td bgcolor=\"#fff\" align=\"right\">$vegfecha</td>
				</tr>";
			}
			?>
		</table>
	</body>
	</html>