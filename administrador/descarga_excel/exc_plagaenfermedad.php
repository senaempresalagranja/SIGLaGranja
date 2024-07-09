<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_PlagaEnfermedad.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM plagaenfermedad");
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
			<th width="1000" colspan="6">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PLAGA ENFERMEDAD (VEGETAL)</font></div></th>
				<th colspan="7">
					<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
				</th>
			</tr>
		</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO DAÑO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AGENTE CAUSAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MANEJO</strong></th>				
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="5"><strong>ZONA AFECTADA (FRUTO, TALLO, FLOR, RAIZ, HOJA)</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM plagaenfermedad ORDER BY penid ASC");
			while($reg=pg_fetch_array($res))
			{
				$penid=$reg[0];
				$pentipdano=$reg[1];
				$pennomcomun=$reg[2];
				$pennomcienti=$reg[3];
				$pentipagecau=$reg[4];
				$pentipmanejo=$reg[5];
				$pentipzaffru =$reg[6];
				$pentipzaftal =$reg[7];
				$pentipzafflo =$reg[8];
				$pentipzafrai =$reg[9];
				$pentipzafhoj =$reg[10];
				$pendescripci =$reg[11];
				$penfecha=$reg[12];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$penid</td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipdano</td>
					<td bgcolor=\"#fff\" align=\"left\">$pennomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$pennomcienti</td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipagecau</td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipmanejo</td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipzaffru </td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipzaftal </td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipzafflo </td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipzafrai </td>
					<td bgcolor=\"#fff\" align=\"left\">$pentipzafhoj </td>
					<td bgcolor=\"#fff\" align=\"left\">$pendescripci </td>
					<td bgcolor=\"#fff\" align=\"right\">$penfecha</td>
				</tr>";
			}
			?>
		</table>
	</body>
	</html>