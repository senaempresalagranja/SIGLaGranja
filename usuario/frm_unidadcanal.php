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

            $res=pg_query($con, "SELECT * FROM unidad_canal WHERE cunkidcodigo='$_REQUEST[conunican]' ");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['unidad_canal']=array('cunid'=>$reg[0]);
              $cunid=utf8_decode($reg[0]);
              $cunkidcodigo=utf8_decode($reg[1]);
              $cununidad=utf8_decode($reg[2]);
              $cuncanal=utf8_decode($reg[3]);
              $cundistancia=utf8_decode($reg[4]);
              $cununimedist=utf8_decode($reg[5]);
              $cundescripci=utf8_decode($reg[6]);
            }
          }
          ?>
          <tr>
            <td colspan="4"><br>
              <?php
                      if (isset($arreglo))
                      {
                        echo "<p class='tit-form'><b>ACTUALIZAR UNIDAD CANAL<b><br><p><br>";
                      }
                      else
                      {
                        echo "<p class='tit-form'><b>REGISTRAR UNIDAD CANAL<b><br><p><br>";
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
                            <input type='text' name='conunican' id='conunican' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conunican' id='conunican' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Registrar*/
                }
              ?>
        </form>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN NUEVO FORM QUE DIRECCIONARÁ A LAS PÁGINAS (REGISTRAR O ACTUALIZAR)   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->          <?php 
            if (isset($arreglo)) 
            {
              echo "<form name='formulario' action='actualizar/act_unidadcanal.php' onsubmit='return ValidarFormUnidadCanal();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_unidadcanal.php' onsubmit='return ValidarFormUnidadCanal();'>";
            }
          ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($cunid)) {echo"$cunid";}?>" name="cunid" id="cunid">
          </td>
        </tr>
      <tr>
        <td>UNIDAD:</td>
            <td>
              <select name="cununidad" id="cununidad" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$cununidad' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $NomUnidad=$reg1[2];
                      echo "<option value='$cununidad' selected>$NomUnidad</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM unidad order by uninombre ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $uniid=$reg[0];
                    $uninombre=$reg[2];
                    echo "<option value='$uniid'>$uninombre</option>";
                  }
                ?>
              </select>
            </td>
            <td>CANAL:</td>
                <td colspan="2">
                  <select name="cuncanal" id="cuncanal" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo)) 
                      {
                        $res3=pg_query($con, "SELECT * FROM canal WHERE canid='$cuncanal'");
                        while ($row3=pg_fetch_array($res3)) 
                        {
                          $NomCanal=$row3[2];
                          echo "<option value='$cuncanal' selected>$NomCanal</option>";
                        }
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      include 'conexion.php';
                      $res1=pg_query($con, "SELECT * FROM canal order by cannombre ASC");
                      while ($row1=pg_fetch_array($res1))
                      {
                        $CodCanal=$row1[0];
                        $NomCanal=$row1[2];
                        echo "<option value='$CodCanal'>$NomCanal</option>";
                      }
                    ?>
                  </select> 
                </td>
      </tr>
      <tr>
        <td>DISTANCIA:</td>
          <td>
            <input type="text" id="cundistancia" name="cundistancia" maxlength="4" value="<?php if (isset($cundistancia)) {echo "$cundistancia";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return UniCanDistancia(event);" onblur="revisarn(this)" required/>           
              <select name="cununimedist" id="cununimedist"class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                    if (isset($arreglo))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$cununimedist ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $umenombre=$reg1[1];
                          echo "<option value='$cununimedist' selected>$umenombre</option>";
                        }
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'LONGITUD'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umenombre= $reg[1];
                        echo "<option value='$umeid'>$umenombre</option>";
                      }
                ?> 
              </select>
          </td>
      </tr>
      <tr>
        <td>DESCRIPCION:</td>
          <td colspan="4">
            <textarea type="text" name="cundescripci" id="cundescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS LA UNIDAD Y LA CANAL" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($cundescripci)) {echo "$cundescripci ";} ?></textarea>
          </td>
      </tr> 
      <tr>
            <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_unidadcanal.php'>
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
              <a href="descarga_pdf/pdf_unidadcanal.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_unidadcanal.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
              </center>
            </td>
          </tr>
        </table>         
      </form>
    </div>
    <div id="grilla">
      <?php include 'grillas/gri_unidadcanal/gri_unidadcanal.php'; ?>
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