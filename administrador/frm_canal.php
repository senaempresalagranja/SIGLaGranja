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
            include 'conexion.php';
            error_reporting(E_ALL ^ E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
            if($_REQUEST['condicion']==1)
            {
              $res=pg_query($con, "SELECT * FROM canal WHERE canidcodigo='$_REQUEST[conscodigo]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['canal']=array('canid'=>$reg[0]);
                $id= utf8_decode($reg [0]);
                $codigo=utf8_decode($reg[1]);
                $nombre=utf8_decode($reg[2]);
                $clase=utf8_decode($reg[3]);
                $uso=utf8_decode($reg[4]);
                $tipo=utf8_decode($reg[5]);
                $profu=utf8_decode($reg[6]);
                $canunimedpro=utf8_decode($reg[7]);
                $ancho=utf8_decode($reg[8]);
                $canunimedanc=utf8_decode($reg[9]);
                $pendi=utf8_decode($reg[10]);
                $canunimedpen=utf8_decode($reg[11]);
                $distan=utf8_decode($reg[12]);
                $canunimedist=utf8_decode($reg[13]);
                $canlatitudi=utf8_decode($reg[14]);
                $canorienlati=utf8_decode($reg[15]);
                $canlongitudi=utf8_decode($reg[16]);
                $canorienloni=utf8_decode($reg[17]);
                $canlatitudf =utf8_decode($reg[18]);
                $canorienlatf=utf8_decode($reg[19]);
                $canlongitudf=utf8_decode($reg[20]);
                $canorienlonf=utf8_decode($reg[21]);
                $fecha=utf8_decode($reg[22]);
              }
            }
          ?>
          <tr>
            <td colspan="5"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR CANAL<br><br><p>";
                }
                else
                {
                  echo "<p class='tit-form'><b>REGISTRAR CANAL<br><br><p>";
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
                            <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CAN01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conscodigo' id='conscodigo' class='inp-form' placeholder='EJ: CAN01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_canal.php' onsubmit='return ValidarFormCanal();'>";
            }
          else
            {
              echo "<form name='formulario' action='registrar/reg_canal.php' onsubmit='return ValidarFormCanal();'>";
            }
        ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($id)) {echo"$id";} ?>" name="canid" id="canid"/>
          </td>
        </tr>
        <tr>
          <td>CODIGO:</td>
          <td width="160px">
            <input type="text" name="canidcodigo" id="canidcodigo" maxlength="10" value="<?php if (isset($codigo)) {echo "$codigo";} ?>" class="inp-form" placeholder="EJ: CAN01-CITR" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
          </td>
          <?php
          if (isset($id)) 
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
            <input type="text" name="cannombre" id="cannombre" class="inp-form" value="<?php if (isset($nombre)) {echo "$nombre";} ?>" placeholder="EJ: CARRETEABLE" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
          <td>CLASE:</td> 
          <td>
            <select name="canclase" id="canclase" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $clase == 'PRIMARIO') 
                {
                  echo "<option value='PRIMARIO' selected>PRIMARIO</option>";
                  echo "<option value='SECUNDARIO'>SECUNDARIO</option>";
                  echo "<option value='TERCIARIO'>TERCIARIO</option>";
                }
                elseif (isset($arreglo) && $clase == 'SECUNDARIO') 
                {
                  echo "<option value='SECUNDARIO' selected>SECUNDARIO</option>";
                  echo "<option value='PRIMARIO'>PRIMARIO</option>";
                  echo "<option value='TERCIARIO'>TERCIARIO</option>";
                }
                elseif (isset($arreglo) && $clase == 'TERCIARIO') 
                {
            	  echo "<option value='TERCIARIO' selected>TERCIARIO</option>";
                  echo "<option value='PRIMARIO'>PRIMARIO</option>";
                  echo "<option value='SECUNDARIO'>SECUNDARIO</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='PRIMARIO'>PRIMARIO</option>";
                  echo "<option value='SECUNDARIO'>SECUNDARIO</option>";
                  echo "<option value='TERCIARIO'>TERCIARIO</option>";
                }
              ?>             
            </select>
          </td>
          <td width="10px"></td><!--<td> para separar la CLASE: de USO:-->
          <td>USO:</td>             
          <td>
            <select name="canuso" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 	
                if (isset($arreglo) && $uso == 'RIEGO') 
                {
                  echo "<option value='RIEGO' selected>RIEGO</option>";
                  echo "<option value='DRENAJE'>DRENAJE</option>";
                }
                elseif (isset($arreglo) && $uso == 'DRENAJE') 
                {
                  echo "<option value='DRENAJE' selected>DRENAJE</option>";
                  echo "<option value='RIEGO'>RIEGO</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='RIEGO'>RIEGO</option>";
                  echo "<option value='DRENAJE'>DRENAJE</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>TIPO CANAL:</td>
          <td>
            <select name="cantipo"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $tipo == 'RECTANGULAR') 
                {
                  echo "<option value='RECTANGULAR' selected>RECTANGULAR</option>";
                  echo "<option value='TRIANGULAR'>TRIANGULAR</option>";
                  echo "<option value='SEMICIRCULAR'>SEMICIRCULAR</option>";
                  echo "<option value='TRAPESOIDAL'>TRAPESOIDAL</option>";
                }
                elseif (isset($arreglo) && $tipo == 'TRIANGULAR') 
                {
                  echo "<option value='TRIANGULAR' selected>TRIANGULAR</option>";
                  echo "<option value='RECTANGULAR'>RECTANGULAR</option>";
                  echo "<option value='SEMICIRCULAR'>SEMICIRCULAR</option>";
                  echo "<option value='TRAPESOIDAL'>TRAPESOIDAL</option>";
                }
                elseif (isset($arreglo) && $tipo == 'SEMICIRCULAR') 
                {
                  echo "<option value='SEMICIRCULAR' selected>SEMICIRCULAR</option>";
                  echo "<option value='RECTANGULAR'>RECTANGULAR</option>";
                  echo "<option value='TRIANGULAR'>TRIANGULAR</option>";
                  echo "<option value='TRAPESOIDAL'>TRAPESOIDAL</option>";
                }
                elseif (isset($arreglo) && $tipo == 'TRAPESOIDAL') 
                {
                  echo "<option value='TRAPESOIDAL' selected>TRAPESOIDAL</option>";
                  echo "<option value='RECTANGULAR'>RECTANGULAR</option>";
                  echo "<option value='TRIANGULAR'>TRIANGULAR</option>";
                  echo "<option value='SEMICIRCULAR'>SEMICIRCULAR</option>";              
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='RECTANGULAR'>RECTANGULAR</option>";
                  echo "<option value='TRIANGULAR'>TRIANGULAR</option>";
                  echo "<option value='SEMICIRCULAR'>SEMICIRCULAR</option>";
                  echo "<option value='TRAPESOIDAL'>TRAPESOIDAL</option>";
                }
              ?>
            </select>
          </td>
          <td width="10px"></td><!--<td> Separador-->
          <td>PROFUNDIDAD:</td>
          <td>
            <input type="text" name="canprofundid" id="canprofundid" maxlength="4" value="<?php if (isset($profu)) {echo "$profu";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepunto1(event);" onblur="revisarn(this)" required/>           
              <select name="canunimedpro" id="canunimedpro" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php                              
                  include 'conexion.php';
                  if (isset($arreglo))
                  {
	                 $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$canunimedpro ");
	                 while($reg1=pg_fetch_array($res1))
	                 {
	                     $umenombre=$reg1[1];
	                     echo "<option value='$canunimedpro' selected>$umenombre</option>";
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
          <td>ANCHO:</td>
          <td>
            <input type="text" name="canancho" id="canancho" maxlength="4" value="<?php if (isset($ancho)) {echo "$ancho";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepunto2(event);" onblur="revisarn(this)" required/>           
              <select name="canunimedanc" id="canunimedanc" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                    if (isset($arreglo))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$canunimedanc ");
                      while($reg1=pg_fetch_array($res1))
                        {
                          $umenombre=$reg1[1];
                          echo "<option value='$canunimedanc' selected>$umenombre</option>";
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
          <td width="10px"></td>
          <td>PENDIENTE:</td>
          <td>
            <input type="text" name="canpendiente" id="canpendiente" maxlength="4" value="<?php if (isset($pendi)) {echo "$pendi";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepunto3(event);" onblur="revisarn(this)" required/>            
              <select name="canunimedpen" id="canunimedpen" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                    if (isset($arreglo))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$canunimedpen ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $umenombre=$reg1[1];
                          echo "<option value='$canunimedpen' selected>$umenombre</option>";
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
          <td>DISTANCIA:</td>
          <td>
            <input type="text" id="candistancia" name="candistancia" maxlength="4" value="<?php if (isset($distan)) {echo "$distan";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return numepunto4(event);" onblur="revisarn(this)" required/>           
              <select name="canunimedist" id="canunimedist"class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php 
                  include 'conexion.php';
                    if (isset($arreglo))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$canunimedist ");
                        while($reg1=pg_fetch_array($res1))
                        {
                          $umenombre=$reg1[1];
                          echo "<option value='$canunimedist' selected>$umenombre</option>";
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
          <td colspan="3"></td>
          <td colspan="2">
            <b><center>COORDENADA INICIAL</center></b>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LATITUD:</td>
          <td>
            <input type="text" name="coorlatitud" id="coorlatitud" maxlength="10" value="<?php if (isset($canlatitudi)) {echo "$canlatitudi";} ?>" class="inp-coor" placeholder="EJ: 123456.78" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required />
            <input type="text" name="orilatitud" id="orilatitud" class="inp-ent" value="<?php if (isset($canorienlati)) {echo "$canorienlati";} ?>" placeholder=" N / S" readonly="readonly" onblur="revisarn(this)"/>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LONGITUD:</td>
          <td>
            <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($canlongitudi)) {echo "$canlongitudi";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
            <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($canorienloni)) {echo "$canorienloni";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly"/>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td colspan="2">
            <b><center>COORDENADA FINAL</center></b>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LATITUD:</td>  
          <td>
            <input type="text" name="coorlatitudf" id="coorlatitudf" class="inp-coor"  value="<?php if (isset($canlatitudf)) {echo "$canlatitudf";} ?>" maxlength="10" placeholder="EJ: 123456.78" onkeypress="return Coorlaf(event);" onkeyup='Orilatitudf(this);'  onblur="revisarc(this)" required/>
            <input type="text" name="orilatitudf" id="orilatitudf" placeholder=" N / S" readonly="readonly" class="inp-ent" Onblur="revisarn(this)" value="<?php if (isset($canorienlatf)) {echo "$canorienlatf";} ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LONGITUD:</td>
          <td>
            <input name="coorlongitudf" maxlength="10" id="coorlongitudf" type="text" placeholder="-123456.78" onkeypress="return Coorlof(event);" onkeyup='Orilongitudf(this);'  class="inp-coor" Onblur="revisarc(this)" value="<?php if (isset($canlongitudf)) {echo "$canlongitudf";} ?>" required/>
            <input type="text" name="orilongitudf" id="orilongitudf" placeholder=" OE / E" readonly="readonly" class="inp-ent" Onblur="revisarn(this)" value="<?php if (isset($canorienlonf)) {echo "$canorienlonf";} ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="5"><br>
            <center>
              <?php 
                if (isset($arreglo)) 
                  {
                    echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                    <a href='frm_canal.php'>
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
              <a href="descarga_pdf/pdf_canal.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_canal.php" target="_blank">
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
          include 'grillas/gri_canal/gri_canal.php';
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