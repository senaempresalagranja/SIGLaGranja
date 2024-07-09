<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Suelo.xls");
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
		<th width="1000" colspan="14">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: SUELO</font>
			</div>
		</th>
		<th width="1000" colspan="14">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">HUMEDAD </th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TEXTURA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">POROCIDAD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONSISTENCIA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">COLOR</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONDUCTIVIDAD ELECTRICA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">NITROGENO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FOSFORO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">POTACIO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ELEMENTOS MENORES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ELEMENTOS INTERCAMBIO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PH</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ACTIVIDAD MICROBIANA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">MASA MICROBIANA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">MATERIA ORGANICA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM suelo ORDER BY sueid ASC");
while($reg=pg_fetch_array($res))
{
	$sueunimedhu= utf8_decode($reg [2]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedhu' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
	$sueunimedpo=utf8_decode($reg[5]);	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpo' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1=$reg1[1];
	}
	$sueunimedco=utf8_decode($reg[7]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedco' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=$reg1[1];
	}
	$sueunimedel=utf8_decode($reg[10]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedel' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre3=$reg1[1];
	}
	$sueunimedni=utf8_decode($reg[12]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedni' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre4=$reg1[1];
	}
	$sueunimedfo=utf8_decode($reg[14]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedfo' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre5=$reg1[1];
	}
	$sueunimedpt=utf8_decode($reg[16]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpt' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre6=$reg1[1];
	}
	$sueunimedph=utf8_decode($reg[20]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedph' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre7=$reg1[1];
	}
	$sueunimedma=utf8_decode($reg[22]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedma' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre8=$reg1[1];
	}
	$sueunimedam=utf8_decode($reg[24]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedam' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre9=$reg1[1];
	}
	$sueunimedmm=utf8_decode($reg[26]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedmm' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre10=$reg1[1];
	}

	$sueid= $reg[0];
    $suefhumedad= $reg[1];
    $sueftextura= $reg[3];
    $suefporocida= $reg[4];
    $suefconsiste= $reg[6];
    $suefcolorter= $reg[8];
    $suefcondelet= $reg[9];
    $sueqnitrogen= $reg[11];
    $sueqfosforo= $reg[13];
    $sueqpotacio= $reg[15];
    $sueqelemmeno= $reg[17];
    $sueqeleminte= $reg[18];
    $sueqph= $reg[19];
    $suebmateorga= $reg[21];
    $suebactimicr= $reg[23];
    $suebmasmicro= $reg[25];
    $suefecha= $reg[27];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$sueid</td>
					<td bgcolor=\"#fff\" align=\"right\">$suefhumedad</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$sueftextura</td>
					<td bgcolor=\"#fff\" align=\"right\">$suefporocida</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$suefconsiste</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"left\">$suefcolorter</td>
					<td bgcolor=\"#fff\" align=\"right\">$suefcondelet</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre3</td>
					<td bgcolor=\"#fff\" align=\"right\">$sueqnitrogen</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre4</td>
					<td bgcolor=\"#fff\" align=\"right\">$sueqfosforo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre5</td>
					<td bgcolor=\"#fff\" align=\"right\">$sueqpotacio</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre6</td>
					<td bgcolor=\"#fff\" align=\"left\">$sueqelemmeno</td>
					<td bgcolor=\"#fff\" align=\"left\">$sueqeleminte</td>
					<td bgcolor=\"#fff\" align=\"right\">$sueqph</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre7</td>					
					<td bgcolor=\"#fff\" align=\"right\">$suebactimicr</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre9</td>
					<td bgcolor=\"#fff\" align=\"right\">$suebmasmicro</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre10</td>
					<td bgcolor=\"#fff\" align=\"right\">$suebmateorga</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre8</td>
					<td bgcolor=\"#fff\" align=\"right\">$suefecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>