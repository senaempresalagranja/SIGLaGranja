<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_RutaUnidad.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM ruta_unidad");
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
			<th width="1000" colspan="4">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: RUTA UNIDAD</font></div></th>
			<th colspan="4">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>

				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
			    <th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RUTA</strong></th>
			    <th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
			    <th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA</strong></th>
			    <th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
			    <th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO RECORRIDO</strong></th> 
		     	<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
		     	<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO RUTA</strong></th>


			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM ruta_unidad ORDER BY runkidcodigo ASC");
    while($reg=pg_fetch_array($res))
    {
      $runruta= utf8_decode($reg [3]);
      $res1=pg_query($con, "SELECT * FROM ruta WHERE rutid='$runruta' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[2];
      }
      $unidad= utf8_decode($reg [2]);
      $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }

      $unidad_medida= utf8_decode($reg [5]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre2=$reg1[1];
      }

      $unidad_medida1= utf8_decode($reg [7]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida1' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre3=$reg1[2];
      }
      $runkidcodigo=$reg[1];
      $rundistancia=$reg[4];
      $runtierecorr=$reg[6];
      $runtipruta=$reg[8];
      $runfecha=$reg[9];
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$runkidcodigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre1</td>
					<td bgcolor=\"#fff\" align=\"right\">$rundistancia</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre2</td>
					<td bgcolor=\"#fff\" align=\"right\">$runtierecorr</td>
					<td bgcolor=\"#fff\" align=\"left\">$nombre3</td>
					<td bgcolor=\"#fff\" align=\"left\">$runtipruta</td>
				</tr>";
			}
			?>
			</table>
	</body>
	</html>