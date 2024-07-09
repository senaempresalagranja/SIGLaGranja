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
        <table width="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php
            include 'conexion.php';
            error_reporting(E_ALL ^ E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
            if($_REQUEST['condicion']==1)
            {
              $res=pg_query($con, "SELECT * FROM plagaenferme_vegetal WHERE pvekidcogigo='$_REQUEST[conplaenfVegetalCod]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['plagenfvege']=array('pveid'=>$reg[0]);
                $pveid= utf8_decode($reg [0]);
                $pvekidcogigo=utf8_decode($reg[1]);
                $pveplagaenfe=utf8_decode($reg[2]);
                $pvevegetal=utf8_decode($reg[3]);
                $pvedescripci=mb_convert_encoding($reg[4], "UTF-8");
                $pvefecha=utf8_decode($reg[5]);
              }
            }
          ?>
          <tr>
            <td colspan="5"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR PLAGAENFERMEDAD VEGETAL<br><br><p>";
                }
                else
                {
                  echo "<p class='tit-form'><b>REGISTRAR PLAGAENFERMEDAD VEGETAL<br><br><p>";
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
                  echo "<tr pveid='consultarr'>
                          <td>CONSULTAR:</td>
                          <td colspan='4'>
                            <input type='text' name='conplaenfVegetalCod' id='conplaenfVegetalCod' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
                else
                {
                  echo "<tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='4'>
                            <input type='text' name='conplaenfVegetalCod' id='conplaenfVegetalCod' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
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
              echo "<form name='formulario' action='actualizar/act_plagaenfermevegetal.php' onsubmit='return ValidarFormPlaEnfVegetal();'>";
            }
          else
            {
              echo "<form name='formulario' action='registrar/reg_plagaenfermevegetal.php' onsubmit='return ValidarFormPlaEnfVegetal();'>";
            }
        ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($pveid)) {echo"$pveid";} ?>" name="pveid" id="pveid"/>
          </td>
        </tr>
        <tr>
          <td>VEGETAL:</td>
          <td>
            <select name="pvevegetal" id="pvevegetal" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM vegetal WHERE vegid='$pvevegetal'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomVegetal=$row3[2];
                    echo "<option value='$pvevegetal' selected>$NomVegetal</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM vegetal order by vegnomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodVegetal=$row1[0];
                  $NomComun=$row1[1];
                  echo "<option value='$CodVegetal'>$NomComun</option>";
                }
              ?>
            </select> 
          </td>
          <td>PLAGA/ENFERMEDAD:</td>
          <td>
            <select name="pveplagaenfe" id="pveplagaenfe" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$pveplagaenfe'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomPlaEnf=$row3[2];
                    echo "<option value='$pveplagaenfe' selected>$NomPlaEnf</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM plagaenfermedad order by pennomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodPlaEnf=$row1[0];
                  $NomPlaEnf=$row1[2];
                  echo "<option value='$CodPlaEnf'>$NomPlaEnf</option>";
                }
              ?>
            </select> 
          </td>          
        </tr>
        <tr>
          <td>DESCRIPCION:</td>
            <td colspan="4">
              <textarea type="text" name="pvedescripci" id="pvedescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL CULTIVO Y LA ENFERMEDAD" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($pvedescripci)) {echo "$pvedescripci ";} ?></textarea>
            </td>
        </tr>
        <tr>
          <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_plagaenfermevegetal.php'>
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
              <a href="descarga_pdf/pdf_plagaenfermevegetal.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_plagaenfermevegetal.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
            </center>
          </td>
        </tr>
      </table>
    </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_plagaenfermevegetal/gri_plagaenfermevegetal.php'; ?>
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