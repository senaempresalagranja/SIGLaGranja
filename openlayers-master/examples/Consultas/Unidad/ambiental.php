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
            <img src="../../img/banner2.png" alt="we_are_champions " style="width: 100%;height: 100%" />
        </div> 
    </header>
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
                   WHERE unidad.uninombre='$nombre'");
                    
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
                }

  ?>
  <section>
        <article>
            <center>
                <table border='0' width="2%" style="border: solid #000;    border-radius: 10px;
                border-style: double; padding: 4px; width: 500px">
                    <tr>
                        <td colspan="4" class="tabla0">
                             <div ><center><b>FICHA TECNICA: <?php echo $nombre;?></b></center></div><br>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="0" class="celdatd"><b>AREA:</b></th>
                        <td class="celdatd" colspan="0"><center><?php echo "$reg0"; ?></center></td>
                    </tr>

                    <tr>
                        <th colspan="0" class="celdatdazul"><b>UNIDAD:</b></th>
                         <td class="celdatdazul" colspan="0"><center><?php echo "$reg1"; ?></center></td>
                     </tr>

                     <tr>
                        <th colspan="0" class="celdatd"><b>EXTENSION:</b></th>
                        <td class="celdatd" colspan="0"><center><?php echo "$reg2"; ?></center></td>
                    </tr>

                    <tr>
                        <th colspan="0" class="celdatdazul"><b>U/M:</b></th>
                        <td class="celdatdazul" colspan="0"><center><?php echo "$nombre1"; ?></center></td>
                    </tr>    

                    <tr>
                        <th colspan="0" class="celdatd"><b>RESPONSABLE:</b></th>
                        <td class="celdatd" colspan="0"><center><?php echo "$reg4"; ?></center></td>
                    </tr>

                    <tr>
                        <th colspan="0" class="celdatd"><b>LATITUD:</b></th>
                        <td class="celdatd" colspan="0"><center><?php echo "$reg5"; ?></center></td>
                    </tr>

                    <tr>
                        <th colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></th>
                        <td class="celdatdazul" colspan="0"><center><?php echo "$reg6"; ?></center></td>
                    </tr>

                    <tr>
                        <th colspan="0" class="celdatd"><b>LONGITUD:</b></th>
                        <td class="celdatd" colspan="0"><center><?php echo "$reg7"; ?></center></td>
                    </tr>

                    <tr>
                         <th colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></th>
                        <td class="celdatdazul" colspan="0"><center><?php echo "$reg8"; ?></center></td>
                    </tr>

                    <tr>
                          <th colspan='0' class="celdatd"> <b>TIPO DE RIEGO:</b></th>
                          <td colspan="0" class="celdatd"><center>
                    <?php
                                include 'conexion.php';
                                $tip_riego=
                                    pg_query($con, "SELECT DISTINCT
                                                                                  
zonaverde.zvetipriego
FROM zonaverde
                  
                  INNER JOIN unidad ON unidad.uniid = zonaverde.zveunidad
                   WHERE unidad.uninombre='$nombre'" );

                                    while ($resultado= pg_fetch_array($tip_riego))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                                       
                    ?>
                        </td>
                    </center>
                </td>
            </tr>

            <tr>
                         
                          <th colspan="0" class="celdatdazul"><b>DESCRIPCION:</b></th>
                        <td class="celdatdazul" colspan="0"><center><?php echo "$reg9"; ?></center></td>
                    </tr>


                    <tr>
                          <th colspan='0' class="celdatdazul"><b>CONSTRUCCIONES:</b></th>
                           <td colspan="0" class="celdatdazul" ><center>
                    <?php
                                include 'conexion.php';
                                $con_construccion=
                                    pg_query($con, "SELECT DISTINCT
                                                                    construccion.connombre,
                                                                    unidad.uninombre
                                                    FROM construccion                       
                                                    INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                    WHERE unidad.uninombre='$nombre'" );

                                    while ($resultado= pg_fetch_array($con_construccion))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatdazul">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                                       
                    ?>
                        </center></td>
                    </tr>

                    <tr>
                          <th colspan='0' class="celdatdazul"><b>POSTES:</b></th>
                           <td colspan="0" class="celdatdazul" ><center>
                         
                    <?php
                        include 'conexion.php';
                        $Postes= pg_query($con, "SELECT DISTINCT
                                                                    poste.posidcodigo, 
                                                                    unidad.uninombre
                                                FROM poste                         
                                                INNER JOIN unidad ON unidad.uniid= poste.posunidad
                                                WHERE unidad.uninombre='$nombre'" );
                                        while ($resultado= pg_fetch_array($Postes))
                                            {
                                                for($i=0;$i<count($Postes);$i++) 
                                                    {
                                                        echo'<div  class="celdatdazul">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                                            if ($Postes=="")
                                            {
                                                echo "NO HAY REGISTROS";
                                            }
                                           
                    ?>
                            
                        </center></td>
                    </tr>

                    <tr>
                          <th colspan='0' class="celdatd"><b>REDES ELECTRICAS:</b></th>
                          <td colspan="0" class="celdatd"><center>
                    <?php
                        include 'conexion.php';
                          $con_electrica= pg_query($con, "SELECT DISTINCT
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redelectrica
                                                INNER JOIN construccion ON construccion.conid= redelectrica.eleconstrucc
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='$nombre'" );
                            while ($resultado= pg_fetch_array($con_electrica))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatd">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                      
                    ?>                            
                        </center></td>
                    </tr>

                    <tr>
                          <th colspan='0' class="celdatd"><b>REDES LOGICAS:</b></th>
                           <td colspan="0" class="celdatd"><center>
                    <?php
                        include 'conexion.php';
                        $con_redlogica= pg_query($con, "SELECT DISTINCT 
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redlogica
                                                INNER JOIN construccion ON construccion.conid= redlogica.rloconstrucc 
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='$nombre'" );
                        if ($con_redlogica<>"NO APLICA") 
                        {
                            while ($resultado= pg_fetch_array($con_redlogica))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
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
                            
                       </center> </td>
                   </tr>

                   <tr>
                          <th colspan='0' class="celdatdazul"><b>REDES SANITARIAS:</b></th>
                          <td colspan="0" class="celdatdazul"><center>
                    <?php
                        include 'conexion.php';
                        $con_sanitaria= pg_query($con, "SELECT DISTINCT 
                                                                        construccion.connombre, 
                                                                        unidad.uninombre
                                                FROM redsanitaria
                                                INNER JOIN construccion ON construccion.conid= redsanitaria.rsaconstrucc 
                                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                                WHERE unidad.uninombre='$nombre'" );
                        if($con_sanitaria<>"NO APLICA")
                        {
                             while ($resultado= pg_fetch_array($con_sanitaria))
                                            {
                                                for($i=0;$i< 1 ;$i++) 
                                                    {
                                                        echo'<div  class="celdatdazul">'. $resultado[$i].'<BR>'.'</div>';
                                                    }
                                            }
                        }
                        else
                        {
                             echo'<div  class="celdatd">NO APLICA <BR></div>';  
                        }
                                       
                    ?>                            
                       </center> </td>
                   </tr>

                   <tr>
                           <th colspan='0' class="celdatd"><b>RUTAS:</b></th>
                           <td colspan="0" class="celdatd"><center>
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
                            }?>
                            
                       </center> </td>
                    </tr>
                    
                          
                    <tr>
                    <th class="celdatdazul" colspan="34">
                       <center>
                    <a href="../descarga_excel/PistaTractores_exc.php" target="_blank">
                            <img src="../img/Excel.png" title="Exportar Excel" class="imagen">
                    </a> 
                       </center>     
                        </th>
                    </tr>