<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Ruta.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM ruta");
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
			<th width="1000" colspan="8">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RUTA </font></div></th>
			<th colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO RECORRIDO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD INICIAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD INICIAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD FINAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD FINAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIENTACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM ruta ORDER BY rutidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$rununimeddis= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimeddis' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[1];
  				}
			
  				$rununimedtie=$reg[7];
  				$con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedtie' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $nombre1=utf8_decode($reg1[2]);
  				}

				$rutidcodigo=$reg[1];
				$rutnombre=$reg[2];
				$rutestado=$reg[3];
				$rutdistancia=$reg[4];
				$ruttierecorr=$reg[6];
				$rutlatitudi=$reg[8];
				$rutorienlati=$reg[9];
				$rutlongitudi=$reg[10];
				$rutorienloni=$reg[11];
				$rutlatitudf=$reg[12];
				$rutorienlatf=$reg[13];
				$rutlongitudf=$reg[14];
				$rutorienlonf=$reg[15];
				$rutdescripci=$reg[16];
				$rutfecha=$reg[17];

				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$rutidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutnombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutestado</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutdistancia</td>					
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"right\">$ruttierecorr</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutlatitudi</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutorienlati</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutlongitudi</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutorienloni</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutlatitudf</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutorienlatf</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutlongitudf</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutorienlonf</td>
					<td bgcolor=\"#fff\" align=\"left\">$rutdescripci</td>
					<td bgcolor=\"#fff\" align=\"right\">$rutfecha</td>
				</tr>";
			}
			?>			
			</table>
	</body>
	</html>