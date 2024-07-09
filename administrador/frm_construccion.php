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
  <?php include 'include/header.php';	?>
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
        <form name="form1" id="formulario">
          <table width="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
            <?php
              error_reporting(E_ALL ^ E_NOTICE);
              if($_REQUEST['condicion']==1)
              {
                include 'conexion.php';
                $res=pg_query($con, "SELECT * FROM construccion WHERE conidcodigo='$_REQUEST[conscodigo]'");
                while($reg=pg_fetch_array($res))
                {
                  $arreglo['construccion']=array('conid'=>$reg[0]);
                  $conid= utf8_decode($reg [0]);
                  $conidcodigo= utf8_decode($reg[1]);
                  $conunidad= utf8_decode($reg[2]);
                  $connombre= utf8_decode($reg[3]);
                  $conextension= utf8_decode($reg[4]);
                  $conunimedcon= utf8_decode($reg[5]);
                  $contipambien= utf8_decode($reg[6]); 
                  $contipconstr= utf8_decode($reg[7]);
                  $conestado= utf8_decode($reg[8]); 
                  $contipcubiert= utf8_decode($reg[9]);
                  $contippiso= utf8_decode($reg[10]);
                  $contipmuro= utf8_decode($reg[11]);
                  $confecconstr= utf8_decode($reg[12]);
                  $confecremode= utf8_decode($reg[13]);
                  $conlatitud= utf8_decode($reg[14]);
                  $conorientlat= utf8_decode($reg[15]);
                  $conlongitud= utf8_decode($reg[16]);
                  $conorientlon= utf8_decode($reg[17]);
                  $confecha= utf8_decode($reg[18]);
                }
              }
            ?>
            <tr>
              <td colspan="5"><br>
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR CONSTRUCCION<b><br><p><br>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR CONSTRUCCION<b><br><p><br>";
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
                            <td width='22%'>CONSULTAR:</td>
                            <td colspan='3'>
                              <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CON01-B1' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td width='22%'>CONSULTAR:</td>
                            <td colspan='3'>
                              <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CON01-B1' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
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
              echo "<form name='formulario' action='actualizar/act_construccion.php' onsubmit='return ValidarFormConstruccion();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_construccion.php' onsubmit='return ValidarFormConstruccion();'>";
            }
          ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($conid)) {echo "$conid";} ?>" name="conid" id="conid"/>
            </td>
          </tr>
          <tr>
            <td>UNIDAD:</td>
            <td>
              <select name="conunidad" id="conunidad" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$conunidad' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $NomUnidad=$reg1[2];
                      echo "<option value='$conunidad' selected>$NomUnidad</option>";
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
            <td>CODIGO:</td>
            <td>
              <input type="text" name="conidcodigo" id="conidcodigo" maxlength="10" value="<?php if (isset($conidcodigo)) {echo "$conidcodigo";} ?>" class="inp-form" placeholder="EJ: CONST01-B1" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
            <?php
              if (isset($conid)) 
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
            <td>NOMBRE:</td>
            <td>
              <input type="text" name="connombre" id="connombre" class="inp-form" value="<?php if (isset($connombre)) {echo "$connombre";} ?>" placeholder="EJ: BLOQUE ADMINISTRATIVO" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
            <?php
              if (isset($id)) 
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
            <td>EXTENSION:</td>
            <td> 
              <input type="text"  name="conextension" id="conextension" class="inp-ent" maxlength="4" value="<?php if (isset($conextension)) {echo "$conextension";} ?>" placeholder="EJ: 1.50" onkeypress="return ExtencionConst(event);" onblur="revisarn(this)" required/>
              
              <select name="conunimedcon" id="conunimedcon" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$conunimedcon' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$conunimedcon' selected>$repunimed</option>";
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umetipunimed = 'SUPERFICIE'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umenombre= $reg[1];
                    echo "<option value='$umeid'>$umenombre</option>";
                  }
                ?>
              </select>
            </td>
                  <td width="15px"></td>
                  <td>TIPO AMBIENTE:</td>
                  <td>
                    <select name="contipambien" id="contipambien" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo) && $contipambien == 'FORMACION') 
                      {
                        echo "<option value='FORMACION' selected>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                      elseif (isset($arreglo) && $contipambien == 'BIENESTAR APRENDIZ') 
                      {
                        echo "<option value='BIENESTAR APRENDIZ' selected>BIENESTAR APRENDIZ</option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                      elseif (isset($arreglo) && $contipambien == 'BIENESTAR FUNCIONARIOS') 
                      {
                        echo "<option value='BIENESTAR FUNCIONARIOS' selected>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                      elseif (isset($arreglo) && $contipambien == 'UNIDAD CONSULTA') 
                      {
                        echo "<option value='UNIDAD CONSULTA' selected>UNIDAD CONSULTA</option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                      elseif (isset($arreglo) && $contipambien == 'UNIDAD ADMINISTRACION') 
                      {
                        echo "<option value='UNIDAD ADMINISTRACION' selected>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                      elseif (isset($arreglo) && $contipambien == 'REUNION/EVENTOS') 
                      {
                        echo "<option value='REUNION EVENTOS' selected>REUNION EVENTOS</option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo "<option value='FORMACION'>FORMACION</option>";
                        echo "<option value='BIENESTAR APRENDIZ'>BIENESTAR APRENDIZ</option>";
                        echo "<option value='BIENESTAR FUNCIONARIOS'>BIENESTAR FUNCIONARIOS</option>";
                        echo "<option value='UNIDAD CONSULTA'>UNIDAD CONSULTA</option>";
                        echo "<option value='UNIDAD ADMINISTRACION'>UNIDAD ADMINISTRACION</option>";
                        echo "<option value='REUNION/EVENTOS'>REUNION/EVENTOS</option>";
                      }
                    ?>
                  </select>
                </td>
              <tr>
                <td>TIPO CONSTRUCCION:</td>
                <td>
                  <select name="contipconstr" id="contipconstr" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo) && $contipconstr == 'MODERNO') 
                      {
                        echo "<option value='MODERNO' selected>MODERNO</option>";
                        echo "<option value='ANTIGUO'>ANTIGUO</option>";
                      }
                      elseif (isset($arreglo) && $contipconstr == 'ANTIGUO') 
                      {
                        echo "<option value='ANTIGUO' selected>ANTIGUO</option>";
                        echo "<option value='MODERNO'>MODERNO</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo "<option value='MODERNO'>MODERNO</option>";
                        echo "<option value='ANTIGUO'>ANTIGUO</option>";
                      }
                    ?>
                  </select>
                </td> 
                <td></td>
                <td>ESTADO:</td>
               <td>
                <select name="conestado" id="conestado" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo) && $conestado == 'MALO') 
                      {
                        echo "<option value='MALO' selected>MALO</option>";
                        echo "<option value='REGULAR'>REGULAR</option>";
                        echo "<option value='BUENO'>BUENO</option>";
                        echo "<option value='EXCELENTE'>EXCELENTE</option>";
                      }
                      elseif (isset($arreglo) && $conestado == 'REGULAR') 
                      {
                        echo "<option value='REGULAR' selected>REGULAR</option>";
                        echo "<option value='MALO'>MALO</option>";
                        echo "<option value='BUENO'>BUENO</option>";
                        echo "<option value='EXCELENTE'>EXCELENTE</option>";
                      }
                      elseif (isset($arreglo) && $conestado == 'BUENO') 
                      {
                        echo "<option value='BUENO' selected>BUENO</option>";
                        echo "<option value='MALO'>MALO</option>";
                        echo "<option value='REGULAR'>REGULAR</option>";
                        echo "<option value='EXCELENTE'>EXCELENTE</option>";
                      }
                      elseif (isset($arreglo) && $conestado == 'EXCELENTE') 
                      {
                        echo "<option value='EXCELENTE' selected>EXCELENTE</option>";
                        echo "<option value='MALO'>MALO</option>";
                        echo "<option value='REGULAR'>REGULAR</option>";
                        echo "<option value='BUENO'>BUENO</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo"<option value='MALO'>MALO</option>";
                        echo"<option value='REGULAR'>REGULAR</option>";
                        echo"<option value='BUENO'>BUENO</option>";
                        echo"<option value='EXCELENTE'>EXCELENTE</option>";
                      }
                    ?>
                </select>
              </td>
            <tr>
              <td>TIPO CUBIERTA:</td>
              <td>
                <select name="contipcubiert" id="contipcubiert" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                      if (isset($arreglo) && $contipcubiert == 'METALICAS') 
                      {
                        echo "<option value='METALICAS' selected>METALICAS</option>";
                        echo "<option value='FIBRACEMENTO'>FIBRACEMENTO</option>";
                        echo "<option value='PVC'>PVC</option>";
                        echo "<option value='PALMA'>PALMA</option>";
                      }
                      elseif (isset($arreglo) && $contipcubiert == 'FIBRACEMENTO') 
                      {
                        echo "<option value='FIBRACEMENTO' selected>FIBRACEMENTO</option>";
                        echo "<option value='METALICAS'>METALICAS</option>";
                        echo "<option value='PVC'>PVC</option>";
                        echo "<option value='PALMA'>PALMA</option>";
                      }
                      elseif (isset($arreglo) && $contipcubiert == 'PVC') 
                      {
                        echo "<option value='PVC' selected>PVC</option>";
                        echo "<option value='METALICAS'>METALICAS</option>";
                        echo "<option value='FIBRACEMENTO'>FIBRACEMENTO</option>";
                        echo "<option value='PALMA'>PALMA</option>";
                      }
                      elseif (isset($arreglo) && $contipcubiert == 'PALMA') 
                      {
                        echo "<option value='PALMA' selected>PALMA</option>";
                        echo "<option value='METALICAS'>METALICAS</option>";
                        echo "<option value='FIBRACEMENTO'>FIBRACEMENTO</option>";
                        echo "<option value='PVC'>PVC</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo"<option value='METALICAS'>METALICAS</option>";
                        echo"<option value='FIBRACEMENTO'>FIBRACEMENTO</option>";
                        echo"<option value='PVC'>PVC</option>";
                        echo"<option value='PALMA'>PALMA</option>";
                      }
                    ?>
                </select>
              </td>
              <td></td>
              <td>TIPO PISO:</td>
              <td>
                <select name="contippiso" id="contippiso" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                      if (isset($arreglo) && $contippiso == 'PORSELANA') 
                      {
                        echo "<option value='PORSELANA' selected>PORSELANA</option>";
                        echo "<option value='RUSTICO'>RUSTICO</option>";
                        echo "<option value='BALDOSIN'>BALDOSIN</option>";
                        echo "<option value='ENTABLON'>ENTABLON</option>";
                        echo"<option value='TIERRA'>TIERRA</option>";
                      }
                      elseif (isset($arreglo) && $contippiso == 'RUSTICO') 
                      {
                        echo "<option value='RUSTICO' selected>RUSTICO</option>";
                        echo "<option value='PORSELANA'>PORSELANA</option>";
                        echo "<option value='BALDOSIN'>BALDOSIN</option>";
                        echo "<option value='ENTABLON'>ENTABLON</option>";
                        echo"<option value='TIERRA'>TIERRA</option>";
                      }
                      elseif (isset($arreglo) && $contippiso == 'BALDOSIN') 
                      {
                        echo "<option value='BALDOSIN' selected>BALDOSIN</option>";
                        echo "<option value='PORSELANA'>PORSELANA</option>";
                        echo "<option value='RUSTICO'>RUSTICO</option>";
                        echo "<option value='ENTABLON'>ENTABLON</option>";
                        echo"<option value='TIERRA'>TIERRA</option>";
                      }
                      elseif (isset($arreglo) && $contippiso == 'ENTABLON') 
                      {
                        echo "<option value='ENTABLON' selected>ENTABLON</option>";
                        echo "<option value='PORSELANA'>PORSELANA</option>";
                        echo "<option value='RUSTICO'>RUSTICO</option>";
                        echo "<option value='BALDOSIN'>BALDOSIN</option>";
                        echo"<option value='TIERRA'>TIERRA</option>";
                      }
                      elseif (isset($arreglo) && $contippiso == 'TIERRA') 
                      {
                        echo "<option value='TIERRA' selected>TIERRA</option>";
                        echo "<option value='PORSELANA'>PORSELANA</option>";
                        echo "<option value='RUSTICO'>RUSTICO</option>";
                        echo "<option value='BALDOSIN'>BALDOSIN</option>";
                        echo"<option value='ENTABLON'>ENTABLON</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo"<option value='PORSELANA'>PORSELANA</option>";
                        echo"<option value='RUSTICO'>RUSTICO</option>";
                        echo"<option value='BALDOSIN'>BALDOSIN</option>";
                        echo"<option value='ENTABLON'>ENTABLON</option>";
                        echo"<option value='TIERRA'>TIERRA</option>";
                      }
                    ?>
                </select>
              </td>
            <tr>
              <td>TIPO MUROS:</td>
              <td>
                <select name="contipmuro" id="contipmuro" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                      if (isset($arreglo) && $contipmuro == 'BL-CEMENTO') 
                      {
                        echo "<option value='BL-CEMENTO' selected>BL-CEMENTO</option>";
                        echo "<option value='CEMENTO'>CEMENTO</option>";
                        echo "<option value='DRAYBOLL'>DRAYBOLL</option>";
                        echo "<option value='GUADUA'>GUADUA</option>";
                        echo"<option value='LADRILLO'>LADRILLO</option>";
                      }
                      elseif (isset($arreglo) && $contipmuro == 'CEMENTO') 
                      {
                        echo "<option value='CEMENTO' selected>CEMENTO</option>";
                        echo "<option value='BL-CEMENTO'>BL-CEMENTO</option>";
                        echo "<option value='DRAYBOLL'>DRAYBOLL</option>";
                        echo "<option value='GUADUA'>GUADUA</option>";
                        echo"<option value='LADRILLO'>LADRILLO</option>";
                      }
                      elseif (isset($arreglo) && $contipmuro == 'DRAYBOLL') 
                      {
                        echo "<option value='DRAYBOLL' selected>DRAYBOLL</option>";
                        echo "<option value='BL-CEMENTO'>BL-CEMENTO</option>";
                        echo "<option value='CEMENTO'>CEMENTO</option>";
                        echo "<option value='GUADUA'>GUADUA</option>";
                        echo"<option value='LADRILLO'>LADRILLO</option>";
                      }
                      elseif (isset($arreglo) && $contipmuro == 'GUADUA') 
                      {
                        echo "<option value='GUADUA' selected>GUADUA</option>";
                        echo "<option value='BL-CEMENTO'>BL-CEMENTO</option>";
                        echo "<option value='CEMENTO'>CEMENTO</option>";
                        echo "<option value='DRAYBOLL'>DRAYBOLL</option>";
                        echo"<option value='LADRILLO'>LADRILLO</option>";
                      }
                      elseif (isset($arreglo) && $contipmuro == 'LADRILLO') 
                      {
                        echo "<option value='LADRILLO' selected>LADRILLO</option>";
                        echo "<option value='BL-CEMENTO'>BL-CEMENTO</option>";
                        echo "<option value='CEMENTO'>CEMENTO</option>";
                        echo "<option value='DRAYBOLL'>DRAYBOLL</option>";
                        echo"<option value='GUADUA'>GUADUA</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo"<option value='BL-CEMENTO'>BL-CEMENTO</option>";
                        echo"<option value='CEMENTO'>CEMENTO</option>";
                        echo"<option value='DRAYBOLL'>DRAYBOLL</option>";
                        echo"<option value='GUADUA'>GUADUA</option>";
                        echo"<option value='LADRILLO'>LADRILLO</option>";
                      }
                    ?>
                </select>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>FECHA CONSTRUCCION:</td>
          <td>
            <input type="date" name="confecconstr" id="confecconstr" class="inp-form" value="<?php if (isset($confecconstr)) {echo "$confecconstr";} ?>" onblur="revisarfecha(this)" required/>
          </td>
          <td></td>
          <td>FECHA REMODELACION:</td>
          <td>
            <input type="date" name="confecremode" id="confecremode" class="inp-form" value="<?php if (isset($confecremode)) {echo "$confecremode";} ?>" onblur="revisarfecha(this)" required/>
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LATITUD:</td>
          <td>
            <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($conlatitud)) {echo "$conlatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($conorientlat)) {echo "$conorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly">  
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LONGITUD:</td>
          <td>
            <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($conlongitud)) {echo "$conlongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($conorientlon)) {echo "$conorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly">
          </td> 
        </tr>
        <tr>
          <td colspan="5"><br>
            <center>
              <!-- Descripcion para enviarlo a Guardarlo o Actualizar-->
              <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_construccion.php'><img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
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
              <a href="descarga_pdf/pdf_construccion.php" target="_blank">
               <img src="img/pdf.png" title="Expotar PDf" class="img-form">
             </a>
<!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_construccion.php" target="_blank">
              <img src="img/Excel.png"  title="Exportar Excel" class="img-form">
            </a>
          </td>
        </tr>
      </table>
    </form>
  </div>
<!-- Cuerpo de la grilla-->
    <div id="grilla">
      <?php include 'grillas/gri_construccion/gri_construccion.php'; ?>
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