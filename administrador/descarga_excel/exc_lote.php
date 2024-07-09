<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Lote.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM lote");
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
			<th width="1000" colspan="5">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: LOTE</font></div></th>
			<th colspan="4">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SUELO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM lote ORDER BY lotidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$lotsuelo= $reg [2];
				$res1=pg_query($con, "SELECT * FROM suelo WHERE sueid='$lotsuelo' ");
				while($reg1=pg_fetch_array($res1))
				{
					$sueftextura=$reg1[3];
				}
				$lotunimedlot= $reg [4];
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lotunimedlot' ");
				while($reg1=pg_fetch_array($res1))
				{
					$umerepreset=$reg1[1];
				}
				$lotidcodigo=$reg[1];
				$lotextension=$reg[3];
				$lotlatitud=$reg[5];
				$lotorientlat=$reg[6];
				$lotlongitud=$reg[7];
				$lotorientlon=$reg[8];
				$lotfecha=$reg[9];//Esta es la fecha del día en que se hizo el registro, no la fecha del reporte generado por el sistema
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$lotidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$sueftextura</td>
					<td bgcolor=\"#fff\" align=\"right\">$lotextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$umerepreset</td>
					<td bgcolor=\"#fff\" align=\"right\">$lotlatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$lotorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$lotlongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$lotorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$lotfecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>