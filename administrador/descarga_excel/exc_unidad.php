<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Unidad.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM unidad");
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
			<th width="1000" colspan="6">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: UNIDAD </font></div></th>
			<th colspan="5">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RESPONSABLE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM unidad ORDER BY uniarea ASC");
			while($reg=pg_fetch_array($res))
			{
				$uniarea= utf8_decode($reg [1]);
				$res1=pg_query($con, "SELECT * FROM area WHERE areid='$uniarea' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nombre=$reg1[2];
				}

				$uniunimedida= utf8_decode($reg [4]);
				$res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$uniunimedida' ");
				while($reg2=pg_fetch_array($res2))
				{
					$nombre1=$reg2[1];
				}

				$uninombre=$reg[2];
				$uniextension=$reg[3];
				$uniresponsab=$reg[5];
				$unilatitud=$reg[6];
				$uniorientlat=$reg[7];
				$unilongitud=$reg[8];
				$uniorientlon=$reg[9];
				$unidescripci=$reg[10];
				$unifecha=$reg[11];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$uninombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$uniextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"left\">$uniresponsab</td>
					<td bgcolor=\"#fff\" align=\"right\">$unilatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$uniorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$unilongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$uniorientlon</td>
					<td bgcolor=\"#fff\" align=\"left\">$unidescripci</td>
					<td bgcolor=\"#fff\" align=\"right\">$unifecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>