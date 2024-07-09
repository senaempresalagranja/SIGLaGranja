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

            $Consulta=pg_query($con,"SELECT 
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
                   WHERE unidad.uninombre='".$nombre."'");
                    
            while ($Reg_Construcc= pg_fetch_array($Consulta)) 
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
                        <td colspan="0" class="celdatd"><b>AREA:</b></td>

                        <td class="celdatd" colspan="0"><?php echo "$reg0"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>UNIDAD:</b></td>

                        <td class="celdatdazul" colspan="0"><?php echo "$reg1"; ?></td>
                    </tr>
                        <td colspan="0" class="celdatd"><b>EXTENSION:</b></td>

                        <td class="celdatd" colspan="0"><?php echo "$reg2"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>U/M:</b></td>

                        <td class="celdatdazul" colspan="0"><?php echo "$nombre1"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>RESPONSABLE:</b></td>

                        <td class="celdatd" colspan="0"><?php echo "$reg4"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatd"><b>LATITUD:</b></td>

                        <td class="celdatd" colspan="0"><?php echo "$reg5"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></td>

                        <td class="celdatdazul" colspan="0"><?php echo "$reg6"; ?></td>
                    </tr>
                     <tr>
                        <td colspan="0" class="celdatd"><b>LONGITUD:</b></td>

                        <td class="celdatd" colspan="0"><?php echo "$reg7"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>HEMISFERIO:</b></td>

                        <td class="celdatdazul" colspan="0"><?php echo "$reg8"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="0" class="celdatdazul"><b>DESCRIPCION:</b></td>

                        <td class="celdatdazul" colspan="0"><?php echo "$reg9"; ?></td>
                    </tr>
                    <tr>
                    <td class="celdatdazul" colspan="4">
                       <center>
                    <a href="../descarga_excel/PistaTractores_exc.php" target="_blank">
                            <img src="../img/Excel.png" title="Exportar Excel" class="imagen">
                    </a> 
                       </center>     
                        </td>
                    </tr>
                    