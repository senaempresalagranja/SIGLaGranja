<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_ZonaVerde.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM zonaverde");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: ZONA VERDE </font></div></th>
				<th colspan="5">
					<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
				</th>
			</tr>
		</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO RIEGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>				
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM zonaverde ORDER BY zveidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidad=$reg[2];
  				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomUnidad=utf8_decode($reg1[2]);
  				}

  				$unidadmedida= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[1];
  				}

				$zveidcodigo=$reg[1];
				$zvetipriego=$reg[3];
				$zveextension=$reg[4];
				$zvelatitud=$reg[6];
				$zveorientlat=$reg[7];
				$zvelongitud=$reg[8];
				$zveorientlon=$reg[9];
				$zvefecha=$reg[10];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$zveidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUnidad</td>
					<td bgcolor=\"#fff\" align=\"right\">$zveextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$zvetipriego</td>
					<td bgcolor=\"#fff\" align=\"right\">$zvelatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$zveorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$zvelongitud</td>					
					<td bgcolor=\"#fff\" align=\"left\">$zveorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$zvefecha</td>
				</tr>";
			}
			?>
		</table>
	</body>
	</html>