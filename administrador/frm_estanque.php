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
          error_reporting(E_ALL ^ E_NOTICE);
          if($_REQUEST['condicion']==1)
          {
            include 'conexion.php';
            $res=pg_query($con, "SELECT * FROM estanque WHERE estnombre='$_REQUEST[conestnombre]'");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['estanque']=array('estid'=>$reg[0]);
              $estid=utf8_decode($reg [0]);
              $estnombre=utf8_decode($reg [1]);
              $esttipestanq=utf8_decode($reg [2]);
              $estprofundid=utf8_decode($reg [3]);
              $estunimedpro=utf8_decode($reg [4]);
              $estespejagua=utf8_decode($reg [5]);
              $estunimedesp=utf8_decode($reg [6]);
              $estvolumagua=utf8_decode($reg [7]);
              $estunimedvol=utf8_decode($reg [8]);
            }
          }
        ?>
        <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR ESTANQUE<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR ESTANQUE<b><br><p><br>";
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
                          <td colspan='2'> 
                           <input type='text' name='conestnombre' id='conestnombre' maxlength='15' class='inp-form' placeholder='EJ: ESTANQUE 9' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)' onblur='revisar(this)' required/> 
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Actualizar*/
                }
                else
                {
                  echo " <tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='2'> 
                           <input type='text' name='conestnombre' id='conestnombre' maxlength='15' class='inp-form' placeholder='EJ: ESTANQUE 9' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)' onblur='revisar(this)' required/>
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
                 echo "<form name='formulario' action='actualizar/act_estanque.php' onsubmit='return ValidarFormEstanque();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_estanque.php' onsubmit='return ValidarFormEstanque();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($estid)) {echo "$estid";} ?>" name="estid" id="estid">
            </td>
          </tr> 
          <tr>
      <tr>
        <td>NOMBRE:</td>
        <td width="15px" colspan="2">
          <input type="text" name="estnombre" id="estnombre" maxlength="15" value="<?php if (isset($estnombre)) {echo "$estnombre";} ?>" class="inp-form" placeholder="EJ: ESTANQUE 9" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
        <td>TIPO:</td>
          <td colspan="2">
            <select name="esttipestanq" class="select-form" onblur="SelectVacio(this)" required/>
              <?php   
                if (isset($arreglo) && $esttipestanq == 'TIERRA') 
                {
                  echo "<option value='TIERRA' selected>TIERRA</option>";
                  echo "<option value='EXCAVACION'>EXCAVACION</option>";
                }
                elseif (isset($arreglo) && $esttipestanq == 'EXCAVACION') 
                {
                  echo "<option value='EXCAVACION' selected>EXCAVACION</option>";
                  echo "<option value='TIERRA'>TIERRA</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='TIERRA'>TIERRA</option>";
                  echo "<option value='EXCAVACION'>EXCAVACION</option>";
                }
              ?>
            </select>
          </td>
          <td width="15px"></td>
          <td>PROFUNDIDAD:</td>
          <td>
            <input type="text" name="estprofundid" id="estprofundid" maxlength="4" value="<?php if (isset($estprofundid)) {echo "$estprofundid";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return estunimedpro1(event);" onblur="revisarn(this)" required/>
              <select name="estunimedpro" id="estunimedpro" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$estunimedpro' selected>$umerepre</option>";
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
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>$umerepre</option>";
                  }
                ?>      
              </select>
          </td>
        </tr>
        <tr>           
        <td> ESPEJO AGUA:</td>
        <td colspan="2">
          <input type="text" name="estespejagua" id="estespejagua" maxlength="4" value="<?php if (isset($estespejagua)) {echo "$estespejagua";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return estespejagua2(event);" onblur="revisarn(this)" required/>
              <select name="estunimedesp" id="estunimedesp" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$estunimedesp' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'SUPERFICIE' OR  umetipunimed = 'VOLUMEN'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>$umerepre</option>";
                  }
                ?>      
              </select>
        </td>
        <td></td>
        <td>
          VOLUMEN AGUA:
        </td>
        <td>
          <input type="text" name="estvolumagua" id="estvolumagua" maxlength="4" value="<?php if (isset($estvolumagua)) {echo "$estvolumagua";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return estvolumagua3(event);" onblur="revisarn(this)" required/>

          <select name="estunimedvol" id="estunimedvol" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$estunimedvol' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'VOLUMEN'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>$umerepre</option>";
                  }
                ?>      
          </select>
        </td>
      </tr>
      <tr>
       <td colspan="6"><br>
              <center>
                <?php
                if (isset($arreglo)) 
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_estanque.php'>
                          <img src='img/Nuevo.png' class='img-form' title'Nuevo Registro'>
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
                <a href="descarga_pdf/pdf_estanque.php" target="_blank">
                  <img src="img/pdf.png" title="Exportar PDF" class="img-form">
                </a> 
<!--BOTON PARA EL (EXCEL)-->          
                <a href="descarga_excel/exc_estanque.php" target="_blank">
                  <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                </a>              
            </td>
              </center>
          </tr>
        </table>
        </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_estanque/gri_estanque.php';?>
      </div>
      <div id="foot">
        <?php include 'include/piepagina.php';?>
      </div>
      <div class="fin">Luis Fernando Chamorro Rodriguez</div>
    </div><!--Cierra <div> del SECTION-->
  </body>
</html>
