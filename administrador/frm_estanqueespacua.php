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
            $res=pg_query($con, "SELECT * FROM estanque_especieacuatica WHERE eeapkcodigo='$_REQUEST[conestanqueespacua]'");
            while ($reg=pg_fetch_array($res))
            {
              $arreglo['estanque_especieacuatica']= array('eeaid' =>$reg[0]);
              $eeaid=utf8_decode($reg[0]);
              $eeapkcodigo=utf8_decode($reg[1]);
              $eeaestanque=utf8_decode($reg[2]);                 
              $eeaespacua=utf8_decode($reg[3]);
              $eearesponsab=utf8_decode($reg[4]);
              $eeafecsiembr=utf8_decode($reg[5]);
              $eeafeccosech=utf8_decode($reg[6]);
              $eeadescripci=utf8_decode($reg[7]);
            }
          }
        ?>
          <tr>
            <td colspan="4"><br>
              <?php
              if (isset($arreglo))
              {
                echo "<p class='tit-form'><b>ACTUALIZAR ESTANQUE ESPECIE ACUATICA<b><br><p><br>";
              }
              else
              {
                echo "<p class='tit-form'><b>REGISTRAR  ESTANQUE ESPECIE ACUATICA<b><br><p><br>";
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
                            <input type='text' name='conestanqueespacua' id='conestanqueespacua' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conestanqueespacua' id='conestanqueespacua' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_estanqueespacua.php' onsubmit='return ValidarFormEstEspAcua();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_estanqueespacua.php' onsubmit='return ValidarFormEstEspAcua();'>";
            }
          ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($eeaid)) {echo"$eeaid";}?>" name="eeaid" id="eeaid">
          </td>
        </tr>
        <tr>
          <td>ESTANQUE:</td>
          <td>
            <select name="eeaestanque" id="eeaestanque" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM estanque WHERE estid='$eeaestanque'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomEst=$row3[1];
                    echo "<option value='$eeaestanque' selected>$NomEst</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM estanque order by estnombre ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodEst=$row1[0];
                  $NomEst=$row1[1];
                  echo "<option value='$CodEst'>$NomEst</option>";
                }
              ?>
            </select>
          </td>
          <td>ESPECIE ACUATICA:</td>
          <td>
            <select name="eeaespacua" id="eeaespacua" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM especieacuatica WHERE eacid='$eeaespacua'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomEspAcua=$row3[3];
                    echo "<option value='$eeaespacua' selected>$NomEspAcua</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM especieacuatica order by eacnomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodEspAcua=$row1[0];
                  $NomEspAcua=$row1[3];
                  echo "<option value='$CodEspAcua'>$NomEspAcua</option>";
                }
              ?>
            </select>
          </td>
        </tr>
          <td>RESPONSABLE:</td>
          <td>
            <input type="text" name="eearesponsab" id="eearesponsab" class="inp-form" value="<?php if (isset($eearesponsab)) {echo "$eearesponsab";} ?>" placeholder="EJ:CATALINA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
          </td>
        </tr>
        <tr>
          <td>FECHA SIEMBRA:</td>
          <td>
            <input type="date" name="eeafecsiembr" id="eeafecsiembr" class="inp-form" value="<?php if (isset($eeafecsiembr)) {echo "$eeafecsiembr";} ?>" onblur="revisarfecha(this)" required/>
          </td>
          <td>FECHA COSECHA:</td>
          <td colspan="2">
            <input type="date" name="eeafeccosech" id="eeafeccosech" class="inp-form" value="<?php if (isset($eeafeccosech)) {echo "$eeafeccosech";} ?>" onblur="revisarfecha(this)" required/>
          </td>
        </tr>
        <tr>
          <td>DESCRIPCION:</td>
          <td colspan="4">
            <textarea type="text" name="eeadescripci" id="eeadescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL ESTANQUE Y LA ESPECIE ACUATICA" onblur="revisard(this)"   onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($eeadescripci)) {echo "$eeadescripci ";} ?></textarea>
          </td>
        </tr> 
        <tr>
          <td colspan="5" align="center"><br>
              <!--<input class="img-form" type="image" src="img/Guardar.png" title="Guardar Registro" onclick="replace(thi.form.name)">-->
            <?php 
              if (isset($arreglo))//Si el arreglo existe, mostramos dos botones: ActualizarReg y NuevoRegi
              {
                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                      <a href='frm_estanqueespacua.php'>
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
              <a href="descarga_pdf/pdf_estanqueespacua.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_estanqueespacua.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
       </center>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_estanqueespacua/gri_estanqueespacua.php'; ?>
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