<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Estanque.xls");
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
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ESTANQUE</font>
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
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">NOMBRE</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TIPO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">PROFUNDIDAD</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">ESPEJO AGUA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">VOLUMEN AGUA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">UND-MEDIDA</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM estanque ORDER BY estnombre ASC");
while($reg=pg_fetch_array($res))
{
	$estunimedpro= utf8_decode($reg [4]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
	$estunimedesp=utf8_decode($reg[6]);	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1=$reg1[1];
	}
	$estunimedvol=utf8_decode($reg[8]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=$reg1[1];
	}
						$estid=$reg[0];
						$estnombre=$reg[1];
						$esttipestanq=$reg[2];
						$estprofundid=$reg[3];					
						$estespejagua=$reg[5];
						$estvolumagua=$reg[7];
						$estfecha=$reg[9];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$estid</td>
					<td bgcolor=\"#fff\" align=\"left\">$estnombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$esttipestanq</td>
					<td bgcolor=\"#fff\" align=\"right\">$estprofundid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$estespejagua</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$estvolumagua</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"right\">$estfecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>