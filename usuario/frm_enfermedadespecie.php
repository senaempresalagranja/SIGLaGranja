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
                /*$consultar=0;
                $aconsultar=$_REQUEST['conenfesp'];
                if ($aconsultar<>"") 
                {
                  $consultar=$_REQUEST['conenfesp'];
                }*/
                $res=pg_query($con, "SELECT * FROM enfermedad_especie WHERE eeskidcodigo='$_REQUEST[conenfesp]'");
                while ($reg=pg_fetch_array($res))
                {
                  $arreglo['enfermedad_especie']= array('eesid' =>$reg[0]);
                  $eesid=$reg[0];
                  $eeskidcodigo=$reg[1];
                  $eesenfermeda=$reg[2];                 
                  $eesespecie=$reg[3];
                  $eesdescripci=$reg[4];
                }
              }
            ?>
          <tr>
            <td colspan="4"><br>
              <?php
              if (isset($arreglo))
              {
                echo "<p class='tit-form'><b>ACTUALIZAR ENFERMEDAD ESPECIE<b><br><p><br>";
              }
              else
              {
                echo "<p class='tit-form'><b>REGISTRAR  ENFERMEDAD ESPECIE<b><br><p><br>";
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
                            <input type='text' name='conenfesp' id='conenfesp' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conenfesp' id='conenfesp' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_enfermedadespecie.php' onsubmit='return ValidarFormEnferEspec();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_enfermedadespecie.php' onsubmit='return ValidarFormEnferEspec();'>";
            }
          ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($eesid)) {echo"$eesid";}?>" name="eesid" id="eesid">
          </td>
        </tr>
        <!--<tr>
          <td>CODIGO:</td>
          <td width="160px">
            <input type="text" name="eeskidcodigo" id="eeskidcodigo" maxlength="3" value="<?php //if (isset($eeskidcodigo)) {echo "$eeskidcodigo";} ?>" class="inp-form" placeholder="EJ: 1 (CODIGO)" onkeypress="return ValNumero(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
          </td>
          <td colspan="2">        
        <?php
            //if (isset($eesid)) 
            {
              //echo "<div id='Info'></div>";
            }
            //else
            {
              //echo "<div id='Info'></div>";
            }
        ?>
          </td>
        </tr>-->
        <tr>
          <td>ENFERMEDAD:</td>
          <td>
            <select name="eesenfermeda" id="eesenfermeda" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM enfermedad WHERE enfid='$eesenfermeda'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomEnf=$row3[1];
                    echo "<option value='$eesenfermeda' selected>$NomEnf</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM enfermedad order by enfnomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodEnf=$row1[0];
                  $NomEnf=$row1[1];
                  echo "<option value='$CodEnf'>$NomEnf</option>";
                }
              ?>
            </select>
          </td>
          <td>ESPECIE:</td>
          <td>
            <select name="eesespecie" id="eesespecie" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM especie WHERE espid='$eesespecie'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomEsp=$row3[3];
                    echo "<option value='$eesespecie' selected>$NomEsp</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM especie order by espnomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodEsp=$row1[0];
                  $NomEsp=$row1[3];
                  echo "<option value='$CodEsp'>$NomEsp</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>DESCRIPCION:</td>
          <td colspan="4">
            <textarea type="text" name="eesdescripci" id="eesdescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS LA ENFERMEDAD Y LA ESPECIE" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($eesdescripci)) {echo "$eesdescripci ";} ?></textarea>
          </td>
        </tr> 
          <tr>
            <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_enfermedadespecie.php'>
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
              <a href="descarga_pdf/pdf_enfermedadespecie.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_enfermedadespecie.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
              </center>
            </td>
          </tr>
        </table>         
      </form>
        </div>
        <div id="grilla">
          <?php include 'grillas/gri_enfermedadespecie/gri_enfermedadespecie.php'; ?>      
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