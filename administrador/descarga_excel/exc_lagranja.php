<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_LaGranja.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM lagranja");
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
			<th width="1000" colspan="12">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: LA GRANJA </font></div></th>
			<th colspan="13">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO (NIT)</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DIRECCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DEPARTAMENTO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MUNICIPIO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>VEREDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO PREDIAL NUEVO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO PREDIAL ANTERIOR</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MATRICULA INMOBILIARIA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ACTIVIDAD ECONOMICA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA FUNDACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA DE TERRENO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA CONSTRUIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANTIDAD CONSTRUCCIONES</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ALTITUD NIVEL MAR</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NUMERO PLANCHA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESCALA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM lagranja ORDER BY lagnit ASC");
			while($reg=pg_fetch_array($res))
			{
				$lagunimedat= utf8_decode($reg [13]);
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedat' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad1=utf8_decode($reg1[1]);
				}

				$lagunimedac= utf8_decode($reg [15]);
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedac' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad2=utf8_decode($reg1[1]);
				}

				$lagunimedam= utf8_decode($reg [18]);
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedam' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad3=utf8_decode($reg1[1]);
				}

				$lagnit=$reg[1];
				$lagnombre=$reg[2];
				$lagdireccio=$reg[3];
				$lagdepartam=$reg[4];
				$lagmunicipi=$reg[5];
				$lagvereda=$reg[6];
				$lagcodprenu=$reg[7];
				$lagcodprean=$reg[8];
				$lagmatriinm=$reg[9];
				$lagactiecon=$reg[10];
				$lagfecfunda=$reg[11];
				$lagareaterr=$reg[12];
				$lagareconst=$reg[14];
				$lagcanconst=$reg[16];
				$lagaltitud=$reg[17];
				$lagplancha=$reg[19];
				$lagescala=$reg[20];
				$laglatitud=$reg[21];
				$lagorientlat=$reg[22];
				$laglongitud=$reg[23];
				$lagorientlon=$reg[24];
				$lagfecha=$reg[25];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$lagnit</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagnombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagdireccio</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagdepartam</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagmunicipi</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagvereda</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagcodprenu</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagcodprean</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagmatriinm</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagactiecon</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagfecfunda</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagareaterr</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad1</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagareconst</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad2</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagcanconst</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagaltitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad3</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagplancha</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagescala</td>
					<td bgcolor=\"#fff\" align=\"right\">$laglatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$laglongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$lagorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$lagfecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>