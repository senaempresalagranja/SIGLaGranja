<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>LOTE 8</title>
        <style type="text/css">
        
        #titulo
        {
            font-family: Cambria;
            text-align: center;
        }
        .imagen{
            width: 32px;
            text-align: center;
        }
        tr{
            font-size: 12px;

           
        }
       
        .whilefor{
            font-weight: normal;
            background-color: #F2F2F2;
        }
        .whilefor1{
            font-weight: normal;
            background-color:#E0E6F8;
            
        }
        .celdatd{
            background-color: #F2F2F2;
            border-style: solid 10px;
        }
        .celdatdazul{
            background-color:#E0E6F8; 
        }
        .tabla0{
            background-color:#2E64FE;
            color:white;  

        }
        </style>
    </head>
    <body>
        <header>
    
    
                   <div style="height: 90px">
                <img src="../../img/banner2.png" alt="we_are_champions " style="width: 100%;max-height: 100%" />                
            </div> 
               

        </header>
        <?php 
        
            include 'conexion.php';

           

            $consulta=pg_query($con,"SELECT area.arenombre,suelo.suefhumedad,suelo.sueftextura,suelo.sueqph,suelo.suefporocida,lote.lotidcodigo,lote.lotextension,lote.lotunimedlot,lote.lotlatitud,lote.lotorientlat,lote.lotlongitud,lote.lotorientlon,suelo.suefconsiste,suelo.suefcolorter,suelo.suefcondelet,suelo.sueqnitrogen,suelo.sueqfosforo,suelo.sueqpotacio,suelo.sueqelemmeno,suelo.sueqeleminte,suelo.suebmateorga,suelo.suebactimicr,suelo.suebmasmicro 
                FROM lote_cultivo
                  inner join unidad on unidad.uniid = lote_cultivo.lcuunidad
                  inner join lote on lote.lotid= lote_cultivo.lculote
                  inner join area on area.areid= unidad.uniarea
                  inner join suelo on suelo.sueid = lote.lotsuelo WHERE lote.lotidcodigo='LOTE 8'");


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
                




               $lotunimedlot=($reg7);
                $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$lotunimedlot ");
                 while($registro=pg_fetch_array($res3))
                {
        
                     $unimedlote=($registro[1]);
                 }
              
            }
        ?>
       <section>
        <article>
        <center>
                <table border='0' width="4%" style="border: solid #000;">
                <tr>
                        <td colspan="4" class="tabla0">
                             <div ><center><b>FICHA TECNICA: LOTE 8</b></center></div><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>AREA:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg0"; ?></td>
                    </tr>
                    <tr>
                        <td colspan='0'class="celdatdazul"><b>EXTENSION:</b></td>
                        <td class="celdatdazul"><?php echo "$reg6"; ?></td>
                        <td class="celdatdazul"><?php echo "<B>$unimedlote</B>"; ?></td>
                        
                    </tr>
                    <tr>
                        <td colspan='0' class="celdatd"><b>LATITUD:</b></td>
                        <td class="celdatd"><?php echo "$reg8"; ?></td>
                        <td class="celdatd">
                            <?php

                            $norte="NORTE";
                            $sur="SUR";
                            

                            if ($reg9==$norte)
                             {
                                echo"<B>N°</B>";
                            }
                            else 
                            {
                                echo"<B>S°</B>";
                            }

                         ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='0'class="celdatdazul"><b>LONGITUD:</b></td>
                        <td class="celdatdazul"><?php echo "$reg10"; ?></td>

                        <td class="celdatdazul">
                            <?php

                            $norte1="NORTE";
                            $sur1="SUR";
                            

                            if ($reg11==$norte1)
                             {
                                echo"<B>N°</B>";
                            }
                            else 
                            {
                                echo"<B>S°</B>";
                            }

                         ?>
                        </td>
                    </tr>
                   <tr class="hola">
                        <td colspan='0'class="celdatd" ><b>UNIDADES:</b></td>
                   
                
                        <td class="celdatd" colspan="2"><?php
                        include 'conexion.php';
                        

                        $con_unidades= pg_query($con, "SELECT DISTINCT unidad.uninombre
                        FROM lote_cultivo
                        inner join lote on lote.lotid= lote_cultivo.lculote 
                        INNER JOIN unidad ON unidad.uniid = lote_cultivo.lcuunidad  WHERE lote.lotidcodigo='LOTE 8'" );
                        while ($resultado_u= pg_fetch_array($con_unidades))
                            {

                                for($i=0;$i<count($con_unidades);$i++) 
                                    {
                                        echo '<div class="whilefor">'.$resultado_u[$i].'<br>'.'</div>';
                                    }
                            }?></td>
                            </tr>
                            <tr class="hola">
                        <td colspan='0' class="celdatdazul"><b>CULTIVOS:</b></td>
                  
                        <td class="celdatdazul " colspan="2" ><?php
                        include 'conexion.php';
                       
                      

                        $con_cultivo= pg_query($con, "SELECT DISTINCT cultivo.culnomcomun
                        FROM lote_cultivo
                        inner join lote on lote.lotid= lote_cultivo.lculote 
                        INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo  WHERE lote.lotidcodigo='LOTE 8'" );
                        while ($resultado= pg_fetch_array($con_cultivo))
                            {

                                for($i=0;$i<count($con_cultivo);$i++) 
                                    {
                                        echo '<div class="whilefor">'. $resultado[$i].'<BR>'.'</div>';
                                    }
                            }?></td>
                        </tr>
                         <tr class="td2">
                        <td colspan='0' class="celdatd"><b>CANALES:</b></td>
                  
                        <td class="celdatd" colspan="2"><?php
                        include 'conexion.php';
                       
                      

                        $con_canales= pg_query($con, "SELECT DISTINCT canal.cannombre
                        FROM lote_cultivo
                        inner join lote on lote.lotid= lote_cultivo.lculote                       
                        INNER JOIN canal ON canal.canid= lote_cultivo.lcucanal  WHERE lotidcodigo='LOTE 8'" );
                        while ($resultado= pg_fetch_array($con_canales))
                            {

                                for($i=0;$i<count($con_canales);$i++) 
                                    {
                                        echo'<div class="whilefor">'. $resultado[$i].'<BR>'.'</div>';
                                    }
                            }?></td>
                        </tr>
                    <tr>
                        <td colspan="3" class="tabla0"><CENTER><B>SUELO</B></CENTER>
                        </td>

                    </tr>
                    <tr class="td2">
                        <td colspan="0" class="celdatdazul"><b>HUMEDAD:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg1"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>TEXTURA:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg2"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>PH:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg3"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>POROSIDAD:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg4"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>CONSISTENCIA:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg12"; ?></td>
                    </tr>
                     <tr>
                        <td class="celdatd"><b>COLOR TERMICO:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg13"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>CONDENSACION:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg14"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>NITROGENO:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg15"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>FOSFORO:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg16"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>POTACIO:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg17"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>ELEMENTOS MENORES:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg18"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>ELEMENTOS MENORES TERMICOS:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg19"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>MATERIA ORGANICA:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg20"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd"><b>BACTERIAS MICROBIOLÓGICAS:</b></td>
                        <td class="celdatd" colspan="2"><?php echo "$reg21"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatdazul"><b>SUEBMASMICRO:</b></td>
                        <td class="celdatdazul" colspan="2"><?php echo "$reg22"; ?></td>
                    </tr>
                    <tr>
                        <td class="celdatd" colspan="3">
                       <center>
                    <a href="../descarga_excel/LoteOcho_exc.php" target="_blank">
                            <img src="../img/Excel.png" title="Exportar Excel" class="imagen">
                    </a> 
                       </center>     
                        </td>
                    </tr>
                   
                   
                                    
                </table>
            </center>
            </article>
        </section>
    </body>
</html>