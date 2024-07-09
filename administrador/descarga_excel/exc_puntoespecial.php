<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_PuntosEspeciales.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor postgres
		  
//realizamos la consulta
include ('../conexion.php');

date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y/H:i:s",time());
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<center><table width="1000" border="0">
	<tr>
		<th width="1000" colspan="5">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PUNTOS ESPECIALES</font>
			</div>
		</th>
		<th width="1000" colspan="5">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">NOMBRE </th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UNIDAD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TIPO PUNTO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">DESCRIPCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LATITUD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LONGITUD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIENTACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM puntoespecial ORDER BY pesid ASC");
while($reg=pg_fetch_array($res))
{
	$pesunidad= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$pesunidad' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[2];
	}
	
						$pesid=$reg[0];
						$pesnombre=$reg[2];
						$pestippunto=$reg[3];
						$peslatitud=$reg[4];
						$pesorientlat=$reg[5];						
						$peslongitud=$reg[6];
						$pesorientlog=$reg[7];
						$pesdescripci=$reg[8];
						$pesfecha=$reg[9];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$pesid</td>
					<td bgcolor=\"#fff\" align=\"left\">$pesnombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>					
					<td bgcolor=\"#fff\" align=\"left\">$pestippunto</td>
					<td bgcolor=\"#fff\" align=\"left\">$pesdescripci</td>
					<td bgcolor=\"#fff\" align=\"right\">$peslatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$pesorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$peslongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$pesorientlog</td>					
					<td bgcolor=\"#fff\" align=\"right\">$pesfecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>