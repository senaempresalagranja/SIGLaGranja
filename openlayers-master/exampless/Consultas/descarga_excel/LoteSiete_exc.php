<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA LOTE 7 .xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('conexion.php');
//realizamos la consulta
$consulta=pg_query($con,"SELECT area.arenombre,suelo.suefhumedad,suelo.sueftextura,suelo.sueqph,suelo.suefporocida,lote.lotidcodigo,lote.lotextension,lote.lotunimedlot,lote.lotlatitud,lote.lotorientlat,lote.lotlongitud,lote.lotorientlon,suelo.suefconsiste,suelo.suefcolorter,suelo.suefcondelet,suelo.sueqnitrogen,suelo.sueqfosforo,suelo.sueqpotacio,suelo.sueqelemmeno,suelo.sueqeleminte,suelo.suebmateorga,suelo.suebactimicr,suelo.suebmasmicro,unidad.uniid,cultivo.culidcodigo,canal.canidcodigo  
                FROM lote_cultivo
                  inner join unidad on unidad.uniid = lote_cultivo.lcuunidad
                  inner join lote on lote.lotid = lote_cultivo.lculote
                  inner join cultivo on cultivo.culid = lote_cultivo.lcucultivo
                  inner join canal on canal.canid = lote_cultivo.lcucanal
                  inner join area on area.areid = unidad.uniarea
                  inner join suelo on suelo.sueid = lote.lotsuelo WHERE lote.lotidcodigo='LOTE 7'");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> TABLA LOTE 7 </font></div></th>
    <th colspan="2">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>
<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CULTIVO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANAL</strong></th>
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
$consulta=pg_query($con,"SELECT area.arenombre,suelo.suefhumedad,suelo.sueftextura,suelo.sueqph,suelo.suefporocida,lote.lotidcodigo,lote.lotextension,lote.lotunimedlot,lote.lotlatitud,lote.lotorientlat,lote.lotlongitud,lote.lotorientlon,suelo.suefconsiste,suelo.suefcolorter,suelo.suefcondelet,suelo.sueqnitrogen,suelo.sueqfosforo,suelo.sueqpotacio,suelo.sueqelemmeno,suelo.sueqeleminte,suelo.suebmateorga,suelo.suebactimicr,suelo.suebmasmicro,unidad.uniid,cultivo.culidcodigo,canal.canidcodigo  
                FROM lote_cultivo
                  inner join unidad on unidad.uniid = lote_cultivo.lcuunidad
                  inner join lote on lote.lotid = lote_cultivo.lculote
                  inner join cultivo on cultivo.culid = lote_cultivo.lcucultivo
                  inner join canal on canal.canid = lote_cultivo.lcucanal
                  inner join area on area.areid = unidad.uniarea
                  inner join suelo on suelo.sueid = lote.lotsuelo WHERE lote.lotidcodigo='LOTE 7'");
while ($Reg_LotCul= pg_fetch_array($consulta)) 
            {
              $reg0=$Reg_LotCul[0];
                $reg1=$Reg_LotCul[1];
                $reg2=$Reg_LotCul[2];   
                $reg3=$Reg_LotCul[3];
                $reg4=$Reg_LotCul[4];
                $reg5=$Reg_LotCul[5]; 
                $reg6=$Reg_LotCul[6]; 
                $registrando=$Reg_LotCul[7]; 
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
                $reg23=$Reg_LotCul[23];
                $reg24=$Reg_LotCul[24];
                $reg25=$Reg_LotCul[25];   
               $lotunimedlot=($registrando);
                $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lotunimedlot'");
                 while($registro=pg_fetch_array($res3))
                {
        
                     $unimedlote=($registro[1]);
                 }
              
            
                 $loteunidad=($Reg_LotCul[23]);
                 $res4=pg_query($con,"SELECT * FROM unidad WHERE uniid='$loteunidad'");
                 while($registro_unidad=pg_fetch_array($res4))
                {
                  $unidadLote=utf8_decode($registro_unidad[2]);
                }
               $lotecultivo=($Reg_LotCul[24]);
                 $res5=pg_query($con,"SELECT * FROM cultivo WHERE culidcodigo='$lotecultivo'");
                 while($registro_cultivo=pg_fetch_array($res5))
                {
                  $cultivolot=utf8_decode($registro_cultivo[2]);
                }
                 $lotecanal=($Reg_LotCul[25]);
                 $res6=pg_query($con,"SELECT * FROM canal WHERE canidcodigo='$lotecanal'");
                 while($registro_canal=pg_fetch_array($res6))
                {
                  $canallot=utf8_decode($registro_canal[2]);
                }
               

    
                
echo "
<tr>
<td bgcolor=\"#fff\" align=\"right\">$reg0</td>
<td bgcolor=\"#fff\" align=\"right\">$reg5</td>
<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
<td bgcolor=\"#fff\" align=\"right\">$unimedlote</td>
<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
<td bgcolor=\"#fff\" align=\"center\">$reg9</td>
<td bgcolor=\"#fff\" align=\"center\">$reg10</td>
<td bgcolor=\"#fff\" align=\"center\">$reg11</td>
<td bgcolor=\"#fff\" align=\"center\">$unidadLote</td>
<td bgcolor=\"#fff\" align=\"center\">$cultivolot</td>
<td bgcolor=\"#fff\" align=\"center\">$canallot</td>
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
}
?>
</table></center>
</body>
</html>