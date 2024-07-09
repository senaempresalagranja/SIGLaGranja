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
if (isset($_SESSION['USUARIO ADMIN'])){}
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
              error_reporting(E_ALL ^ E_NOTICE);
              if($_REQUEST['condicion']==1)
              {
                include 'conexion.php';
                $res=pg_query($con, "SELECT * FROM zonaverde_vegetal WHERE zovkidcodigo='$_REQUEST[conzovkidcodigo]'");
                while ($reg=pg_fetch_array($res))
                {
                  $arreglo['zonaverde_vegetal']= array('zovid' =>$reg[0]);
                  $zovid=$reg[0];
                  $zovkidcodigo=$reg[1];
                  $zovzonaverde=$reg[2];                 
                  $zovvegetal=$reg[3];
                  $zovdescripci=$reg[4];
                  $zovfecha=utf8_decode($reg[5]);
                }
              }
            ?>
          <tr>
            <td colspan="4"><br>
              <?php
              if (isset($arreglo))
              {
                echo "<p class='tit-form'><b>ACTUALIZAR ZONAVERDE VEGETAL <b><br><p><br>";
              }
              else
              {
                echo "<p class='tit-form'><b>REGISTRAR  ZONAVERDE VEGETAL <b><br><p><br>";
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
                  echo "<tr id='consultarr'>
                          <td>CONSULTAR:</td>
                          <td colspan='4'>
                            <input type='text' name='conzovkidcodigo' id='conzovkidcodigo' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conzovkidcodigo' id='conzovkidcodigo' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_zonaverdevegetal.php' onsubmit='return ValidarFormZonverVegetal();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_zonaverdevegetal.php' onsubmit='return ValidarFormZonverVegetal();'>";
            }
          ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($zovid)) {echo"$zovid";}?>" name="zovid" id="zovid">
          </td>
        <tr>
          <td>ZONA VERDE:</td>
          <td>
            <select name="zovzonaverde" id="zovzonaverde" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM zonaverde WHERE zveid='$zovzonaverde'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomZonVer=$row3[1];
                    echo "<option value='$zovzonaverde' selected>$NomZonVer</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM zonaverde order by zveidcodigo ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodZonVer=$row1[0];
                  $NomZonVer=$row1[1];
                  echo "<option value='$CodZonVer'>$NomZonVer</option>";
                }
              ?>
            </select>
          </td>
          <td>VEGETAL:</td>
          <td>
            <select name="zovvegetal" id="zovvegetal" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM vegetal WHERE vegid='$zovvegetal'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomComun=$row3[1];
                    echo "<option value='$zovvegetal' selected>$NomComun</option>";
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
                  $Codigo=$row1[0];
                  $NomComun=$row1[1];
                  echo "<option value='$Codigo'>$NomComun</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>DESCRIPCION:</td>
          <td colspan="4">
            <textarea type="text" name="zovdescripci" id="zovdescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS LA ZONA VERDE Y EL VEGETAL" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($zovdescripci)) {echo "$zovdescripci ";} ?></textarea> 
          </td>
      </tr>
      <tr>
            <td colspan="4"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_zonaverdevegetal.php'>
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
              <a href="descarga_pdf/pdf_zonaverdevegetal.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_zonaverdevegetal.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
              </center>
            </td>
          </tr>
        </table>         
      </form>
        </div>
        <div id="grilla">
          <?php include 'grillas/gri_zonaverdevegetal/gri_zonaverdevegetal.php'; ?>      
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