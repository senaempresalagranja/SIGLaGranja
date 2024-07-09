<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_LoteCultivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('../conexion.php');
//realizamos la consulta
$res=pg_query($con, "SELECT * FROM lote_cultivo");
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
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: LOTE CULTIVO </font></div></th>
			<th colspan="9">
				<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
			</th>
		</tr>
	</table>

		<table width="641" border="1">
			<tr>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LOTE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CULTIVO</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PLAGA/ENFERMEDAD</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA SIEMBRA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA COSECHA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PRODUCCION ESTIMADA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PRODUCCION REAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>COSTO PRODUCCION ESTIMADA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>COSTO PRODUCCION REAL</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UND-MEDIDA</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RESPONSABLE</strong></th>
				<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>

			</tr>
			<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
			$res=pg_query($con, "SELECT * FROM lote_cultivo ORDER BY lcuid ASC");
			while($reg=pg_fetch_array($res))
			{
				$codigo=$reg[0];
				$lote=$reg[1];
				$conLot=pg_query($con, "SELECT * FROM lote WHERE lotid='$lote' ");
				while($reg1=pg_fetch_array($conLot))
				{
					$CodLot=$reg1[1];
				}

				$cultivo=$reg[2];
				$con1=pg_query($con, "SELECT * FROM cultivo WHERE culid='$cultivo' ");
				while($reg1=pg_fetch_array($con1))
				{
					$NomComun=$reg1[2];
				}

				$unidad=$reg[3];
				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
				while($reg1=pg_fetch_array($con2))
				{
					$NomUnidad=$reg1[2];
				}

				$fechasiembra=$reg[4];
				$fechacosecha=$reg[5];
				$prodestimada=$reg[6];

				$undmedida=$reg[7];
				$con3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida' ");
				while($reg1=pg_fetch_array($con3))
				{
					$NomUniMed=$reg1[1];
				}

				$prodreal=$reg[8];

				$undmedida1=$reg[9];
				$con4=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida1' ");
				while($reg1=pg_fetch_array($con4))
				{
					$NomUniMed1=$reg1[1];
				}

				$cosproestimada=$reg[10];

				$undmedida2=$reg[11];
				$con5=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida2' ");
				while($reg1=pg_fetch_array($con5))
				{
					$NomUniMed2=$reg1[1];
				}

				$cosproreal=$reg[12];

				$undmedida3=$reg[13];
				$con6=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida3' ");
				while($reg1=pg_fetch_array($con6))
				{
					$NomUniMed3=$reg1[1];
				}

				$responsable=$reg[14];				
				$fecha=$reg[15];

				$canal=$reg[16];
				$con7=pg_query($con, "SELECT * FROM canal WHERE canid='$canal' ");
				while($reg1=pg_fetch_array($con7))
				{
					$NomCanal=$reg1[2];
				}

				$plagaenfermedad=$reg[17];
				$con8=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$plagaenfermedad' ");
				while($reg1=pg_fetch_array($con8))
				{
					$NomComunPlaEnf=$reg1[2];
				}
				echo "
				<tr>
					<td bgcolor=\"#fff\" align=\"center\">$codigo</td>
					<td bgcolor=\"#fff\" align=\"left\">$CodLot</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomComun</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUnidad</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomCanal</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomComunPlaEnf</td>
					<td bgcolor=\"#fff\" align=\"right\">$fechasiembra</td>
					<td bgcolor=\"#fff\" align=\"right\">$fechacosecha</td>
					<td bgcolor=\"#fff\" align=\"right\">$prodestimada</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUniMed</td>
					<td bgcolor=\"#fff\" align=\"right\">$prodreal</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUniMed1</td>
					<td bgcolor=\"#fff\" align=\"right\">$cosproestimada</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUniMed2</td>
					<td bgcolor=\"#fff\" align=\"right\">$cosproreal</td>
					<td bgcolor=\"#fff\" align=\"left\">$NomUniMed3</td>
					<td bgcolor=\"#fff\" align=\"left\">$responsable</td>
					<td bgcolor=\"#fff\" align=\"left\">$fecha</td>					
				</tr>";
			}
			?>
			</table>
	</body>
	</html>