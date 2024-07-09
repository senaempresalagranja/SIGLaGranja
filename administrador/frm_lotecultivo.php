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
    <!-- Descripcion para el cuerpo de la pagina  -->
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
                if ($_REQUEST['condicion']==1)
                
                  
                  /*{$lotcons=0;
                  $lcucons=$_REQUEST['lcuid'];
                  if ($lcucons<>"") 
                  {
                   $lotcons=$_REQUEST['lcuid'];                
                  }*/
                {
                  include 'conexion.php';
                  $res=pg_query($con,"SELECT * FROM lote_cultivo WHERE lcuid='$_REQUEST[lcuid]'");
                  while ($reg=pg_fetch_array($res))
                  {
                    $arreglo['lote_cultivo']=array('lcuid'=>$reg[0]);
                    $lcuid=utf8_decode($reg[0]);
                    $lculote=utf8_decode($reg[1]);
                    $lcucultivo=utf8_decode($reg[2]);
                    $lcuunidad=utf8_decode($reg[3]);
                    $lcufechsiemb=utf8_decode($reg[4]);
                    $lcufechcosec=utf8_decode($reg[5]);
                    $lcuproduesti=utf8_decode($reg[6]);
                    $lcuunimedest=utf8_decode($reg[7]);
                    $lcuprodureal=utf8_decode($reg[8]);
                    $lcuunimedrea=utf8_decode($reg[9]);
                    $lcucosproest=utf8_decode($reg[10]);
                    $lcuunimedies=utf8_decode($reg[11]);
                    $lcucosprorea=utf8_decode($reg[12]);
                    $lcuunimedire=utf8_decode($reg[13]);
                    $lcuresponsab=utf8_decode($reg[14]);
                    $lcucanal=utf8_decode($reg[16]);
                    $lcuplagenfer=utf8_decode($reg[17]);
                  }
                }
              ?>
              <tr>
                <td colspan="6"><br>
                  <?php
                    if (isset($arreglo))
                    {
                      echo "<p class='tit-form'><b>ACTUALIZAR LOTE CULTIVO<b><br><p><br>";
                    }
                    else
                    {
                      echo "<p class='tit-form'><b>REGISTRAR LOTE CULTIVO<b><br><p><br>";
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
                          <td width='28%' colspan='3'>
                            <input type='text' name='lcuid' id='lcuid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
                else
                {
                  echo "<tr id='consultar'>
                            <td width='22%'>CONSULTAR:</td>
                            <td width='28%' colspan='3'>
                              <input type='text' name='lcuid' id='lcuid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)'>
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
                  echo "<form name='formulario' action='actualizar/act_lotecultivo.php' onsubmit='return ValidarFormLoteCultivo();'>";//pendiente hacer validacion del frm
                } 
                else
                {
                  echo "<form name='formulario' action='registrar/reg_lotecultivo.php' onsubmit='return ValidarFormLoteCultivo();'>";
                }
              ?>
              <tr>
                <td>
                  <input type="hidden" value="<?php if(isset($lcuid)){echo "$lcuid";}?>" name="lcuid" id="lcuid"/>
                </td>
              </tr>
              <tr>
                <td>LOTE:</td>
                <td colspan="2">
                  <select name="lculote" id="lculote" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo)) 
                      {
                       $res1=pg_query($con, "SELECT * FROM lote WHERE lotid='$lculote'");
                        while ($row1=pg_fetch_array($res1)) 
                        {
                          $CodLot=$row1[1];
                          echo "<option value='$lculote' selected>$CodLot</option>";
                        }
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      include 'conexion.php';
                      $res=pg_query($con, "SELECT * FROM lote order by lotidcodigo ASC");
                      while ($row=pg_fetch_array($res))
                      {
                        $CodLoteId=$row[0];
                        $CodLote=$row[1];
                        echo "<option value='$CodLoteId'>$CodLote</option>";
                      }
                    ?>
                  </select>
                </td>
                <td>CULTIVO:</td>
                <td colspan="2">
                  <select name="lcucultivo" id="lcucultivo" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo)) 
                      {
                        $res3=pg_query($con, "SELECT * FROM cultivo WHERE culid='$lcucultivo'");
                        while ($row3=pg_fetch_array($res3)) 
                        {
                          $NomCultivo=$row3[2];
                          echo "<option value='$lcucultivo' selected>$NomCultivo</option>";
                        }
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      include 'conexion.php';
                      $res1=pg_query($con, "SELECT * FROM cultivo order by culnomcomun ASC");
                      while ($row1=pg_fetch_array($res1))
                      {
                        $CodCultivo=$row1[0];
                        $NomComun=$row1[2];
                        echo "<option value='$CodCultivo'>$NomComun</option>";
                      }
                    ?>
                  </select> 
                </td>
              <tr>
                <td>UNIDAD:</td>
                <td colspan="2">
                  <select  name="lcuunidad" id="lcuunidad" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo))
                      {
                        $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$lcuunidad'");
                        while ($row=pg_fetch_array($res1))
                        {
                          $NomUnidad=utf8_decode($row[2]);
                        } 
                        echo "<option value='$lcuunidad' selected>$NomUnidad</option>";//Carga la primera opcion que fue escogida
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      //Consultar el nombre del Area Agricola
                      $consulta=pg_query($con, "SELECT * FROM area WHERE arenombre='AGRICOLA'");
                      while ($registros=pg_fetch_array($consulta)) 
                      {
                        $CodArea=$registros[0];
                      }
                      // Consultar la base de datos para traer las demás opciones del select
                      $res=pg_query($con, "SELECT * FROM unidad where uniarea ='$CodArea' order by uninombre ASC");
                      while($reg=pg_fetch_array($res))
                      {
                        $uniid=$reg[0];
                        $uninombre= $reg[2];
                        echo "<option value='$uniid'>$uninombre</option>";
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>CANAL:</td>
                <td colspan="2">
                  <select name="lcucanal" id="lcucanal" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo)) 
                      {
                        $res3=pg_query($con, "SELECT * FROM canal WHERE canid='$lcucanal'");
                        while ($row3=pg_fetch_array($res3)) 
                        {
                          $NomCanal=$row3[2];
                          echo "<option value='$lcucanal' selected>$NomCanal</option>";
                        }
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      include 'conexion.php';
                      $res1=pg_query($con, "SELECT * FROM canal order by cannombre ASC");
                      while ($row1=pg_fetch_array($res1))
                      {
                        $CodCanal=$row1[0];
                        $NomCanal=$row1[2];
                        echo "<option value='$CodCanal'>$NomCanal</option>";
                      }
                    ?>
                  </select> 
                </td>
                <td>PLAGA/ENFERMEDAD:</td>
                <td>
                  <select name="lcuplagenfer" id="lcuplagenfer" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo)) 
                      {
                        $res3=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$lcuplagenfer'");
                        while ($row3=pg_fetch_array($res3)) 
                        {
                          $NomPlaEnf=$row3[2];
                          echo "<option value='$lcuplagenfer' selected>$NomPlaEnf</option>";
                        }
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                      }
                      include 'conexion.php';
                      $res1=pg_query($con, "SELECT * FROM plagaenfermedad order by pennomcomun ASC");
                      while ($row1=pg_fetch_array($res1))
                      {
                        $CodPlaEnf=$row1[0];
                        $NomPlaEnf=$row1[2];
                        echo "<option value='$CodPlaEnf'>$NomPlaEnf</option>";
                      }
                    ?>
                  </select> 
                </td>
              </tr>
              <tr> 
                <td>FECHA SIEMBRA:</td>
                <td colspan="2">
                  <input type="date" name="lcufechsiemb" id="lcufechsiemb" class="inp-form" value="<?php if (isset($lcufechsiemb)) { echo "$lcufechsiemb";} ?>" onblur="revisarfecha(this)" required/>
                </td>
            
                 <td>FECHA COSECHA:</td>
                <td>
                  <input type="date" name="lcufechcosec" id="lcufechcosec" class="inp-form" value="<?php if (isset($lcufechcosec)) { echo "$lcufechcosec";} ?>" onblur="revisarfecha(this)" required/>
                </td>
              </tr>
              <tr>
                <td>PRODUCCION ESTIMADA:</td>
              <td colspan="2">
                <input type="text"  name="lcuproduesti" id="lcuproduesti" class="inp-ent" maxlength="4" value="<?php if (isset($lcuproduesti)) { echo "$lcuproduesti";} ?>" placeholder="EJ: 1.50" onkeypress="return ProdEstLoteCultivo(event);" onblur="revisarn(this)" required/>

                <select name="lcuunimedest" id="lcuunimedest" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    if (isset($lcuunimedest))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lcuunimedest' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=utf8_decode($row[1]);
                      } 
                      echo "<option value='$lcuunimedest' selected>$repunimed</option>";//carga la primera opcion que fue escogida
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                      // Consultar la base de datos para traer las demás opciones del select
                      $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'MASA' ORDER BY umerepreset ASC");
                      while($reg=pg_fetch_array($res))
                      {
                        $umeid=$reg[0];
                        $umenombre= $reg[1];
                        echo "<option value='$umeid'>$umenombre</option>";
                      }
                  ?>
                </select>
              </td>
              <td>PRODUCCION REAL:</td>
              <td colspan="2">
                <input type="text"  name="lcuprodureal" id="lcuprodureal" class="inp-ent" maxlength="4" value="<?php if (isset($lcuprodureal)) { echo "$lcuprodureal";} ?>" placeholder="EJ: 1.50" onkeypress="return ProdRealLoteCultivo(event);" onblur="revisarn(this)" required/><!--readonly='readonly', es para bloquear el input y no dejar escribir-->
                <select  name="lcuunimedrea" id="lcuunimedrea" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    if (isset($lcuunimedrea))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lcuunimedrea' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=utf8_decode($row[1]);
                      } 
                      echo "<option value='$lcuunimedrea' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                    // Consultar la base de datos para traer las demás opciones del select
                    $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'MASA' ORDER BY umerepreset ASC");
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
              <td>COSTO PRODUCCION ESTIMADA:</td>
              <td colspan="2">
                <input type="text" name="lcucosproest" id="lcucosproest" class="inp-ent" maxlength="12" value="<?php if (isset($lcucosproest)) { echo "$lcucosproest";} ?>" placeholder="EJ: 100000000.50" onkeypress="return CosProdEstLoteCultivo(event);" onblur="revisarn(this)" required/>

                <select  name="lcuunimedies" id="lcuunimedies" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    if (isset($lcuunimedies))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lcuunimedies' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=utf8_decode($row[1]);
                      } 
                      echo "<option value='$lcuunimedies' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                    // Consultar la base de datos para traer las demás opciones del select
                    $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'MONEDA'");
                    while($reg=pg_fetch_array($res))
                    {
                      $umeid=$reg[0];
                      $umenombre= $reg[1];
                      echo "<option value='$umeid'>$umenombre</option>";
                    }
                  ?>
                </select>
              </td>
              <td>COSTO PRODUCCION REAL:</td>
              <td colspan="2">
                <input type='text'  name='lcucosprorea' id='lcucosprorea' class="inp-ent" maxlength="12" value="<?php if (isset($lcucosprorea)) { echo "$lcucosprorea";} ?>" placeholder="EJ: 100000000.50" onkeypress="return CosProdRealLoteCultivo(event);" onblur="revisarn(this)" required/>

                <select  name="lcuunimedire" id="lcuunimedire" class="uni-form" onblur="SelectVaciouni(this)" required/>
                  <?php
                    if (isset($lcuunimedire))
                    {
                      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lcuunimedire' ");
                      while ($row=pg_fetch_array($res1))
                      {
                        $repunimed=utf8_decode($row[1]);
                      } 
                      echo "<option value='$lcuunimedire' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                      // Consultar la base de datos para traer las demás opciones del select
                      $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'MONEDA'");
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
              <td>RESPONSABLE:</td>
              <td>
                <input type="text" name="lcuresponsab" id="lcuresponsab" class="inp-form" value="<?php if (isset($lcuresponsab)) {echo "$lcuresponsab";}?>" placeholder="EJ: FERNANDO" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
              </td>
            </tr>
            <tr>
              <td colspan="6" align="center"><br>
                <?php 
                  if (isset($arreglo)) 
                  {
                    echo"<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                         <a href='frm_lotecultivo.php'><img src='img/nuevo.png' class='img-form' title='Nuevo Registro'>
                         <a/>";
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
                <a href="descarga_pdf/pdf_lotecultivo.php" target="_blank">
                  <img src="img/pdf.png" title="Exportar PDF" class="img-form">
                </a>
<!--BOTON PARA EL (EXCEL)-->
                <a href="descarga_excel/exc_lotecultivo.php" target="_blank">
                  <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                </a>
              </td>
            </tr>
          </table>
        </form>
        </div>
          <div id="grilla">
            <?php include 'grillas/gri_lotecultivo/gri_lotecultivo.php'; ?>
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
        <!--<script type='text/javascript'>document.write
                  (unescape('%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%3E%0A%20%20%20%20%20%20%20%20%66%75%6E%63%74%69%6F%6E%20%72%65%76%69%73%61%72%66%65%63%68%61%28%65%6C%65%6D%65%6E%74%6F%29%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%69%66%20%28%65%6C%65%6D%65%6E%74%6F%2E%76%61%6C%75%65%3D%3D%22%22%29%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%65%6C%65%6D%65%6E%74%6F%2E%63%6C%61%73%73%4E%61%6D%65%3D%27%65%72%72%6F%72%27%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%65%6C%73%65%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%65%6C%65%6D%65%6E%74%6F%2E%63%6C%61%73%73%4E%61%6D%65%3D%27%73%65%6C%65%63%74%2D%66%6F%72%6D%27%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%20%20%20%20%66%75%6E%63%74%69%6F%6E%20%72%65%76%69%73%61%72%66%65%63%68%61%6D%61%79%6F%72%28%29%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%76%61%72%20%69%6E%69%63%69%6F%20%3D%20%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%6C%63%75%66%65%63%68%73%69%65%6D%62%27%29%2E%76%61%6C%75%65%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%76%61%72%20%66%69%6E%61%6C%71%20%20%3D%20%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%6C%63%75%66%65%63%68%63%6F%73%65%63%27%29%2E%76%61%6C%75%65%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%69%6E%69%63%69%6F%3D%20%6E%65%77%20%44%61%74%65%28%69%6E%69%63%69%6F%29%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%66%69%6E%61%6C%71%3D%20%6E%65%77%20%44%61%74%65%28%66%69%6E%61%6C%71%29%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%69%66%28%69%6E%69%63%69%6F%3E%66%69%6E%61%6C%71%29%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%61%6C%65%72%74%28%27%4C%61%20%66%65%63%68%61%20%64%65%20%63%6F%73%65%63%68%61%20%64%65%62%65%20%73%65%72%20%6D%61%79%6F%72%20%61%20%6C%61%20%66%65%63%68%61%20%64%65%20%73%69%65%6D%62%72%61%20%27%29%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%3C%2F%73%63%72%69%70%74%3E'))
                </script>