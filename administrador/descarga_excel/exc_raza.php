<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Raza.xls");
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
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RAZA</font>
			</div>
		</th>
		<th width="1000" colspan="4">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">NOMBRE</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ORIGEN</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LUGAR ORIGEN</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PROPOSITO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PRODUCCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FENOTIPO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM raza ORDER BY raznombre ASC");
while($reg=pg_fetch_array($res))
{
	$razunimedpro= utf8_decode($reg [6]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
						$razid=$reg[0];
						$raznombre=$reg[1];
						$razorigen=$reg[2];
						$razlugorigen=$reg[3];					
						$razproposito=$reg[4];
						$razproducion=$reg[5];
						$razcarfenoti=$reg[7];
						$razfecha=$reg[8];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$razid</td>
					<td bgcolor=\"#fff\" align=\"left\">$raznombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$razorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$razlugorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$razproposito</td>
					<td bgcolor=\"#fff\" align=\"right\">$razproducion</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$razcarfenoti</td>
					<td bgcolor=\"#fff\" align=\"right\">$razfecha</td>
				</tr>";				
		}
?>
</table></center>
</body>
</html>