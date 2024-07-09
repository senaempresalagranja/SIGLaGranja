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
            error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
            if ($_REQUEST['condicion']==1)
            {
              include 'conexion.php';  
              $res=pg_query($con, "SELECT * FROM lote WHERE lotidcodigo='$_REQUEST[conlotidcodigo]'");       
              while ($reg=pg_fetch_array($res))
              {
                $arreglo['lote']=array('lotid'=>$reg[0]);//Es un arreglo para hacer las funciones
                $lotid= $reg [0];
                $lotidcodigo= $reg [1];
                $lotsuelo= $reg [2];
                $lotextension= $reg [3];
                $lotunimedlot= $reg [4];
                $lotlatitud= $reg [5];
                $lotorientlat= $reg [6];
                $lotlongitud= $reg [7];
                $lotorientlon= $reg [8];
                $lotfecha= $reg [9];
              }
            }
          ?>
          <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR LOTE<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR LOTE<b><br><p><br>";
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
                          <td colspan='5'>
                            <input type='text' name='conlotidcodigo' id='conlotidcodigo' class='inp-form' placeholder='EJ: LOTE 01' maxlength='7' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
                else
                {
                  echo "<tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='5'>
                            <input type='text' name='conlotidcodigo' id='conlotidcodigo' class='inp-form' placeholder='EJ: LOTE 01' maxlength='7' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                 echo "<form name='formulario' action='actualizar/act_lote.php' onsubmit='return ValidarFormLote();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_lote.php' onsubmit='return ValidarFormLote();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($lotid)) {echo "$lotid";} ?>" name="lotid">
            </td>
          </tr> 
      <tr>
        <td>CODIGO:</td>
        <td width="10px">
          <input type="text" name="lotidcodigo" id="lotidcodigo" maxlength="7" value="<?php if (isset($lotidcodigo)) {echo "$lotidcodigo";} ?>" class="inp-form" placeholder="EJ: LOTE 01" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
        </td>
        <td width="10px"></td>
        <?php
          if (isset($arreglo)) 
          {
            echo "<td id='Info' colspan='4'></td>";
          }
          else
          {
           echo "<td id='Info' colspan='4'></td>";
         }
         ?>
      </tr>
      <tr>
        <td>SUELO:</td>
          <td>
            <select name="lotsuelo" id="lotsuelo" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM suelo WHERE sueid='$lotsuelo' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $sueftextura=$reg1[3];
                      echo "<option value='$lotsuelo' selected>$sueftextura</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM suelo order by sueftextura ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $sueid=$reg[0];
                    $sueftextura=$reg[3];
                    echo "<option value='$sueid'>$sueftextura</option>";
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>EXTENSION:</td>
            <td colspan="2"> 
              <input type="text"  name="lotextension" id="lotextension" class="inp-ent" maxlength="4" value="<?php if (isset($lotextension)) {echo "$lotextension";} ?>" placeholder="EJ: 1.50" onkeypress="return loteExtension(event);" onblur="revisarn(this)" required/>
              
              <select name="lotunimedlot" id="lotunimedlot" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lotunimedlot' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$lotunimedlot' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
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
            <td>
              <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($lotlatitud)) {echo "$lotlatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($lotorientlat)) {echo "$lotorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado--> 
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td>LONGITUD:</td>
            <td>
              <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($lotlongitud)) {echo "$lotlongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($lotorientlon)) {echo "$lotorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado-->
            </td> 
          </tr>
  <tr>
            <td colspan="5" align="center"><br>
              <!--<input class="img-form" type="image" src="img/Guardar.png" title="Guardar Registro" onclick="replace(thi.form.name)">-->
              <?php 
                if (isset($arreglo))//Si el arreglo existe, mostramos dos botones: ActualizarReg y NuevoRegi
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_lote.php'>
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
              <a href="descarga_pdf/pdf_lote.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_lote.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_lote/gri_lote.php'; ?>
      </div>
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php'; ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodríguez
      </div>
  </div><!--Cierra <div> del SECTION-->
</body>
</html>