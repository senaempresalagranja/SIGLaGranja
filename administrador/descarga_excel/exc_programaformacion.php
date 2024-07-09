<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_ProgramaFormacion.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM programaformacion");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: PROGRAMA FORMACION </font></div></th>
			<th colspan="5">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO FORMACION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ETAPA LECTIVA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ETAPA PRODUCTIVA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO</strong></th>
				<!--<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>IMAGEN</strong></th>-->
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM programaformacion ORDER BY pfoarea ASC");
			while($reg=pg_fetch_array($res))
			{
				$Area= utf8_decode($reg [1]);
  				$res1=pg_query($con, "SELECT * FROM area WHERE areid='$Area' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[2];
  				}
  				$UniMed1= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed1' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre1=$reg1[2];
  				}
  				$UniMed2= utf8_decode($reg [7]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed2' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre2=$reg1[2];
  				}

				$pfoid=$reg[0];
				$pfonombre=$reg[2];
				$pfotipformac=$reg[3];
				$pfotieelecti=$reg[4];
				$pfotieproduc=$reg[6];
				$pfodescripci=$reg[8];
				//$pfoimagen=$reg[9];
				$profecha=$reg[10];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$pfoid</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$pfonombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$pfotipformac</td>
					<td bgcolor=\"#fff\" align=\"right\">$pfotieelecti</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$pfotieproduc</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"left\">$pfodescripci</td>					
					<td bgcolor=\"#fff\" align=\"right\">$profecha</td>
				</tr>";
				//<td bgcolor=\"#fff\" align=\"center\"><img src='../galeria/$pfoimagen' width='35px'></td>
			}
			?>
			</table>
	</body>
	</html>