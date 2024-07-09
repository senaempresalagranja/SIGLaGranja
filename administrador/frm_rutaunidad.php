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
          error_reporting(E_ALL ^ E_NOTICE);
          if($_REQUEST['condicion']==1)
          {
            include 'conexion.php';

            $res=pg_query($con, "SELECT * FROM ruta_unidad WHERE runkidcodigo='$_REQUEST[conrutuni]' ");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['ruta_unidad']=array('runid'=>$reg[0]);
              $runid=utf8_decode($reg[0]);
              $runkidcodigo=utf8_decode($reg[1]);
              $rununidad=utf8_decode($reg[2]);
              $runruta=utf8_decode($reg[3]);
              $rundistancia=utf8_decode($reg[4]);
              $rununimeddis=utf8_decode($reg[5]);
              $runtierecorr=utf8_decode($reg[6]);
              $rununimedrec=utf8_decode($reg[7]);
              $runtipruta=utf8_decode($reg[8]);
              $runfecha=utf8_decode($reg[9]);
            }
          }
          ?>
          <tr>
            <td colspan="8"><br>
              <?php
                      if (isset($arreglo))
                      {
                        echo "<p class='tit-form'><b>ACTUALIZAR RUTA UNIDAD<b><br><p><br>";
                      }
                      else
                      {
                        echo "<p class='tit-form'><b>REGISTRAR  RUTA UNIDAD<b><br><p><br>";
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
                          <td colspan='7'>
                            <input type='text' name='conrutuni' id='conrutuni' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
                else
                {
                  echo "<tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='7'>
                            <input type='text' name='conrutuni' id='conrutuni' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_rutaunidad.php' onsubmit='return ValidarFormRutaUnidad();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_rutaunidad.php' onsubmit='return ValidarFormRutaUnidad();'>";
            }
          ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($runid)) {echo"$runid";}?>" name="runid" id="runid">
          </td>
        </tr>
      <tr>
       <td>RUTA:</td>
      <td colspan="3">
        <select name="runruta" id="runruta" class="select-form" onblur="SelectVacio(this)" required/>
                  <?php
                    if (isset($arreglo)) 
                    {
                      $res3=pg_query($con, "SELECT * FROM ruta WHERE rutid='$runruta'");
                      while ($row3=pg_fetch_array($res3)) 
                      {
                        $NomRuta=$row3[2];
                        echo "<option value='$runruta' selected>$NomRuta</option>";
                      }
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                    include 'conexion.php';
                    $res1=pg_query($con, "SELECT * FROM ruta order by rutnombre ASC");
                    while ($row1=pg_fetch_array($res1))
                    {
                      $CodRuta=$row1[0];
                      $NomRuta=$row1[2];
                      echo "<option value='$CodRuta'>$NomRuta</option>";
                    }
                  ?>
        </select>
      </td>
      <td colspan="2"></td>
      <td>UNIDAD:</td>
            <td>
              <select name="rununidad" id="rununidad" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$rununidad' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $NomUnidad=$reg1[2];
                      echo "<option value='$rununidad' selected>$NomUnidad</option>";
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
            </tr>
            <tr>
              <td>DISTANCIA:</td>
              <td colspan="2">
                <input type="text" name="rundistancia" id="rundistancia" maxlength="4" value="<?php if (isset($rundistancia)) {echo "$rundistancia";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return RutUniDistancia(event);" onblur="revisarn(this)" required/>

                <select name="rununimeddis" id="rununimeddis" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php                              
                    include 'conexion.php';
                    if (isset($arreglo))
                    {
                     $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$rununimeddis ");
                     while($reg1=pg_fetch_array($res1))
                     {
                         $umenombre=$reg1[1];
                         echo "<option value='$rununimeddis' selected>$umenombre</option>";
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
              <td colspan="3"></td>
              <td>TIEMPO RECORRIDO:</td>
              <td> 
                <input type="text" name="runtierecorr" id="runtierecorr" maxlength="4" value="<?php if (isset($runtierecorr)) {echo "$runtierecorr";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return RutUniTiempoRec(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisarn(this)" required/>
                
                <select name="rununimedrec" id="rununimedrec" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    include 'conexion.php';
                    if (isset($arreglo)) 
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedrec' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=$row[2];
                      } 
                      echo "<option value='$rununimedrec' selected>$repunimed</option>";
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                    $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umenombre = 'SEGUNDOS' or umenombre = 'MINUTOS' or umenombre = 'HORAS' ORDER BY   umenombre ASC");
                    while($reg=pg_fetch_array($res))
                    {
                      $umeid=$reg[0];
                      $umenombre= $reg[2];
                      echo "<option value='$umeid'>$umenombre</option>";
                    }
                  ?>
                </select>
              </td>
             </tr>
             <tr>
              <td>TIPO RUTA:</td> 
              <td colspan="7">
                <select name="runtipruta" id="runtipruta" class="select-form" onblur="SelectVacio(this)" required/>
                  <?php 
                    if (isset($arreglo) && $runtipruta == 'CARRETEABLE') 
                    {
                      echo "<option value='CARRETEABLE' selected>CARRETEABLE</option>";
                      echo "<option value='PEATONAL'>PEATONAL</option>";
                      echo "<option value='SENDERO'>SENDERO</option>";
                    }
                    elseif (isset($arreglo) && $runtipruta == 'PEATONAL') 
                    {
                      echo "<option value='PEATONAL' selected>PEATONAL</option>";
                      echo "<option value='CARRETEABLE'>CARRETEABLE</option>";
                      echo "<option value='SENDERO'>SENDERO</option>";
                    }
                    elseif (isset($arreglo) && $runtipruta == 'SENDERO') 
                    {
                    echo "<option value='SENDERO' selected>SENDERO</option>";
                      echo "<option value='CARRETEABLE'>CARRETEABLE</option>";
                      echo "<option value='PEATONAL'>PEATONAL</option>";
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                      echo "<option value='CARRETEABLE'>CARRETEABLE</option>";
                      echo "<option value='PEATONAL'>PEATONAL</option>";
                      echo "<option value='SENDERO'>SENDERO</option>";
                    }
                  ?>             
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="8"><br>
                <center>
              <!-- Descripcion para enviarlo a Guardarlo o Actualizar-->
              <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_rutaunidad.php'><img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
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
              <img src="img/Grilla.png" title="Ver Grilla" class="img-form" id="boton">
<!--BOTON PARA EL (PDF)-->
              <a href="descarga_pdf/pdf_rutaunidad.php" target="_blank">
               <img src="img/pdf.png" title="Expotar PDf" class="img-form">
             </a>
<!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_rutaunidad.php" target="_blank">
              <img src="img/Excel.png"  title="Exportar Excel" class="img-form">
            </a>
          </td>
        </tr>
      </table>
    </form>
  </div>
<!-- Cuerpo de la grilla-->
    <div id="grilla">
      <?php include 'grillas/gri_rutaunidad/gri_rutaunidad.php'; ?>
    </div>
<!-- Descripcion para el pie de pagina-->
    <div id="foot">
      <?php include 'include/piepagina.php'; ?>
    </div>
    <div class="fin">
      Luis Fernando Chamorro Rodríguez
    </div>
  </div>
</body>
</html>