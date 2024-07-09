<!-- 
  Proyecto: Sistema de Informacion Georeferenciado del Centro Agropecuario "La Granja". 
  Nombre del proyecto:  SIGLaGranja. 
  Desarrolladores: Tecnologo en Análisis y Desarrollo de Sistemas de Información "ADSI". 
  Numero de Ficha: 798585. 
  Descripcion del Proyecto: Software que permita la Georeferenciación de Centro Agropecuario "La Granja" SENA Espinal - Tolima. 
  Año de Desarrollo: 2014-2015.-->
<!-- Descripcion de la pagina en formato de HTML5. a
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
            $res=pg_query($con, "SELECT * FROM redgas WHERE rgaid='$_REQUEST[conrgaid]'");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['redgas']=array('rgaid'=>$reg[0]);
              $rgaid=utf8_decode($reg [0]);
              $rgaconstrucc=utf8_decode($reg [1]);
              $rgatipmateri=utf8_decode($reg [2]);
              $rganumvalvul=utf8_decode($reg [3]);
              $rganumconexi=utf8_decode($reg [4]);
              $rganumcontad=utf8_decode($reg [5]);
              $rganumsoport=utf8_decode($reg [6]);
              $rgafecha=utf8_decode($reg [7]);
            }
          }
        ?>
        <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR RED GAS<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR RED GAS<b><br><p><br>";
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
                            <td colspan='3'>
                              <input type='text' name='conrgaid' id='conrgaid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td>CONSULTAR:</td>
                            <td colspan='3'>
                              <input type='text' name='conrgaid' id='conrgaid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Guardar*/
                  }
                ?>
      </form>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN NUEVO FORM QUE DIRECCIONARÁ A LAS PÁGINAS (REGISTRAR O ACTUALIZAR)   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
              <?php 
               if (isset($arreglo))
               {
                 echo "<form name='formulario' action='actualizar/act_redgas.php' onsubmit='return ValidarFormRedGas();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_redgas.php' onsubmit='return ValidarFormRedGas();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($rgaid)) {echo "$rgaid";} ?>" name="rgaid" id="rgaid">
            </td>
          </tr>
          <tr>
            <td>CONSTRUCCION:</td>
            <td width="10px">
              <select name="rgaconstrucc" id="rgaconstrucc" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rgaconstrucc' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $Nomconstruccion=$reg1[3];
                      echo "<option value='$rgaconstrucc' selected>$Nomconstruccion</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM construccion order by connombre ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $conidcodigo=$reg[0];
                    $connombre=$reg[3];
                    echo "<option value='$conidcodigo'>$connombre</option>";
                  }
                ?>
              </select>
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
            </td>
          </tr>
          <tr>
            <td>TIPO MATERIAL:</td> 
            <td>
              <select name="rgatipmateri" id="rgatipmateri" class="select-form"  onchange="habilitarCantVentilacion(this.value);" onblur="    SelectVacio(this)" required/>
                <?php 
                  if (isset($arreglo) && $rgatipmateri == 'ALUMINIO') 
                  {
                    echo "<option value='ALUMINIO' selected>ALUMINIO</option>";
                    echo "<option value='BRONCE'>BRONCE</option>";
                    echo "<option value='COBRE'>COBRE</option>";
                    echo "<option value='PVC'>PVC</option>";
                  }
                  elseif (isset($arreglo) && $rgatipmateri == 'BRONCE') 
                  {
                    echo "<option value='BRONCE' selected>BRONCE</option>";
                    echo "<option value='ALUMINIO'>ALUMINIO</option>";
                    echo "<option value='COBRE'>COBRE</option>";
                    echo "<option value='PVC'>PVC</option>";
                  }
                  elseif (isset($arreglo) && $rgatipmateri == 'COBRE') 
                  {
                  echo "<option value='COBRE' selected>COBRE</option>";
                    echo "<option value='ALUMINIO'>ALUMINIO</option>";
                    echo "<option value='BRONCE'>BRONCE</option>";
                    echo "<option value='PVC'>PVC</option>";
                  }
                  elseif (isset($arreglo) && $rgatipmateri == 'PVC') 
                  {
                  echo "<option value='PVC' selected>PVC</option>";
                    echo "<option value='ALUMINIO'>ALUMINIO</option>";
                    echo "<option value='BRONCE'>BRONCE</option>";
                    echo "<option value='COBRE'>COBRE</option>";
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                    echo "<option value='ALUMINIO'>ALUMINIO</option>";
                    echo "<option value='BRONCE'>BRONCE</option>";
                    echo "<option value='COBRE'>COBRE</option>";
                    echo "<option value='PVC'>PVC</option>";
                  }
                ?>             
              </select>
            </td>
          </tr>
          <tr>
            <td>N° CONEXIONES:</td>
            <td> 
                <input type="text" name="rganumconexi" id="rganumconexi" maxlength="2" value="<?php if (isset($rganumconexi)) {echo "$rganumconexi";} ?>" class="inp-ent" placeholder="EJ: 18" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            </td>
            <td>N° CONTADORES:</td>
              <td> 
                <input type="text" name="rganumcontad" id="rganumcontad" maxlength="2" value="<?php if (isset($rganumcontad)) {echo "$rganumcontad";} ?>" class="inp-ent" placeholder="EJ: 18" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            </td>
          </tr>
          <tr>
            <td>N° VALVULAS:</td>
            <td> 
              <input type="text" name="rganumvalvul" id="rganumvalvul" maxlength="2" value="<?php if (isset($rganumvalvul)) {echo "$rganumvalvul";} ?>" class="inp-ent" placeholder="EJ: 18" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            </td>
            <td>N° SOPORTES:</td>
            <td> 
              <input type="text" name="rganumsoport" id="rganumsoport" maxlength="2" value="<?php if (isset($rganumsoport)) {echo "$rganumsoport";} ?>" class="inp-ent" placeholder="EJ: 18" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            </td>
          </tr>
            <tr>
       <td colspan="6"><br>
              <center>
                <?php
                if (isset($arreglo)) 
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_redgas.php'>
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
                <a href="descarga_pdf/pdf_redgas.php" target="_blank">
                  <img src="img/pdf.png" title="Exportar PDF" class="img-form">
                </a> 
<!--BOTON PARA EL (EXCEL)-->          
                <a href="descarga_excel/exc_redgas.php" target="_blank">
                  <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                </a>              
            </td>
              </center>
          </tr>
        </table>
        </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_redgas/gri_redgas.php';?>
      </div>
      <div id="foot">
        <?php include 'include/piepagina.php';?>
      </div>
      <div class="fin">Luis Fernando Chamorro Rodriguez</div>
    </div><!--Cierra <div> del SECTION-->
  </body>
</html>
