<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_NombreProgramaFormacion.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('conexion.php');
//realizamos la consulta

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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: NOMBRES DE LOS PROGRAMAS DE FORMACION</font></div></th>
    <th colspan="5">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">PROGRAMA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CODIGO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">RESPONSABLE</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO FORMACION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ETAPA LECTIVA</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">DURACION</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ETAPA PRODUCTIVA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">DURACION</th> 
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">DESCRIPCION</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
include ('conexion.php');
$NomProgForma=$_SESSION['NombreProgForm'];

 $Consultar= pg_query($con,"SELECT programaformacion.pfoid, area.arenombre, area.arecoordinad, programaformacion.pfonombre,programaformacion.pfotipformac,programaformacion.pfotieelecti,programaformacion.pfounimedel,programaformacion.pfotieproduc,programaformacion.pfounimedep,programaformacion.pfoimagen,programaformacion.pfodescripci FROM programaformacion
                  INNER JOIN area ON area.areid = programaformacion.pfoarea WHERE pfonombre LIKE '%$NomProgForma%' order by pfonombre asc");
              while ($reg=pg_fetch_array($Consultar)) 
              {
                $pfounimedel=$reg[6];
                $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedel' ");
                while($reg1=pg_fetch_array($res1))
                {
                  $nombre=$reg1[2];
                }

                $pfounimedep=$reg[8];
                $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedep' ");
                while($reg1=pg_fetch_array($res1))
                {
                  $nombre1=$reg1[2];
                }

                echo "
                      <tr>
                        <td>$reg[3]</td>
                        <td>$reg[1]</td>
                        <td>$reg[0]</td>
                        <td>$reg[2]</td>
                        <td>$reg[4]</td>
                        <td>$reg[5]</td>
                        <td>$nombre</td>
                        <td>$reg[7]</td>
                        <td>$nombre1</td>
                        <td>$reg[10]</td>       
                      </tr>";
              }
?>
</table></center>
</body>
</html>