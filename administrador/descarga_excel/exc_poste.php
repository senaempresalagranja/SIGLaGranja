<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Poste.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM poste");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: POSTE </font></div></th>
			<th colspan="8">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MATERIAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ALTURA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO TENSION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ILUMINACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO ILUMINACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRANSFORMADOR</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO TRANSFORMADOR</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RUTA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM poste ORDER BY posidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidadmedida= utf8_decode($reg [6]);
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

  				$ruta=$reg[12];
  				$con2=pg_query($con, "SELECT * FROM ruta WHERE rutid='$ruta' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomRuta=$reg1[2];
  				}
				$posidcodigo=$reg[1];
				$postipmateri=$reg[3];
				$posestado=$reg[4];
				$posaltura=$reg[5];
				$postiptensio=$reg[7];
				$posalumbrado=$reg[8];
				$posestalumbr=$reg[9];
				$postransform=$reg[10];
				$posesttransf=$reg[11];
				$poslatitud=$reg[13];
				$posorientlat=$reg[14];
				$poslongitud=$reg[15];
				$posorientlon=$reg[16];
				$posfecha=$reg[17];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$posidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUnidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$postipmateri</td>
					<td bgcolor=\"#fff\" align=\"left\">$posestado</td>					
					<td bgcolor=\"#fff\" align=\"right\">$posaltura</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$postiptensio</td>
					<td bgcolor=\"#fff\" align=\"left\">$posalumbrado</td>
					<td bgcolor=\"#fff\" align=\"left\">$posestalumbr</td>
					<td bgcolor=\"#fff\" align=\"left\">$postransform</td>
					<td bgcolor=\"#fff\" align=\"left\">$posesttransf</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomRuta</td>
					<td bgcolor=\"#fff\" align=\"right\">$poslatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$posorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$poslongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$posorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$posfecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>