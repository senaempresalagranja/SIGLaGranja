<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Cultivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res1=pg_query($con, "SELECT * FROM cultivo");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: CULTIVO </font></div></th>
			<th colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIGEN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA SIEMBRA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CLIMA FAVORABLE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>VIDA UTIL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO</strong></th>
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
			$res=pg_query($con, "SELECT * FROM cultivo ORDER BY culidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$umeid= utf8_decode($reg [8]);
				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid' ");
				while($reg1=pg_fetch_array($res1))
				{
					$nomunidad=utf8_decode($reg1[1]);
				}

				$umeid1= utf8_decode($reg [12]);
				$res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid1' ");
				while($reg2=pg_fetch_array($res2))
				{
					$nomunidad1=utf8_decode($reg2[1]);
				}


				$culidcodigo=$reg[1];
				$culnomcomun=$reg[2];
				$culnomcienti=$reg[3];
				$culorigen=$reg[4];
				$cullugarorig=$reg[5];
				$culclimafavo=$reg[6];
				$culdistsiemb=$reg[7];
				$culvidautil=$reg[9];
				$cultiempvida=$reg[10];
				$culextension=$reg[11];
				$cullatitud=$reg[13];
				$culorientlat=$reg[14];
				$cullongitud=$reg[15];
				$culorientlon=$reg[16];
				$fecha=$reg[17];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"left\">$culidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$culnomcomun</td>
					<td bgcolor=\"#fff\" align=\"left\">$culnomcienti</td>
					<td bgcolor=\"#fff\" align=\"left\">$culorigen</td>
					<td bgcolor=\"#fff\" align=\"left\">$cullugarorig</td>
					<td bgcolor=\"#fff\" align=\"right\">$culdistsiemb</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$culclimafavo</td>					
					<td bgcolor=\"#fff\" align=\"right\">$culvidautil</td>
					<td bgcolor=\"#fff\" align=\"left\">$cultiempvida</td>
					<td bgcolor=\"#fff\" align=\"right\">$culextension</td>
					<td bgcolor=\"#fff\" align=\"left\">$nomunidad1</td>
					<td bgcolor=\"#fff\" align=\"right\">$cullatitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$culorientlat</td>
					<td bgcolor=\"#fff\" align=\"right\">$cullongitud</td>
					<td bgcolor=\"#fff\" align=\"left\">$culorientlon</td>
					<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>