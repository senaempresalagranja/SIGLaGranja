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
  $_SESSION['ExcelSiembra']=$_REQUEST['Siembra'];
  $_SESSION['ExcelCosecha']=$_REQUEST["Cosecha"];
  $_SESSION['ExcelSiembra1']=$_REQUEST['Siembra1'];
  $_SESSION['ExcelCosecha1']=$_REQUEST["Cosecha1"];
  $_SESSION['ExcelConstruccion']=$_REQUEST['Construccion'];
  $_SESSION['ExcelRemodelacion']=$_REQUEST["Remodelacion"];
  $_SESSION['ExcelConstruccion1']=$_REQUEST['Construccion1'];
  $_SESSION['ExcelRemodelacion1']=$_REQUEST["Remodelacion1"];
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
              <br><p class='tit-form'><b>CONSULTAR FECHAS </b></p><br>
            </td>
          </tr>
        <fieldset class="fielsetcon">
          <legend class="legendcon">SIEMBRAS Y COSECHAS:</legend>
          <form action="con_fecha.php" name="form1">
              <center><td><b><i>SIEMBRAS:</i></b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>DESDE:</td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="1">
                <input type="date" name="Siembra" id="Siembra" class="inp-form" value='<?php $Siembra=$_REQUEST["Siembra"]; if (isset($Siembra)) { echo "$Siembra"; } ?>' onblur="revisarfecha(this)" required/>
              </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <td>HASTA:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="date" name="Cosecha" id="Cosecha" class="inp-form" value='<?php $Cosecha=$_REQUEST["Cosecha"]; if (isset($Cosecha)) { echo "$Cosecha"; } ?>' onblur="revisarfecha(this)" required/>  
              </td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td><input type='image' src='img/Consultar.png' width='2%' onclick='replace(this.form.name)' title='Consultar'>
              </center>      
            </form>

          <form action="con_fecha.php" name="form1">
              <center><td><b><i>COSECHAS:</i></b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>DESDE:</td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="2">
                <input type="date" name="Siembra1" id="Siembra1" class="inp-form" value='<?php $Siembra1=$_REQUEST["Siembra1"]; if (isset($Siembra1)) { echo "$Siembra1"; } ?>' onblur="revisarfecha(this)" required/>
              </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <td>HASTA:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="date" name="Cosecha1" id="Cosecha1" class="inp-form" value='<?php $Cosecha1=$_REQUEST["Cosecha1"]; if (isset($Cosecha1)) { echo "$Cosecha1"; } ?>' onblur="revisarfecha(this)" required/>  
              </td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td><input type='image' src='img/Consultar.png' width='2%' onclick='replace(this.form.name)' title='Consultar'>
              </center>      
            </form>
        </fieldset><br><br>
<!--******************************************************************************-->
<!--******   AQUÍ COMIENZA EL SEGUNDO BLOQUE DE CONSULTA (CONSTRUCCIONES-REMODELACIONES)   ******-->
<!--******************************************************************************-->
        <fieldset class="fielsetcon">
          <legend class="legendcon">CONSTRUCCIONES Y REMODELACIONES:</legend>
          <form action="con_fecha.php" name="form1">
              <center><td><b><i>CONSTRUCCIONES:</i></b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>DESDE:</td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="3">
                <input type="date" name="Construccion" id="Construccion" class="inp-form" value='<?php $Construccion=$_REQUEST["Construccion"]; if (isset($Construccion)) { echo "$Construccion"; } ?>' onblur="revisarfecha(this)" required/>
              </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <td>HASTA:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="date" name="Remodelacion" id="Remodelacion" class="inp-form" value='<?php $Remodelacion=$_REQUEST["Remodelacion"]; if (isset($Remodelacion)) { echo "$Remodelacion"; } ?>' onblur="revisarfecha(this)" required/>  
              </td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td><input type='image' src='img/Consultar.png' width='2%' onclick='replace(this.form.name)' title='Consultar'>
              </center>      
            </form>

          <form action="con_fecha.php" name="form1">
              <center><td><b><i>REMODELACIONES:</i></b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>DESDE:</td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td>
                <input type="hidden" name="CodigoOculto" value="4">
                <input type="date" name="Construccion1" id="Construccion1" class="inp-form" value='<?php $Construccion1=$_REQUEST["Construccion1"]; if (isset($Construccion1)) { echo "$Construccion1"; } ?>' onblur="revisarfecha(this)" required/>
              </td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <td>HASTA:</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="date" name="Remodelacion1" id="Remodelacion1" class="inp-form" value='<?php $Remodelacion1=$_REQUEST["Remodelacion1"]; if (isset($Remodelacion1)) { echo "$Remodelacion1"; } ?>' onblur="revisarfecha(this)" required/>  
              </td>&nbsp;&nbsp;&nbsp;&nbsp;
              <td><input type='image' src='img/Consultar.png' width='2%' onclick='replace(this.form.name)' title='Consultar'>
              </center>      
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
      $Siembra=$_REQUEST['Siembra'];
      $Cosecha=$_REQUEST["Cosecha"];
      $Siembra1=$_REQUEST['Siembra1'];
      $Cosecha1=$_REQUEST["Cosecha1"];    
      $Construccion=$_REQUEST['Construccion'];
      $Remodelacion=$_REQUEST["Remodelacion"];
      $Construccion1=$_REQUEST['Construccion1'];
      $Remodelacion1=$_REQUEST["Remodelacion1"];
      $Tip_Hidden=$_REQUEST['CodigoOculto'];
/***********************************************/
/****   SIEMBRAS Y COSECHAS    ******/
/***********************************************/
    
      if ($Tip_Hidden == 1) 
      {
          $consulta= pg_query($con,"SELECT 
                              lote_cultivo.lcufechsiemb,
                              lote_cultivo.lcufechcosec,
                              area.arenombre,
                              unidad.uninombre,
                              cultivo.culidcodigo,
                              cultivo.culnomcomun,
                              cultivo.culnomcienti,
                              cultivo.culorigen,
                              cultivo.cullugarorig,
                              cultivo.culclimafavo,
                              cultivo.culdistsiemb,
                              cultivo.culunimedsie,
                              cultivo.culvidautil,
                              cultivo.cultiempvida,
                              cultivo.culextension,
                              cultivo.culunimedida,
                              cultivo.cullatitud,
                              cultivo.culorientlat,
                              cultivo.cullongitud,
                              cultivo.culorientlon
                      FROM lote_cultivo
                      INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo
                      INNER JOIN unidad ON unidad.uniid = lote_cultivo.lcuunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where lcufechsiemb between '$Siembra' and '$Cosecha' order by lcufechsiemb asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>FECHA SIEMBRA</th>
                            <th>FECHA COSECHA</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>CODIGO</th> 
                            <th>NOMBRE COMUN</th>
                            <th>NONBRE CIENTIFICO</th>
                            <th>ORIGEN</th>
                            <th>LUGAR ORIGEN</th>  
                            <th>CLIMA FAVORABLE</th>  
                            <th colspan="2">DISTANCIA SIEMBRA</th>
                            <th colspan="2">VIDA UTIL</th>
                            <th colspan="2">EXTENSION</th>
                            <th colspan="2">LATITUD</th>                          
                            <th colspan="2">LONGITUD</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $culunimedsie=$reg[11];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedsie'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $culunimedida=$reg[15];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedida'");
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
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
                        echo "<td>$reg[18]</td>";
                        echo "<td>$reg[19]</td>";
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
              <a href="descarga_consulta/fecha/exc_FechaSiembra.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
      }
      elseif ($Tip_Hidden == 2) 
      {
        $consulta= pg_query($con,"SELECT 
                              lote_cultivo.lcufechsiemb,
                              lote_cultivo.lcufechcosec,
                              area.arenombre,
                              unidad.uninombre,
                              cultivo.culidcodigo,
                              cultivo.culnomcomun,
                              cultivo.culnomcienti,
                              cultivo.culorigen,
                              cultivo.cullugarorig,
                              cultivo.culclimafavo,
                              cultivo.culdistsiemb,
                              cultivo.culunimedsie,
                              cultivo.culvidautil,
                              cultivo.cultiempvida,
                              cultivo.culextension,
                              cultivo.culunimedida,
                              cultivo.cullatitud,
                              cultivo.culorientlat,
                              cultivo.cullongitud,
                              cultivo.culorientlon
                      FROM lote_cultivo
                      INNER JOIN cultivo ON cultivo.culid = lote_cultivo.lcucultivo
                      INNER JOIN unidad ON unidad.uniid = lote_cultivo.lcuunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where lcufechcosec between '$Siembra1' and '$Cosecha1' order by lcufechcosec asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>FECHA SIEMBRA</th>
                            <th>FECHA COSECHA</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>CODIGO</th> 
                            <th>NOMBRE COMUN</th>
                            <th>NONBRE CIENTIFICO</th>
                            <th>ORIGEN</th>
                            <th>LUGAR ORIGEN</th>  
                            <th>CLIMA FAVORABLE</th>  
                            <th colspan="2">DISTANCIA SIEMBRA</th>
                            <th colspan="2">VIDA UTIL</th>
                            <th colspan="2">EXTENSION</th>
                            <th colspan="2">LATITUD</th>                          
                            <th colspan="2">LONGITUD</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $culunimedsie=$reg[11];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedsie'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[1];
                        }
        
                        $culunimedida=$reg[15];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedida'");
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
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
                        echo "<td>$reg[18]</td>";
                        echo "<td>$reg[19]</td>";
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
              <a href="descarga_consulta/fecha/exc_FechaCosecha.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
      }
      elseif ($Tip_Hidden == 3) 
      {
        $consulta= pg_query($con,"SELECT 
                              construccion.confecconstr,
                              construccion.confecremode,
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
                              construccion.conlatitud,
                              construccion.conorientlat,
                              construccion.conlongitud,
                              construccion.conorientlon
                      FROM construccion 
                      INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where confecconstr between '$Construccion' and '$Remodelacion' order by confecconstr asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>CODIGO</th> 
                            <th>NOMBRE</th>
                            <th colspan="2">EXTENSION</th>
                            <th>TIPO AMBIENTE</th>
                            <th>TIPO CONSTRUCCION</th>  
                            <th>ESTADO</th>  
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th colspan="2">LATITUD</th>                          
                            <th colspan="2">LONGITUD</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $conunidad=$reg[3];
                        $res1=pg_query($con, "SELECT * FROM unidad WHERE uninombre='$conunidad'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $conunimedcon=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$conunimedcon'");
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
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
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
              <a href="descarga_consulta/fecha/exc_FechaConstruccion.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
      }
      elseif ($Tip_Hidden == 4) 
      {
        $consulta= pg_query($con,"SELECT 
                              construccion.confecconstr,
                              construccion.confecremode,
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
                              construccion.conlatitud,
                              construccion.conorientlat,
                              construccion.conlongitud,
                              construccion.conorientlon
                      FROM construccion 
                      INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                      INNER JOIN area ON area.areid = unidad.uniarea where confecremode between '$Construccion1' and '$Remodelacion1' order by confecremode asc");
            echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>AREA</th>  
                            <th>UNIDAD</th>  
                            <th>CODIGO</th> 
                            <th>NOMBRE</th>
                            <th colspan="2">EXTENSION</th>
                            <th>TIPO AMBIENTE</th>
                            <th>TIPO CONSTRUCCION</th>  
                            <th>ESTADO</th>  
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th colspan="2">LATITUD</th>                          
                            <th colspan="2">LONGITUD</th>
                          </tr>
                        </thead>
                        <tbody>                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        
                        $conunidad=$reg[3];
                        $res1=pg_query($con, "SELECT * FROM unidad WHERE uninombre='$conunidad'");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $conunimedcon=$reg[7];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$conunimedcon'");
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
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
                        echo "<td>$reg[16]</td>";
                        echo "<td>$reg[17]</td>";
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
              <a href="descarga_consulta/fecha/exc_FechaRemodelacion.php" target="_blank">
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

   <!--ESTE ES UN EJEMPLO PARA GENERAR EL REPORTE ENTRE FECHAS
    $ini=2010-12-02
    $fin=2010-12-10
    $reporte=mysql_query("select * FROM reporte  WHERE DATE_FORMAT(fecha,'%Y-%m-%d') BETWEEN '$ini' AND '$fin' ");  

   -->