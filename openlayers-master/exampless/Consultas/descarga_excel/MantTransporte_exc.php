<?php 
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA TRANSPORTE Y MANTENIMIENTO.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor Postgresql
include ('conexion.php');
//realizamos la consulta
?>
<?php
 $fecha= date("d/m/y",time()-25200);
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">TRANSPORTE Y MANTENIMIENTO </font></div></th>
    <th colspan="1">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>
<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RESPONSABLE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>


<?php
    include 'conexion.php';

            $consulta=pg_query($con,"SELECT 
       area.arenombre,
       unidad.uninombre,
       unidad.uniextension,
       unidad.uniunimedida,
       unidad.uniresponsab,
       unidad.unilatitud,
       unidad.uniorientlat,
       unidad.unilongitud,
       unidad.uniorientlon,
       unidad.unidescripci
       FROM unidad
                  inner join area on area.areid = unidad.uniarea
                   WHERE unidad.uninombre='TRANSPORTE Y MANTENIMIENTO'");
                    
            while ($Reg_Construcc= pg_fetch_array($consulta)) 
                {
                    $reg0=$Reg_Construcc[0];
                    $reg1=$Reg_Construcc[1];
                    $reg2=$Reg_Construcc[2];
                    $reg3=$Reg_Construcc[3];
                    $reg4=$Reg_Construcc[4];
                    $reg5=$Reg_Construcc[5];
                    $reg6=$Reg_Construcc[6];
                    $reg7=$Reg_Construcc[7];
                    $reg8=$Reg_Construcc[8];
                    $reg9=$Reg_Construcc[9];
                    
                     $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg3");
                                        while($registro_constr=pg_fetch_array($res1))
                                            {
                                                $nombre1=($registro_constr[1]);
                                            }
                                   
                     echo "
				<tr>
				<td bgcolor=\"#fff\" align=\"center\">$reg0</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg1</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg2</td>
				<td bgcolor=\"#fff\" align=\"center\">$nombre1</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg4</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg5</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg7</td>
        <td bgcolor=\"#fff\" align=\"center\">$reg8</td>
        <td bgcolor=\"#fff\" align=\"center\">$reg9</td>
              
				";

	}

?>

</table></center>