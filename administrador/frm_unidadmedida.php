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
session_start();
if (isset($_SESSION['ADMINISTRADOR'])){}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../visitante/index.php?Acceso Denegado'</script>";
}
  ?>

<!DOCTYPE html>
<html lang="es">  
<?php include 'include/header.php';?>  
  <!-- Descripcion para el cuerpo de la pagina  oncontextmenu="return false" -->
  <body>
    <!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">
      <!-- Descripcion para el Banner-->
      <div id="banner">
        <?php include 'include/banner.php';?>
      </div>
      <!-- Descripcion para el Menu-->
      <div id="nav">
        <?php include 'include/menu.php';?>
      </div>
      <!-- Descripcion para el cuerpo de la pagina-->
      <div id="form">
        <form name="form1" id="formulario"><!--RECARGAR LA PAGINA-->
          <table width="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php
            error_reporting(E_ALL ^ E_NOTICE);
            if($_REQUEST['condicion']==1)
            {
              include 'conexion.php';

              $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umenombre='$_REQUEST[consumenombre]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['unidad_medida']=array('umeid'=>$reg[0]);
                $umeid= utf8_decode($reg [0]);
                $umerepreset=$reg [1];
                $umenombre=$reg[2];
                $umefecha=utf8_decode($reg[3]);
                $umetipunimed=utf8_decode($reg[4]);
              }
            }
          ?>
            <tr>
              <td colspan="5">
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR UNIDAD DE MEDIDA<b><br><br><p>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR UNIDAD DE MEDIDA<b><br><br><p>";
                  }
                ?>
              </td>
            </tr>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   CARGA EN EL FORMULARIO EL CAMPO PARA CONSULTAR CUANDO SE PULSA EL ICONO DE "LUPA"   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
                <?php
                if (isset($arreglo)) 
                {
                  echo " <tr id='consultarr'>
                          <td>CONSULTAR:</td>
                          <td colspan='3'> 
                           <input type='text'  name='consumenombre' id='consumenombre' class='inp-form' placeholder='EJ:METRO' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Actualizar*/
                }
                else
                {
                  echo " <tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='3'> 
                           <input type='text'  name='consumenombre' id='consumenombre' class='inp-form'  placeholder='EJ:METRO' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%'  onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Registrar*/
                }
              ?>
        </form>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN NUEVO FORM QUE DIRECCIONARÁ A LAS PÁGINAS (REGISTRAR O ACTUALIZAR)   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
              <?php 
              if (isset($arreglo)) 
              {
                echo "<form name='formulario' action='actualizar/act_unidadmedida.php' onsubmit='return ValidarFormUnidadMedida();'>";
              }
              else
              {
                echo "<form name='formulario' action='registrar/reg_unidadmedida.php' onsubmit='return ValidarFormUnidadMedida();'>";
              }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($umeid)) {echo"$umeid";} ?>" name="umeid" id="umeid"/>
            </td>
          </tr> 
      <tr>
        <td>MAGNITUD:</td>
          <td width="10px">
            <select name="umetipunimed"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $umetipunimed == 'CAPACIDAD') 
                {
                  echo "<option value='CAPACIDAD' selected>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";
                }
                elseif (isset($arreglo) && $umetipunimed == 'CONDUCTANCIA ELECTRICA') 
                {                  
                  echo "<option value='CONDUCTANCIA ELECTRICA' selected>CONDUCTANCIA ELECTRICA</option>";                  
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";  
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";
                }
                elseif (isset($arreglo) && $umetipunimed == 'LONGITUD') 
                {                  
                  echo "<option value='LONGITUD' selected>LONGITUD</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";  
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";
                }
                elseif (isset($arreglo) && $umetipunimed == 'MASA') 
                {
                  echo "<option value='MASA' selected>MASA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";   
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";               
                }
                elseif (isset($arreglo) && $umetipunimed == 'MONEDA') 
                {
                  echo "<option value='MONEDA' selected>MONEDA</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";                  
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";                
                }
                elseif (isset($arreglo) && $umetipunimed == 'RADIACION SOLAR') 
                {
                  echo "<option value='RADIACION SOLAR' selected>RADIACION SOLAR</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";                  
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";                 
                }
                elseif (isset($arreglo) && $umetipunimed == 'SUPERFICIE') 
                {
                  echo "<option value='SUPERFICIE' selected>SUPERFICIE</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";                  
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";                 
                }
                elseif (isset($arreglo) && $umetipunimed == 'TEMPERATURA') 
                {
                  echo "<option value='TEMPERATURA' selected>TEMPERATURA</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";                  
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";                
                }
                elseif (isset($arreglo) && $umetipunimed == 'TIEMPO') 
                {
                  echo "<option value='TIEMPO' selected>TIEMPO</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";                  
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";                 
                }
                elseif (isset($arreglo) && $umetipunimed == 'VELOCIDAD') 
                {
                  echo "<option value='VELOCIDAD' selected>VELOCIDAD</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";               
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";               
                }
                elseif (isset($arreglo) && $umetipunimed == 'VOLUMEN') 
                {
                  echo "<option value='VOLUMEN' selected>VOLUMEN</option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";    
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='CAPACIDAD'>CAPACIDAD</option>";
                  echo "<option value='CONDUCTANCIA ELECTRICA'>CONDUCTANCIA ELECTRICA</option>";
                  echo "<option value='LONGITUD'>LONGITUD</option>";
                  echo "<option value='MASA'>MASA</option>";
                  echo "<option value='MONEDA'>MONEDA</option>";
                  echo "<option value='RADIACION SOLAR'>RADIACION SOLAR</option>";
                  echo "<option value='SUPERFICIE'>SUPERFICIE</option>";
                  echo "<option value='TEMPERATURA'>TEMPERATURA</option>";
                  echo "<option value='TIEMPO'>TIEMPO</option>";
                  echo "<option value='VELOCIDAD'>VELOCIDAD</option>";
                  echo "<option value='VOLUMEN'>VOLUMEN</option>";
                }
              ?>
            </select>
          </td>
        <td width="400px">         
        </td>
      </tr>
        <tr>
          <td>NOMBRE:</td>
            <td>
              <input type="text" name="umenombre" id="umenombre" class="inp-form" value="<?php if (isset($umenombre)) {echo "$umenombre";} ?>" placeholder="EJ: METRO" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
              <?php
                if (isset($arreglo)) 
                {
                  echo "<td id='Info' colspan='3'></td>";
                }
                else
                {
                  echo "<td id='Info' colspan='3'></td>";
                }
              ?>
          </tr>
          <tr>
          <td>SIMBOLO:</td>
          <td>
              <input type="text" name="umerepreset" id="umerepreset" class="inp-form" value="<?php if (isset($umerepreset)) {echo "$umerepreset";} ?>" placeholder="EJ: M² " maxlength="4" onkeydown="espacios(this)" onblur="revisar(this)" required/>
         </td>
         <?php
                if (isset($arreglo)) 
                {
                  echo "<td id='Info1' colspan='3'></td>";
                }
                else
                {
                  echo "<td id='Info1' colspan='3'></td>";
                }
              ?>
       </tr>
       <tr>
          <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_unidadmedida.php'>
                    <img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
                    </a>";
                  }
                else
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Guardar Registro'>";
                  }
              ?>
<!--BOTON PARA (CONSULTAR)-->
              <img src="img/Consultar.png" class="img-form" title="Consultar" id="botonconsulta">
<!--BOTON PARA LA(GRILLA)-->
              <img src="img/Grilla.png" class="img-form" title="Ver Grilla" id="boton">
              <a href="descarga_pdf/pdf_unidadmedida.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_unidadmedida.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
            </center>
          </td>
        </tr>
      </table>
    </form>
      </div>
      <div id="grilla">
        <?php
          include 'grillas/gri_unidadmedida/gri_unidadmedida.php';
        ?>
      </div>
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