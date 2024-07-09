<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RedGas.xls");
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
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RED GAS</font>
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
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONSTRUCCION</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">TIPO MATERIAL</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONEXIONES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">CONTADORES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">VALVULAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">SOPORTES</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">FECHA REGISTRO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM redgas ORDER BY rgaid ASC");
while($reg=pg_fetch_array($res))
{
	$rgaconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rgaconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
						$rgaid=$reg[0];
						$rgatipmateri=$reg[2];
						$rganumvalvul=$reg[3];					
						$rganumconexi=$reg[4];
						$rganumcontad=$reg[5];
						$rganumsoport=$reg[6];
						$elefecha=$reg[7];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$rgaid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$rgatipmateri</td>					
					<td bgcolor=\"#fff\" align=\"right\">$rganumconexi</td>
					<td bgcolor=\"#fff\" align=\"right\">$rganumcontad</td>
					<td bgcolor=\"#fff\" align=\"right\">$rganumvalvul</td>
					<td bgcolor=\"#fff\" align=\"right\">$rganumsoport</td>
					<td bgcolor=\"#fff\" align=\"right\">$elefecha</td>
				</tr>";
				
		}
?>
</table></center>
</body>
</html>