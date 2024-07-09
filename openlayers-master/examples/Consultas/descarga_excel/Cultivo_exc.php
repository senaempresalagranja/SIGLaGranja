<?php
$nombre=$_REQUEST['name'];
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Cultivo $nombre.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
include ('conexion.php');
//realizamos la consulta
$consulta=pg_query($con,"SELECT 
       area.arenombre,
       unidad.uninombre,
       -- lote.lotidcodigo,
       cultivo.culextension,
       cultivo.culunimedida,
       cultivo.cullatitud,
       cultivo.culorientlat,
       cultivo.cullongitud,
       cultivo.culorientlon,
       cultivo.culnomcomun,
       cultivo.culnomcienti,
       cultivo.culorigen,
       cultivo.cullugarorig,
       cultivo.culclimafavo,
       cultivo.culdistsiemb,
       cultivo.culvidautil,
       cultivo.cultiempvida,
       unidad_cultivo.lcufechsiemb,
       unidad_cultivo.lcufechcosec,
       unidad_cultivo.lcuproduesti,
       unidad_cultivo.lcuunimedest,
       unidad_cultivo.lcuprodureal,
       unidad_cultivo.lcuunimedrea,
       unidad_cultivo.lcuresponsab,
       plagaenfermedad.pentipdano,
       plagaenfermedad.pennomcomun,
       plagaenfermedad.pennomcienti,
       plagaenfermedad.pentipagecau,
       plagaenfermedad.pentipmanejo,
       plagaenfermedad.pentipzaffru,
       plagaenfermedad.pentipzaftal,
       plagaenfermedad.pentipzafflo,
       plagaenfermedad.pentipzafrai,
       plagaenfermedad.pentipzafhoj,
       canal.cannombre,
       suelo.suefhumedad,
       suelo.sueftextura,
       suelo.sueqph,
       suelo.suefporocida,
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
       suelo.suebmasmicro,
       cultivo.culunimedsie

              
                  FROM unidad_cultivo
                  inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad
                  inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo     
                  inner join area on area.areid = unidad.uniarea
                  -- inner join lote on lote.lotid = lote_cultivo.lculote
                  inner join plagaenfermedad on plagaenfermedad.penid = unidad_cultivo.lcuplagenfer
                  inner join canal on canal.canid = unidad_cultivo.lcucanal
                  inner join suelo on suelo.sueid = unidad.unisuelo
                   WHERE cultivo.culnomcomun='$nombre'");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> TABLA CULTIVO <?php echo $nombre ?> </font></div></th>
    <th colspan="2">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>
<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UBICACION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIGEN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CLIMA FAVORABLE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA SIEMBRA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>VIDA UTIL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIEMPO VIDA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA SIEMBRA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA COSECHA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PRODUCCION ESTIMADA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PRODUCCION REAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO DAÑO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE DAÑO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO AGENTE CAUSAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MANEJO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ZONA AFECTADA FRUTA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ZONA AFECTADA TALLO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ZONA AFECTADA FLOR</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ZONA AFECTADA RAIZ</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ZONA AFECTADA HOJA</strong></th>
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
$nombre=$_REQUEST['name'];
$consulta=pg_query($con,"SELECT 
       area.arenombre,
       unidad.uninombre,
       -- lote.lotidcodigo,
       cultivo.culextension,
       cultivo.culunimedida,
       cultivo.cullatitud,
       cultivo.culorientlat,
       cultivo.cullongitud,
       cultivo.culorientlon,
       cultivo.culnomcomun,
       cultivo.culnomcienti,
       cultivo.culorigen,
       cultivo.cullugarorig,
       cultivo.culclimafavo,
       cultivo.culdistsiemb,
       cultivo.culvidautil,
       cultivo.cultiempvida,
       unidad_cultivo.lcufechsiemb,
       unidad_cultivo.lcufechcosec,
       unidad_cultivo.lcuproduesti,
       unidad_cultivo.lcuunimedest,
       unidad_cultivo.lcuprodureal,
       unidad_cultivo.lcuunimedrea,
       unidad_cultivo.lcuresponsab,
       plagaenfermedad.pentipdano,
       plagaenfermedad.pennomcomun,
       plagaenfermedad.pennomcienti,
       plagaenfermedad.pentipagecau,
       plagaenfermedad.pentipmanejo,
       plagaenfermedad.pentipzaffru,
       plagaenfermedad.pentipzaftal,
       plagaenfermedad.pentipzafflo,
       plagaenfermedad.pentipzafrai,
       plagaenfermedad.pentipzafhoj,
       canal.cannombre,
       suelo.suefhumedad,
       suelo.sueftextura,
       suelo.sueqph,
       suelo.suefporocida,
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
       suelo.suebmasmicro,
       cultivo.culunimedsie

              
                  FROM unidad_cultivo
                  inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad
                  inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo     
                  inner join area on area.areid = unidad.uniarea
                  -- inner join lote on lote.lotid = lote_cultivo.lculote
                  inner join plagaenfermedad on plagaenfermedad.penid = unidad_cultivo.lcuplagenfer
                  inner join canal on canal.canid = unidad_cultivo.lcucanal
                  inner join suelo on suelo.sueid = unidad.unisuelo
                   WHERE cultivo.culnomcomun='$nombre'");
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
                    $reg23=$Reg_LotCul[23];
                    $reg24=$Reg_LotCul[24];
                    $reg25=$Reg_LotCul[25];   
                    $reg26=$Reg_LotCul[26];
                    $reg27=$Reg_LotCul[27];
                    $reg28=$Reg_LotCul[28]; 
                    $reg29=$Reg_LotCul[29]; 
                    $reg30=$Reg_LotCul[30]; 
                    $reg31=$Reg_LotCul[31]; 
                    $reg32=$Reg_LotCul[32]; 
                    $reg33=$Reg_LotCul[33]; 
                    $reg34=$Reg_LotCul[34];
                    $reg35=$Reg_LotCul[35];
                    $reg36=$Reg_LotCul[36];
                    $reg37=$Reg_LotCul[37];   
                    $reg38=$Reg_LotCul[38];
                    $reg39=$Reg_LotCul[39];
                    $reg40=$Reg_LotCul[40]; 
                    $reg41=$Reg_LotCul[41]; 
                    $reg42=$Reg_LotCul[42]; 
                    $reg43=$Reg_LotCul[43]; 
                    $reg44=$Reg_LotCul[44]; 
                    $reg45=$Reg_LotCul[45];
                    $reg46=$Reg_LotCul[46]; 
                    $reg47=$Reg_LotCul[47]; 
                    $reg48=$Reg_LotCul[48]; 
                    $reg49=$Reg_LotCul[49];
                    $reg50=$Reg_LotCul[50];  
                    $culunimedcul=($reg4);
                    $culunimedest=($reg20);
                    $culunimedrea=($reg22);
                    $culunimeddis=($reg50);
               $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$culunimedcul ");
                 while($registro_cul=pg_fetch_array($res3))
                {
        
                     $unimedcultivo=($registro_cul[1]);
                 }
                 $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$culunimedest ");
                 while($registro_pcestimada=pg_fetch_array($res1))
                {
        
                     $unimedestimada=($registro_pcestimada[1]);
                 }
                $res2=pg_query($con,"SELECT * FROM unidad_medida WHERE umeid=$culunimedrea ");
                 while($registro_pcreal=pg_fetch_array($res2))
                {
        
                     $unimedreal=($registro_pcreal[1]);
                 }
                 $res4=pg_query($con,"SELECT * FROM unidad_medida WHERE umeid=$culunimeddis ");
                 while($registro_distanciasiembra=pg_fetch_array($res4))
                {
        
                     $unimeddistanciasiembra=($registro_distanciasiembra[1]);
                 }
                 $lotecanal=($Reg_LotCul[34]);
                 $res6=pg_query($con,"SELECT * FROM canal WHERE canidcodigo='$lotecanal'");
                 while($registro_canal=pg_fetch_array($res6))
                {
                  $canallot=utf8_decode($registro_canal[2]);
                }
       echo "
				<tr>
				<td bgcolor=\"#fff\" align=\"right\">$reg0</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg1</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg2</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg3</td>
				<td bgcolor=\"#fff\" align=\"center\">$unimedcultivo</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg5</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg7</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg10</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg11</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg12</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg13</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg14</td>
				<td bgcolor=\"#fff\" align=\"center\">$unimeddistanciasiembra</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg15</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg16</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg17</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg18</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg19</td>
				<td bgcolor=\"#fff\" align=\"center\"> $unimedestimada</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg21</td>
				<td bgcolor=\"#fff\" align=\"center\">$unimedreal</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg34</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg24</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg25</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg26</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg27</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg28</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg29</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg30</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg31</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg32</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg33</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg35</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg36</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg37</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg38</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg39</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg40</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg41</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg42</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg43</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg44</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg45</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg46</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg47</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg48</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg49</td>
				<td bgcolor=\"#fff\" align=\"right\">$fecha</td>";
			}
?>
</table></center>
</body>
</html>
                
          

