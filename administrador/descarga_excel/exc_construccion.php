<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Construccion.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM construccion");
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
			<th width="1000" colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: CONSTRUCCION </font></div></th>
			<th colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO AMBIENTE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CONSTRUCCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CUBIERTA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO PISO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MURO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA CONSTRUCCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REMODELACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM construccion ORDER BY conidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidadmedida= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[1];
  				}
			
  				$unidad=$reg[2];
  				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomUnidad=utf8_decode($reg1[2]);
  				}
				$conidcodigo=$reg[1];
				$connombre=$reg[3];
				$conextension=$reg[4];
				$contipambien=$reg[6];
				$contipconstr=$reg[7];
				$conestado=$reg[8];
				$contipcubiert=$reg[9];
				$contippiso=$reg[10];
				$contipmuro=$reg[11];
				$confecconstr=$reg[12];
				$confecremode=$reg[13];
				$conlatitud=$reg[14];
				$conorientlat=$reg[15];
				$conlongitud=$reg[16];
				$conorientlon=$reg[17];
				$fecha=$reg[18];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$conidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUnidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$connombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$conextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$contipambien</td>
					<td bgcolor=\"#fff\" align=\"left\">$contipconstr</td>
					<td bgcolor=\"#fff\" align=\"left\">$conestado</td>
					<td bgcolor=\"#fff\" align=\"left\">$contipcubiert</td>
					<td bgcolor=\"#fff\" align=\"left\">$contippiso</td>
					<td bgcolor=\"#fff\" align=\"left\">$contipmuro</td>
					<td bgcolor=\"#fff\" align=\"right\">$confecconstr</td>
					<td bgcolor=\"#fff\" align=\"right\">$confecremode</td>
					<td bgcolor=\"#fff\" align=\"right\">$conlatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$conorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$conlongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$conorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>