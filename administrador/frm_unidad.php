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
              $res=pg_query($con, "SELECT * FROM unidad WHERE uninombre='$_REQUEST[consuninombre]'");       
              while ($reg=pg_fetch_array($res))
              {
                $arreglo['unidad']=array('uniid'=>$reg[0]);//Es un arreglo para hacer las funciones
                $uniid= utf8_decode($reg [0]);
                $uniarea= utf8_decode($reg [1]);
                $uninombre= utf8_decode($reg [2]);
                $uniextension= utf8_decode($reg [3]);
                $uniunimedida= utf8_decode($reg [4]);
                $uniresponsab= utf8_decode($reg [5]);
                $unilatitud= utf8_decode($reg [6]);
                $uniorientlat= utf8_decode($reg [7]);
                $unilongitud= utf8_decode($reg [8]);
                $uniorientlon= utf8_decode($reg [9]);
                $unidescripci= utf8_decode($reg [10]);
                $unifecha= utf8_decode($reg [11]);
              }
            }
          ?>
          <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR UNIDAD<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR UNIDAD<b><br><p><br>";
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
                           <input type='text'  name='consuninombre' id='consuninombre' class='inp-form' placeholder='EJ: CITRICOS' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
                           <input type='text'  name='consuninombre' id='consuninombre' class='inp-form'  placeholder='EJ: CITRICOS' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                 echo "<form name='formulario' action='actualizar/act_unidad.php' onsubmit='return ValidarFormUnidad();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_unidad.php' onsubmit='return ValidarFormUnidad();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($uniid)) {echo "$uniid";} ?>" name="uniid">
            </td>
          </tr>  
         <tr> 
          <td>AREA:</td>
          <td width="160px">
            <select name="uniarea" id="uniarea" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM area WHERE areid='$uniarea' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $Nomarea=$reg1[2];
                      echo "<option value='$uniarea' selected>$Nomarea</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM area order by arenombre ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $areid=$reg[0];
                    $arenombre=$reg[2];
                    echo "<option value='$areid'>$arenombre</option>";
                  }
                ?>
              </select>
        </td>
      </tr>
      <tr colspan="4">
        <td>NOMBRE:</td>
            <td>
              <input type="text" name="uninombre" id="uninombre" class="inp-form" value="<?php if (isset($uninombre)) {echo "$uninombre";} ?>" placeholder="EJ: CITRICOS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
        <td>EXTENSION:</td>
            <td> 
              <input type="text"  name="uniextension" id="uniextension" class="inp-ent" maxlength="4" value="<?php if (isset($uniextension)) {echo "$uniextension";} ?>" placeholder="EJ: 1.50" onkeypress="return UnidadExtension(event);" onblur="revisarn(this)" required/>
              
              <select name="uniunimedida" id="uniunimedida" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$uniunimedida' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$uniunimedida' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }                    
                  // Consultar la base de datos para traer las demás opciones del select
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'SUPERFICIE'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umenombre= $reg[1];
                    echo "<option value='$umeid'>$umenombre</option>";
                  }
                ?>
              </select>
            </td>
            <td width="10px"></td>
            <td>RESPONSABLE:</td>
            <td>
              <input type="text" name="uniresponsab" id="uniresponsab" class="inp-form" value="<?php if (isset($uniresponsab)) {echo "$uniresponsab";} ?>" placeholder="EJ:LUIS FERNANDO" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr> 
          <tr>
            <td>DESCRIPCION:</td>
            <td colspan="4">
              <textarea type="text" name="unidescripci" id="unidescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DE LA UNIDAD" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($unidescripci)) {echo "$unidescripci";} ?></textarea>
            </td>
          </tr>
          <tr>
           <td></td>
           <td colspan="2"></td>
           <td>LATITUD:</td>
            <td>
              <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($unilatitud)) {echo "$unilatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($uniorientlat)) {echo "$uniorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly">
            </td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2"></td>
            <td>LONGITUD:</td>
            <td>
              <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($unilongitud)) {echo "$unilongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($uniorientlon)) {echo "$uniorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly">
            </td>
      </tr>
      <tr>
            <td colspan="5" align="center"><br>
              <?php 
                if (isset($arreglo))
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_unidad.php'>
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
              <a href="descarga_pdf/pdf_unidad.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_unidad.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_unidad/gri_unidad.php'; ?>
      </div>
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php'; ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodríguez
      </div>
  </div><!--Cierra <div> del SECTION-->    
</body>
</html>