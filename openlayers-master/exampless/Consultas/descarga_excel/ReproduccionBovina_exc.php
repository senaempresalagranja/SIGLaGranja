<?php 
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA REPRODUCCION BOVINA.xls");
header("Pragma: no-cache");
header("Expires: 0");
//hacemos la conexion al servidor Postgresql
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
    <th width="1000" colspan="9">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">REPRODUCCION BOVINA </font></div></th>
    <th colspan="1">
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
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>DESCRIPCION</strong></th>

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
                                FROM construccion
                                INNER JOIN unidad ON unidad.uniid= construccion.conunidad
                                INNER JOIN area ON area.areid= unidad.uniarea
                                WHERE construccion.connombre = 'REPRODUCCION BOVINA'"
                        );

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
                                        $res3=pg_query($con,
                                                             "SELECT * FROM unidad_medida WHERE umeid='$reg3'"
                                                      );

                                while ($Registro_Unidad=pg_fetch_array($res3))
                                    {        
                                        $Unidad_Medida=($Registro_Unidad[1]);
                                    }
                    
                                   
                     echo "
				<tr>
				<td bgcolor=\"#fff\" align=\"center\">$reg0</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg1</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg2</td>
				<td bgcolor=\"#fff\" align=\"center\">$Unidad_Medida</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg4</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg5</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg7</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
        <td bgcolor=\"#fff\" align=\"center\">$reg9</td>
                
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
                    WHERE construccion.connombre='REPRODUCCION BOVINA'");
                
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
                    WHERE construccion.connombre='REPRODUCCION BOVINA'");
                
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
                    WHERE construccion.connombre='REPRODUCCION BOVINA'");
                
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
                    WHERE construccion.connombre='REPRODUCCION BOVINA'");
                
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
</table>