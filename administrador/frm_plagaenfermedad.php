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
<?php  include 'include/header.php'; ?>
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
    <div id="form">
      <form name="form1" id="formulario"><!--RECARGAR LA PAGINA-->
        <table whidt="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php 
            error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
            if ($_REQUEST['condicion']==1)
            {
              include 'conexion.php';  
              $res=pg_query($con, "SELECT * FROM plagaenfermedad WHERE pennomcomun='$_REQUEST[conspennomcomun]'");       
              while ($reg=pg_fetch_array($res))
              {
                $arreglo['plagaenfermedad']=array('penid'=>$reg[0]);//Es un arreglo para hacer las funciones
                $penid= utf8_decode($reg [0]);
                $pentipdano= utf8_decode($reg [1]);
                $pennomcomun= utf8_decode($reg [2]);
                $pennomcienti= utf8_decode($reg [3]);
                $pentipagecau= utf8_decode($reg [4]);
                $pentipmanejo= utf8_decode($reg [5]);
                $pentipzaffru= utf8_decode($reg [6]);
                $pentipzaftal= utf8_decode($reg [7]);
                $pentipzafflo= utf8_decode($reg [8]);
                $pentipzafrai= utf8_decode($reg [9]);
                $pentipzafhoj= utf8_decode($reg [10]);
                $pendescripci= $reg [11];
                $penfecha= utf8_decode($reg [12]);
              }
            }
          ?>
          <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR PLAGA ENFERMEDAD (VEGETAL)<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR PLAGA ENFERMEDAD (VEGETAL)<b><br><p><br>";
                }
              ?>              
            </td>
          </tr>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   CARGA EN EL FORMULARIO EL CAMPO PARA CONSULTAR CUANDO SE PULSA EL ICONO DE "LUPA"   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
              <?php
                if (isset ($arreglo)) 
                {
                 echo "
                 <tr id='consultarr'>
                   <td width='22%'>CONSULTAR:</td>
                   <td colspan='3'> 
                     <input type='text' name='conspennomcomun' id='conspennomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                     <input type='hidden' name='condicion' value='1'>
                     <input type='image' src='img/Consultar.png' width='4%' onclick='replace( this.form.name)' title='consultar'>
                   </td>
                 </tr>";/*Actualizar*/
                }
                else
                {
                  echo "
                 <tr id='consultar'>
                   <td width='22%'>CONSULTAR:</td>
                   <td colspan='3'> 
                     <input type='text'  name='conspennomcomun' id='conspennomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                     <input type='hidden' name='condicion' value='1'>
                     <input type='image' src='img/Consultar.png' width='4%' onclick='replace( this.form.name)' title='consultar'>
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
                 echo "<form name='formulario' action='actualizar/act_plagaenfermedad.php' onsubmit='return ValidarFormPlagaEnfer();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_plagaenfermedad.php' onsubmit='return ValidarFormPlagaEnfer();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($penid)) {echo "$penid";} ?>" name="penid">
            </td>
          </tr>
        <tr>
          <td>TIPO DAÑO:</td>
          <td>
            <select name="pentipdano" id="tipdano" onblur="SelectVacio(this)" class="select-form" required/>
            <?php

            include 'conexion.php';

              if (isset($arreglo) && $pentipdano == 'ENFERMEDAD')
              {
                echo "<option value='0' disabled></option>";
                echo "<option value='1'>ENFERMEDAD</option>";
                echo "<option value='2'>PLAGA</option>";                               
              }
              elseif (isset($arreglo) && $pentipdano == 'PLAGA')
              {              	
                echo "<option value='0' disabled></option>";
                echo "<option value='2'>PLAGA</option>";
                echo "<option value='1'>ENFERMEDAD</option>";                        
              }
              else
              {
                //if (isset($arreglo) && $pentipdano == 1)
                echo "<option selected disabled value=''></option>";                 
                echo "<option value='1'>ENFERMEDAD</option>";
                echo "<option value='2'>PLAGA</option>";                
                //elseif (isset($arreglo) && $arreglo == 2)                
              }            	
            ?>                 
            </select>
            <input type="hidden" id="esperaPlaEnf"><!--Es para representar el tiempo que tarda en cargar las opciones de la segunda lista desplegable con respecto al valor seleccionado en la primera(TIPO DAÑO:), se puede dinamizar con un ícino .GIF, pero para mejor funcionalidad solamente se esconde el input para no alterar el espacio del formulario-->
          </td>
          <td width="15px"></td>
          <td>TIPO AGENTE CAUSAL:</td>
          <td>
            <select name="pentipagecau" id="tipagentecausal" onblur="SelectVacio(this)" class="select-form" required/>
              <?php 
                if (isset($arreglo))
                {
                  echo "<option>$pentipagecau</option>";
                }
                else
                {
                  echo "<option disabled></option>";
                }
               ?>
            </select>
          </td>
        </tr>   
        <tr>
          <td>NOMBRE COMUN:</td>
          <td>
            <input type="text" name="pennomcomun" id="pennomcomun" class="inp-form" value="<?php if (isset($pennomcomun)) {echo "$pennomcomun";} ?>" placeholder="EJ: BOTRITIS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
          <td>NOMBRE CIENTIFICO:</td>
          <td> 
              <input type="text" name="pennomcienti" id="pennomcienti" class="inp-form" value="<?php if (isset($pennomcienti)) {echo "$pennomcienti";} ?>" placeholder="EJ: BOTRYTIS CINEREA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
          <td>TIPO MANEJO:</td>
          <td id="Radio">
            <input type="hidden" name="pentipmanejo">
            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="QUIMICO" 
            <?php if (isset($arreglo) && $pentipmanejo == 'QUIMICO')
            	{          	
            		echo "<input type='radio' value='QUIMICO' checked='checked'";            		
				      }
				    ?>> QUIMICO<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="ORGANICO" 
            <?php if (isset($arreglo) && $pentipmanejo == 'ORGANICO')
            	{          	
            		echo "<input type='radio' value='ORGANICO' checked='checked'";            		
				      }
				    ?>> ORGANICO<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="BIOLOGICO" 
            <?php if (isset($arreglo) && $pentipmanejo == 'BIOLOGICO')
            	{          	
            		echo "<input type='radio' value='BIOLOGICO' checked='checked'";            		
				    }
				    ?>> BIOLOGICO<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="QUIM-ORG" 
            <?php if (isset($arreglo) && $pentipmanejo == 'QUIM-ORG')
            	{          	
            		echo "<input type='radio' value='QUIM-ORG' checked='checked'";            		
				    }
				    ?>> QUIM-ORG<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="QUIM-BIO" 
            <?php if (isset($arreglo) && $pentipmanejo == 'QUIM-BIO')
            	{          	
            		echo "<input type='radio' value='QUIM-BIO' checked='checked'";            		
				    }
				    ?>> QUIM-BIO<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="BIO-ORG" 
            <?php if (isset($arreglo) && $pentipmanejo == 'BIO-ORG')
            	{          	
            		echo "<input type='radio' value='BIO-ORG' checked='checked'";            		
				    }
				    ?>> BIO-ORG<br>

            <input type="radio" name="pentipmanejo" id="pentipmanejo" value="QUIM-ORG-BIO" 
            <?php if (isset($arreglo) && $pentipmanejo == 'QUIM-ORG-BIO')
            	{          	
            		echo "<input type='radio' value='QUIM-ORG-BIO' checked='checked'";            		
				    }
				    ?>> QUIM-ORG-BIO<br>
          </td>
          <td></td>
          <td>
            ZONA AFECTADA:
          </td>
          <td id="checkbox">
           <input type="hidden" name="pentipzaffru" value="N/A"><!--Type=HIDDEN me guarda por defecto un valor cuando no es seleccionado por el checkbox-->
           <input type="checkbox" name="pentipzaffru" id="checkboxz" value="FRUTA" <?php if (isset($arreglo) && $pentipzaffru == 'FRUTA') {echo "<input type='checkbox' value='FRUTA' checked='checked'";} ?>> FRUTA<br>
           <input type="hidden" name="pentipzaftal" value="N/A">
           <input type="checkbox" name="pentipzaftal" id="checkboxz" value="TALLO" <?php if (isset($arreglo) && $pentipzaftal == 'TALLO') {echo "<input type='checkbox' value='TALLO' checked='checked'";} ?>> TALLO<br>
           <input type="hidden" name="pentipzafflo" value="N/A">
           <input type="checkbox" name="pentipzafflo" id="checkboxz" value="FLOR" <?php if (isset($arreglo) && $pentipzafflo == 'FLOR') {echo "<input type='checkbox' value='FLOR' checked='checked'";} ?>> FLOR<br>
           <input type="hidden" name="pentipzafrai" value="N/A">
           <input type="checkbox" name="pentipzafrai" id="checkboxz" value="RAIZ" <?php if (isset($arreglo) && $pentipzafrai == 'RAIZ') {echo "<input type='checkbox' value='RAIZ' checked='checked'";} ?>> RAIZ<br>
           <input type="hidden" name="pentipzafhoj" value="N/A">
           <input type="checkbox" name="pentipzafhoj" id="checkboxz" value="HOJA" <?php if (isset($arreglo) && $pentipzafhoj == 'HOJA') {echo "<input type='checkbox' value='HOJA' checked='checked'";} ?>> HOJA<br>
          </td>          
        </tr>
        <tr>
          <td>DESCRIPCION:</td>
            <td colspan="5">
              <textarea type="text" name="pendescripci" id="pendescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DE LA PLAGA O ENFERMEDAD" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($pendescripci)) {echo "$pendescripci ";} ?></textarea>  
        </td>
      </tr>
        <tr>
                <td colspan="6"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_plagaenfermedad.php'>
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
              <!--<a href="javascript:void(0)" onclick="window.open('grillas/gri_plagaenfermedad/index.php','','width=1000,height=500,top=20,left=100')">
                    <img src="img/Grilla.png" title="Ver Grilla" class="img-form">
                  </a>-->
              <img src="img/Grilla.png" class="img-form" title="Ver Grilla" id="boton">
<!--BOTON PARA EL (PDF)-->
              <a href="descarga_pdf/pdf_plagaenfermedad.php" target="_blank">
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_plagaenfermedad.php" target="_blank">
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
          include 'grillas/gri_plagaenfermedad/gri_plagaenfermedad.php';
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
