<?php 
  session_start();
?>
<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_UnidadesCultivos.xls");
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
    <th width="1000" colspan="6">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPORTE: UNIDADES CON CULTIVOS</font></div></th>
    <th colspan="5">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>

<table width="641" border="1">
<tr>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">AREA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">UNIDAD</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">UBICACION</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LATITUD</th>
  <th colspan="2" width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">LONGITUD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE COMUN</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">EXTENSION CULTIVO</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">ORIGEN</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LUGAR ORIGEN</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">CLIMA FAVORABLE</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">DISTANCIA SIEMBRA</th>
  <th colspan="2" width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">VIDA UTIL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA SIEMBRA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">FECHA COSECHA</th>
  <th colspan="2" width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">PRODUCCION ESTIMADA</th>
  <th colspan="2" width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">PRODUCCION REAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">RESPONSABLE</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">CANALES</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">LOTES QUE LO CULTIVAN</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO DAÑO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE DAÑO</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">NOMBRE CIENTIFICO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO AGENTE CAUSAL</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">TIPO MANEJO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ZONA AFECTADA (FRUTA,TALLO,FLOR,RAIZ,HOJA)</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">CANAL</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">HUMEDAD</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">TEXTURA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">PH</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">POROSIDAD</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CONSISTENCIA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">COLOR TERMICO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">CONDUCTIVIDAD ELECTRICA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">NITROGENO</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">FOSFORO</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">POTACIO</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">ELEMENTOS MENORES</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ELEMENTOS INTERCAMBIO</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">MATERIA ORGANICA</th>
  <th width="130px" style="background-color:#0000ff; text-align:center; color:#FFF">ACTIVIDAD MICROBIANA</th>
  <th width="80px" style="background-color:#0000ff; text-align:center; color:#FFF">MASA MICROBIANA</th>
</tr>
<?php
// Un proceso repetitivo para imprimir cada uno de los registros.
 $consulta=pg_query($con,"SELECT 
       area.arenombre,
       unidad.uninombre,
       lote.lotid,
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
       cultivo.culunimedsie,
       cultivo.culvidautil,
       cultivo.cultiempvida,
       lote_cultivo.lcufechsiemb,
       lote_cultivo.lcufechcosec,
       lote_cultivo.lcuproduesti,
       lote_cultivo.lcuunimedest,
       lote_cultivo.lcuprodureal,
       lote_cultivo.lcuunimedrea,
       lote_cultivo.lcuresponsab,
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
       suelo.suebmasmicro
       FROM lote_cultivo
                  inner join unidad on unidad.uniid = lote_cultivo.lcuunidad
                  inner join cultivo on cultivo.culid = lote_cultivo.lcucultivo     
                  inner join area on area.areid = unidad.uniarea
                  inner join lote on lote.lotid = lote_cultivo.lculote
                  inner join plagaenfermedad on plagaenfermedad.penid = lote_cultivo.lcuplagenfer
                  inner join canal on canal.canid = lote_cultivo.lcucanal
                  inner join suelo on suelo.sueid = lote.lotsuelo");

    //*******************************************************************
    //SE HACE CONSULTA PARA SABER LAS "CANALES" QUE PASAN POR ESE CULTIVO
          $con_canales= pg_query($con, "SELECT DISTINCT canal.cannombre
                        FROM lote_cultivo                        
                        INNER JOIN canal ON canal.canid= lote_cultivo.lcucanal
                        INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo" );
                        while ($resultado= pg_fetch_array($con_canales))
                            {

                                for($i=0;$i<count($con_canales);$i++)   
                                    {
                                        $datoCanal=$resultado[$i];
                                    }
                            }
    //*****************************************************************
    //SE HACE CONSULTA PARA SABER LOS "LOTES" QUE PASAN POR ESE CULTIVO
          $con_lotes= pg_query($con, "SELECT DISTINCT lote.lotidcodigo
                        FROM lote_cultivo 
                        INNER JOIN lote ON lote.lotid = lote_cultivo.lculote  
                        INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo" );
                        while ($resultado_l= pg_fetch_array($con_lotes))
                            {

                                for($i=0;$i<count($con_lotes);$i++) 
                                {
                                    $datoLote=$resultado_l[$i];
                                }
                            }
              while ($reg=pg_fetch_array($consulta)) 
              {
                $lote1=$reg[2];
                        $con1=pg_query($con, "SELECT * FROM lote WHERE lotid=$lote1");
                        while ($reg1=pg_fetch_array($con1)) 
                        {
                          $nom1=$reg1[1];
                        }

                      $umd=$reg[4];
                        $con1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$umd");
                        while ($reg1=pg_fetch_array($con1)) 
                        {
                          $nom2=$reg1[1];
                        }

                      $umd1=$reg[15];
                        $con1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$umd1");
                        while ($reg1=pg_fetch_array($con1)) 
                        {
                          $nom3=$reg1[1];
                        }

                      $umd2=$reg[21];
                        $con1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$umd2");
                        while ($reg1=pg_fetch_array($con1)) 
                        {
                          $nom4=$reg1[1];
                        }

                      $umd3=$reg[23];
                        $con1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$umd3");
                        while ($reg1=pg_fetch_array($con1)) 
                        {
                          $nom5=$reg1[1];
                        }

                        echo "<tr>";
                        echo "<td align=\"left\">$reg[0]</td>";//Area
                        echo "<td align=\"left\">$reg[1]</td>";//Unidad
                        echo "<td align=\"left\">$nom1</td>";//Se llama el lote
                        echo "<td align=\"right\">$reg[5]</td>";//Latitud
                        echo "<td align=\"left\">$reg[6]</td>";//orientacion
                        echo "<td align=\"right\">$reg[7]</td>";//Longitud
                        echo "<td align=\"left\">$reg[8]</td>";//orientacion
                        echo "<td align=\"left\">$reg[9]</td>";//Nom Comun
                        echo "<td align=\"left\">$reg[10]</td>";//Nom Cientif
                        echo "<td align=\"right\">$reg[3]</td>";//Extensión #
                        echo "<td align=\"left\">$nom2</td>";//UM
                        echo "<td align=\"left\">$reg[11]</td>";//ORIGEN
                        echo "<td align=\"left\">$reg[12]</td>";//LUGAR ORIGEN
                        echo "<td align=\"left\">$reg[13]</td>";//CLIMA
                        echo "<td align=\"right\">$reg[14]</td>";//DISTANCIA SIEMB
                        echo "<td align=\"left\">$nom3</td>";//UM
                        echo "<td align=\"right\">$reg[16]</td>";//VIDA UTIL
                        echo "<td align=\"left\">$reg[17]</td>";//TIEMPO
                        echo "<td align=\"right\">$reg[18]</td>";//FECHA SIEMB
                        echo "<td align=\"right\">$reg[19]</td>";//FECHA COSE
                        echo "<td align=\"right\">$reg[20]</td>";//PROD-ESTI
                        echo "<td align=\"left\">$nom4</td>";//UM
                        echo "<td align=\"right\">$reg[22]</td>";//PROD-REAL
                        echo "<td align=\"left\">$nom5</td>";//UM
                        echo "<td align=\"left\">$reg[24]</td>";//RESPONSABLE
                        echo "<td align=\"left\">$datoCanal</td>";//Canales
                        echo "<td align=\"left\">$datoLote</td>";//Lotes
                        echo "<td align=\"left\">$reg[25]</td>";//Tipo daño
                        echo "<td align=\"left\">$reg[26]</td>";//Nombre com
                        echo "<td align=\"left\">$reg[27]</td>";//Nombre cient
                        echo "<td align=\"left\">$reg[28]</td>";//Tip age causal
                        echo "<td align=\"left\">$reg[29]</td>";//Tipo manejo
                        echo "<td align=\"left\">$reg[30]</td>";//fruta
                        echo "<td align=\"left\">$reg[31]</td>";//tallo
                        echo "<td align=\"left\">$reg[32]</td>";//flor
                        echo "<td align=\"left\">$reg[33]</td>";//raiz
                        echo "<td align=\"left\">$reg[34]</td>";//hoja
                        echo "<td align=\"left\">$reg[35]</td>";
                        echo "<td align=\"left\">$reg[36]</td>";
                        echo "<td align=\"left\">$reg[37]</td>";
                        echo "<td align=\"left\">$reg[38]</td>";
                        echo "<td align=\"left\">$reg[39]</td>";
                        echo "<td align=\"left\">$reg[40]</td>";
                        echo "<td align=\"left\">$reg[41]</td>";
                        echo "<td align=\"left\">$reg[42]</td>";
                        echo "<td align=\"left\">$reg[43]</td>";
                        echo "<td align=\"left\">$reg[44]</td>";
                        echo "<td align=\"left\">$reg[45]</td>";
                        echo "<td align=\"left\">$reg[46]</td>";
                        echo "<td align=\"left\">$reg[47]</td>";
                        echo "<td align=\"left\">$reg[48]</td>";
                        echo "<td align=\"left\">$reg[49]</td>";
                        echo "<td align=\"left\">$reg[50]</td>";
                        echo "</tr>";
              }
?>
</table></center>
</body>
</html>