<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_EstanqueEspecieacuatica.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM estanque_especieacuatica");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ESTANQUE ESPECIE ACUATICA</font></div></th>
			<th colspan="3">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTANQUE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESPECIE ACUATICA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RESPONSABLE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA SIEMBRA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA COSECHA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM estanque_especieacuatica ORDER BY eeapkcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$estanque= utf8_decode($reg [2]);
				$res1=pg_query($con, "SELECT * FROM estanque WHERE estid='$estanque' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun=utf8_decode($reg1[1]);
				}
				$especieacuatica= utf8_decode($reg [3]);
				$res1=pg_query($con, "SELECT * FROM especieacuatica WHERE eacid='$especieacuatica' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun1=utf8_decode($reg1[3]);
				}
				$eeapkcodigo=$reg[1];
				$eearesponsab=$reg[4];
				$eeafecsiembr=$reg[5];
				$eeafeccosech=$reg[6];
				$eeadescripci=$reg[7];
				$eeafecha=$reg[8];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$eeapkcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun1</td>
					<td bgcolor=\"#fff\" align=\"left\">$eearesponsab</td>
					<td bgcolor=\"#fff\" align=\"right\">$eeafecsiembr</td>
					<td bgcolor=\"#fff\" align=\"right\">$eeafeccosech</td>
					<td bgcolor=\"#fff\" align=\"left\">$eeadescripci</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>