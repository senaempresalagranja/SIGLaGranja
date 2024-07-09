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
          error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
          if ($_REQUEST['condicion']==1)
          {
            include 'conexion.php';
            $res=pg_query($con, "SELECT * FROM lagranja WHERE lagnit='$_REQUEST[conlagnit]'");
            while ($reg=pg_fetch_array($res))
            {
              $arreglo['lagranja']=array('lagid'=>$reg[0]);//Es un arreglo para hacer las funciones
              $lagid=$reg [0];
              $lagnit= $reg [1];
              $lagnombre= $reg [2];
              $lagdireccio= $reg [3];
              $lagdepartam= $reg [4];
              $lagmunicipi= $reg [5];
              $lagvereda= $reg [6];
              $lagcodprenu= $reg [7];
              $lagcodprean= $reg [8];
              $lagmatriinm= $reg [9];
              $lagactiecon= $reg [10];
              $lagfecfunda= $reg [11];
              $lagareaterr= $reg [12];
              $lagunimedat= $reg [13];
              $lagareconst= $reg [14];
              $lagunimedac= $reg [15];
              $lagcanconst= $reg [16];
              $lagaltitud= $reg [17];
              $lagunimedam= $reg [18];
              $lagplancha= $reg [19];
              $lagescala= $reg [20];
              $laglatitud= $reg [21];
              $lagorientlat= $reg [22];
              $laglongitud= $reg [23];
              $lagorientlon= $reg [24];
            }
          }
         ?>
         <tr>
              <td colspan="8">
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><br><b>ACTUALIZAR LA GRANJA<b><br><br><p>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><br><b>REGISTRAR LA GRANJA<b><br><br><p>";
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
                            <td colspan='7'>
                              <input type='text' name='conlagnit' id='conlagnit' class='inp-form' placeholder='EJ: (NIT)' maxlength='17' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td>CONSULTAR:</td>
                            <td colspan='7'>
                              <input type='text' name='conlagnit' id='conlagnit' class='inp-form' placeholder='EJ: (NIT)' maxlength='17' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                echo "<form name='formulario' action='actualizar/act_lagranja.php' onsubmit='return ValidarFormLagranja();'>";
              }
              else
              {
                echo "<form name='formulario' action='registrar/reg_lagranja.php' onsubmit='return ValidarFormLagranja();'>";
              }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($lagid)) {echo"$lagid";} ?>" name="lagid" id="lagid"/>
            </td>
          </tr> 
          <tr>
            <td>CODIGO (NIT):</td>
            <td colspan="7">
              <input type="text" name="lagnit" id="lagnit" maxlength="17" value="<?php if (isset($lagnit)) {echo "$lagnit";} ?>" class="inp-form" placeholder="EJ:0614-290209-000-0" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>
            <td>NOMBRE:</td>
            <td colspan="3">
              <input type="text" name="lagnombre" id="lagnombre" class="inp-form" value="<?php if (isset($lagnombre)) {echo "$lagnombre";} ?>" placeholder='EJ: C.A "LA GRANJA"' onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
            <td>DIRECCION:</td>
            <td colspan="3">
              <input type="text" name="lagdireccio" id="lagdireccio" class="inp-form" value="<?php if (isset($lagdireccio)) {echo "$lagdireccio";} ?>" placeholder="EJ: KM5 VIA ESP-IBG" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>
            <td>DEPARTAMENTO:</td>
            <td colspan="3">
              <input type="text" name="lagdepartam" id="lagdepartam" class="inp-form" value="<?php if (isset($lagdepartam)) {echo "$lagdepartam";} ?>" placeholder="EJ: TOLIMA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/> 
            </td>
            <td>MUNICIPIO:</td>
            <td colspan="3">
              <input type="text" name="lagmunicipi" id="lagmunicipi" class="inp-form" value="<?php if (isset($lagmunicipi)) {echo "$lagmunicipi";} ?>" placeholder="EJ: ESPINAL" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>   
            <td>VEREDA:</td>
            <td colspan="7">
              <input type="text" name="lagvereda" id="lagvereda" class="inp-form" value="<?php if (isset($lagvereda)) {echo "$lagvereda";} ?>" placeholder="EJ: DINDALITO" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr height="20px"></tr>
          <tr>
            <td>CODIGO PREDIAL NUEVO:</td>
            <td colspan="3">             
              <input type="text" name="lagcodprenu" id="lagcodprenu" maxlength="15" value="<?php if (isset($lagcodprenu)) {echo "$lagcodprenu";} ?>" class="inp-form" placeholder="EJ:0101009909011778" onkeypress="return ValNumero(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
            <td>CODIGO PREDIAL ANTERIOR:</td>
            <td colspan="3">            
              <input type="text" name="lagcodprean" id="lagcodprean" maxlength="15" value="<?php if (isset($lagcodprean)) {echo "$lagcodprean";} ?>" class="inp-form" placeholder="EJ:0101009909012568" onkeypress="return ValNumero(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>
            <td>MATRICULA INMOBILIARIA:</td>
            <td colspan="3">
              <input type="text" name="lagmatriinm" id="lagmatriinm" maxlength="10" value="<?php if (isset($lagmatriinm)) {echo "$lagmatriinm";} ?>" class="inp-form" placeholder="EJ: 050C01119757" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>  
            <td>ACTIVIDAD ECONOMICA:</td>
            <td colspan="3">
              <input type="text" name="lagactiecon" id="lagactiecon" class="inp-form" value="<?php if (isset($lagactiecon)) {echo "$lagactiecon";} ?>" placeholder="EJ: SER. EDUCATIVOS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>
            <td>FECHA FUNDACION:</td>
            <td colspan="3">
              <input type="date" name="lagfecfunda" id="lagfecfunda" class="inp-form" value="<?php if (isset  ($lagfecfunda)) {echo "$lagfecfunda";} ?>" onblur="revisarfecha(this)" required/>
            </td>
            <td>AREA DE TERRENO:</td>
            <td colspan="3"> 
              <input type="text"  name="lagareaterr" id="lagareaterr" class="inp-ent" maxlength="4" value="<?php if (isset($lagareaterr)) {echo "$lagareaterr";} ?>" placeholder="EJ: 1.50" onkeypress="return areaTerreno(event);" onblur="revisarn(this)" required/>
              
              <select name="lagunimedat" id="lagunimedat" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedat' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=utf8_decode($row[1]);
                    } 
                    echo "<option value='$lagunimedat' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }                    
                  // Consultar la base de datos para traer las demás opciones del select
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'SUPERFICIE' or umenombre = 'HECTOMETRO'");
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
            <td>AREA CONSTRUIDA:</td>
            <td colspan="3"> 
              <input type="text"  name="lagareconst" id="lagareconst" class="inp-ent" maxlength="4" value="<?php if (isset($lagareconst)) {echo "$lagareconst";} ?>" placeholder="EJ: 1.50" onkeypress="return areaConstruida(event);" onblur="revisarn(this)" required/>
              
              <select name="lagunimedac" id="lagunimedac" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedac' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$lagunimedac' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }                    
                  // Consultar la base de datos para traer las demás opciones del select
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'SUPERFICIE' or umenombre = 'HECTOMETRO'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umenombre= $reg[1];
                    echo "<option value='$umeid'>$umenombre</option>";
                  }
                ?>
              </select>
            </td>
            <td>CANTIDAD CONSTRUCCIONES:</td>
            <td colspan="3">
              <input type="text"  name="lagcanconst" id="lagcanconst" class="inp-ent" maxlength="4" value="<?php if (isset($lagcanconst)) {echo "$lagcanconst";} ?>" placeholder="EJ: 055" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            </td>
          </tr>
          <tr>
            <td>ALTITUD NIVEL MAR:</td>
            <td colspan="3"> 
              <input type="text"  name="lagaltitud" id="lagaltitud" class="inp-ent" maxlength="6" value="<?php if (isset($lagaltitud)) {echo "$lagaltitud";} ?>" placeholder="EJ: 150.67" onkeypress="return altitudmar(event);" onblur="revisarn(this)" required/>
              
              <select name="lagunimedam" id="lagunimedam" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lagunimedam' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$lagunimedam' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }                    
                  // Consultar la base de datos para traer las demás opciones del select
                  $res=pg_query($con, "SELECT * FROM unidad_medida where umenombre = 'METRO' or umenombre = 'KILOMETRO'");
                  while($reg=pg_fetch_array($res))
                  {
                    $umeid=$reg[0];
                    $umenombre= $reg[1];
                    echo "<option value='$umeid'>$umenombre</option>";
                  }
                ?>
              </select>
            </td>
            <td>NUMERO PLANCHA:</td>
            <td colspan="3">
              <input type="text"  name="lagplancha" id="lagplancha" class="inp-ent" maxlength="4" value="<?php if (isset($lagplancha)) {echo "$lagplancha";} ?>" placeholder="EJ: 197" onkeypress="return ValNumero(this)" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisarn(this)" required/>
            </td>
          </tr>
            <td>ESCALA:</td>
            <td colspan="7">
              <input type="text" name="lagescala" id="lagescala" maxlength="10" value="<?php if (isset($lagescala)) {echo "$lagescala";} ?>" class="inp-form" placeholder="EJ: 1: 10.000" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
          </tr>
          <tr>
          </tr>
          <tr>
          <tr>
            <td></td>
            <td colspan="3">LATITUD:</td>
            <td colspan="4">
              <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($laglatitud)) {echo "$laglatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($lagorientlat)) {echo "$lagorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado--> 
            </td>
          </tr>
          <tr>
            <td></td>
            <td colspan="3">LONGITUD:</td>
            <td colspan="4">
              <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($laglongitud)) {echo "$laglongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($lagorientlon)) {echo "$lagorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado-->
            </td> 
      </tr>
      <lag>
          <td colspan="8" align="center"><br>
              <!--<input class="img-form" type="image" src="img/Guardar.png" title="Guardar Registro" onclick="replace(thi.form.name)">-->
              <?php 
                if (isset($arreglo)) 
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_lagranja.php'>
                        <img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'></a>";
                }
                else
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Guardar Registro'>";
                }
               ?>
            <!--BOTON PARA EL (PDF)-->
              <img src="img/Consultar.png" class="img-form" title="Consultar" id="botonconsulta">
              <img src="img/Grilla.png" class="img-form" title="Ver Grilla" id="boton">
              <a href="descarga_pdf/pdf_lagranja.php" target="_blank">
              <img src="img/pdf.png" title="Exportar PDF" class="img-form"></a>
             <!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_lagranja.php" target="_blank">
               <img src="img/Excel.png" title="Exportar Excel" class="img-form">
             </a>
           </center>  
         </td>         
       </tr>
     </table>          
    </form>
  </div>
  <div id="grilla">
    <?php
        include 'grillas/gri_lagranja/gri_lagranja.php';
    ?>
  </div>
  <!-- Descripcion para el pie de pagina-->

  <div id="foot">
     <?php
        include 'include/piepagina.php'
     ?>
  </div>
  <div class="fin">
    Jayron Carreño.
  </div>
  </div>
</body>
</html>