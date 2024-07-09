<?php
$nombre=$_REQUEST['name']

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $nombre;?></title>
        <link rel="stylesheet" type="text/css" href="../css/Consulta.css">
    <body>
    <header>
        <div style="height: 90px">
            <img src="../../img/banner2.png" alt="we_are_champions " style="width: 100%;max-height: 100%" />
        </div> 
    </header>
  <?php
    include 'conexion.php';

            $consulta=pg_query($con,"SELECT 
       area.arenombre,
       unidad.uninombre,
       construccion.conidcodigo,
       construccion.connombre,
       construccion.conextension,
       construccion.conunimedcon,
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
                  inner join unidad on unidad.uniid = construccion.conunidad

                  inner join area on area.areid = unidad.uniarea
                   WHERE construccion.connombre='$nombre'");
                    
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
                    $reg10=$Reg_Construcc[10];
                    $reg11=$Reg_Construcc[11];
                    $reg12=$Reg_Construcc[12];
                    $reg13=$Reg_Construcc[13];
                    $reg14=$Reg_Construcc[14];
                    $reg15=$Reg_Construcc[15];
                    $reg16=$Reg_Construcc[16];
                    $reg17=$Reg_Construcc[17];
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg5");
                                        while($registro_constr=pg_fetch_array($res1))
                                            {
                                                $nombre1=($registro_constr[1]);
                                            }
                }

  ?>
  <section>
        <article>
            <center>
                <table border='0' width="2%" style="border: solid #000;">
                    <tr>
                        <td colspan="4" class="tabla0">
                             <div ><center><b>FICHA TECNICA: <?php echo $nombre;?></b></center></div><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>AREA:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg0"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>UNIDAD:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg1"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>CODIGO:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg2"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>NOMBRE:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg3"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>EXTENSION:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg4"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>U/M:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$nombre1"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>TIPO AMBIENTE:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg6"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>TIPO CONSTRUCCION:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg7"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>ESTADO:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg8"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>TIPO CUBIERTA:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg9"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>TIPO PISO:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg10"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>TIPO MURO:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg11"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>FECHA INAUGURACIÓN:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg12"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>FECHA REMODELACION:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg13"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>LATITUD:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg14"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg15"; ?></td>
                    </tr>
                     <tr>
                        <td colspan="0" class="celdatd"><b>LONGITUD:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg16"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg17"; ?></td>
                    </tr>
                    <td colspan="3" class="tabla0"><CENTER><B>RED ELECTRICA</B></CENTER></td>
    <?php
     $redelectrica=pg_query($con,"SELECT

            redelectrica.elenumlampar,
            redelectrica.elenumtomaco,
            redelectrica.elenuminterr,
            redelectrica.eletipventil,
            redelectrica.elecantidad

                FROM redelectrica
                    inner join construccion on construccion.conid= redelectrica.eleconstrucc
                    WHERE construccion.connombre='$nombre'");
                
            while ($Reg_RedElectrica= pg_fetch_array($redelectrica)) 
                {
                    $reg18=$Reg_RedElectrica[0];
                    $reg19=$Reg_RedElectrica[1];
                    $reg20=$Reg_RedElectrica[2];
                    $reg21=$Reg_RedElectrica[3];
                    $reg22=$Reg_RedElectrica[4];
                }

    ?>
                    <tr>
                        <td colspan="0" class="celdatd"><b>LAMPARAS:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg18"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>TOMACORRIENTES:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg19"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>INTERRUPTORES:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg20"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>VENTILADORES:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg21"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>CANTIDAD:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg22"; ?></td>
                    </tr>
                    <td colspan="3" class="tabla0"><CENTER><B>RED GAS</B></CENTER></td>
    <?php
     $RedGas=pg_query($con,"SELECT

            redgas.rgatipmateri,
            redgas.rganumvalvul,
            redgas.rganumconexi,
            redgas.rganumcontad,
            redgas.rganumsoport

                FROM redgas
                    inner join construccion on construccion.conid= redgas.rgaconstrucc
                    WHERE construccion.connombre='$nombre'");
                
            while ($Red_Gas= pg_fetch_array($RedGas)) 
                {
                    $reg23=$Red_Gas[0];
                    $reg24=$Red_Gas[1];
                    $reg25=$Red_Gas[2];
                    $reg26=$Red_Gas[3];
                    $reg27=$Red_Gas[4];
                }

    ?>
                    <tr>
                        <td colspan="0" class="celdatd"><b>TIPO MATERIAL:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg23"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>VALVULAS:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg24"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>CONEXIONES:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg25"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>CONTADORES:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg26"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>SOPORTES:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg27"; ?></td>
                    </tr>
                    <td colspan="3" class="tabla0"><CENTER><B>RED LOGICA</B></CENTER></td>
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
                    WHERE construccion.connombre='$nombre'");
                
            while ($Red_Gas= pg_fetch_array($RedLogica)) 
                {
                    $reg28=$Red_Gas[0];
                    $reg29=$Red_Gas[1];
                    $reg30=$Red_Gas[2];
                    $reg31=$Red_Gas[3];
                    $reg32=$Red_Gas[4];
                    $reg33=$Red_Gas[5];
                    $reg34=$Red_Gas[6];
                    $reg35=$Red_Gas[7];
                    $reg36=$Red_Gas[8];
                    $reg37=$Red_Gas[9];
                    $reg38=$Red_Gas[10];
                    $reg39=$Red_Gas[11];
                    $reg40=$Red_Gas[12];
                    $res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$reg32");
                                        while($registro_logica=pg_fetch_array($res2))
                                            {
                                                $nombre2=($registro_logica[1]);
                                            }
                    
                }

    ?>
    <tr>
                        <td colspan="0" class="celdatdazul"><b>ZONA WIFI:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg28"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>ACCESS POINT:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg29"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>RED ALAMBRICA:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg30"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b> LONGITUD CANALETA:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg31"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>U/M:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$nombre2"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>RJ:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg33"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>FIBRA OPTICA:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg34"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>UTP:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg35"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>TOPOLOGIA:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg36"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>RACK:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg37"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>SWITCH:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg38"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>REGLETAS:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg39"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>UPS:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg40"; ?></td>
                    </tr>
                    <td colspan="3" class="tabla0"><CENTER><B>RED SANITARIA</B></CENTER></td>
    <?php
     $RedSanitaria=pg_query($con,"SELECT

            redsanitaria.rsannumbater,
            redsanitaria.rsanumducha,
            redsanitaria.rsanumlavama,
            redsanitaria.sannumgrifos,
            redsanitaria.sannumsifon

                FROM redsanitaria
                    inner join construccion on construccion.conid= redsanitaria.rsaconstrucc
                    WHERE construccion.connombre='$nombre'");
                
            while ($Red_Sanitaria= pg_fetch_array($RedSanitaria)) 
                {
                    $reg41=$Red_Sanitaria[0];
                    $reg42=$Red_Sanitaria[1];
                    $reg43=$Red_Sanitaria[2];
                    $reg44=$Red_Sanitaria[3];
                    $reg45=$Red_Sanitaria[4];
                }

    ?>
                    <tr>
                        <td colspan="0" class="celdatd"><b>BATERIAS:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg41"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>DUCHAS:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg42"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>LAVAMANOS:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg43"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>GRIFOS:</b></td>

                        <td class="celdatdazul" colspan="2"><?php echo "$reg44"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>SIFON:</b></td>

                        <td class="celdatd" colspan="2"><?php echo "$reg45"; ?></td>
                    </tr>
                    <tr>
                    <td class="celdatdazul" colspan="4">
                       <center>
                    <a href="../descarga_excel/Construccion_exc.php?name=<?php echo $nombre;?>" target="_blank">
                            <img src="../img/Excel.png" title="Exportar Excel" class="imagen">
                    </a> 
                       </center>     
                        </td>
                    </tr>



