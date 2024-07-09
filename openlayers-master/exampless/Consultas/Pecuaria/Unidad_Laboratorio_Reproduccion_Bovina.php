<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>REPRODUCCION BOVINA</title>

        <style type="text/css">
        
            #titulo
                {
                    font-family: Cambria;
                    text-align: center;
                }
            .imagen
                {
                    width: 32px;
                    text-align: center;
                }
            tr
                {
                    font-size: 12px;  
                }

       
            .whilefor
                {
                    font-weight: normal;
                    background-color: #F2F2F2;
                }
            .whilefor1
                {
                    font-weight: normal;
                    background-color:#E0E6F8;
                }
            .celdatd
                {
                    background-color: #F2F2F2;
                    border-style: solid 10px;
                }
            .celdatdazul
                {
                    background-color:#E0E6F8; 
                }
            .tabla0
                {
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
 error_reporting(E_ALL & ~E_NOTICE);
    include 'Conexion.php';
    $Consulta = pg_query
                        ($con,
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
                                FROM construccion
                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                INNER JOIN area ON area.areid= unidad.uniarea
                                WHERE construccion.connombre = 'REPRODUCCION BOVINA'"
                        );

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
                                    }

?>
        <section>
        <article>
            <center>
                <table border='0' width="25%" style="border: solid #000;">
                    <tr>
                        <td colspan="4" class="tabla0">
                             <div >
                                <center>
                                    <b>
                                        FICHA TECNICA: UNIDAD REPRODUCCION BOVINA
                                    </b>
                                </center>
                            </div>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd">
                            <b>
                                AREA:
                            </b>
                        </td>

                        <td class="celdatd" colspan="2">
                            <?php 
                                echo "$reg0"; 
                            ?>
                        </td>                      
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul">
                            <b>
                                UNIDAD:
                            </b>
                        </td>
                        <td class="celdatdazul" colspan="2">
                            <?php
                                 echo "$reg1"; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="celdatdazul">
                            <b>
                                EXTENSION:
                            </b>
                        </td>
                        <td class="celdatdazul">
                            <?php
                                 echo "$reg2"; ?>
                        </td>
                        <td class="celdatdazul">
                            <?php
                                 echo "$Unidad_Medida"; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd">
                            <b>
                                RESPONSABLE:
                            </b>
                        </td>
                        <td class="celdatd" colspan="2">
                            <?php
                                echo "$reg4"; 
                             ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='0' class="celdatd">
                            <b>
                                LATITUD:
                            </b>
                        </td>
                        <td class="celdatd">
                            <?php 
                                echo "$reg5"; 
                            ?>
                        </td>
                        <td class="celdatd">
                            <?php

                                $norte="NORTE";
                                $sur="SUR";

                                if ($reg6==$norte)
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
                        <td class="celdatd">
                            <b>
                                LONGITUD:
                            </b>
                        </td>
                        <td class="celdatd">
                            <?php
                                 echo "$reg7"; 
                            ?>
                        </td>

                        <td class="celdatd">
                            <?php

                                $norte1="NORTE";
                                $sur1="SUR";                            

                                if ($reg8==$norte1)
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
                    <tr class="td2">
                        <td colspan='0' class="celdatd"><b>REDES ELECTRICAS:</b></td>
                        <td colspan="2" class="celdatd">
                    <?php
                        include 'conexion.php';
                          $con_electrica= pg_query($con, "SELECT DISTINCT
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redelectrica
                                                INNER JOIN construccion ON construccion.conid= redelectrica.eleconstrucc
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='REPRODUCCION BOVINA'" );
                            while ($resultado= pg_fetch_array($con_electrica))
                                            {
                                                for($i=0;$i<count($con_electrica);$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                      
                    ?>                            
                        </td>
                    <tr>
                    <tr class="td2">
                        <td colspan='0' class="celdatdazul"><b>REDES  GAS:</b></td>
                        <td colspan="2" class="celdatdazul">
                    <?php
                        include 'conexion.php';
                        $con_redgas= pg_query($con, "SELECT DISTINCT 
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redgas
                                                INNER JOIN construccion ON construccion.conid= redgas.rgaconstrucc 
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='REPRODUCCION BOVINA'" );
                       
                            while ($resultado= pg_fetch_array($con_redgas))
                                            {                                                   
                                                for($i=0;$i<count($con_redgas);$i++) 
                                                    {
                                                        echo'<div  class="celdatdazul">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                    
                                        
                    ?>                            
                        </td>
                    </tr>
                    <tr class="td2">
                        <td colspan='0' class="celdatd"><b>REDES LOGICAS:</b></td>
                        <td colspan="2" class="celdatd">
                    <?php
                        include 'conexion.php';
                        $con_redlogica= pg_query($con, "SELECT DISTINCT 
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redlogica
                                                INNER JOIN construccion ON construccion.conid= redlogica.rloconstrucc 
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='REPRODUCCION BOVINA'" );
                        if ($con_redlogica<>"NO APLICA") 
                        {
                            while ($resultado= pg_fetch_array($con_redlogica))
                                            {
                                                for($i=0;$i<count($con_redlogica);$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                        }
                        else
                        {
                         echo'<div  class="celdatd">NO APLICA <BR></div>';   
                        }                                            
                        
                                        
                    ?>
                            
                        </td>
                    </tr>
                    <tr class="td2">
                        <td colspan='0' class="celdatdazul"><b>REDES SANITARIAS:</b></td>
                        <td colspan="2" class="celdatdazul">
                    <?php
                        include 'conexion.php';
                        $con_sanitaria= pg_query($con, "SELECT DISTINCT 
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redsanitaria
                                                INNER JOIN construccion ON construccion.conid= redsanitaria.rsaconstrucc 
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='REPRODUCCION BOVINA'" );
                        
                             while ($resultado= pg_fetch_array($con_sanitaria))
                                            {
                                                for($i=0;$i<count($con_sanitaria);$i++) 
                                                    {
                                                        echo'<div  class="celdatdazul">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                    
                                       
                    ?>                            
                        </td>
                    </tr>
                    <tr class="td2">
                        <td colspan='0' class="celdatd"><b>RUTAS:</b></td>
                        <td colspan="2" class="celdatd">
                    <?php
                        include 'conexion.php';
                        $con_ruta= pg_query($con, "SELECT DISTINCT 
                                                                    ruta.rutnombre, 
                                                                    unidad.uninombre
                                                FROM ruta_unidad
                                                INNER JOIN ruta ON ruta.rutid= ruta_unidad.runruta
                                                INNER JOIN unidad ON unidad.uniid= ruta_unidad.rununidad
                                                WHERE unidad.uninombre='REPRODUCCION BOVINA'" );
                                        while ($resultado= pg_fetch_array($con_ruta))
                                            {
                                                for($i=0;$i<count($con_ruta);$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                            }?>
                            
                        </td>
                        </tr>
                        <tr>
                    <td class="celdatdazul" colspan="4">
                       <center>
                    <a href="../descarga_excel/ReproduccionBovina_exc.php" target="_blank">
                            <img src="../img/Excel.png" title="Exportar Excel" class="imagen">
                    </a> 
                       </center>     
                        </td>
                    </tr>
                        



