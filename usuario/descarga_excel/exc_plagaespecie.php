<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_PlagaEspecie.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM plaga_especie");
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
			<th width="1000" colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PLAGA ESPECIE</font></div></th>
			<th colspan="2">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESPECIE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PLAGA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM plaga_especie ORDER BY peskidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$especie= utf8_decode($reg [2]);
				$res1=pg_query($con, "SELECT * FROM especie WHERE espid='$especie' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun=$reg1[3];
				}
				$plaga= utf8_decode($reg [3]);
				$res1=pg_query($con, "SELECT * FROM plaga WHERE plaid='$plaga' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomcomun1=$reg1[2];
				}
				$codigo=$reg[1];
				$pesdescripci=$reg[4];
				$pesfecha=$reg[5];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"right\">$codigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomcomun1</td>
					<td bgcolor=\"#fff\" align=\"left\">$pesdescripci</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>