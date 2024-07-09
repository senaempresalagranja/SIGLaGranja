<!-- 
  Proyecto: Sistema de Informacion Georeferenciado del Centro Agropecuario "La Granja". 
  Nombre del proyecto:  SIGLaGranja. 
  Desarrolladores: Tecnologo en Análisis y Desarrollo de Sistemas de Información "ADSI". 
  Numero de Ficha: 798585. 
  Descripcion del Proyecto: Software que permita la Georeferenciación de Centro Agropecuario "La Granja" SENA Espinal - Tolima. 
  Año de Desarrollo: 2014-2015.-->
<!-- Descripcion de la pagina en formato de HTML5. 
-->

<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE INICIA LA SESION PARA IDENTIFICAR EL ROL QUE TIENE LA PERSONA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<?php
error_reporting(E_ALL^E_NOTICE);
session_start();
if (isset($_SESSION['USUARIO ADMIN'])){}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../visitante/index.php?Acceso Denegado'</script>";
}
  $_SESSION['EstanqueExcel']=$_REQUEST['ConEstanques'];
  $_SESSION['NombreEspAcu']=$_REQUEST["NomEspAcua"];
  $_SESSION['EspecieExcel']=$_REQUEST['ConEspecies'];
  $_SESSION['NomRazaExcel']=$_REQUEST["NomRaza"];
  ?>

  <!DOCTYPE html>
  <html lang="es">
  <?php  include 'include/header.php'; ?>
  <!--<META HTTP-EQUIV="REFRESH" CONTENT="5">Es molesto que refresque las pagina cada 5 seg, por eso es mejor validar que esta línea de código se ejecute sólo cuando se acaba de dar clic en una opcion del value-->
  <style type="text/css">
    .GrillaConsulta table 
    { 
      border-collapse: collapse; 
      text-align: left; 
      width: 50%; 
    } 
    .GrillaConsulta
    {
      font: normal 12px/150% Arial, Helvetica, sans-serif; 
      background: #fff; 
      overflow: scroll; 
      margin-left: 15px; 
      margin-right: 15px; 
      -webkit-border-radius: 11px; 
      -moz-border-radius: 11px; 
      border-radius: 11px; 
    }
    .GrillaConsulta table td, .GrillaConsulta table th 
    { 
      padding: 4px 7px;/*Espaciado Vertical y Horizontal*/
    }
    .GrillaConsulta table thead th 
    {
      background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );/*Degradé del ENCABEZADO, Superior e Inferior*/ 
      color:#FFFFFF;/*Color de la Letra*/ 
      font-size: 12px;/*Tamaño de la letra*/
      font-weight: bold;/*Decoración de la letra*/ 
      border-left: 1px solid #fff;/*Opciones para la linea separadora de los encabezados*/ 
    } 
    .GrillaConsulta table thead th:first-child 
    { 
      border: none; 
    }
    .GrillaConsulta table tbody td 
    { 
      color: #00557F; 
      border-left: 2px solid #E1EEF4;
      font-size: 12px;
      font-weight: normal; 
    }
    .GrillaConsulta table tbody td:first-child 
    { 
      border-left: groove;/*Borde izquierdo de la columna*/ 
    }
    .GrillaConsulta table tbody tr:last-child td 
    { 
      border-bottom: groove;/*Borde inferior de la fila*/ 
    }
  </style>
  <!-- Descripcion para el cuerpo de la pagina  -->
  <body>
    <!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">
      <!-- Descripcion para el Banner-->
      <div id="banner">
        <?php include 'include/banner.php'; ?>
      </div>
      <!-- Descripcion para el Menu-->
      <div id="nav">
        <?php include 'include/menu.php'; ?>
      </div>
      <!-- Descripcion para el cuerpo de la pagina-->
      <!-- Descripcion para el cuerpo de la pagina-->
      <div>
      <tr>
            <td colspan="4">
              <br><p class='tit-form'><b>CONSULTAR ESPECIES</b></p><br>
            </td>
          </tr>
        <fieldset class="fielsetcon">
          <legend class="legendcon">ESPECIES ACUATICAS:</legend>
          <form action="con_especies.php" name="ConEstanque">
              <td>ESTANQUE:</td>&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="1">                    
                <select name="ConEstanques" class="select-form" onchange="submit();">
                  <?php
                  include 'conexion.php';

                  $Estanques=$_REQUEST['ConEstanques'];

                  if ($Estanques) 
                  {
                    if ($Estanques == "All") 
                    {
                      echo "<option selected disabled>TODAS</option>";
                      $ConBDEstanques= pg_query($con,"SELECT * FROM estanque where estfecha <> '$Estanques'");
                      while ($RegistrosEstanques=pg_fetch_array($ConBDEstanques)) 
                      {
                        $IdEstanque=$RegistrosEstanques[0];
                        $NomEstanque=$RegistrosEstanques[1];
                        echo "<option value='$IdEstanque'>$NomEstanque</option>";
                      }
                    }
                    else
                    {
                      $ConBDEst= pg_query($con, "SELECT * from estanque where estid = '$Estanques'");
                      while ($RegistrosEst=pg_fetch_array($ConBDEst)) 
                      {
                        $NomEst=$RegistrosEst[1];
                        echo "<option selected disabled>$NomEst</option>";
                      }
                      echo "<option value='All'>TODAS</option>";
                      $ConBDArea2= pg_query($con, "SELECT * from estanque where estid <> '$Estanques'");
                      while ($RegistrosEst=pg_fetch_array($ConBDArea2)) 
                      {
                        $IdEst=$RegistrosEst[0];
                        $NomEst=$RegistrosEst[1];
                        echo "<option value='$IdEst'>$NomEst</option>";
                      }
                    }
                  }
                  else
                  {
                    echo "<option selected disabled>SELECCIONE</option>
                    <option value='All'>TODAS</option>";
                    $ConBDEstanques2= pg_query($con, "SELECT * from estanque");
                    while ($RegistrosEstanques2=pg_fetch_array($ConBDEstanques2)) 
                    {
                      $IdEstanque1=$RegistrosEstanques2[0];
                      $NomEstanque1=$RegistrosEstanques2[1];
                      echo "<option value='$IdEstanque1'>$NomEstanque1</option>";
                    }
                  }            
                  ?>
                </select>
              </td>
            </form><br><br>
            <!--   NomComun Enfermedad   -->
            <form action="con_especies.php" name="ConNomEspAcu">
              <td>NOMBRE:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="CodigoOculto" value="2">
                <input type="text" name="NomEspAcua" id="NomEspAcua" class="inp-form" value='<?php $NomEspAcua=$_REQUEST["NomEspAcua"]; if (isset($NomEspAcua)) { echo "$NomEspAcua"; } ?>' placeholder="EJ: CACHAMA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onchange="submit();">    
              </td>      
            </form>
        </fieldset><br><br>
<!--******************************************************************************-->
<!--******   AQUÍ COMIENZA EL SEGUNDO BLOQUE DE CONSULTA (ESPECIES "TERRESTRES")   ******-->
<!--******************************************************************************-->
        <fieldset class="fielsetcon">
          <legend class="legendcon">ESPECIES:</legend>
          <form action="con_especies.php" name="ConEstanque">
              <td>ESPECIE:</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="3">                    
                <select name="ConEspecies" class="select-form" onchange="submit();">
                  <?php
                  include 'conexion.php';

                  $Especies=$_REQUEST['ConEspecies'];

                  if ($Especies) 
                  {
                    if ($Especies == "All") 
                    {
                      echo "<option selected disabled>TODAS</option>";
                      $ConBDespecies= pg_query($con,"SELECT * FROM especie where espnomcomun <> '$Especies'");
                      while ($Registrosespecies=pg_fetch_array($ConBDespecies)) 
                      {
                        $Idespecie=$Registrosespecies[0];
                        $Nomespecie=$Registrosespecies[3];
                        echo "<option value='$Idespecie'>$Nomespecie</option>";
                      }
                    }
                    else
                    {
                      $ConBDEsp= pg_query($con, "SELECT * from especie where espid = '$Especies'"); 
                      while ($RegistrosEst=pg_fetch_array($ConBDEsp)) 
                      {
                        $NomEspes=$RegistrosEst[3];
                        echo "<option selected disabled>$NomEspes</option>";
                      }
                      echo "<option value='All'>TODAS</option>";
                      $ConBDArea2= pg_query($con, "SELECT * from especie where espid <> '$Especies'");
                      while ($RegistrosEst=pg_fetch_array($ConBDArea2)) 
                      {
                        $IdEst=$RegistrosEst[0];
                        $NomEspes=$RegistrosEst[3];
                        echo "<option value='$IdEst'>$NomEspes</option>";
                      }
                    }
                  }
                  else
                  {
                    echo "<option selected disabled>SELECCIONE</option>
                    <option value='All'>TODAS</option>";
                    $ConBDespecies2= pg_query($con, "SELECT * from especie");
                    while ($Registrosespecies2=pg_fetch_array($ConBDespecies2)) 
                    {
                      $Idespecie1=$Registrosespecies2[0];
                      $Nomespecie1=$Registrosespecies2[3];
                      echo "<option value='$Idespecie1'>$Nomespecie1</option>";
                    }
                  }            
                  ?>
                </select>
              </td>
            </form><br><br>
            <!--   NomComun Enfermedad   -->
            <form action="con_especies.php" name="ConNomEsp">
              <td>RAZA:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="CodigoOculto" value="4">
                <input type="text" name="NomRaza" id="NomRaza" class="inp-form" value='<?php $NomRaza=$_REQUEST["NomRaza"]; if (isset($NomRaza)) { echo "$NomRaza"; } ?>' placeholder="EJ: ISPAÑOLA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onchange="submit();">    
              </td>      
            </form>
        </fieldset>
      </div>
<!--+++++++               +++++++-->
<!--+++++++   CONSULTAS   +++++++-->
<!--+++++++               +++++++-->
  <br><br>
  <div>
<?php
      error_reporting(E_ALL ^ E_NOTICE);
      include 'conexion.php';      
      $Estanques=$_REQUEST['ConEstanques'];
      $NomEspAcuatica=$_REQUEST["NomEspAcua"];      
      $Especies=$_REQUEST['ConEspecies'];
      $NomRaza=$_REQUEST["NomRaza"];
      $Tip_Hidden=$_REQUEST['CodigoOculto'];
/***********************************************/
/****   ESPECIES ACUATICAS (ESTANQUES)    ******/
/***********************************************/
    
      if ($Tip_Hidden == 1) 
      {
        if ($Estanques == "All")
        {        
          $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              estanque.estnombre,
                              estanque.esttipestanq,
                              estanque.estprofundid,
                              estanque.estunimedpro,
                              estanque.estespejagua,
                              estanque.estunimedesp,
                              estanque.estvolumagua,
                              estanque.estunimedvol,
                              especieacuatica.eactipespeci,
                              especieacuatica.eacnomcomun,
                              especieacuatica.eacnomcienti
                      FROM estanque_especieacuatica
                      INNER JOIN especieacuatica ON especieacuatica.eacid = estanque_especieacuatica.eeaespacua
                      INNER JOIN estanque ON estanque.estid = estanque_especieacuatica.eeaestanque
                      INNER JOIN unidad ON unidad.uniid = especieacuatica.eacunidad
                      INNER JOIN area ON area.areid = unidad.uniarea order by estnombre asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>NOMBRE</th>
                            <th>TIPO ESTANQUE</th>
                            <th colspan="2">PROFUNDIDAD</th>
                            <th colspan="2">ESPEJO AGUA</th>
                            <th colspan="2">VOLUMEN</th>  
                            <th>TIPO ESPECIE</th>  
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>                          
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $estunimedpro=$reg[5];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $estunimedesp=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }

                        $estunimedvol=$reg[9];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol'");

                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre2=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$nombre2</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_Estanques.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
        else
        {
          $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              estanque.estnombre,
                              estanque.esttipestanq,
                              estanque.estprofundid,
                              estanque.estunimedpro,
                              estanque.estespejagua,
                              estanque.estunimedesp,
                              estanque.estvolumagua,
                              estanque.estunimedvol,
                              especieacuatica.eactipespeci,
                              especieacuatica.eacnomcomun,
                              especieacuatica.eacnomcienti
                      FROM estanque_especieacuatica
                      INNER JOIN especieacuatica ON especieacuatica.eacid = estanque_especieacuatica.eeaespacua
                      INNER JOIN estanque ON estanque.estid = estanque_especieacuatica.eeaestanque
                      INNER JOIN unidad ON unidad.uniid = especieacuatica.eacunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where estid = '$Estanques' order by estnombre asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>NOMBRE</th>
                            <th>TIPO ESTANQUE</th>
                            <th colspan="2">PROFUNDIDAD</th>
                            <th colspan="2">ESPEJO AGUA</th>
                            <th colspan="2">VOLUMEN</th>  
                            <th>TIPO ESPECIE</th>  
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>                          
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $estunimedpro=$reg[5];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $estunimedesp=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }

                        $estunimedvol=$reg[9];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol'");

                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre2=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$nombre2</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_Estanque.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
      }
/***************************************/
/**** NOMBRE ESPECIE ACUATICA **********/
/***************************************/
      elseif ($Tip_Hidden == 2) 
      {
        $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              estanque.estnombre,
                              estanque.esttipestanq,
                              estanque.estprofundid,
                              estanque.estunimedpro,
                              estanque.estespejagua,
                              estanque.estunimedesp,
                              estanque.estvolumagua,
                              estanque.estunimedvol,
                              especieacuatica.eactipespeci,
                              especieacuatica.eacnomcomun,
                              especieacuatica.eacnomcienti
                      FROM estanque_especieacuatica
                      INNER JOIN especieacuatica ON especieacuatica.eacid = estanque_especieacuatica.eeaespacua
                      INNER JOIN estanque ON estanque.estid = estanque_especieacuatica.eeaestanque
                      INNER JOIN unidad ON unidad.uniid = especieacuatica.eacunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where eacnomcomun LIKE '%$NomEspAcuatica%' order by eacnomcomun asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>                             
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>
                            <th>TIPO ESPECIE</th> 
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>NOMBRE ESTANQUE</th>
                            <th>TIPO ESTANQUE</th>
                            <th colspan="2">PROFUNDIDAD</th>
                            <th colspan="2">ESPEJO AGUA</th>
                            <th colspan="2">VOLUMEN</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $estunimedpro=$reg[5];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $estunimedesp=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }

                        $estunimedvol=$reg[9];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol'");

                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre2=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$nombre2</td>";
                        
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_NombreEspAcu.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
/**********************************************/
/****       ESPECIES (TERRESTRES)        ******/
/**********************************************/
        if ($Tip_Hidden == 3) 
      {
        if ($Especies == "All")
        {        
          $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              raza.raznombre,
                              raza.razorigen,
                              raza.razlugorigen,
                              raza.razproposito,
                              raza.razproducion,
                              raza.razunimedpro,
                              especie.esptipespeci,
                              especie.espnomcomun,
                              especie.espnomcienti
                      FROM especie_raza
                      INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                      INNER JOIN raza ON raza.razid = especie_raza.eraraza
                      INNER JOIN unidad ON unidad.uniid = especie.espunidad
                      INNER JOIN area ON area.areid = unidad.uniarea order by espnomcomun asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>                              
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>
                            <th>TIPO ESPECIE</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>NOMBRE RAZA</th>
                            <th>ORIGEN</th>
                            <th>LUGAR ORIGEN</th>
                            <th>PROPOSITO</th>
                            <th colspan="2">PRODUCCION</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $razunimedpro=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";                        
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_Especies.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
        else
        {
          $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              raza.raznombre,
                              raza.razorigen,
                              raza.razlugorigen,
                              raza.razproposito,
                              raza.razproducion,
                              raza.razunimedpro,
                              especie.esptipespeci,
                              especie.espnomcomun,
                              especie.espnomcienti
                      FROM especie_raza
                      INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                      INNER JOIN raza ON raza.razid = especie_raza.eraraza
                      INNER JOIN unidad ON unidad.uniid = especie.espunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where espid = '$Especies' order by espnomcomun asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>                              
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>
                            <th>TIPO ESPECIE</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>NOMBRE RAZA</th>
                            <th>ORIGEN</th>
                            <th>LUGAR ORIGEN</th>
                            <th>PROPOSITO</th>
                            <th colspan="2">PRODUCCION</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $razunimedpro=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";                        
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_Especie.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
      }
    }
/***************************************/
/****       NOMBRE RAZA       **********/
/***************************************/
      elseif ($Tip_Hidden == 4) 
      {
        $consulta= pg_query($con,"SELECT 
                              area.arenombre,
                              unidad.uninombre,
                              raza.raznombre,
                              raza.razorigen,
                              raza.razlugorigen,
                              raza.razproposito,
                              raza.razproducion,
                              raza.razunimedpro,
                              especie.esptipespeci,
                              especie.espnomcomun,
                              especie.espnomcienti
                      FROM especie_raza
                      INNER JOIN especie ON especie.espid = especie_raza.eraespecie
                      INNER JOIN raza ON raza.razid = especie_raza.eraraza
                      INNER JOIN unidad ON unidad.uniid = especie.espunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where raznombre like '%$NomRaza%' order by raznombre asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>NOMBRE RAZA</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>
                            <th>ORIGEN</th>
                            <th>LUGAR ORIGEN</th>
                            <th>PROPOSITO</th>
                            <th colspan="2">PRODUCCION</th>
                            <th>TIPO ESPECIE</th>
                            <th>NOMBRE COMUN</th>
                            <th>NOMBRE CIENTIFICO</th>                            
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $razunimedpro=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[1];
                        }
                        
                        echo "<tr ";
                        if ($Num_Fila%2==0) 
                        {
                          echo "bgcolor=#A8D4E1";
                          echo ">";
                        }
                        else
                        {
                          echo "bgcolor=#FAFAFA";
                          echo ">";
                        }                        
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";                        
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";                        
                        echo "</tr>";
                        $Num_Fila++;                    
                      }
                          echo "</tbody>";
                          echo "</table>";
                          echo "</div>";
        echo '
          <tr>
            <td colspan="16" class="td-iconos">
            <center>                        
              <a href="descarga_consulta/especie/exc_NombreRaza.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }       
      ?>
      </center>
      <!-- Descripcion para el pie de pagina-->
       <div id="foot">
         <?php
         include 'include/piepagina.php'
         ?>
       </div>
       <div class="fin">
         Luis Fernando Chamorro Rodríguez
       </div>
     </div>
   </body>
   </html>