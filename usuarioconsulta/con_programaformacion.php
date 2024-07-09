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
$_SESSION['NombreProgForm']=$_REQUEST['NomProFor'];
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

<script type="text/javascript">
  //++++++++++++++++++   **PRIMER** VALIDACION DE HAB Y DESHAB   ++++++++++++++++++++++++++++++++++++
//Validacion para Habilitar las opciones del RadioButton
function habilitaProgramaForma(form)
{ 
  document.getElementById("ProgForma2").disabled=true;
  document.getElementById("ProgForma2").style.background = "#EDE9E9";

  document.getElementById("ProgForma1").disabled=false;
  document.getElementById("ProgForma1").style.background = "#FFF";
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaProgramaForma(form)
{ 
  document.getElementById("ProgForma1").disabled=true;
  document.getElementById("ProgForma1").style.background = "#EDE9E9";

  document.getElementById("ProgForma2").disabled=false;
  document.getElementById("ProgForma2").style.background = "#FFF";
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
            <br><p class='tit-form'><b>CONSULTAR PROGRAMA DE FORMACION</b></p><br>
          </td>
        </tr>
        <tr>
          <center>
          <td colspan="2">
            <input type='radio' name='ProgramaForma' id='ProgramaForma' onclick='habilitaProgramaForma(this.form)'> <em>CRITERIO DE BÚSQUEDA POR FILTRO</em></input>        
          </td>
          <td colspan="2">
            <input type='radio' name='ProgramaForma' id='ProgramaForma' onclick='deshabilitaProgramaForma(this.form)'> <em>CRITERIO DE BÚSQUEDA POR CÓDIGO</em></input>
          </td>
          </center>
        </tr>
        <tr height="20px"></tr>
<!--CONSULTA DE LOS PROGRAMAS DE FORMACION-->
      <form action="con_programaformacion.php" name="ConArea">
        <tr>        
          <td>AREA:</td>
          <td>
            <input type="hidden" name="CodigoOculto" value="1">                    
            <select name="ConsAreas" id="ProgForma1" class="select-form" onchange="submit();">
                <?php
                  include 'conexion.php';

                  $Areas=$_REQUEST['ConsAreas'];
                  $Unidades=$_REQUEST['ConsUnidades'];

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
                    echo "<option selected disabled>SELECCIONE</option>
                          <option value='All'>TODAS</option>";
                    $ConBDArea= pg_query($con, "SELECT * from area");
                    while ($RegistrosAreas=pg_fetch_array($ConBDArea)) 
                    {
                      $IdArea=$RegistrosAreas[1];
                      $NomArea=$RegistrosAreas[2];
                      echo "<option value='$IdArea'>$NomArea</option>";
                    }
                  }
              ?>
            </select>
          </td>
        </form>
      <!--   NomComun Progama Formacion  -->
        <form action="con_programaformacion.php" name="ConNomProgFor">
          <td>NOMBRE COMUN:</td>
          <td>
            <input type="hidden" name="CodigoOculto" value="2">
            <input type="text" name="NomProFor" id="ProgForma2" class="inp-form" value='<?php $NomProgForma=$_REQUEST["NomProFor"]; if (isset($NomProgForma)) {echo "$NomProgForma"; } ?>' placeholder="EJ: SOLDADURA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onchange="submit();">    
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
  <center>   
  <?php
    error_reporting(E_ALL ^ E_NOTICE);
    include 'conexion.php';      
    $NomProgForma=$_REQUEST["NomProFor"];
    $Tip_Hidden=$_REQUEST['CodigoOculto'];
    $Areas=$_REQUEST["ConsAreas"];
    $Unidades=$_REQUEST["ConsUnidades"];
/***********************************/
/****          AREAS          ******/
/***********************************/    
      if ($Tip_Hidden == 1) 
      {
        if ($Areas == "All") 
        {
          $consulta = pg_query($con,"SELECT programaformacion.pfoid, area.arenombre, area.arecoordinad, programaformacion.pfonombre,programaformacion.pfotipformac,programaformacion.pfotieelecti,programaformacion.pfounimedel,programaformacion.pfotieproduc,programaformacion.pfounimedep,programaformacion.pfoimagen,programaformacion.pfodescripci FROM programaformacion
                  INNER JOIN area ON area.areid = programaformacion.pfoarea order by arenombre asc");
                  echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>AREA</th>
                            <th>CODIGO</th>                            
                            <th>RESPONSABLE</th>
                            <th>PROGRAMA</th> 
                            <th>TIPO FORMACION</th>  
                            <th>ETAPA LECTIVA</th>
                            <th>DURACION</th>
                            <th>ETAPA PRODUCTIVA</th>
                            <th>DURACION</th>  
                            <th>UNIFORME</th>
                            <th>DESCRIPCION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $imagen=$reg[9];

                        $pfounimedel=$reg[6];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedel' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $pfounimedep=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedep' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
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
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td><img src='galeria/repeat/$imagen'</td>";
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
              <a href="descarga_consulta/programaformacion/exc_ProgFormAreas.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
        else
        {
          $consulta = pg_query($con,"SELECT programaformacion.pfoid, area.arenombre, area.arecoordinad, programaformacion.pfonombre,programaformacion.pfotipformac,programaformacion.pfotieelecti,programaformacion.pfounimedel,programaformacion.pfotieproduc,programaformacion.pfounimedep,programaformacion.pfoimagen,programaformacion.pfodescripci FROM programaformacion
                  INNER JOIN area ON area.areid = programaformacion.pfoarea where pfoarea = '$Areas' order by arenombre asc");
                  echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>AREA</th>
                            <th>CODIGO</th>                            
                            <th>RESPONSABLE</th>
                            <th>PROGRAMA</th> 
                            <th>TIPO FORMACION</th>  
                            <th>ETAPA LECTIVA</th>
                            <th>DURACION</th>
                            <th>ETAPA PRODUCTIVA</th>
                            <th>DURACION</th>  
                            <th>UNIFORME</th>
                            <th>DESCRIPCION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $imagen=$reg[9];

                        $pfounimedel=$reg[6];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedel' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $pfounimedep=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedep' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
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
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[2]</td>";
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td><img src='galeria/repeat/$imagen'</td>";
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
              <a href="descarga_consulta/programaformacion/exc_ProgFormArea.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>
            </center>
            </td>
          </tr>';
        }
      }
/***********************************/
/****        PLAGA       ***********/
/***********************************/
      elseif ($Tip_Hidden == 2) 
      {
        $consulta = pg_query($con,"SELECT programaformacion.pfoid, area.arenombre, area.arecoordinad, programaformacion.pfonombre,programaformacion.pfotipformac,programaformacion.pfotieelecti,programaformacion.pfounimedel,programaformacion.pfotieproduc,programaformacion.pfounimedep,programaformacion.pfoimagen,programaformacion.pfodescripci FROM programaformacion
                  INNER JOIN area ON area.areid = programaformacion.pfoarea WHERE pfonombre LIKE '%$NomProgForma%' order by pfonombre asc");
                  echo <<<EOT
                    <div class="GrillaConsulta">
                      <table>
                        <thead>
                          <tr>
                            <th>PROGRAMA</th>
                            <th>AREA</th>
                            <th>CODIGO</th>                            
                            <th>RESPONSABLE</th>                             
                            <th>TIPO FORMACION</th>  
                            <th>ETAPA LECTIVA</th>
                            <th>DURACION</th>
                            <th>ETAPA PRODUCTIVA</th>
                            <th>DURACION</th>  
                            <th>UNIFORME</th>
                            <th>DESCRIPCION</th>
                          </tr>
                        </thead>
                        <tbody>
                                  
EOT;
            $Num_Fila=0;
            while ($reg= pg_fetch_array($consulta)) 
                      {                    
                        $imagen=$reg[9];

                        $pfounimedel=$reg[6];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedel' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre=$reg1[2];
                        }
        
                        $pfounimedep=$reg[8];
                        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedep' ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $nombre1=$reg1[2];
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
                        echo "<td>$reg[3]</td>";
                        echo "<td>$reg[1]</td>";
                        echo "<td>$reg[0]</td>";
                        echo "<td>$reg[2]</td>";                        
                        echo "<td>$reg[4]</td>";
                        echo "<td>$reg[5]</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$reg[7]</td>";
                        echo "<td>$nombre1</td>";
                        echo "<td><img src='galeria/repeat/$imagen'</td>";
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
              <a href="descarga_consulta/programaformacion/exc_ProgFormNombre.php" target="_blank">
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