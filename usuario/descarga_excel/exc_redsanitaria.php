<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RedSanitaria.xls");
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
				<font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RED SANITARIA</font>
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
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">BATERIAS SANITARIAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">DUCHAS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">LAVAMANOS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">GRIFOS</th>
<th width="50%" style="background-color:#0000FF; text-align:center; color:#FFF">SIFONES</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
$res=pg_query($con, "SELECT * FROM redsanitaria ORDER BY rsaid ASC");
while($reg=pg_fetch_array($res))
{
	$rsaconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
						$rsaid=$reg[0];
						$rsannumbater=$reg[2];
						$rsanumducha=$reg[3];					
						$rsanumlavama=$reg[4];
						$sannumgrifos=$reg[5];
						$sannumsifon=$reg[6];
						$sanfecha=$reg[7];
	echo "	<tr>
					<td bgcolor=\"#fff\" align=\"center\">$rsaid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$rsannumbater</td>
					<td bgcolor=\"#fff\" align=\"right\">$rsanumducha</td>
					<td bgcolor=\"#fff\" align=\"right\">$rsanumlavama</td>
					<td bgcolor=\"#fff\" align=\"right\">$sannumgrifos</td>
					<td bgcolor=\"#fff\" align=\"right\">$sannumsifon</td>
			</tr>";
				
		}
?>
</table></center>
</body>
</html>