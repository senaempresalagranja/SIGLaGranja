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
                $res=pg_query($con, "SELECT * FROM ruta WHERE rutidcodigo='$_REQUEST[conruta]'");
                while($reg=pg_fetch_array($res))
                {
                  $arreglo['ruta']=array('rutid'=>$reg[0]);
                  $rutid= utf8_decode($reg [0]);
                  $rutidcodigo= mb_convert_encoding($reg[1], "UTF-8");
                  $rutnombre= $reg[2];
                  $rutestado= utf8_decode($reg[3]);
                  $rutdistancia= utf8_decode($reg[4]);
                  $rununimeddis= utf8_decode($reg[5]);
                  $ruttierecorr= utf8_decode($reg[6]); 
                  $rununimedtie= utf8_decode($reg[7]); 
                  $rutlatitudi= utf8_decode($reg[8]);
                  $rutorienlati= utf8_decode($reg[9]); 
                  $rutlongitudi= utf8_decode($reg[10]);
                  $rutorienloni= utf8_decode($reg[11]);
                  $rutlatitudf= utf8_decode($reg[12]);
                  $rutorienlatf= utf8_decode($reg[13]);
                  $rutlongitudf= utf8_decode($reg[14]);
                  $rutorienlonf= utf8_decode($reg[15]);
                  $rutdescripci= $reg[16];
                  $rutfecha= utf8_decode($reg[17]);
                }
              }
            ?>
            <tr>
              <td colspan="5"><br>
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR RUTA<b><br><p><br>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR RUTA<b><br><p><br>";
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
                            <td colspan='4'>
                              <input type='text' name='conruta' id='conruta' class='inp-form' placeholder='EJ: RUT01-POGA' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td width='22%'>CONSULTAR:</td>
                            <td colspan='4'>
                              <input type='text' name='conruta' id='conruta' class='inp-form' placeholder='EJ: RUT01-POGA' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_ruta.php' onsubmit='return ValidarFormRuta();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_ruta.php' onsubmit='return ValidarFormRuta();'>";
            }
          ?>
      <tr>
        <td>
          <input type="hidden" value="<?php if (isset($rutid)) {echo "$rutid";} ?>" name="rutid" id="rutid"/>
        </td>
      </tr>
      <tr>
        <td>CODIGO:</td>
        <td>
                  <input type="text" name="rutidcodigo" id="rutidcodigo" maxlength="10" value="<?php if (isset($rutidcodigo)) {echo "$rutidcodigo";} ?>" class="inp-form" placeholder="EJ: RUT01-POGA" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
        <td>NOMBRE:</td>
        <td>
          <input type="text" name="rutnombre" id="rutnombre" class="inp-form" value="<?php if (isset($rutnombre)) {echo "$rutnombre";} ?>" placeholder="EJ: PORTERIA-GANADERIA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
        <td>ESTADO:</td> 
        <td>
          <select name="rutestado" id="rutestado" class="select-form" onblur="SelectVacio(this)" required/>
            <?php 
              if (isset($arreglo) && $rutestado == 'BUENO') 
              {
                echo "<option value='BUENO' selected>BUENO</option>";
                echo "<option value='MALO'>MALO</option>";
                echo "<option value='REGULAR'>REGULAR</option>";
              }
              elseif (isset($arreglo) && $rutestado == 'MALO') 
              {
                echo "<option value='MALO' selected>MALO</option>";
                echo "<option value='BUENO'>BUENO</option>";
                echo "<option value='REGULAR'>REGULAR</option>";
              }
              elseif (isset($arreglo) && $rutestado == 'REGULAR') 
              {
              echo "<option value='REGULAR' selected>REGULAR</option>";
                echo "<option value='BUENO'>BUENO</option>";
                echo "<option value='MALO'>MALO</option>";
              }
              else
              {
                echo "<option selected disabled></option>";
                echo "<option value='BUENO'>BUENO</option>";
                echo "<option value='MALO'>MALO</option>";
                echo "<option value='REGULAR'>REGULAR</option>";
              }
            ?>             
          </select>
        </td>
        <td>DISTANCIA:</td>
        <td colspan="2">
          <input type="text" name="rutdistancia" id="rutdistancia" maxlength="4" value="<?php if (isset($rutdistancia)) {echo "$rutdistancia";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return RutDistancia(event);" onblur="revisarn(this)" required/>

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
      </tr>
      <tr>
        <td>TIEMPO RECORRIDO:</td>
        <td colspan="4"> 
          <input type="text" name="ruttierecorr" id="ruttierecorr" maxlength="4" value="<?php if (isset($ruttierecorr)) {echo "$ruttierecorr";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return RutTiempoRec(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisarn(this)" required/>
          
          <select name="rununimedtie" id="rununimedtie" class="uni-form" onblur="SelectVaciouni(this)" required/>
            <?php
              include 'conexion.php';
              if (isset($arreglo)) 
              {
                $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedtie' ");
                while ($row=pg_fetch_array($res1))
                {
                  $repunimed=$row[2];
                } 
                echo "<option value='$rununimedtie' selected>$repunimed</option>";
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
          <td>DESCRIPCION:</td>
            <td colspan="4">
              <textarea type="text" name="rutdescripci" id="rutdescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS LA RUTA" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($rutdescripci)) {echo "$rutdescripci";} ?></textarea>
            </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td colspan="3">
          <b><center>COORDENADA INICIAL</b></center>
        </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td>LATITUD:</td>
        <td colspan="2">
          <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($rutlatitudi)) {echo "$rutlatitudi";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
          <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($rutorienlati)) {echo "$rutorienlati";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"> 
        </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td>LONGITUD:</td>
        <td colspan="2">
          <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($rutlongitudi)) {echo "$rutlongitudi";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
          <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($rutorienloni)) {echo "$rutorienloni";} ?>" placeholder=" E / O" onblur="revisarn(this)" readonly="readonly">
          </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td colspan="3">
          <b><center>COORDENADA FINAL</center></b>
        </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td>LATITUD:</td>
        <td colspan="2">
          <input type="text" name="coorlatitudf" id="coorlatitudf" class="inp-coor" value="<?php if (isset($rutlatitudf)) {echo "$rutlatitudf";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorlaf(event);" onkeyup='Orilatitudf(this);' onblur="revisarc(this)" required/>
          <input type="text" name="orilatitudf" id= "orilatitudf" class="inp-ent" value="<?php if (isset($rutorienlatf)) {echo "$rutorienlatf";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"> 
        </td>
      </tr>
      <tr>
      <td colspan="2"></td>
        <td>LONGITUD:</td>
        <td colspan="2">
          <input type="text" name="coorlongitudf" id="coorlongitudf" class="inp-coor" value="<?php if (isset($rutlongitudf)) {echo "$rutlongitudf";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlof(event);" onkeyup='Orilongitudf(this);' onblur="revisarc(this)" required/>
          <input type="text" name="orilongitudf" id="orilongitudf" class="inp-ent" value="<?php if (isset($rutorienlonf)) {echo "$rutorienlonf";} ?>" placeholder=" E / O" onblur="revisarn(this)" readonly="readonly">
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
                        <a href='frm_ruta.php'><img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
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
              <a href="descarga_pdf/pdf_ruta.php" target="_blank">
               <img src="img/pdf.png" title="Expotar PDf" class="img-form">
             </a>
<!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_ruta.php" target="_blank">
              <img src="img/Excel.png"  title="Exportar Excel" class="img-form">
            </a>
          </td>
        </tr>
      </table>
    </form>
  </div>
<!-- Cuerpo de la grilla-->
    <div id="grilla">
      <?php include 'grillas/gri_ruta/gri_ruta.php'; ?>
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