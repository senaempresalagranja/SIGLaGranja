<?php 
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA CAPRINOS.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor MySql
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
    <th width="1000" colspan="7">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> TABLA UNIDAD CAPRINOS </font></div></th>
    <th colspan="2">
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
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong>

<?php
    include 'Conexion.php';
    $Consulta = pg_query($con,
                                "SELECT
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
                                INNER JOIN area ON area.areid= unidad.uniarea
                                WHERE unidad.uninombre = 'CAPRINOS'");

                                while ($Reg_LotCul= pg_fetch_array($Consulta)) 
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
                                        $res3=pg_query($con,
                                                             "SELECT * FROM unidad_medida WHERE umeid='$reg3'"
                                                      );

                                while ($Registro_Unidad=pg_fetch_array($res3))
                                    {        
                                        $Unidad_Medida=($Registro_Unidad[1]);
                                    }

                    
                     echo "
				<tr>
				<td bgcolor=\"#fff\" align=\"right\">$reg0</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg1</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg2</td>
				<td bgcolor=\"#fff\" align=\"center\">$Unidad_Medida</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg4</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg5</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg7</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
				";

	}

?>

</table></center>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> CANALES </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CLASE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>USO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CANAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PROFUNDIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ANCHO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PENDIENTE</strong></th>
<th width="10%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DISTANCIA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD INICIAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD INICIAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD FINAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<?php
    include 'Conexion.php';
    $Consulta_Canal = pg_query($con,
                                "SELECT
                                   canal.cannombre,
                                   canal.canclase,
                                   canal.canuso,
                                   canal.cantipo,
                                   canal.canprofundid,
                                   canal.canunimedpro,
                                   canal.canancho,
                                   canal.canunimedanc,
                                   canal.canpendiente,
                                   canal.canunimedpen,
                                   canal.candistancia,
                                   canal.canunimedist,
                                   canal.canlatitudi,
                                   canal.canorienlati,
                                   canal.canlongitudi,
                                   canal.canorienloni,
                                   canal.canlatitudf,
                                   canal.canorienlatf,
                                   canal.canlongitudi,
                                   canal.canorienlonf
                                FROM unidad_canal
                                INNER JOIN unidad ON unidad.uniid = unidad_canal.cununidad
                                INNER JOIN canal ON canal.canid = unidad_canal.cuncanal

                                WHERE unidad.uninombre = 'CAPRINOS'");

                                while ($Reg_Canal= pg_fetch_array($Consulta_Canal)) 
                                    {

                                    
                                        $reg0=utf8_decode($Reg_Canal[0]);
                                        $reg1=utf8_decode($Reg_Canal[1]);
                                        $reg2=utf8_decode($Reg_Canal[2]);   
                                        $reg3=utf8_decode($Reg_Canal[3]);
                                        $reg4=utf8_decode($Reg_Canal[4]);
                                        $reg5=utf8_decode($Reg_Canal[5]); 
                                        $reg6=utf8_decode($Reg_Canal[6]); 
                                        $reg7=utf8_decode($Reg_Canal[7]); 
                                        $reg8=utf8_decode($Reg_Canal[8]); 
                                        $reg9=utf8_decode($Reg_Canal[9]);
                                        $reg10=utf8_decode($Reg_Canal[10]);
                                        $reg11=utf8_decode($Reg_Canal[11]);
                                        $reg12=utf8_decode($Reg_Canal[12]);   
                                        $reg13=utf8_decode($Reg_Canal[13]);
                                        $reg14=utf8_decode($Reg_Canal[14]);
                                        $reg15=utf8_decode($Reg_Canal[15]); 
                                        $reg16=utf8_decode($Reg_Canal[16]); 
                                        $reg17=utf8_decode($Reg_Canal[17]); 
                                        $reg18=utf8_decode($Reg_Canal[18]);
                                        $reg19=utf8_decode($Reg_Canal[19]);
                                        $unimed1=($reg5);
                                        $unimed2=($reg7);
                                        $unimed3=($reg9);
                                        $unimed4=($reg11);
                                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$unimed1");
                                        while($registro_canal=pg_fetch_array($res1))
                                            {
                                                $nombre1=($registro_canal[1]);
                                            }
                                        $res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$unimed2");
                                        while($registro_canal=pg_fetch_array($res2))
                                            {
                                                $nombre2=($registro_canal[1]);
                                            }
                                        $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$unimed3");
                                        while($registro_canal=pg_fetch_array($res3))
                                            {
                                                $nombre3=($registro_canal[1]);
                                            }
                                        $res4=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$unimed4");
                                        while($registro_canal=pg_fetch_array($res4))
                                            {
                                                $nombre4=($registro_canal[1]);
                                            }  
                                        
                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"right\">$reg0</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg1</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg2</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg3</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg4</td>
                <td bgcolor=\"#fff\" align=\"center\">$nombre1</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg6</td>
                <td bgcolor=\"#fff\" align=\"center\">$nombre2</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg8</td>
                <td bgcolor=\"#fff\" align=\"center\">$nombre3</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg10</td>
                <td bgcolor=\"#fff\" align=\"right\">$nombre4</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg12</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg13</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg14</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg15</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg16</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg17</td>
             
                ";
            }

?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> CONSTRUCIONES </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO AMBIENTE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CONSTRUCCION</strong></th>

<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CUBIERTA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO PISO</strong></th>
<th width="10%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MURO</strong></th>

<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA CONSTRUCCION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>REMODELACION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<?php
$Consulta_Construccion = pg_query($con,
                                "SELECT
                                construccion.connombre,
                                construccion.conextension,
                                construccion.conunimedcon,
                                construccion.conestado,
                                construccion.contipambien,
                                construccion.contipconstr,
                                construccion.conestado,
                                construccion.contipcubiert,
                                construccion.contippiso,
                                construccion.contipmuro,
                                construccion.confecconstr,
                                construccion.confecremode,
                                construccion.conlatitud,
                                construccion.conorientlat,
                                construccion.conlongitud,
                                construccion.conorientlon
                                FROM construccion
                                INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($Reg_Construccion= pg_fetch_array($Consulta_Construccion)) 
                                    {

                                    
                                        $reg00=utf8_decode($Reg_Construccion[0]);
                                        $reg01=utf8_decode($Reg_Construccion[1]);
                                        $reg02=utf8_decode($Reg_Construccion[2]);   
                                        $reg03=utf8_decode($Reg_Construccion[3]);
                                        $reg04=utf8_decode($Reg_Construccion[4]);
                                        $reg05=utf8_decode($Reg_Construccion[5]); 
                                        $reg07=utf8_decode($Reg_Construccion[7]); 
                                        $reg08=utf8_decode($Reg_Construccion[8]); 
                                        $reg09=utf8_decode($Reg_Construccion[9]);
                                        $reg010=utf8_decode($Reg_Construccion[10]);
                                        $reg011=utf8_decode($Reg_Construccion[11]);
                                        $reg012=utf8_decode($Reg_Construccion[12]);   
                                        $reg013=utf8_decode($Reg_Construccion[13]);
                                        $reg014=utf8_decode($Reg_Construccion[14]);
                                        $reg015=utf8_decode($Reg_Construccion[15]);
                                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg02");
                                        while($reg_estanquea=pg_fetch_array($res1))
                                            {
                                                $nombre1=($reg_estanquea[1]);
                                            }

                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"center\">$reg00</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg01</td>
                <td bgcolor=\"#fff\" align=\"center\">$nombre1</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg03</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg04</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg05</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg07</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg08</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg09</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg010</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg011</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg012</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg013</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg014</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg015</td>";
}
?>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> ESPECIES </font></div></th>
       <th width="1000" colspan="3">
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO ESPECIE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
<?php
$Consulta_Especie = pg_query($con,
                                "SELECT
                                especie.esptipespeci,
                                especie.espnomcomun,
                                especie.espnomcienti,
                                raza.raznombre,
                                raza.razorigen,
                                raza.razlugorigen,
                                raza.razproposito,
                                raza.razproducion,
                                raza.razunimedpro,
                                raza.razcarfenoti

                                
                                FROM especie_raza
                                INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                                INNER JOIN raza ON raza.razid = especie_raza.eraraza
                                INNER JOIN unidad ON unidad.uniid = especie.espunidad

                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($Reg_Especie= pg_fetch_array($Consulta_Especie)) 
                                    {

                                    
                                        $reg0000=utf8_decode($Reg_Especie[0]);
                                        $reg0001=utf8_decode($Reg_Especie[1]);
                                        $reg0002=utf8_decode($Reg_Especie[2]);
                                       

                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"center\">$reg0000</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg0001</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg0002</td>";
}
                ?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> RAZAS </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIGEN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN </strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PROPOSITO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>PRODUCCION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<?php
$Consulta_Especie = pg_query($con,
                                "SELECT
                                raza.raznombre,
                                raza.razorigen,
                                raza.razlugorigen,
                                raza.razproposito,
                                raza.razproducion,
                                raza.razunimedpro
                                
                                
                                FROM especie_raza
                                INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                                INNER JOIN raza ON raza.razid = especie_raza.eraraza
                                INNER JOIN unidad ON unidad.uniid = especie.espunidad

                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($Reg_Raza= pg_fetch_array($Consulta_Especie)) 
                                    {

                                    
                                        $reg00000=utf8_decode($Reg_Raza[0]);
                                        $reg00001=utf8_decode($Reg_Raza[1]);
                                        $reg00002=utf8_decode($Reg_Raza[2]);
                                        $reg00003=utf8_decode($Reg_Raza[3]);
                                        $reg00004=utf8_decode($Reg_Raza[4]);
                                        $reg00005=utf8_decode($Reg_Raza[5]);
                                       

                                       

                     echo "
               <tr>
               <td bgcolor=\"#fff\" align=\"center\">$reg00000</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg00001</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg00002</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg00003</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg00004</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg00005</td>
             
                ";
}
                ?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> PLAGAS </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ORIGEN</strong></th>

<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN </strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AGENTE CAUSAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRATAMIENTO</strong></th>
<!--3157340061-->
<?php
$Consulta_Plaga = pg_query($con,
                                "SELECT
                                plaga.planomcomun,
                                plaga.planomcienti,
                                plaga.plaorigen,
                                plaga.plalugarorig,
                                plaga.platipagecau,
                                plaga.platratamien                                
                                FROM plaga_especie
                                INNER JOIN especie ON especie.espid = plaga_especie.pesespecie
                                INNER JOIN plaga ON plaga.plaid= plaga_especie.pesplaga
                                INNER JOIN unidad ON unidad.uniid = especie.espunidad

                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($Reg_Plaga= pg_fetch_array($Consulta_Plaga)) 
                                    {

                                    
                                        $reg000000=utf8_decode($Reg_Plaga[0]);
                                        $reg000001=utf8_decode($Reg_Plaga[1]);
                                        $reg000002=utf8_decode($Reg_Plaga[2]);
                                        $reg000003=utf8_decode($Reg_Plaga[3]);
                                        $reg000004=utf8_decode($Reg_Plaga[4]);
                                        $reg000005=utf8_decode($Reg_Plaga[5]);
                                       

                                       

                     echo "
               <tr>
               <td bgcolor=\"#fff\" align=\"center\">$reg000000</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg000001</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg000002</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg000003</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg000004</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg000005</td>
             
                ";
}
                ?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> ENFERMEDADES </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE COMUN</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE CIENTIFICO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LUGAR ORIGEN </strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>MORVIMORTALIDAD</strong></th>


<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SINTOMAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRATAMIENTO</strong></th>
<?php
$Consulta_Enfermedad = pg_query($con,
                                "SELECT
                                enfermedad.enfnomcomun,
                                enfermedad.enfnomcinti,
                                enfermedad.enftipagecau,
                                enfermedad.enfmorvimort,
                                enfermedad.enfsintomas,
                                enfermedad.enftratamien                              
                                FROM enfermedad_especie
                                INNER JOIN especie ON especie.espid = enfermedad_especie.eesespecie
                                INNER JOIN enfermedad ON enfermedad.enfid= enfermedad_especie.eesenfermeda
                                INNER JOIN unidad ON unidad.uniid = especie.espunidad

                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($Reg_Enfermedad= pg_fetch_array($Consulta_Enfermedad)) 
                                    {

                                    
                                        $reg0000000=utf8_decode($Reg_Enfermedad[0]);
                                        $reg0000001=utf8_decode($Reg_Enfermedad[1]);
                                        $reg0000002=utf8_decode($Reg_Enfermedad[2]);
                                        $reg0000003=utf8_decode($Reg_Enfermedad[3]);
                                        $reg0000004=utf8_decode($Reg_Enfermedad[4]);
                                        $reg0000005=utf8_decode($Reg_Enfermedad[5]);
                                       

                                       

                     echo "
               <tr>
               <td bgcolor=\"#fff\" align=\"center\">$reg0000000</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg0000001</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg0000002</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg0000003</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg0000004</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg0000005</td>
             
                ";
}


                ?>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> POSTES </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MATERIAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ALTURA</strong></th>


<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO TENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ALUMBRADO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO ALUMBRADO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TRANSFORMADOR</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO TRANSFORMADOR</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<?php
$Consulta_Poste = pg_query($con,
                                "SELECT
                                poste.posidcodigo,
                                poste.postipmateri,
                                poste.posestado,
                                poste.posaltura,
                                poste.posunimedi,
                                poste.postiptensio,
                                poste.posalumbrado,
                                poste.posestalumbr,
                                poste.postransform,
                                poste.posesttransf,                               
                                poste.poslatitud,
                                poste.posorientlat,
                                poste.poslongitud,
                                poste.posorientlon

                                FROM poste
                               
                                INNER JOIN unidad ON unidad.uniid = poste.posunidad

                                WHERE unidad.uninombre = 'CAPRINOS'");
                                while ($a= pg_fetch_array($Consulta_Poste)) 
                                    {

                                    
                                        $reg0a=utf8_decode($a[0]);
                                        $reg1a=utf8_decode($a[1]);
                                        $reg2a=utf8_decode($a[2]);
                                        $reg3a=utf8_decode($a[3]);
                                        $reg4a=utf8_decode($a[4]);
                                        $reg5a=utf8_decode($a[5]);
                                        $reg6a=utf8_decode($a[6]);
                                        $reg7a=utf8_decode($a[7]);
                                        $reg8a=utf8_decode($a[8]);
                                        $reg9a=utf8_decode($a[9]);
                                        $reg10a=utf8_decode($a[10]);
                                        $reg11a=utf8_decode($a[11]);
                                        $reg12a=utf8_decode($a[12]);
                                        $reg13a=utf8_decode($a[13]);

                                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg4a");
                                        while($registro_poste=pg_fetch_array($res1))
                                            {
                                                $nombre1a=($registro_poste[1]);
                                            }
                                       

                                       

                     echo "
               <tr>
                <td bgcolor=\"#fff\"align=\"center\">$reg0a</td>
                <td bgcolor=\"#fff\"align=\"right\">$reg1a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg2a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg3a</td>
                <td bgcolor=\"#fff\"align=\"right\">$nombre1a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg5a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg6a</td>
                <td bgcolor=\"#fff\"align=\"right\">$reg7a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg8a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg9a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg10a</td>
                <td bgcolor=\"#fff\"align=\"right\">$reg11a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg12a</td>
                <td bgcolor=\"#fff\"align=\"center\">$reg13a</td>
             
                ";
}
?>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> RED ELECTRICA </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LAMPARAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TOMACORRIENTES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>INTERRUPTORES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>VENTILADORES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CANTIDAD</strong></th>
<?php
     $redelectrica=pg_query($con,"SELECT

            redelectrica.elenumlampar,
            redelectrica.elenumtomaco,
            redelectrica.elenuminterr,
            redelectrica.eletipventil,
            redelectrica.elecantidad

                FROM redelectrica
                    inner join construccion on construccion.conid= redelectrica.eleconstrucc
                    inner join unidad on unidad.uniid= construccion.conunidad
                    WHERE unidad.uninombre='CAPRINOS'");
                
            while ($Reg_RedElectrica= pg_fetch_array($redelectrica)) 
                {
                    $reg18=$Reg_RedElectrica[0];
                    $reg19=$Reg_RedElectrica[1];
                    $reg20=$Reg_RedElectrica[2];
                    $reg21=$Reg_RedElectrica[3];
                    $reg22=$Reg_RedElectrica[4]; 
                                        
                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"right\">$reg18</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg19</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg20</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg21</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg22</td>
                ";
            }

?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> RED GAS </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MATERIAL</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>VALVULAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CONEXIONES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CONTADORES</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SOPORTES</strong></th>
<?php
     $RedGas=pg_query($con,"SELECT

            redgas.rgatipmateri,
            redgas.rganumvalvul,
            redgas.rganumconexi,
            redgas.rganumcontad,
            redgas.rganumsoport

                FROM redgas
                    inner join construccion on construccion.conid= redgas.rgaconstrucc
                    inner join unidad on unidad.uniid= construccion.conunidad
                    WHERE unidad.uninombre='CAPRINOS'");
                
            while ($Red_Gas= pg_fetch_array($RedGas)) 
                {
                    $reg23=$Red_Gas[0];
                    $reg24=$Red_Gas[1];
                    $reg25=$Red_Gas[2];
                    $reg26=$Red_Gas[3];
                    $reg27=$Red_Gas[4];
                

                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"center\">$reg23</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg24</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg25</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg26</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg27</td>";
}
?>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> RED LOGICA </font></div></th>
       <th width="1000" colspan="3">
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOZA WIFI</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ACCES POINT</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RED ALAMBRICA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD CANALETA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RJ</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FIBRA OPTICA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UTP</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TOPOLOGIA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>RACK</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SWITCH</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>REGLETAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UPS</strong></th>
<?php
     $RedLogica=pg_query($con,"SELECT

            redlogica.rlozonawifi,
            redlogica.rlocantacces,
            redlogica.rloredalambr,
            redlogica.rlocantanale,
            redlogica.rlounimedcca,
            redlogica.rlocantrj,
            redlogica.rlocantfibop,
            redlogica.rlocategoutp,
            redlogica.rlotopologia,
            redlogica.rlorack,
            redlogica.rlocantswitc,
            redlogica.rlocantregle,
            redlogica.rlocantups

                FROM redlogica
                    inner join construccion on construccion.conid= redlogica.rloconstrucc
                    inner join unidad on unidad.uniid= construccion.conunidad
                    WHERE unidad.uninombre='CAPRINOS'");
                
            while ($Red_Logica= pg_fetch_array($RedLogica)) 
                {
                    $reg28=$Red_Logica[0];
                    $reg29=$Red_Logica[1];
                    $reg30=$Red_Logica[2];
                    $reg31=$Red_Logica[3];
                    $reg32=$Red_Logica[4];
                    $reg33=$Red_Logica[5];
                    $reg34=$Red_Logica[6];
                    $reg35=$Red_Logica[7];
                    $reg36=$Red_Logica[8];
                    $reg37=$Red_Logica[9];
                    $reg38=$Red_Logica[10];
                    $reg39=$Red_Logica[11];
                    $reg40=$Red_Logica[12];
                    $res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg32");
                                        while($registro_logica=pg_fetch_array($res2))
                                            {
                                                $nombre2=($registro_logica[1]);
                                            }
                    
                



                     echo "
               <tr>
                <td bgcolor=\"#fff\" align=\"center\">$reg28</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg29</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg30</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg31</td>
                <td bgcolor=\"#fff\" align=\"right\">$nombre2</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg33</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg34</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg35</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg36</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg37</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg38</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg39</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg40</td>";
                }
                ?>
</table>
<table>
    <tr>
        <td>
            <br>

        </td>
    </tr>
</table>
<table width="1000" border="0">
  <tr>
    <th width="1000" colspan="3">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2"> RED SANITARIA </font></div></th>
</table>
<table width="641" border="1">
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>BATERIAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DUCHAS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LAVAMANOS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>GRIFOS</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SIFON</strong></th>
<?php
     $RedSanitaria=pg_query($con,"SELECT

            redsanitaria.rsannumbater,
            redsanitaria.rsanumducha,
            redsanitaria.rsanumlavama,
            redsanitaria.sannumgrifos,
            redsanitaria.sannumsifon

                FROM redsanitaria
                    inner join construccion on construccion.conid= redsanitaria.rsaconstrucc
                    inner join unidad on unidad.uniid= construccion.conunidad
                    WHERE unidad.uninombre='CAPRINOS'");
                   
            while ($Red_Sanitaria= pg_fetch_array($RedSanitaria)) 
                {
                    $reg41=$Red_Sanitaria[0];
                    $reg42=$Red_Sanitaria[1];
                    $reg43=$Red_Sanitaria[2];
                    $reg44=$Red_Sanitaria[3];
                    $reg45=$Red_Sanitaria[4];

                                       

                     echo "
               <tr>
               <td bgcolor=\"#fff\" align=\"center\">$reg41</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg42</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg43</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg44</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg45</td>
             
                ";
}

                ?>
</body>
</html>

