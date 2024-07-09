<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Plaga.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM plaga");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PLAGA </font></div></th>
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
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AGENTE CAUSAL</strong></th>				
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRATAMIENTO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM plaga ORDER BY plaidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$plaidcodigo=$reg[1];
				$planomcomun=$reg[2];
				$planomcienti=$reg[3];
				$plaorigen=$reg[4];
				$plalugarorig=$reg[5];
				$platipagecau=$reg[6];
				$platratamien=$reg[7];
				$plafecha=$reg[8];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$plaidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$planomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$planomcienti</td>
					<td bgcolor=\"#fff\" align=\"left\">$plaorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$plalugarorig</td>
					<td bgcolor=\"#fff\" align=\"left\">$platipagecau</td>
					<td bgcolor=\"#fff\" align=\"left\">$platratamien</td>
					<td bgcolor=\"#fff\" align=\"right\">$plafecha</td>
				</tr>";
			}
			?>
		</table>
	</body>
	</html>