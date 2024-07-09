<?php
$nombre=$_REQUEST['name'];

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $nombre;?></title>
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
                // $cont=pg_num_rows($consulta); 
                
            

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
        ?>
       <section>
        <article>
        <center>
                <table border='0' width="2%" style="border: solid #000;    border-radius: 10px;
                border-style: double; padding: 4px; width: 500px">
                    <tr>
                        <td colspan="34" class="tabla0">
                             <div ><center><b>FICHA TECNICA:  <?php echo $nombre;?></b></center></div><br>
                        </td>
                    </tr>
                 
                        <tr>
                         <th colspan="0" class="celdatd"><b>AREA:</b></th>
                        <td class="celdatd" colspan="2"><center> <?php echo "$reg0"; ?></center> </td>

                        </tr>

                        <tr>        
                        <th colspan='0'class="celdatdazul"><b>EXTENSION:</b></th>                     
                        <td class="celdatdazul" colspan='1'><center><?php echo "$reg6"; ?></center></td>
                        <td class="celdatdazul"><center><?php echo "<B>$unimedlote</B>"; ?></center></td>
                    </tr>


                     <tr>
                        <th colspan='0' class="celdatd"><b>LATITUD:</b></th>
                        <td class="celdatd"><center><?php echo "$reg8"; ?></center></td>
                        <td class="celdatd"><center>
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

                         ?></center>
                        </td>
                    </tr>

                    <tr>

                        <th colspan='0'class="celdatdazul"><b>LONGITUD:</b></th>
                        <td class="celdatdazul"><center><?php echo "$reg10"; ?></center></td>

                        <td class="celdatdazul"><center>
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

                         ?></center>
                        </td>

                    </tr>

                    <tr>

                        <th colspan='0'class="celdatd" ><b>UNIDADES:</b></th>
                        <td class="celdatd" colspan="2"><center><?php
                        include 'conexion.php';
                        

                        $con_unidades= pg_query($con, "SELECT DISTINCT unidad.uninombre
                        FROM unidad_cultivo 
                       
                        INNER JOIN unidad ON unidad.uniid = unidad_cultivo.lcuunidad  WHERE unidad.uninombre='$nombre'" );
                        while ($resultado_u= pg_fetch_array($con_unidades))
                            {

                                for($i=0;$i<1;$i++) 
                                    {
                                        echo '<div class="whilefor">'.$resultado_u[$i].'<br>'.'</div>';
                                    }
                            }?></center></td>

                        </tr>

                        <tr>

                            <th colspan='0' class="celdatdazul"><b>CULTIVOS:</b></th>
                        <td class="celdatdazul " colspan="2" ><center><?php
                        include 'conexion.php';
                       
                      

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
                            }?></center></td>

                        </tr>

                        <tr>
                        <th colspan='0' class="celdatd"><b>CANALES:</b></th>
                        <td class="celdatd" colspan="2"><center><?php
                        include 'conexion.php';
                       
                      

                        $con_canales= pg_query($con, "SELECT DISTINCT canal.cannombre
                        FROM unidad
                        -- inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad                        
                        INNER JOIN canal ON canal.canid= unidad.unicanal  WHERE unidad.uninombre='$nombre'" );
                        while ($resultado= pg_fetch_array($con_canales))
                            {

                                for($i=0;$i<1;$i++) 
                                    {
                                        echo'<div class="whilefor">'. $resultado[$i].'<BR>'.'</div>';
                                    }
                            }?></center></td>
                        </tr>

                        <tr>

                        <th colspan='0' class="celdatd"><b>RUTAS:</b></th>
                        <td colspan="2" class="celdatd"><center>
                    <?php
                        include 'conexion.php';
                        $con_ruta= pg_query($con, "SELECT DISTINCT 
                                                                    ruta.rutnombre, 
                                                                    unidad.uninombre
                                                FROM ruta_unidad
                                                INNER JOIN ruta ON ruta.rutid= ruta_unidad.runruta
                                                INNER JOIN unidad ON unidad.uniid= ruta_unidad.rununidad
                                                WHERE unidad.uninombre='$nombre'" );
                                        while ($resultado= pg_fetch_array($con_ruta))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                            }?></center>
                            
                        </td>
                    </tr>

                    <tr> <th colspan="3" class="tabla0"><CENTER><B>SUELO</B></CENTER></th></tr>


                        <tr>
                        <th colspan="0" class="celdatdazul"><b>HUMEDAD:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg1"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>TEXTURA:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg2"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatdazul"><b>PH:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg3"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>POROSIDAD:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg4"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatdazul"><b>CONSISTENCIA:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg12"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>COLOR TERMICO:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg13"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatdazul"><b>CONDENSACION:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg14"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>NITROGENO:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg15"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatdazul"><b>FOSFORO:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg16"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>POTACIO:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg17"; ?></center></td>
                        </tr>

                        <tr>
                         <th colspan="0"class="celdatdazul"><b>ELEMENTOS MENORES:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg18"; ?></center></td>
                        </tr>

                        <tr>
                         <th colspan="0"class="celdatd"><b>ELEMENTOS MENORES TERMICOS:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg19"; ?></center></td>
                        </tr>

                        <tr>
                         <th colspan="0"class="celdatdazul"><b>MATERIA ORGANICA:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg20"; ?></center></td>
                        </tr>

                        <tr>
                        <th colspan="0"class="celdatd"><b>BACTERIAS MICROBIOLÓGICAS:</b></th>
                        <td class="celdatd" colspan="2"><center><?php echo "$reg21"; ?></center></td>
                        </tr>

                        <tr>
                         <th colspan="0"class="celdatdazul"><b>SUEBMASMICRO:</b></th>
                        <td class="celdatdazul" colspan="2"><center><?php echo "$reg22"; ?></center></td>
                        </tr>
                    
                    <tr>
                        <td class="celdatd" colspan="34">
                       <center>
                    <a href="../descarga_excel/Lote_exc.php?name=<?php echo $nombre;?>"  target="_blank">
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
<?php ?>