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
              $res=pg_query($con, "SELECT * FROM plaga WHERE planomcomun='$_REQUEST[consplanomcomun]'");
                while($reg=pg_fetch_array($res))
                  {
                    $arreglo['plaga']=array('planomcomun'=>$reg[2]);
                    $plaid=$reg [0];
                    $plaidcodigo=$reg[1];
                    $planomcomun=$reg[2];
                    $planomcienti= $reg [3];
                    $plaorigen= $reg [4];
                    $plalugarorig= $reg [5];
                    $platipagecau=$reg[6];
                    $platratamien= $reg [7];
                    $plafecha= $reg [8];
                  }
            }
        ?>
      <tr>
        <td colspan="5"><br>
          <?php
            if (isset($arreglo))
            {
              echo "<p class='tit-form'><b>ACTUALIZAR PLAGA<b><p><br>";
            }
            else
            {
              echo "<p class='tit-form'><b>REGISTRAR PLAGA<b><p><br>";
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
                 <input type='text' name='consplanomcomun' id='consplanomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
                 <input type='text'  name='consplanomcomun' id='consplanomcomun' class='inp-form' placeholder='(NOMBRE COMUN)' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
        echo "<form name='actualizar' action='actualizar/act_plaga.php' onsubmit='return ValidarFormPlaga();'>";
      }
      else
      {
        echo "<form name='registrar' action='registrar/reg_plaga.php' onsubmit='return ValidarFormPlaga();'>";
      }
    ?>
    <tr>
      <td>
        <input type="hidden" value="<?php if (isset($plaid)) {echo "$plaid";} ?>" name="plaid" id="plaid">
      </td>
    </tr>
          	  <tr>
                <td>CODIGO:</td>
                <td> 
                    <input type="text" name="plaidcodigo" id="plaidcodigo" maxlength="10" value="<?php if (isset($plaidcodigo)) {echo "$plaidcodigo";} ?>" class="inp-form" placeholder="EJ: PLA01-NUCH" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
                  <td>NOMBRE COMUN:</td>
                  <td width="110px"> 
                      <input type="text" name="planomcomun" id="planomcomun" class="inp-form" value="<?php if (isset($planomcomun)) {echo "$planomcomun";} ?>" placeholder="EJ: NUCHE" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
                  <td>NOMBRE CIENTIFICO:</td>
                  <td> 
                      <input type="text" name="planomcienti" id="planomcienti" class="inp-form" value="<?php if (isset($planomcienti)) {echo "$planomcienti";} ?>" placeholder="EJ: DERMATOBIA HOMINIS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
                  </td>
                  <?php
                    if (isset($arreglo)) 
                    {
                      echo "<td id='Info2' colspan='3'></td>";
                    }
                    else
                    {
                      echo "<td id='Info2' colspan='3'></td>";
                    }
                  ?> 
              </tr>
              <tr>
                  <td>ORIGEN:</td>
                  <td>
                      <select name="plaorigen" id="origen" onblur="SelectVacio(this)" class="select-form" required/>
                        <?php 
                            if (isset($arreglo) && $plaorigen == 'NATIVO')
                            {
                                echo "<option value='1'>NATIVO</option>";
                                echo "<option value='2'>EXOTICO</option>";
                            }
                            elseif (isset($arreglo) && $plaorigen == 'EXOTICO')
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
                      </select><span id="espera"></span>
                  </td>
                  <td width="15px"></td>
                  <td>LUGAR ORIGEN:</td>
                  <td>
                    <select name="plalugarorig" id="lugarorigen" onblur="SelectVacio(this)" class="select-form" required/>
                      <?php 
                          if (isset($arreglo))
                          {
                            echo "<option>$plalugarorig</option>";
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
                  <td>AGENTE CAUSAL:</td>
                  <td>
                      <select name="platipagecau" id="platipagecau" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $platipagecau == 'GARRAPATAS') 
                {
                  echo "<option value='GARRAPATAS' selected>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
                elseif (isset($arreglo) && $platipagecau == 'GUSANOS') 
                {
                  echo "<option value='GUSANOS' selected>GUSANOS</option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
                elseif (isset($arreglo) && $platipagecau == 'HORMIGAS') 
                {
                  echo "<option value='HORMIGAS' selected>HORMIGAS</option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
                elseif (isset($arreglo) && $platipagecau == 'MOSCAS') 
                {
                  echo "<option value='MOSCAS' selected>MOSCAS</option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
                elseif (isset($arreglo) && $platipagecau == 'PIOJOS') 
                {
                  echo "<option value='PIOJOS' selected>PIOJOS</option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
                elseif (isset($arreglo) && $platipagecau == 'TIÑAS') 
                {
                  echo "<option value='TIÑAS' selected>TIÑAS</option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='GARRAPATAS'>GARRAPATAS</option>";
                  echo "<option value='GUSANOS'>GUSANOS</option>";
                  echo "<option value='HORMIGAS'>HORMIGAS</option>";
                  echo "<option value='MOSCAS'>MOSCAS</option>";
                  echo "<option value='PIOJOS'>PIOJOS</option>";
                  echo "<option value='TIÑAS'>TIÑAS</option>";
                }
              ?>             
        </select>
                  </td> 
                  <td></td>    
                  <td>TRATAMIENTO:</td>
                  <td> 
                      <select name="platratamien"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $platratamien == 'BIOLOGICO') 
                {
                  echo "<option value='BIOLOGICO' selected>BIOLOGICO</option>";
                  echo "<option value='BIOLOGICO-ORGANICO'>BIOLOGICO-ORGANICO</option>";
                  echo "<option value='ORGANICO'>ORGANICO</option>";
                  echo "<option value='QUIMICO'>QUIMICO</option>";
                }
                elseif (isset($arreglo) && $platratamien == 'BIOLOGICO-ORGANICO') 
                {
                  echo "<option value='BIOLOGICO-ORGANICO' selected>BIOLOGICO-ORGANICO</option>";
                  echo "<option value='BIOLOGICO'>BIOLOGICO</option>";
                  echo "<option value='ORGANICO'>ORGANICO</option>";
                  echo "<option value='QUIMICO'>QUIMICO</option>";
                }
                elseif (isset($arreglo) && $platratamien == 'ORGANICO') 
                {
                  echo "<option value='ORGANICO' selected>ORGANICO</option>";
                  echo "<option value='BIOLOGICO'>BIOLOGICO</option>";
                  echo "<option value='BIOLOGICO-ORGANICO'>BIOLOGICO-ORGANICO</option>";
                  echo "<option value='QUIMICO'>QUIMICO</option>";
                }
                elseif (isset($arreglo) && $platratamien == 'QUIMICO') 
                {
                  echo "<option value='QUIMICO' selected>QUIMICO</option>";
                  echo "<option value='BIOLOGICO'>BIOLOGICO</option>";
                  echo "<option value='BIOLOGICO-ORGANICO'>BIOLOGICO-ORGANICO</option>";
                  echo "<option value='ORGANICO'>ORGANICO</option>";              
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='BIOLOGICO'>BIOLOGICO</option>";
                  echo "<option value='BIOLOGICO-ORGANICO'>BIOLOGICO-ORGANICO</option>";
                  echo "<option value='ORGANICO'>ORGANICO</option>";
                  echo "<option value='QUIMICO'>QUIMICO</option>";
                }
              ?>
            </select>
                  </td> 
              </tr>
              <tr>
                <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_plaga.php'>
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
              <a href="descarga_pdf/pdf_plaga.php" target="_blank">
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_plaga.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
            </center>
          </td>
        </tr>
      </table>
    </form>
      </div>
      <div id="grilla">
        <?php
          include 'grillas/gri_plaga/gri_plaga.php';
        ?>
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