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
if (isset($_SESSION['USUARIO CONSULTA'])){}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../visitante/index.php?Acceso Denegado'</script>";
}
$_SESSION['CodUnidad']=$_REQUEST['ConsUnidades'];
$_SESSION['CodArea']=$_REQUEST['ConsAreas'];
$_SESSION['CodConstruccion']=$_REQUEST['CodConstrucciones'];
$_SESSION['TipAmbConstruccion']=$_REQUEST['TipAmbiente'];
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
  alt-background-Color: #ff0d0d; 
}
.GrillaConsulta table tbody .alt td 
{ 
  background: #FF0D0D; color: #00557F; 
}
.GrillaConsulta table tbody td:first-child 
{ 
  border-left: groove;/*Borde izquierdo de la columna*/
  alt-background-Color: #ff0d0d;  
}
.GrillaConsulta table tbody tr:last-child td 
{ 
  border-bottom: groove;/*Borde inferior de la fila*/ 
  alt-background-Color: #ff0d0d; 
}
</style>

<script type="text/javascript">
  //++++++++++++++++++   **PRIMER** VALIDACION DE HAB Y DESHAB   ++++++++++++++++++++++++++++++++++++
//Validacion para Habilitar las opciones del RadioButton
function habilitaConstruccion(form)
{ 
  document.getElementById("Construccion4").disabled=true;
  document.getElementById("Construccion4").style.background = "#EDE9E9";

  document.getElementById("Construccion2").disabled=false;
  document.getElementById("Construccion2").style.background = "#FFF";

  document.getElementById("Construccion1").disabled=false;
  document.getElementById("Construccion1").style.background = "#FFF";

  document.getElementById("Construccion3").disabled=false;
  document.getElementById("Construccion3").style.background = "#FFF";
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaConstruccion(form)
{ 
  document.getElementById("Construccion3").disabled=true;
  document.getElementById("Construccion3").style.background = "#EDE9E9";

  document.getElementById("Construccion2").disabled=true;
  document.getElementById("Construccion2").style.background = "#EDE9E9";

  document.getElementById("Construccion1").disabled=true;
  document.getElementById("Construccion1").style.background = "#EDE9E9";

  document.getElementById("Construccion4").disabled=false;
  document.getElementById("Construccion4").style.background = "#FFF";
}

</script>
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
    <table class="table">
        <tr>
          <td colspan="4">
            <br><p class='tit-form'><b>CONSULTAR CONSTRUCCION</b></p><br>
          </td>
        </tr>
        <tr>
          <center>
          <td colspan="2">
            <input type='radio' name='Construccion' id='Construccion' onclick='habilitaConstruccion(this.form)'> <em>CRITERIO DE BÚSQUEDA POR FILTRO</em></input>        
          </td>
          <td colspan="2">
            <input type='radio' name='Construccion' id='Construccion' onclick='deshabilitaConstruccion(this.form)'> <em>CRITERIO DE BÚSQUEDA POR CÓDIGO</em></input>
          </td>
          </center>
        </tr>
        <tr height="20px"></tr>

        <form action="con_construccion.php" name="ConArea">
        <tr>        
          <td>AREA:</td>
          <td>
            <input type="hidden" name="CodigoOculto" value="1">                    
            <select name="ConsAreas" id="Construccion1"  class="select-form" onchange="submit();">
                <?php
                  include 'conexion.php';

                  $Areas=$_REQUEST['ConsAreas'];
                  $Unidades=$_REQUEST['ConsUnidades'];
                  $Construcciones=$_REQUEST['TipAmbiente'];

                  if ($Areas) 
                  {
                    if ($Areas == "All") 
                    {                      
                      echo "<option selected disabled>TODAS</option>";//Opcion Todas cuando se selecciona un Area
                      $ConBDArea2= pg_query($con, "SELECT * from area where areidcodigo <> '$Areas'");
                      while ($RegistrosAreas=pg_fetch_array($ConBDArea2)) 
                      {
                        $IdArea=$RegistrosAreas[0];
                        $NomArea=$RegistrosAreas[2]; 
                        echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado un Area
                      }
                    }
                    else
                    {
                      $ConBDArea= pg_query($con, "SELECT * from area where areid = '$Areas'");
                      while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                      {
                        $NomArea=$RegistrosAreas[2];
                        echo "<option selected disabled>$NomArea</option>";//Opcion por defecto al escoger un Area
                      }
                      echo "<option value='All'>TODAS</option>";//Opcion Todas cuando se selecciona un Area
                      $ConBDArea2= pg_query($con, "SELECT * from area where areid <> '$Areas'");//Es diferente para que no repita como opcion el Area anteriormente seleccionada
                      while ($RegistrosAreas=pg_fetch_array($ConBDArea2)) 
                      {
                        $IdArea=$RegistrosAreas[0];
                        $NomArea=$RegistrosAreas[2];
                        echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado un Area
                      }
                    }                    
                  }
                  else
                  {
                    if ($Unidades) 
                    {
                      $CodUniArea=$_SESSION['uniarea'];
                      if ($Unidades == "All") 
                      {
                        $ConBDArea= pg_query($con, "SELECT * from area where areid = '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $NomArea=$RegistrosAreas[2];
                          echo "<option selected disabled>$NomArea</option>";//Opcion por defecto al escoger un Area
                        }
                        echo "<option value='All'>TODAS</option>";//Opcion Todas cuando se selecciona un Area
                        $ConBDArea2= pg_query($con, "SELECT * from area where areid <> '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea2)) 
                        {
                          $IdArea=$RegistrosAreas[0];
                          $NomArea=$RegistrosAreas[2];
                          echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado un Area
                        }                        
                      }
                      elseif ($Unidades <> "All") 
                      {
                        $ConBDUnidad=pg_query($con, "SELECT * from unidad where uniid = '$Unidades'");
                        while ($RegistrosUnidades=pg_fetch_array($ConBDUnidad)) 
                        {
                          $CodArea=$RegistrosUnidades[1];
                          $CodUnidad=$RegistrosUnidades[0];
                        }
                        $ConBDArea= pg_query($con, "SELECT * from area where areid = '$CodArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $NomArea=$RegistrosAreas[2];
                          echo "<option selected disabled>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado una Unidad
                        }
                          echo "<option value='All'>TODAS</option>";
                        $ConBDArea= pg_query($con, "SELECT * from area where areid <> '$CodArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $IdArea=$RegistrosAreas[0];
                          $NomArea=$RegistrosAreas[2];
                          echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado una Unidad
                        }
                      }
                    }
                    elseif ($Construcciones) 
                    {
                      if ($Construcciones == "All") 
                      {
                        $CodUniArea=$_SESSION['uniarea'];
                        $ConBDArea= pg_query($con, "SELECT * from area where areid = '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $NomArea=$RegistrosAreas[2];
                          echo "<option selected disabled>$NomArea</option>";//Opcion por defecto al escoger TODAS Unidades
                        }
                        echo "<option value='All'>TODAS</option>";//Opcion Todas cuando se selecciona TODAS Unidades
                        $ConBDArea= pg_query($con, "SELECT * from area where areid <> '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $IdArea=$RegistrosAreas[0];
                          $NomArea=$RegistrosAreas[2];
                          echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado TODAS Unidades
                        }
                      }
                      else
                      {
                        $CodUniArea=$_SESSION['uniarea'];
                        $ConBDArea= pg_query($con, "SELECT * from area where areid = '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $IdArea=$RegistrosAreas[0];
                          $NomArea=$RegistrosAreas[2];
                          echo "<option selected disabled>$NomArea</option>";//Opcion por defecto al escoger TODAS Unidades
                        }
                        echo "<option value='All'>TODAS</option>";//Opcion Todas cuando se selecciona TODAS Unidades
                        $ConBDArea= pg_query($con, "SELECT * from area where areid <> '$CodUniArea'");
                        while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                        {
                          $IdArea=$RegistrosAreas[0];
                          $NomArea=$RegistrosAreas[2];
                          echo "<option value='$IdArea'>$NomArea</option>";//Opciones de las Areas despues de haber seleccionado TODAS Unidades
                        }
                      }
                    }
                    else
                    {
                      echo "<option selected disabled>SELECCIONE</option>
                            <option value='All'>TODAS</option>";
                      $ConBDArea= pg_query($con, "SELECT * from area");
                      while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                      {
                        $IdArea=$RegistrosAreas[0];
                        $NomArea=$RegistrosAreas[2];
                        echo "<option value='$IdArea'>$NomArea</option>";
                      }
                    }                    
                  }                  
                ?>                                 
            </select>                          
          </td>
        </form>
<!--   CODIGO CONSTRUCCION   -->
        <form action="con_construccion.php" name="ConConstruccion">
          <td>CODIGO CONSTRUCCION:</td>
          <td>
            <input type="hidden" name="CodigoOculto" value="2">
            <input type="text" id="Construccion4" name="CodConstrucciones" id="CodConstrucciones" maxlength="10" class="inp-form" value='<?php $CodConstruccion=$_REQUEST["CodConstrucciones"]; if (isset($CodConstruccion)) {
              echo "$CodConstruccion";
            } ?>' placeholder="EJ: CONST01-B1" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onchange="submit();">    
          </td>      
       </form>
        </tr>
<!--   UNIDAD   -->      
      <tr>
      <form action="con_construccion.php" name="ConUnidad">
        <td>UNIDAD:</td>
        <td>
          <input type="hidden" name="CodigoOculto" value="3">
          <select name="ConsUnidades" id="Construccion2" class="select-form" onchange="submit();">
            <?php 
              error_reporting(E_ALL ^ E_NOTICE);
              include 'conexion.php';
              $Areas=$_REQUEST['ConsAreas'];
              $Unidades=$_REQUEST['ConsUnidades'];
              $Construcciones=$_REQUEST['TipAmbiente'];

              if ($Areas) 
              {
                if ($Areas == "All")  
                {
                  
                }
                else
                {
                  echo "<option selected disabled>SELECCIONE</option>";
                  echo "<option value='All'>TODAS</option>";
                  $ConsultaUnidad= pg_query($con, "SELECT * from unidad where uniarea = '$Areas'");
                  while ($RegUnid=pg_fetch_array($ConsultaUnidad)) 
                  {
                    $IdUnidad=$RegUnid[0];
                    $NomUnidad=$RegUnid[2];
                    echo "<option value='$IdUnidad'>$NomUnidad</option>";
                  }
                  $_SESSION['area']=($Areas);//Se captura la session para tener el valor del Area.
                }
              }
              else
              {
                if ($Unidades) 
                {
                  $_SESSION['uniarea']=$_SESSION['area'];
                  $Area=($_SESSION['uniarea']);

                  /*$_SESSION['CodUnidad']=$_SESSION['unidad'];
                  $Unidad_session=($_SESSION['CodUniArea']);*/

                  if ($Unidades == "All")
                  {
                    echo "<option selected disabled>TODAS</option>";
                    $ConBDUnidad= pg_query($con, "SELECT * from unidad where uniarea = '$Area'");
                    while ($RegistrosUnidades=pg_fetch_array($ConBDUnidad)) 
                    {
                      $IdUnidad=$RegistrosUnidades[0];
                      $NomUnidad=$RegistrosUnidades[2];
                      echo "<option value='$IdUnidad'>$NomUnidad</option>";
                    }
                  }
                  else
                  {
                    $CodUniArea=$_SESSION[uniarea];
                    $ConBDUnidad= pg_query($con, "SELECT * from unidad where uniid = '$Unidades'");
                    while ($RegistrosUnidades=pg_fetch_array($ConBDUnidad)) 
                    {
                      $NomUnidad=$RegistrosUnidades[2];
                      echo "<option selected disabled>$NomUnidad</option>";
                    }
                    echo "<option value='All'>TODAS</option>";
                    $ConBDUnidad2= pg_query($con, "SELECT * from unidad where uniid <> '$Unidades' AND uniarea = '$CodUniArea'");
                    while ($RegistrosUnidades2=pg_fetch_array($ConBDUnidad2)) 
                    {
                      $IdUnidad2=$RegistrosUnidades2[0];
                      $NomUnidad2=$RegistrosUnidades2[2];
                      echo "<option value='$IdUnidad2'>$NomUnidad2</option>";
                    }
                    $_SESSION['unidad']=($Unidades);
                  }
                }
                elseif ($Construcciones) 
                {
                  $_SESSION['conunidad']=$_SESSION['unidad'];
                  $Unidad=($_SESSION['conunidad']);

                  /*************************************************************************
                  /++++++++++  NO OLVIDARME!!!! AQUÍ DEBO CAPTURAR UNA SESSION CORRESPONDIENTE AL CODIGO DE LA "CONSTRUCCION", DEBE SER AALGO ASÍ COMO LA CAPTURA DE LA SESSION DEL AREA CUANDO SE SELECCIONA ALGUNA OPCION DE LA (UNIDAD):

                  $_SESSION['area']=($Areas);---> SE CAPTURA EL CODIGO
                  ----------------------------------------------------------
                  if ($Unidades) 
                {
                  $_SESSION['uniarea']=$_SESSION['area'];
                  $Area=($_SESSION['uniarea']);---> SE PASA EL CODIGO AREA AL SELECT UNIDAD APENAS SELECCIONE UNA OOPCION
                  ------------------------------------------
                  /*************************************************************************

                  /*$_SESSION['CodUnidad']=$_SESSION['unidad'];
                  $Unidad_session=($_SESSION['CodUniArea']);*/

                  if ($Construcciones == "All") 
                  {
                    $ConBDUnidad= pg_query($con, "SELECT * from unidad where uniid = '$Unidad'");
                    while ($RegistrosUnidades=pg_fetch_array($ConBDUnidad)) 
                    {
                      $NomUnidad=$RegistrosUnidades[2];
                      echo "<option selected disabled>$NomUnidad</option>";
                    }
                    echo "<option value='All'>TODAS</option>";
                    $ConBDUnidad1= pg_query($con, "SELECT * FROM unidad where uniid <> '$Unidad' and uniarea = '$CodUniArea'");
                    while ($RegUnidad=pg_fetch_array($ConBDUnidad1)) 
                    {
                      $IdUnidad=$RegUnidad[0];
                      $NomUnidad=$RegUnidad[2];
                      echo "<option value'$IdUnidad'>$NomUnidad</option>";
                    }                                                          
                  }
                  else
                  {
                    $ConBDUnidad2= pg_query($con, "SELECT * from unidad where uniid = '$Unidad'");
                    while ($RegistrosUnidades1=pg_fetch_array($ConBDUnidad2)) 
                    {
                      $NomUnidad1=$RegistrosUnidades1[2];
                      echo "<option selected disabled>$NomUnidad1</option>";
                    }
                    echo "<option value='All'>TODAS</option>";
                    $ConBDUnidad= pg_query($con, "SELECT * from unidad where uniid <> '$Unidad' AND uniarea = '$CodUniArea'");
                    while ($RegistrosUnidades=pg_fetch_array($ConBDUnidad)) 
                    {
                      $IdUnidad=$RegistrosUnidades[0];
                      $NomUnidad=$RegistrosUnidades[2];
                      echo "<option value='$IdUnidad'>$NomUnidad</option>";
                    }
                  }
                }                
              }
            ?>            
          </select>
        </td>
      </form>      
      </tr>

      <tr>
      <form action="con_construccion.php" name="ConTipoAmbiente">
        <td>TIPO AMBIENTE:</td>
        <td>
          <input type="hidden" name="CodigoOculto" value="4">
          <select class="select-form" id="Construccion3" name="TipAmbiente" onchange="submit();">
           <?php
            error_reporting(E_ALL ^ E_NOTICE);
            include 'conexion.php';
            $Areas=$_REQUEST['ConsAreas'];
            $Unidades=$_REQUEST['ConsUnidades'];
            $Construcciones=$_REQUEST['TipAmbiente'];

            if (isset($Unidades)) 
            {
              if ($Unidades == "All") 
              {
                
              }
              elseif($Unidades <> "All")
              {
                echo "<option selected disabled>SELECCIONE</option>";
                echo "<option value='All'>TODOS</option>";
                $ConBDTipAmbiente= pg_query($con, "SELECT * from construccion where conunidad = '$Unidades'");
                while ($RegTipAmb=pg_fetch_array($ConBDTipAmbiente)) 
                {
                  $IdConstruccion=$RegTipAmb[0];
                  $TipAmbiente=$RegTipAmb[6];
                  echo "<option value='$IdConstruccion'>$TipAmbiente</option>";
                }                
              }
            }            
            elseif (isset($Construcciones)) 
            {
              if ($Construcciones == "All") 
              {
                echo "<option selected disabled>TODOS</option>";
                $ConBDTipAmbiente= pg_query($con, "SELECT * from construccion where conunidad = '$Unidad'");
                while ($RegTipAmb=pg_fetch_array($ConBDTipAmbiente)) 
                {
                  $IdConstruccion=$RegTipAmb[0];
                  $TipAmbiente=$RegTipAmb[6];
                  echo "<option value='$IdConstruccion'>$TipAmbiente</option>";
                }                
              }
              else
              {
                $ConBDTipAmbiente= pg_query($con, "SELECT * from construccion where conid = '$Construcciones'");
                while ($RegTipAmb=pg_fetch_array($ConBDTipAmbiente)) 
                {
                  $TipAmbiente=$RegTipAmb[6];
                  echo "<option selected disabled>$TipAmbiente</option>";
                }
                echo "<option value='All'>TODOS</option>";
                $ConBDTipAmbiente1= pg_query($con, "SELECT * from construccion where conid <> '$Construcciones' AND conunidad = '$Unidad'");
                while ($RegistrosUnidades2=pg_fetch_array($ConBDTipAmbiente1)) 
                {
                  $IdUnidad2=$RegistrosUnidades2[0];
                  $NomUnidad2=$RegistrosUnidades2[6];
                  echo "<option value='$IdUnidad2'>$NomUnidad2</option>";
                } 
              }
            }

           ?>
          </select>
        </td>
      </form>
      </tr>        
    </table>    
   </div>

<!--+++++++               +++++++-->
<!--+++++++   CONSULTAS   +++++++-->
<!--+++++++               +++++++-->
  <br><br>   
      <div>
              <?php
                include 'conexion.php';
                error_reporting(E_ALL^E_NOTICE);
                $CodConstruccion=$_REQUEST['CodConstrucciones'];
                $Tip_Hidden=$_REQUEST['CodigoOculto'];
                $Areas=$_REQUEST['ConsAreas'];
                $Unidades=$_REQUEST['ConsUnidades'];
                $Construcciones=$_REQUEST['TipAmbiente'];


        /***********************************/
        /****          AREAS          ******/
        /***********************************/
                if ($Tip_Hidden == 1) 
                {
                  if ($Areas == "All") 
                  {
                    $consulta = pg_query("SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                  INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                  INNER JOIN area ON area.areid = unidad.uniarea order by arenombre asc");
                    echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>AREA</th>                       
                            <th>UNIDAD</th>
                            <th>NOMBRE CONSTRUCCION</th>
                            <th>CODIGO</th>                                              
                            <th>TIPO AMBIENTE</th>
                            <th>TIPO CONSTRUCCION</th>
                            <th>ESTADO</th>
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>LATITUD</th>
                            <th>ORIENTACION</th>
                            <th>LONGITUD</th>
                            <th>ORIENTACION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            
            $Num_Fila=0; 
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
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
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
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
                        <a href="descarga_consulta/construccion/exc_ConstruccionArea.php" target="_blank">
                          <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                        </a>
                      </center>
                      </td>
                    </tr>';
                  }                  
                }
/***********************************/
/****   CODIGO CONSTRUCCION   ******/
/***********************************/
                elseif ($Tip_Hidden == 2) 
                {                  
                  $consulta = pg_query("SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                  INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                  INNER JOIN area ON area.areid = unidad.uniarea WHERE conidcodigo LIKE'%$CodConstruccion%' order by conidcodigo asc");
                    echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>CODIGO</th>
                            <th>AREA</th>                       
                            <th>UNIDAD</th>                            
                            <th>NOMBRE CONSTRUCCION</th>                                      
                            <th>TIPO AMBIENTE</th>
                            <th>TIPO CONSTRUCCION</th>
                            <th>ESTADO</th>
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>LATITUD</th>
                            <th>ORIENTACION</th>
                            <th>LONGITUD</th>
                            <th>ORIENTACION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
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
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
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
                        <a href="descarga_consulta/construccion/exc_ConstruccionCodigo.php" target="_blank">
                          <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                        </a>
                      </center>
                      </td>
                    </tr>';
                }
/***********************************/
/****         UNIDAD          ******/
/***********************************/
                elseif ($Tip_Hidden == 3) 
                {                  
                  if ($Unidades == "All") 
                  {
                    $CodUniArea=$_SESSION['uniarea'];
                    $consulta = pg_query("SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                    INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                    INNER JOIN area ON area.areid = unidad.uniarea WHERE uniarea = '$CodUniArea' order by uninombre asc");
                    echo <<<EOT
                      <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>UNIDAD</th>
                            <th>AREA</th>                       
                            <th>NOMBRE CONSTRUCCION</th>
                            <th>CODIGO</th>                                              
                            <th>TIPO AMBIENTE</th>
                            <th>TIPO CONSTRUCCION</th>
                            <th>ESTADO</th>
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>LATITUD</th>
                            <th>ORIENTACION</th>
                            <th>LONGITUD</th>
                            <th>ORIENTACION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
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
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
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
                        <a href="descarga_consulta/construccion/exc_ConstruccionUnidad.php" target="_blank">
                          <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                        </a>
                      </center>
                      </td>
                    </tr>';
                  }                  
                }
                elseif ($Tip_Hidden == 4) 
                {                  
                  if ($Construcciones == "All") 
                  {
                    $consulta = pg_query("SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                    INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                    INNER JOIN area ON area.areid = unidad.uniarea WHERE conunidad = '$Unidad' order by contipambien asc");
                    echo <<<EOT
                      <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>TIPO AMBIENTE</th>
                            <th>AREA</th>
                            <th>UNIDAD</th>                       
                            <th>NOMBRE CONSTRUCCION</th>
                            <th>CODIGO</th>                      
                            <th>TIPO CONSTRUCCION</th>
                            <th>ESTADO</th>
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>LATITUD</th>
                            <th>ORIENTACION</th>
                            <th>LONGITUD</th>
                            <th>ORIENTACION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
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
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
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
                        <a href="descarga_consulta/construccion/exc_ConstruccionTiposAmbientes.php" target="_blank">
                          <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                        </a>
                      </center>
                      </td>
                    </tr>';
                  }
                  else
                  {
                    $consulta = pg_query("SELECT area.arenombre, unidad.uninombre, construccion.connombre, construccion.conidcodigo, construccion.contipambien, construccion.contipconstr,construccion.conestado, construccion.contipcubiert, construccion.contippiso, construccion.contipmuro, construccion.confecconstr, construccion.confecremode, construccion.conlatitud,construccion.conorientlat,construccion.conlongitud,construccion.conorientlon from construccion
                    INNER JOIN unidad ON unidad.uniid = construccion.conunidad
                    INNER JOIN area ON area.areid = unidad.uniarea WHERE conid = '$Construcciones'");
                    echo <<<EOT
                      <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>TIPO AMBIENTE</th>
                            <th>AREA</th>
                            <th>UNIDAD</th>                       
                            <th>NOMBRE CONSTRUCCION</th>
                            <th>CODIGO</th>                      
                            <th>TIPO CONSTRUCCION</th>
                            <th>ESTADO</th>
                            <th>TIPO CUBIERTA</th>
                            <th>TIPO PISO</th>
                            <th>TIPO MURO</th>
                            <th>FECHA CONSTRUCCION</th>
                            <th>FECHA REMODELACION</th>
                            <th>LATITUD</th>
                            <th>ORIENTACION</th>
                            <th>LONGITUD</th>
                            <th>ORIENTACION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
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
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$reg[6]</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$reg[8]</td>";
                        echo "<td>$reg[9]</td>";
                        echo "<td>$reg[10]</td>";
                        echo "<td>$reg[11]</td>";
                        echo "<td>$reg[12]</td>";
                        echo "<td>$reg[13]</td>";
                        echo "<td>$reg[14]</td>";
                        echo "<td>$reg[15]</td>";
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
                        <a href="descarga_consulta/construccion/exc_ConstruccionTipAmb.php" target="_blank">
                          <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                        </a>
                      </center>
                      </td>
                    </tr>';
                  }
                  
                }                                       
?>
</div>     
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php'; ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodríguez
      </div>
  </div><!--Cierra <div> del SECTION-->    
</body>
</html>



