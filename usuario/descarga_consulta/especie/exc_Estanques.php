<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Estanques.xls");
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
    <th width="1000" colspan="10">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: TODOS ESTANQUES</font></div></th>
    <th colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE</th>          
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO ESTANQUE</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">PROFUNDIDAD</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">ESPEJO AGUA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF" colspan="2">VOLUMEN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO ESPECIE</th> 
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>  
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
 $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              estanque.estnombre,
                              estanque.esttipestanq,
                              estanque.estprofundid,
                              estanque.estunimedpro,
                              estanque.estespejagua,
                              estanque.estunimedesp,
                              estanque.estvolumagua,
                              estanque.estunimedvol,
                              especieacuatica.eactipespeci,
                              especieacuatica.eacnomcomun,
                              especieacuatica.eacnomcienti
                      FROM estanque_especieacuatica
                      INNER JOIN especieacuatica ON especieacuatica.eacid = estanque_especieacuatica.eeaespacua
                      INNER JOIN estanque ON estanque.estid = estanque_especieacuatica.eeaestanque
                      INNER JOIN unidad ON unidad.uniid = especieacuatica.eacunidad
                      INNER JOIN area ON area.areid = unidad.uniarea order by estnombre asc");

            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $estunimedpro=$reg[5];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $estunimedesp=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1 =$reg1[1];
                        }

                        $estunimedvol=$reg[9];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol'");

                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre2=$reg1[1];
                        }
                        
                        echo "<tr>";
                        echo "<td align=\"left\">$reg[0]</td>";
                        echo "<td align=\"left\">$reg[1]</td>";
                        echo "<td align=\"left\">$reg[2]</td>";
                        echo "<td align=\"left\">$reg[3]</td>";
                        echo "<td align=\"right\">$reg[4]</td>";
                        echo "<td align=\"left\">$nombre</td>";
                        echo "<td align=\"right\">$reg[6]</td>";
                        echo "<td align=\"left\">$nombre1</td>";
                        echo "<td align=\"right\">$reg[8]</td>";
                        echo "<td align=\"left\">$nombre2</td>";
                        echo "<td align=\"left\">$reg[10]</td>";
                        echo "<td align=\"left\">$reg[11]</td>";
                        echo "<td align=\"left\">$reg[12]</td>";
                        echo "</tr>";                   
                      }
?>
</table></center>
</body>
</html>