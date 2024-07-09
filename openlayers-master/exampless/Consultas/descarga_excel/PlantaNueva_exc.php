<?php 
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=TABLA PLANTA NUEVA.xls");
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
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">PLANTA NUEVA </font></div></th>
    <th colspan="1">
      <div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
    </th>
  </tr>
</table>
<table width="641" border="1">
<tr>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>AREA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>UNIDAD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>EXTENSION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>U/M</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO AMBIENTE</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CONTRUCCION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ESTADO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO CUBIERTA</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO PISO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TIPO MURO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA INAUGURACION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REMODELACION</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LATITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>LONGITUD</strong></th>
<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>HEMISFERIO</strong></th>

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
                   WHERE construccion.connombre='PLANTA NUEVA'");
                    
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
                                   
                     echo "
				<tr>
				<td bgcolor=\"#fff\" align=\"center\">$reg0</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg1</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg2</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg3</td>
				<td bgcolor=\"#fff\" align=\"right\">$reg4</td>
				<td bgcolor=\"#fff\" align=\"center\">$nombre1</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg6</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg7</td>
				<td bgcolor=\"#fff\" align=\"center\">$reg8</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg9</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg10</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg11</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg12</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg13</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg14</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg15</td>
                <td bgcolor=\"#fff\" align=\"right\">$reg16</td>
                <td bgcolor=\"#fff\" align=\"center\">$reg17</td>
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
                    WHERE construccion.connombre='PLANTA NUEVA'");
                
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
                    WHERE construccion.connombre='PLANTA NUEVA'");
                
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
                    WHERE construccion.connombre='PLANTA NUEVA'");
                
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
                    WHERE construccion.connombre='PLANTA NUEVA'");
                
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
</body>
</html>

