<?php
$nombre=$_REQUEST['name'];
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA $nombre .xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('conexion.php');
//realizamos la consulta
$consulta=pg_query($con,"SELECT area.arenombre,
                suelo.suefhumedad,
                suelo.sueftextura,
                suelo.sueqph,
                suelo.suefporocida,
                unidad.uninombre,
                unidad.uniextension,
                unidad.uniunimedida,
                unidad.unilatitud,
                unidad.uniorientlat,
                unidad.unilongitud,
                unidad.uniorientlon,
                suelo.suefconsiste,
                suelo.suefcolorter,
                suelo.suefcondelet,
                suelo.sueqnitrogen,
                suelo.sueqfosforo,
                suelo.sueqpotacio,
                suelo.sueqelemmeno,
                suelo.sueqeleminte,
                suelo.suebmateorga,
                suelo.suebactimicr,
                suelo.suebmasmicro
                FROM unidad     
                  inner join area on area.areid = unidad.uniarea
                  inner join suelo on suelo.sueid = unidad.unisuelo
                WHERE unidad.uninombre='$nombre'");
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
    <th width="1000" colspan="24">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> TABLA <?php echo $nombre ?> </font></div></th>
    <th colspan="2">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>
<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CULTIVO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RUTA</strong></th>

<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HUMEDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TEXTURA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PH</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>POROSIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CONSISTENCIA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>COLOR TERMICO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CONDENSACION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NITROGENO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FOSFORO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>POTASIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ELEMENTOS MENORES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ELEMENTOS MENORES TERMICOS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MATERIA ORGANICA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>BACTERIAS MICROBIOLOGICAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SUEBMASMICRO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA</strong></th>
</tr>
<?php
$consulta=pg_query($con,"SELECT area.arenombre,
                suelo.suefhumedad,
                suelo.sueftextura,
                suelo.sueqph,
                suelo.suefporocida,
                unidad.uninombre,
                unidad.uniextension,
                unidad.uniunimedida,
                unidad.unilatitud,
                unidad.uniorientlat,
                unidad.unilongitud,
                unidad.uniorientlon,
                suelo.suefconsiste,
                suelo.suefcolorter,
                suelo.suefcondelet,
                suelo.sueqnitrogen,
                suelo.sueqfosforo,
                suelo.sueqpotacio,
                suelo.sueqelemmeno,
                suelo.sueqeleminte,
                suelo.suebmateorga,
                suelo.suebactimicr,
                suelo.suebmasmicro
                FROM unidad     
                  inner join area on area.areid = unidad.uniarea
                  inner join suelo on suelo.sueid = unidad.unisuelo
                WHERE unidad.uninombre='$nombre'");
while ($Reg_LotCul= pg_fetch_array($consulta)) 
            {
              
               $reg0=$Reg_LotCul[0];
                $reg1=$Reg_LotCul[1];
                $reg2=$Reg_LotCul[2];   
                $reg3=$Reg_LotCul[3];
                $reg4=$Reg_LotCul[4];
                $reg5=$Reg_LotCul[5]; 
                $reg6=$Reg_LotCul[6]; 
                $reg7=$Reg_LotCul[7]; 
                $reg8=$Reg_LotCul[8]; 
                $reg9=$Reg_LotCul[9]; 
                $reg10=$Reg_LotCul[10]; 
                $reg11=$Reg_LotCul[11];
                $reg12=$Reg_LotCul[12];
                $reg13=$Reg_LotCul[13];
                $reg14=$Reg_LotCul[14];   
                $reg15=$Reg_LotCul[15];
                $reg16=$Reg_LotCul[16];
                $reg17=$Reg_LotCul[17]; 
                $reg18=$Reg_LotCul[18]; 
                $reg19=$Reg_LotCul[19]; 
                $reg20=$Reg_LotCul[20]; 
                $reg21=$Reg_LotCul[21]; 
                $reg22=$Reg_LotCul[22]; 
              


              $uniunimedida=($reg7);
                $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$uniunimedida ");
                 while($registro=pg_fetch_array($res3))
                {
        
                     $unimedlote=($registro[1]);
                 }
              
            }
              
            
                 $con_unidades= pg_query($con, "SELECT DISTINCT unidad.uninombre
                        FROM unidad_cultivo 
                       
                        INNER JOIN unidad ON unidad.uniid = unidad_cultivo.lcuunidad  WHERE unidad.uninombre='$nombre'" );
                        while ($resultado_u= pg_fetch_array($con_unidades))
                            {

                                for($i=0;$i<1;$i++) 
                                    {
                                        echo '<div class="whilefor">'.$resultado_u[$i].'<br>'.'</div>';
                                    }
                            }


               $con_cultivo= pg_query($con, "SELECT DISTINCT cultivo.culnomcomun
                        FROM unidad_cultivo
                        inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad 
                        INNER JOIN cultivo ON cultivo.culid = unidad_cultivo.lcucultivo  WHERE unidad.uninombre='$nombre'" );
                        while ($resultado= pg_fetch_array($con_cultivo))
                            {
                              
                                for($i=0;$i<1;$i++) 
                                    {
                                        echo '<div class="whilefor">'. $resultado[$i].'<BR>'.'</div>';
                                    }
                            }


                $con_canales= pg_query($con, "SELECT DISTINCT canal.cannombre
                        FROM unidad
                        -- inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad                        
                        INNER JOIN canal ON canal.canid= unidad.unicanal  WHERE unidad.uninombre='$nombre'" );
                        while ($resultado1= pg_fetch_array($con_canales))
                            {

                                for($i=0;$i<1;$i++) 
                                    {
                                        echo'<div class="whilefor">'. $resultado1[$i].'<BR>'.'</div>';
                                    }
                            }

                            $con_ruta= pg_query($con, "SELECT DISTINCT 
                                                                    ruta.rutnombre, 
                                                                    unidad.uninombre
                                                FROM ruta_unidad
                                                INNER JOIN ruta ON ruta.rutid= ruta_unidad.runruta
                                                INNER JOIN unidad ON unidad.uniid= ruta_unidad.rununidad
                                                WHERE unidad.uninombre='$nombre'" );
                                        while ($resultado2= pg_fetch_array($con_ruta))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado2[$i].'<BR>'.'</div>';
                                                    }
                            }

               

    
                
echo "
<tr>
<td bgcolor=\"#fff\" align=\"right\">$reg0</td>
<td bgcolor=\"#fff\" align=\"right\">$reg6</td>
<td bgcolor=\"#fff\" align=\"right\">$unimedlote</td>
<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
<td bgcolor=\"#fff\" align=\"center\">$reg9</td>
<td bgcolor=\"#fff\" align=\"center\">$reg10</td>
<td bgcolor=\"#fff\" align=\"center\">$reg11</td>
<td bgcolor=\"#fff\" align=\"center\">$reg5</td>
<td bgcolor=\"#fff\" align=\"center\">$</td>
<td bgcolor=\"#fff\" align=\"center\">$</td>
<td bgcolor=\"#fff\" align=\"center\">$</td>
<td bgcolor=\"#fff\" align=\"right\">$reg1</td>
<td bgcolor=\"#fff\" align=\"center\">$reg2</td>
<td bgcolor=\"#fff\" align=\"center\">$reg3</td>
<td bgcolor=\"#fff\" align=\"center\">$reg4</td>
<td bgcolor=\"#fff\" align=\"center\">$reg12</td>
<td bgcolor=\"#fff\" align=\"center\">$reg13</td>
<td bgcolor=\"#fff\" align=\"center\">$reg14</td>
<td bgcolor=\"#fff\" align=\"center\">$reg15</td>
<td bgcolor=\"#fff\" align=\"center\">$reg16</td>
<td bgcolor=\"#fff\" align=\"center\">$reg17</td>
<td bgcolor=\"#fff\" align=\"center\">$reg18</td>
<td bgcolor=\"#fff\" align=\"center\">$reg19</td>
<td bgcolor=\"#fff\" align=\"center\">$reg20</td>
<td bgcolor=\"#fff\" align=\"center\">$reg21</td>
<td bgcolor=\"#fff\" align=\"center\">$reg22</td>
<td bgcolor=\"#fff\" align=\"right\">$fecha</td>
</tr>";

?>
</table></center>
</body>
</html>