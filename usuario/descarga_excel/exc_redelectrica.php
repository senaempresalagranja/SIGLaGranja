<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RedElectrica.xls");
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
		<th width="1000" colspan="4">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RED ELECTRICA</font>
			</div>
		</th>
		<th width="1000" colspan="3">
			<div style="color:#0000ff; text-shadow:#666;">
				<font size="+2">FECHA: <?php echo $fecha ?></font>
			</div>
		</th>
	</tr>
</table>
<table border="1">						
<tr>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CODIGO</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONSTRUCCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LAMPARAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TOMA CORRIENTES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">INTERRUPTORES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TIPO VENTILACION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CANTIDAD</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM redelectrica ORDER BY eleid ASC");
while($reg=pg_fetch_array($res))
{
	$eleconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$eleconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
						$eleid=$reg[0];
						$elenumlampar=$reg[2];
						$elenumtomaco=$reg[3];					
						$elenuminterr=$reg[4];
						$eletipventil=$reg[5];
						$elecantidad=$reg[6];
						$elefecha=$reg[7];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$eleid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$elenumlampar</td>
					<td bgcolor=\"#fff\" align=\"right\">$elenumtomaco</td>
					<td bgcolor=\"#fff\" align=\"right\">$elenuminterr</td>
					<td bgcolor=\"#fff\" align=\"left\">$eletipventil</td>
					<td bgcolor=\"#fff\" align=\"right\">$elecantidad</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>