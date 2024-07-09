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
                  $res=pg_query($con, "SELECT * FROM cultivo WHERE culidcodigo='$_REQUEST[conscodigo]'");
                  while($reg=pg_fetch_array($res))
                  {
                      $arreglo['cultivo']=array('culid'=>$reg[0]);
                      $culid= $reg [0];
                      $culidcodigo= $reg[1];
                      $culnomcomun= $reg[2];
                      $culnomcienti= $reg[3];
                      $culorigen= $reg [4];
                      $cullugarorig= $reg [5];
                      $culclimafavo= $reg [6];
                      $culdistsiemb= $reg [7];
                      $culunimedsie= $reg [8];
                      $culvidautil= $reg [9];
                      $cultiempvida= $reg [10];
                      $culextension= $reg [11];
                      $culunimedida= $reg [12];
                      $cullatitud= $reg [13];
                      $culorientlat= $reg [14];
                      $cullongitud= $reg [15];
                      $culorientlon= $reg [16];
                      $culfecha= $reg [17];
                  }
                }
              ?>
          <tr>
            <td colspan="8"><br>
                <?php 
                    if (isset($arreglo))
                    {
                      echo "<p class='tit-form'><b>ACTUALIZAR CULTIVO<b><br><p><br>";
                    }
                    else
                    {
                      echo "<p class='tit-form'><b>REGISTRAR CULTIVO<b><br><p><br>";
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
                          <td></td>
                          <td>CONSULTAR:</td>
                          <td colspan='6'>
                            <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CUL01-NARA' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                          <td></td>
                          <td>CONSULTAR:</td>
                          <td colspan='6'>
                            <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CUL01-NARA' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
            ?>
        </form>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN NUEVO FORM QUE DIRECCIONARÁ A LAS PÁGINAS (REGISTRAR O ACTUALIZAR)   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->    
          <?php 
              if (isset($arreglo)) 
              {
                echo "<form name='formulario' action='actualizar/act_cultivo.php' onsubmit='return ValidarFormCultivo();'>";
              }
              else
              {
                echo "<form name='formulario' action='registrar/reg_cultivo.php' onsubmit='return ValidarFormCultivo();'>";
              }
          ?>
            <tr>
                <td colspan="8">
                    <br><input type="hidden" value="<?php if (isset($culid)) {echo"$culid";} ?>" name="culid" id="culid"/>
                </td>
            </tr>
            <tr>
              <td></td>
              <td>CODIGO:<td>
                <input type="text" name="culidcodigo" id="culidcodigo" maxlength="10" value="<?php if (isset($culidcodigo)) {echo "$culidcodigo";} ?>" class="inp-form" placeholder="EJ: CUL01-NARA" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/> 
                <?php
                  if (isset($arreglo)) 
                  {
                    echo "<td id='Info' colspan='5'></td>";
                  }
                  else
                  {
                    echo "<td id='Info' colspan='5'></td>";
                  } 
                ?>
            </tr>
            <tr>
              <td></td>
              <td>NOMBRE COMUN:</td>
              <td> 
                  <input type="text" name="culnomcomun" id="culnomcomun" class="inp-form" value="<?php if (isset($culnomcomun)) {echo "$culnomcomun";} ?>" placeholder="EJ: NARANJA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
              </td>
                <?php
                  if (isset($arreglo)) 
                  {
                    echo "<td id='Info1' colspan='5'></td>";
                  }
                  else
                  {
                    echo "<td id='Info1' colspan='5'></td>";
                  } 
                ?>
            </tr>
            <tr>
              <td></td>
              <td>NOMBRE CIENTIFICO:</td>
              <td>
                <input type="text" name="culnomcienti" id="culnomcienti" class="inp-form" value="<?php if (isset($culnomcienti)) {echo "$culnomcienti";} ?>" placeholder="EJ: CITRUS SINENSIS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
              </td>
                <?php
                  if (isset($arreglo)) 
                  {
                    echo "<td id='Info2' colspan='5'></td>";
                  }
                  else
                  {
                    echo "<td id='Info2' colspan='5'></td>";
                  } 
                ?>
            </tr>
            <tr>
              <td></td>
              <td>ORIGEN:</td>
              <td colspan="2">
                <select name="culorigen" id="origen" class="select-form" onblur="SelectVacio(this)" required/>
                  <?php   
                    if (isset($arreglo) && $culorigen == 'EXOTICO') 
                    {
                      echo "<option value='0' disabled></option>";
                      echo "<option value='2' selected>EXOTICO</option>";
                      echo "<option value='1'>NATIVO</option>";
                    }
                    elseif (isset($arreglo) && $culorigen == 'NATIVO')
                    {
                      echo "<option value='0' disabled></option>";
                      echo "<option value='1' selected>NATIVO</option>";
                      echo "<option value='2'>EXOTICO</option>";
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                      echo "<option value='2'>EXOTICO</option>";
                      echo "<option value='1'>NATIVO</option>";
                    }
                  ?>
                </select><span id="espera"></span>
              </td>
              <td>LUGAR ORIGEN:</td>
                <td colspan="3">
                  <select name="cullugarorig" id="lugarorigen" class="select-form"  onblur="SelectVacio(this)" required/>
                    <?php 
                          if (isset($arreglo))
                          {
                            echo "<option>$cullugarorig</option>";
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
                <td></td>
                <td>DISTANCIA SIEMBRA:</td>
                <td colspan="2"> 
                  <input type="text" name="culdistsiemb" id="culdistsiemb" maxlength="4" value="<?php if (isset($culdistsiemb)) {echo "$culdistsiemb";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return puntodecimal1(event);" onblur="revisarn(this)" required/>
                    <select name="culunimedsie" id="culunimedsie" class="uni-form" onblur="SelectVaciouni(this)" required/>
                    <?php
                      include 'conexion.php';
                      if (isset($arreglo))
                      {
                       $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$culunimedsie ");
                       while($reg1=pg_fetch_array($res1))
                       {
                         $umenombre=$reg1[1];
                         echo "<option value='$culunimedsie' selected>$umenombre</option>";
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
                <td>CLIMA FAVORABLE:</td>
                <td colspan="3">
                  <select name="culclimafavo" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php   
                      if (isset($arreglo) && $culclimafavo == 'CALIENTE') 
                      {
                        echo "<option value='CALIENTE' selected>CALIENTE</option>";
                        echo "<option value='FRIO'>FRIO</option>";
                        echo "<option value='TEMPLADO'>TEMPLADO</option>";
                      }
                      elseif (isset($arreglo) && $culclimafavo == 'FRIO') 
                      {
                        echo "<option value='FRIO' selected>FRIO</option>";
                        echo "<option value='CALIENTE'>CALIENTE</option>";
                        echo "<option value='TEMPLADO'>TEMPLADO</option>";
                      }
                       elseif (isset($arreglo) && $culclimafavo == 'TEMPLADO') 
                      {
                        echo "<option value='TEMPLADO' selected>TEMPLADO</option>";
                        echo "<option value='CALIENTE'>CALIENTE</option>";
                        echo "<option value='FRIO'>FRIO</option>";                        
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo "<option value='CALIENTE'>CALIENTE</option>";
                        echo "<option value='FRIO'>FRIO</option>";
                        echo "<option value='TEMPLADO'>TEMPLADO</option>";
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>VIDA UTIL:</td>
                <td colspan="2"> 
                  <input type="text" name="culvidautil" id="culvidautil" maxlength="4" value="<?php if (isset($culvidautil)) {echo "$culvidautil";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return puntodecimal(event);" onblur="revisarn(this)" required/>
                    <select name="cultiempvida" class="uni-form" onblur="SelectVaciouni(this)" required/>
                      <?php   
                        if (isset($arreglo) && $cultiempvida == 'DIAS') 
                        {
                          echo "<option value='DIAS' selected>DIAS</option>";
                          echo "<option value='MESES'>MESES</option>";
                          echo "<option value='AÑOS'>AÑOS</option>";
                        }
                        elseif (isset($arreglo) && $cultiempvida == 'MESES') 
                        {
                          echo "<option value='MESES' selected>MESES</option>";
                          echo "<option value='DIAS'>DIAS</option>";
                          echo "<option value='AÑOS'>AÑOS</option>";
                        }
                         elseif (isset($arreglo) && $cultiempvida == 'AÑOS') 
                        {
                          echo "<option value='AÑOS' selected>AÑOS</option>";
                          echo "<option value='DIAS'>DIAS</option>";
                          echo "<option value='MESES'>MESES</option>";                        
                        }
                        else
                        {
                          echo "<option selected disabled></option>";
                          echo "<option value='DIAS'>DIAS</option>";
                          echo "<option value='MESES'>MESES</option>";
                          echo "<option value='AÑOS'>AÑOS</option>";
                        }
                      ?>
                    </select>
                </td>
              <td>EXTENSION:</td>
              <td colspan="3"> 
                <input type="text"  name="culextension" id="culextension" class="inp-ent" maxlength="4" value="<?php if (isset($culextension)) {echo "$culextension";} ?>" placeholder="EJ: 1.50" onkeypress="return puntodecimal2(event);" onblur="revisarn(this)" required/>
              
                <select name="culunimedida" id="culunimedida" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    include 'conexion.php';
                    if (isset($culunimedida)) 
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$culunimedida' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=$row[1];
                      } 
                      echo "<option value='$culunimedida' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
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
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>LATITUD:</td>
              <td width="10px"></td>
              <td colspan="3">
                <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($cullatitud)) {echo "$cullatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
                <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($culorientlat)) {echo "$culorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly">  
              </td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>LONGITUD:</td>
              <td width="10px"></td>
              <td colspan="3">
                <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($cullongitud)) {echo "$cullongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
                <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($culorientlon)) {echo "$culorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly">
              </td> 
            </tr>
            <tr>
                <td colspan="8"><br>
                    <center>
                          <?php
                             if (isset($arreglo)) 
                                {
                                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                                  <a href='frm_cultivo.php'>
                                  <img src='img/Nuevo.png' class='img-form' title'nuevo Registro'>
                                  </a>";
                                }
                              else
                                {
                                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Guardar Registro'>";
                                }
                          ?>
<!--BOTON PARA CONSULTAR-->
                          <img src="img/Consultar.png" class="img-form" title="Consultar" id="botonconsulta">
<!--BOTON PARA LA (GRILLA)-->
                          <img src="img/Grilla.png" class="img-form" title="Ver Grilla" id="boton">
<!--BOTON PARA EL (PDF)-->
                          <a href="descarga_pdf/pdf_cultivo.php" target="_blank">
                              <img src="img/Pdf.png" class="img-form" title="Exportar PDF">
                          </a> 
<!--BOTON PARA EL (EXCEL)-->                         
                          <a href="descarga_excel/exc_cultivo.php" target="_blank">
                              <img src="img/Excel.png" class="img-form" title="Exportar Excel">
                          </a>
                    </center>
                </td>
            </tr>
    </table>
    </div>
    <div id="grilla">
      <?php
        include 'grillas/gri_cultivo/gri_cultivo.php';
      ?>
    </div>
    <div id="foot">
     <?php
     include 'include/piepagina.php'
     ?>
    </div>
    <div class="fin">
        Angelica Sanchez Trochez
    </div>
  </div>
</body>
</html>