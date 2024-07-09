<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadMedida.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM unidad_medida");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: UNIDAD MEDIDA</font></div></th>
			<th colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MAGNITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SIMBOLO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM unidad_medida order by umetipunimed");
while($reg=pg_fetch_array($res))
{
	$umeid=$reg[0];
	$umerepreset=$reg[1];
	$umenombre=$reg[2];
	$umefecha=$reg[3];
	$umetipunimed=$reg[4];

echo "
<tr>
	<td bgcolor=\"#fff\" align=\"left\">$umetipunimed</td>
	<td bgcolor=\"#fff\" align=\"center\">$umeid</td>	
	<td bgcolor=\"#fff\" align=\"left\">$umenombre</td>
	<td bgcolor=\"#fff\" align=\"left\">$umerepreset</td>
	<td bgcolor=\"#fff\" align=\"right\">$umefecha</td>	
</tr>";
}
?>
</table></center>
</body>
</html>