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
<?php include 'include/header.php';?>  
  <!-- Descripcion para el cuerpo de la pagina  oncontextmenu="return false" -->
  <body>
    <!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">
      <!-- Descripcion para el Banner-->
      <div id="banner">
        <?php include 'include/banner.php';?>
      </div>
      <!-- Descripcion para el Menu-->
      <div id="nav">
        <?php include 'include/menu.php';?>
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

              $res=pg_query($con, "SELECT * FROM clima WHERE cliid='$_REQUEST[conscodigo]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['clima']=array('cliid'=>$reg[0]);
                $cliid= $reg [0];
                $clifecha=$reg [2];
                $cliradisolar=$reg[3];
                $cliunimedrad=$reg[4];
                $clitempeaire=$reg[5];
                $cliunimedtem=$reg[6];                                    
                $clihumeralat=$reg[7];
                $cliunimedhum=$reg[8];
                $cliprecipita=$reg[9];
                $cliunimedpre=$reg[10];
                $clivelovient=$reg[11];
                $cliunimedvel=$reg[12];                                  
                $clidireccion=$reg[13];

              }
            }
          ?>
            <tr>
              <td colspan="5">
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR CLIMA<b><br><br><p>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR CLIMA<b><br><br><p>";
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
                              <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                              <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                echo "<form name='formulario' action='actualizar/act_clima.php' onsubmit='return ValidarFormClima();'>";
              }
              else
              {
                echo "<form name='formulario' action='registrar/reg_clima.php' onsubmit='return ValidarFormClima();'>";
              }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($cliid)) {echo"$cliid";} ?>" name="cliid" id="cliid"/>
            </td>
          </tr>
          <tr>
            <td>HORA:</td>
            <td>
              <input type="time" id="clihora" name="clihora" class="inp-form" value="<?php date_default_timezone_set("America/Bogota"); echo date("H:i:s",time());?>" step="1" onblur="revisar(this)" required/>
            </td>
          </tr>

          <tr>
            <td>FECHA:</td>
            <td>
              <input type="date" name="clifecha" id="clifecha" class="inp-form" value="<?php if (isset($clifecha)) {echo "$clifecha";} ?>" onblur="revisarfecha(this)" required/>
            </td>
          </tr>
          <tr>
            <td>RADIACION SOLAR:</td>
            <td> 
              <input type="text" name="cliradisolar" id="cliradisolar" maxlength="4" value="<?php if (isset($cliradisolar)) {echo "$cliradisolar";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepuntoClima(event);" onblur="revisarn(this)" required/>
              <select name="cliunimedrad" id="cliunimedrad" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedrad' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$cliunimedrad' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'RADIACION SOLAR'");
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
            <td>TEMPERATURA DEL AIRE:</td>
            <td>
              <input  type="text" name="clitempeaire" id="clitempeaire" maxlength="4" value="<?php if (isset($clitempeaire)) {echo "$clitempeaire";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepuntoClima1(event);" onblur="revisarn(this)" required/>
              <select name="cliunimedtem" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedtem' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$cliunimedtem' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'TEMPERATURA'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>".$umerepre."</option>";
                  }
                ?>      
              </select>
            </td>   
          </tr>
          <tr>
            <td>HUMEDAD RELATIVA:</td>
            <td> 
              <input type="text" name="clihumeralat" id="clihumeralat" maxlength="4" value="<?php if (isset($clihumeralat)) {echo "$clihumeralat";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepuntoClima2(event);" onblur="revisarn(this)" required/>
              <select name="cliunimedhum" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedhum' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$cliunimedhum' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>".$umerepre."</option>";
                  }
                ?>      
              </select>
            </td>   
          </tr>
          <tr>
            <td>PRECIPITACION:</td>
            <td> 
              <input type="text" name="cliprecipita" id="cliprecipita" maxlength="4" value="<?php if (isset($cliprecipita)) {echo "$cliprecipita";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepuntoClima3(event);" onblur="     revisarn(this)" required/>
              <select name="cliunimedpre" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedpre' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$cliunimedpre' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'CAPACIDAD'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umerepre= $reg[1];
                    echo "<option value='$umeid'>".$umerepre."</option>";
                  }
                ?>      
              </select>
            </td>   
          </tr>
          <tr>
            <td>VELOCIDAD VIENTO:</td>
            <td> 
              <input type="text" name="clivelovient" id="clivelovient" maxlength="4" value="<?php if ( isset($clivelovient)) {      echo "$clivelovient";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepuntoClima4(event);" onblur="revisarn(this)" required/>
              <select name="cliunimedvel" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedvel' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $umerepre=$reg1[1];
                      echo "<option value='$cliunimedvel' selected>$umerepre</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'VELOCIDAD'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umenombre= $reg[1];
                    echo "<option value='$umeid'>".$umenombre."</option>";
                  }
                ?>      
              </select>
            </td>   
          </tr>
          <tr>
            <td>DIRECCION VIENTO:</td>
            <td>
              <select name="clidireccion" class="select-form" onblur="SelectVacio(this)" required/>
                <?php 
                  if (isset($arreglo) && $clidireccion == 'NORTE')
                  {
                    echo "<option value='NORTE' selected>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'SUR') 
                  {
                    echo "<option value='SUR' selected>SUR</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'ESTE') 
                  {
                    echo "<option value='ESTE' selected>ESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'OESTE') 
                  {
                    echo "<option value='OESTE' selected>OESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";                    
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'NORESTE') 
                  {
                    echo "<option value='NORESTE' selected>NORESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";                    
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'NOROESTE') 
                  {
                    echo "<option value='NOROESTE' selected>NOROESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'SURESTE') 
                  {
                    echo "<option value='SURESTE' selected>SURESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
                  }
                  elseif (isset($arreglo) && $clidireccion == 'SUROESTE') 
                  {
                    echo "<option value='SUROESTE' selected>SUROESTE</option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option>";
                    echo "<option value='ESTE'>ESTE</option>";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                    echo "<option value='NORTE'>NORTE</option>";
                    echo "<option value='SUR'>SUR</option> ";
                    echo "<option value='ESTE'>ESTE</option> ";
                    echo "<option value='OESTE'>OESTE</option>";
                    echo "<option value='NORESTE'>NORESTE</option>";
                    echo "<option value='NOROESTE'>NOROESTE</option>";
                    echo "<option value='SURESTE'>SURESTE</option>";
                    echo "<option value='SUROESTE'>SUROESTE</option>";
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
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_clima.php'>
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
                <a href="descarga_pdf/pdf_clima.php" target="_blank">
                  <img src="img/pdf.png" title="Exportar PDF" class="img-form">
                </a> 
<!--BOTON PARA EL (EXCEL)-->          
                <a href="descarga_excel/exc_clima.php" target="_blank">
                  <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                </a>              
            </td>
              </center>
          </tr>
        </table>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_clima/gri_clima.php';?>
      </div>
      <div id="foot">
        <?php include 'include/piepagina.php';?>
      </div>
      <div class="fin">Angelica Sanchez Trochez, Luisa Alejandra Salcedo Lozano, Yesica Paola Gomez Arias</div>
    </div><!--Cierra <div> del SECTION-->
  </body>
</html>