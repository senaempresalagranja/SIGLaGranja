<!-- 
  Proyecto: Sistema de Informacion del Centro Agropecuario La Granja. 
  Nombre del proyecto:  SIG LA GRANJA. 
  Desarrolladores: Tecnologos en Analisis y desarrollo de sistemas de informacion "ADSI". 
  Numero de Ficha: 798585. 
  Descripcion del Proyecto: Software que permita la Georeferenciación de Centro agropecuario la granja Sena Espinal - Tolima. 
  Año de Desarrollo: 2014-2015. -->

<!-- Descripcion de la pagina en formato de HTML5. 
-->
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
<?php
include 'include/header.php';
?>
<!-- Descripcion para el cuerpo de la pagina  -->
 <body>
  <!-- Descripcion para el contenedor principal, campo de trabajo-->
  <div id="section">
    <!-- Descripcion para el Banner-->
    <div id="banner">
      <?php
      include 'include/banner.php';
      ?>
    </div>
    <!-- Descripcion para el Menu-->
    <div id="nav">
      <?php
      include 'include/menu.php';
      ?>
    </div>
    <!-- Descripcion para el cuerpo de la pagina-->
    <div id="form">   
      <table width="100%" class="table">
      <center>
          <form name="form1" id="formulario" action="frm_suelo.php">
            <?php
            error_reporting(E_ALL ^E_NOTICE);
            if($_REQUEST['condicion']==1)
            {
              include 'conexion.php';

              $res=pg_query($con,"SELECT * FROM suelo WHERE sueid='$_REQUEST[consueid]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['suelo']=array('sueid'=>$reg[0]);
                $sueid= utf8_decode($reg[0]);
                $suefhumedad= utf8_decode($reg[1]);
                $sueunimedhu= utf8_decode($reg[2]);
                $sueftextura= utf8_decode($reg[3]);
                $suefporocida= utf8_decode($reg[4]);
                $sueunimedpo= utf8_decode($reg[5]);
                $suefconsiste= utf8_decode($reg[6]);
                $sueunimedco= utf8_decode($reg[7]);
                $suefcolorter= utf8_decode($reg[8]);
                $suefcondelet= utf8_decode($reg[9]);
                $sueunimedel= utf8_decode($reg[10]);
                $sueqnitrogen= utf8_decode($reg[11]);
                $sueunimedni= utf8_decode($reg[12]);
                $sueqfosforo= utf8_decode($reg[13]);
                $sueunimedfo= utf8_decode($reg[14]);
                $sueqpotacio= utf8_decode($reg[15]);
                $sueunimedpt= utf8_decode($reg[16]);
                $sueqelemmeno= utf8_decode($reg[17]);
                $sueqeleminte= utf8_decode($reg[18]);
                $sueqph= utf8_decode($reg[19]);
                $sueunimedph= utf8_decode($reg[20]);
                $suebmateorga= utf8_decode($reg[21]);
                $sueunimedma= utf8_decode($reg[22]);
                $suebactimicr= utf8_decode($reg[23]);
                $sueunimedam= utf8_decode($reg[24]);
                $suebmasmicro= utf8_decode($reg[25]);
                $sueunimedmm= utf8_decode($reg[26]);
              }
            }
            ?> 
            <tr>
              <td colspan="4"><br>
                <?php
                if (isset($arreglo))
                {
                  echo "<p class= 'tit-form'><b>ACTUALIZAR SUELO</b><br><p><br>";
                }
                else 
                {
                  echo "<p class= 'tit-form'><b>REGISTRAR SUELO</b><br><p><br>";
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
                              <input type='text' name='consueid' id='consueid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress=\"return permite(event,'num')\">
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
                              <input type='text' name='consueid' id='consueid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress=\"return permite(event,'num')\">
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
                echo "<form name='formulario' action='actualizar/act_suelo.php' onsubmit='return ValidarFormSuelo();'>";
              }
              else
              {
                echo "<form name='formulario' action='registrar/reg_suelo.php' onsubmit='return ValidarFormSuelo();'>";
              }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($sueid)) {echo"$sueid";} ?>" name="sueid" id="sueid"/>
            </td>
          </tr>
          <tr>
            <td colspan="4" >
              <b>PROPIEDADES FISICAS</b>
            </td>
          </tr>
        <tr>
          <td>HUMEDAD:</td>
          <td>
            <input type="text" name="suefhumedad" id="suefhumedad" maxlength="4" value="<?php if (isset($suefhumedad)) {echo "$suefhumedad";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloHume(event);" onblur="revisarn(this)" required/>

              <select name="sueunimedhu" id="sueunimedhu" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedhu ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedhu' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umerepre= $reg[1];
                        echo "<option value='$umeid'>$umerepre</option>";
                      }
                ?>
              </select>
          </td>
          <td>TEXTURA:</td>
          <td>
            <select name="sueftextura"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $sueftextura == 'ARENOSA') 
                {
                  echo "<option value='ARENOSA' selected>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";
                }
                elseif (isset($arreglo) && $sueftextura == 'ARENOSA-FRANCA') 
                {                  
                  echo "<option value='ARENOSA-FRANCA' selected>ARENOSA-FRANCA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";                  
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCO-ARENOSA') 
                {
                  echo "<option value='FRANCO-ARENOSA' selected>FRANCO-ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";                 
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCA') 
                {
                  echo "<option value='FRANCA' selected>FRANCA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";                  
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCO-LIMOSA') 
                {
                  echo "<option value='FRANCO-LIMOSA' selected>FRANCO-LIMOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";                  
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'LIMOSA') 
                {
                  echo "<option value='LIMOSA' selected>LIMOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";                  
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCO-ARCILLO-ARENOSA') 
                {
                  echo "<option value='FRANCO-ARCILLO-ARENOSA' selected>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";                  
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCO-ARCILLOSA') 
                {
                  echo "<option value='FRANCO-ARCILLOSA' selected>FRANCO-ARCILLOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";                  
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'FRANCO-ARCILLO-LIMOSA') 
                {
                  echo "<option value='FRANCO-ARCILLO-LIMOSA' selected>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";               
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'ARCILLO-ARENOSA') 
                {
                  echo "<option value='ARCILLO-ARENOSA' selected>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";                  
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'ARCILLO-LIMOSA') 
                {
                  echo "<option value='ARCILLO-LIMOSA' selected>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";                  
                }
                elseif (isset($arreglo) && $sueftextura == 'ARCILLOSA') 
                {
                  echo "<option value='ARCILLOSA' selected>ARCILLOSA</option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";                                    
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='ARENOSA'>ARENOSA</option>";
                  echo "<option value='ARENOSA-FRANCA'>ARENOSA-FRANCA</option>";
                  echo "<option value='FRANCO-ARENOSA'>FRANCO-ARENOSA</option>";
                  echo "<option value='FRANCA'>FRANCA</option>";
                  echo "<option value='FRANCO-LIMOSA'>FRANCO-LIMOSA</option>";
                  echo "<option value='LIMOSA'>LIMOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-ARENOSA'>FRANCO-ARCILLO-ARENOSA</option>";
                  echo "<option value='FRANCO-ARCILLOSA'>FRANCO-ARCILLOSA</option>";
                  echo "<option value='FRANCO-ARCILLO-LIMOSA'>FRANCO-ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLO-ARENOSA'>ARCILLO-ARENOSA</option>";
                  echo "<option value='ARCILLO-LIMOSA'>ARCILLO-LIMOSA</option>";
                  echo "<option value='ARCILLOSA'>ARCILLOSA</option>";
                }
              ?>
            </select>
          </td>
        </tr>
      <tr> 
        <td>POROCIDAD:</td>
          <td>
            <input type="text" name="suefporocida" id="suefporocida" maxlength="4" value="<?php if (isset($suefporocida)) {echo "$suefporocida";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloPoro(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedpo" id="sueunimedpo" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedpo ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedpo' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
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
        <td>CONSISTENCIA:</td>
          <td>
            <input type="text" name="suefconsiste" id="suefconsiste" maxlength="4" value="<?php if (isset($suefconsiste)) {echo "$suefconsiste";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloConsi(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedco" id="sueunimedco" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedco ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedco' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umerepre= $reg[1];
                        echo "<option value='$umeid'>$umerepre</option>";
                      }
                ?>
              </select>
          </td>
        <td>COLOR:</td>
          <td>
            <select name="suefcolorter"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $suefcolorter == 'AMARILLO') 
                {
                  echo "<option value='AMARILLO' selected>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'AZUL') 
                {
                  echo "<option value='AZUL' selected>AZUL</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";                              
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'BLANCO') 
                {
                  echo "<option value='BLANCO' selected>BLANCO</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                 
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'GRIS') 
                {
                  echo "<option value='GRIS' selected>GRIS</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'MARRON') 
                {
                  echo "<option value='MARRON' selected>MARRON</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";                  
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'ROJO') 
                {
                  echo "<option value='ROJO' selected>ROJO</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";                  
                  echo "<option value='VERDE'>VERDE</option>";
                }
                elseif (isset($arreglo) && $suefcolorter == 'VERDE') 
                {
                  echo "<option value='VERDE' selected>VERDE</option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";                  
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='AMARILLO'>AMARILLO</option>";
                  echo "<option value='AZUL'>AZUL</option>";                  
                  echo "<option value='BLANCO'>BLANCO</option>";
                  echo "<option value='GRIS'>GRIS</option>";
                  echo "<option value='MARRON'>MARRON</option>";
                  echo "<option value='ROJO'>ROJO</option>";
                  echo "<option value='VERDE'>VERDE</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr> 
          <td>CONDUCTIVIDAD ELECTRICA:</td>
          <td>
            <input type="text" name="suefcondelet" id="suefcondelet" maxlength="4" value="<?php if (isset($suefcondelet)) {echo "$suefcondelet";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloCoEl(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedel" id="sueunimedel" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedel ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedel' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'SIEMENS'");
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
          <td colspan="4">
            <b>PROPIEDADES QUIMICAS</b>
          </td>
        </tr>
        <tr>
          <td>NITROGENO:</td>
          <td>
            <input type="text" name="sueqnitrogen" id="sueqnitrogen" maxlength="4" value="<?php if (isset($sueqnitrogen)) {echo "$sueqnitrogen";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloNitr(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedni" id="sueunimedni" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedni ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedni' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umerepre= $reg[1];
                        echo "<option value='$umeid'>$umerepre</option>";
                      }
                ?>
              </select>
          </td>
          <td>FOSFORO:</td>
          <td>
            <input type="text" name="sueqfosforo" id="sueqfosforo" maxlength="4" value="<?php if (isset($sueqfosforo)) {echo "$sueqfosforo";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloFosf(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedfo" id="sueunimedfo" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedfo ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedfo' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
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
          <td>POTACIO:</td>
          <td>
            <input type="text" name="sueqpotacio" id="sueqpotacio" maxlength="4" value="<?php if (isset($sueqpotacio)) {echo "$sueqpotacio";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloPota(event);" onblur="revisarn(this)" required/>

              <select name="sueunimedpt" id="sueunimedpt" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedpt ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedpt' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umerepre= $reg[1];
                        echo "<option value='$umeid'>$umerepre</option>";
                      }
                ?>
              </select>
          </td>
          <td>ELEMENTOS MENORES:</td>
          <td>
            <select name="sueqelemmeno"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $sueqelemmeno == 'BORO') 
                {
                  echo "<option value='BORO' selected>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'COBALTO') 
                {
                  echo "<option value='COBALTO' selected>COBALTO</option>";
                  echo "<option value='BORO'>BORO</option>";                                                      
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'COBRE') 
                {
                  echo "<option value='COBRE' selected>COBRE</option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                 
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'HIERRO') 
                {
                  echo "<option value='HIERRO' selected>HIERRO</option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'MAGNECIO') 
                {
                  echo "<option value='MAGNECIO' selected>MAGNECIO</option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";                  
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'MOLIBDENO') 
                {
                  echo "<option value='MOLIBDENO' selected>MOLIBDENO</option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";                  
                  echo "<option value='ZINC'>ZINC</option>";
                }
                elseif (isset($arreglo) && $sueqelemmeno == 'ZINC') 
                {
                  echo "<option value='ZINC' selected>ZINC</option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";                  
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='BORO'>BORO</option>";
                  echo "<option value='COBALTO'>COBALTO</option>";                  
                  echo "<option value='COBRE'>COBRE</option>";
                  echo "<option value='HIERRO'>HIERRO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                  echo "<option value='MOLIBDENO'>MOLIBDENO</option>";
                  echo "<option value='ZINC'>ZINC</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>ELEMENTOS INTERCAMBIO:</td> 
          <td>
            <select name="sueqeleminte" id="sueqeleminte" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $sueqeleminte == 'CALCIO') 
                {
                  echo "<option value='CALCIO' selected>CALCIO</option>";
                  echo "<option value='HIDROGENO'>HIDROGENO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                }
                elseif (isset($arreglo) && $sueqeleminte == 'HIDROGENO') 
                {
                  echo "<option value='HIDROGENO' selected>HIDROGENO</option>";
                  echo "<option value='CALCIO'>CALCIO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                }
                elseif (isset($arreglo) && $sueqeleminte == 'MAGNECIO') 
                {
                echo "<option value='MAGNECIO' selected>MAGNECIO</option>";
                  echo "<option value='CALCIO'>CALCIO</option>";
                  echo "<option value='HIDROGENO'>HIDROGENO</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='CALCIO'>CALCIO</option>";
                  echo "<option value='HIDROGENO'>HIDROGENO</option>";
                  echo "<option value='MAGNECIO'>MAGNECIO</option>";
                }
              ?>             
            </select>
          </td>
            <td>PH:</td>
          <td>
            <input type="text" name="sueqph" id="sueqph" maxlength="4" value="<?php if (isset($sueqph)) {echo "$sueqph";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloPH(event);" onblur="revisarn(this)" required/> 

              <select name="sueunimedph" id="sueunimedph" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedph ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedph' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
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
            <td colspan="4" >
              <b>PROPIEDADES BIOLOGICAS</b>
            </td>
          </tr>
          <tr>
           <td>ACTIVIDAD MICROBIANA:</td>
          <td>
            <input type="text" name="suebactimicr" id="suebactimicr" maxlength="4" value="<?php if (isset($suebactimicr)) {echo "$suebactimicr";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloAcMi(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedam" id="sueunimedam" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedam ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedam' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
                    while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umerepre= $reg[1];
                        echo "<option value='$umeid'>$umerepre</option>";
                      }
                ?>
              </select>
          </td>
           <td>MASA MICROBIANA:</td>
          <td>
            <input type="text" name="suebmasmicro" id="suebmasmicro" maxlength="4" value="<?php if (isset($suebmasmicro)) {echo "$suebmasmicro";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SueloMaMi(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedmm" id="sueunimedmm" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedmm ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedmm' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'MASA'");
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
          <td>MATERIA ORGANICA:</td>
          <td>
            <input type="text" name="suebmateorga" id="suebmateorga" maxlength="4" value="<?php if (isset($suebmateorga)) {echo "$suebmateorga";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return SuloMaOr(event);" onblur="revisarn(this)" required/>           
              <select name="sueunimedma" id="sueunimedma" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
                   $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$sueunimedma ");
                   while($reg1=pg_fetch_array($res1))
                   {
                       $umerepre=$reg1[1];
                       echo "<option value='$sueunimedma' selected>$umerepre</option>";
                   }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'PORCENTAJE'");
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
          <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_suelo.php'>
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
              <a href="descarga_pdf/pdf_suelo.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_suelo.php" target="_blank">
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
          include 'grillas/gri_suelo/gri_suelo.php';
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