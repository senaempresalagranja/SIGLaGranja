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
  <?php include 'include/header.php'; ?>
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
          error_reporting(E_ALL ^ E_NOTICE);
          if($_REQUEST['condicion']==1)
            {
              include 'conexion.php';
              $res=pg_query($con, "SELECT * FROM vegetal WHERE vegnomcomun='$_REQUEST[convegnomcomun]'");
                while($reg=pg_fetch_array($res))
                  {
                    $arreglo['vegetal']=array('vegnomcomun'=>$reg[1]);
                    $vegid=$reg [0];
                    $vegnomcomun= mb_convert_encoding($reg[1], "UTF-8");
                    $vegnomcienti= mb_convert_encoding($reg[2], "UTF-8");
                    $vegorigen= $reg [3];
                    $veglugorigen= $reg [4];
                    $vegclima= $reg [5];
                    $vegtipo= mb_convert_encoding($reg[6], "UTF-8");
                    $vegdescripci= $reg [7];
                    $vegfecha= $reg [8];
                  }
            }
        ?>
      <tr>
        <td colspan="5"><br>
          <?php
            if (isset($arreglo))
            {
              echo "<p class='tit-form'><b>ACTUALIZAR VEGETAL<b><p><br>";
            }
            else
            {
              echo "<p class='tit-form'><b>REGISTRAR VEGETAL<b><p><br>";
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
                 <input type='text' name='convegnomcomun' id='convegnomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
                 <input type='text'  name='convegnomcomun' id='convegnomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
        echo "<form name='actualizar' action='actualizar/act_vegetal.php' onsubmit='return ValidarFormVegetal();'>";
      }
      else
      {
        echo "<form name='registrar' action='registrar/reg_vegetal.php' onsubmit='return ValidarFormVegetal();'>";
      }
    ?>
    <tr>
      <td>
        <input type="hidden" value="<?php if (isset($vegid)) {echo "$vegid";} ?>" name="vegid" id="vegid">
      </td>
    </tr>  
    <tr>
      <td>NOMBRE COMUN:</td>
      <td width="110px"> 
          <input type="text" name="vegnomcomun" id="vegnomcomun" class="inp-form" value="<?php if (isset($vegnomcomun)) {echo "$vegnomcomun";} ?>" placeholder="EJ: CHAYOTE" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
          <input type="text" name="vegnomcienti" id="vegnomcienti" class="inp-form" value="<?php if (isset($vegnomcienti)) {echo "$vegnomcienti";} ?>" placeholder="EJ: SECHIUM EDULE" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
      <td>ORIGEN:</td>
      <td>
          <select name="vegorigen" id="vegorigen" onblur="SelectVacio(this)" class="select-form" required/>
            <?php 
                if (isset($arreglo) && $vegorigen == 'NATIVO')
                {
                    echo "<option value='1'>NATIVO</option>";
                    echo "<option value='2'>EXOTICO</option>";
                }
                elseif (isset($arreglo) && $vegorigen == 'EXOTICO')
                {
                    echo "<option value='2'>EXOTICO</option>";
                    echo "<option value='1'>NATIVO</option>";
                }
                else 
                {
                    echo "<option Selected disabled></option>";
                    echo "<option value='1'>NATIVO</option>";
                    echo "<option value='2'>EXOTICO</option>";
                  }
            ?>
          </select><span id="esperaVegetal"></span>
      </td>
      <td width="15px"></td>
      <td>LUGAR ORIGEN:</td>
      <td>
        <select name="veglugorigen" id="veglugorigen" onblur="SelectVacio(this)" class="select-form" required/>
          <?php 
              if (isset($arreglo))
              {
                echo "<option>$veglugorigen</option>";
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
      <td>TIPO VEGETAL:</td> 
          <td>
            <select name="vegtipo" id="vegtipo" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $vegtipo == 'COMESTIBLE') 
                {
                  echo "<option value='COMESTIBLE' selected>COMESTIBLE</option>";
                  echo "<option value='MEDICINAL'>MEDICINAL</option>";
                  echo "<option value='ORNAMENTAL'>ORNAMENTAL</option>";
                }
                elseif (isset($arreglo) && $vegtipo == 'MEDICINAL') 
                {
                  echo "<option value='MEDICINAL' selected>MEDICINAL</option>";
                  echo "<option value='COMESTIBLE'>COMESTIBLE</option>";
                  echo "<option value='ORNAMENTAL'>ORNAMENTAL</option>";
                }
                elseif (isset($arreglo) && $vegtipo == 'ORNAMENTAL') 
                {
                echo "<option value='ORNAMENTAL' selected>ORNAMENTAL</option>";
                  echo "<option value='COMESTIBLE'>COMESTIBLE</option>";
                  echo "<option value='MEDICINAL'>MEDICINAL</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='COMESTIBLE'>COMESTIBLE</option>";
                  echo "<option value='MEDICINAL'>MEDICINAL</option>";
                  echo "<option value='ORNAMENTAL'>ORNAMENTAL</option>";
                }
              ?>             
            </select>
          </td>
      <td></td>
      <td>CLIMA:</td>
        <td>
          <select name="vegclima" id="vegclima" class="select-form" onblur="SelectVacio(this)" required/>
          <?php
            if (isset($arreglo) && $vegclima == 'CALIDO') 
            {
              echo "<option value='CALIDO' selected>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
            elseif (isset($arreglo) && $vegclima == 'CALIENTE') 
            {
              echo "<option value='CALIENTE' selected>CALIENTE</option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
            elseif (isset($arreglo) && $vegclima == 'LLUVIOSO') 
            {
              echo "<option value='LLUVIOSO' selected>LLUVIOSO</option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
            elseif (isset($arreglo) && $vegclima == 'SECO') 
            {
              echo "<option value='SECO' selected>SECO</option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
            elseif (isset($arreglo) && $vegclima == 'TEMPLADO') 
            {
              echo "<option value='TEMPLADO' selected>TEMPLADO</option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
            elseif (isset($arreglo) && $vegclima == 'TROPICAL') 
            {
              echo "<option value='TROPICAL' selected>TROPICAL</option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
            }
            else
            {
              echo "<option selected disabled></option>";
              echo "<option value='CALIDO'>CALIDO</option>";
              echo "<option value='CALIENTE'>CALIENTE</option>";
              echo "<option value='LLUVIOSO'>LLUVIOSO</option>";
              echo "<option value='SECO'>SECO</option>";
              echo "<option value='TEMPLADO'>TEMPLADO</option>";
              echo "<option value='TROPICAL'>TROPICAL</option>";
            }
          ?>
        </select>
      </td>
    </tr>         
    <tr>
      <td>DESCRIPCION:</td>
      <td colspan="4">
        <textarea type="text" name="vegdescripci" id="vegdescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL VEGETAL" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($vegdescripci)) {echo "$vegdescripci";} ?></textarea>
      </td>
    </tr>       
    <tr>
        <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_vegetal.php'>
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
<!--BOTON PARA EL (PDF)-->
              <a href="descarga_pdf/pdf_vegetal.php" target="_blank">
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_vegetal.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
            </center>
          </td>
        </tr>
      </table>
    </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_vegetal/gri_vegetal.php'; ?>
      </div>
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php' ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodríguez
      </div>
    </div>
  </body>
</html>