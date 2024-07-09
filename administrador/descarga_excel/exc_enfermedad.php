<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Enfermedad.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM enfermedad");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ENFERMEDAD </font></div></th>
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
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AGENTE CAUSAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MORTALIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SINTOMAS</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRATAMIENTO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM enfermedad ORDER BY enfid ASC");
			while($reg=pg_fetch_array($res))
			{
				$enfid=$reg[0];
				$enfnomcomun=$reg[1];
				$enfnomcinti=$reg[2];
				$enftipagecau=$reg[3];
				$enfmorvimort=$reg[4];
				$enfsintomas=$reg[5];
				$enftratamien=$reg[6];
				$enffecha=$reg[7];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$enfid</td>
					<td bgcolor=\"#fff\" align=\"left\">$enfnomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$enfnomcinti</td>
					<td bgcolor=\"#fff\" align=\"left\">$enftipagecau</td>
					<td bgcolor=\"#fff\" align=\"left\">$enfmorvimort</td>
					<td bgcolor=\"#fff\" align=\"left\">$enfsintomas</td>
					<td bgcolor=\"#fff\" align=\"left\">$enftratamien</td>
					<td bgcolor=\"#fff\" align=\"right\">$enffecha</td>
				</tr>";
			}
			?>
		</table>
	</body>
	</html>