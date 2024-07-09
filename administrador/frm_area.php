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
      <form name="form1" id="formulario" method="post"><!--RECARGAR LA PAGINA-->
        <table whidt="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php 
            error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
            if ($_REQUEST['condicion']==1)
            {
              include 'conexion.php';  
              $res=pg_query($con, "SELECT * FROM area WHERE arenombre='$_REQUEST[consarenombre]'");       
              while ($reg=pg_fetch_array($res))
              {
                $arreglo['area']=array('areidcodigo'=>$reg[0]);//Es un arreglo para hacer las funciones
                $id= $reg [0];
                $areidcodigo= $reg [1];
                $arenombre= $reg [2];
                $areextension= $reg [3];
                $areunimedida= $reg [4];
                $arecoordinad= $reg [5];
                $arelatitud= $reg [6];
                $areorientlat= $reg [7];
                $arelongitud= $reg [8];
                $areorientlon= $reg [9];
                $aredescripci= $reg [10];
                $arefecha= $reg [11];
              }
            }
          ?>
          <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR AREA<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR AREA<b><br><p><br>";
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
                  echo " <tr id='consultarr'>
                          <td>CONSULTAR:</td>
                          <td colspan='3'> 
                           <input type='text'  name='consarenombre' id='consarenombre' class='inp-form' placeholder='EJ:GESTION' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Actualizar*/
                }
                else
                {
                  echo " <tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='3'> 
                           <input type='text'  name='consarenombre' id='consarenombre' class='inp-form'  placeholder='EJ:GESTION' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%'  onclick='replace(this.form.name)' title='consultar'>
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
                 echo "<form name='formulario' method='post' action='actualizar/act_area.php' onsubmit='return ValidarFormArea();'>";//Antes de enviar los datos al archivo .php, se llama a la funcion de JS para verificar los datos antes de enviarlos (return ValidarFormArea(); para que no refresque la página y borre los datos)
               }
               else
               {
                 echo "<form name='formulario' method='post' action='registrar/reg_area.php' onsubmit='return ValidarFormArea();'>";//Antes de enviar los datos al archivo .php, se llama a la funcion de JS para verificar los datos antes de enviarlos (return ValidarFormArea(); para que no refresque la página y borre los datos)
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($id)) {echo "$id";} ?>" name="actarea"><!--Aquí enviamos el "name" del código hacia Actualizar(act_area.php) ($id es el campo autonumérico "areid")-->
              <!--<input type="text" id="areidcodigoant" name="areidcodigoant" value="<?php// if (isset($areidcodigo)) {echo "$areidcodigo";} ?>" disabled>Aquí enviamos el name del codigo del Area, para que el fichero act_area.php compare el valor actualizado con el valor antiguo sin actualizar-->
            </td>
          </tr> 
          <tr> 
            <td>CODIGO:</td>
            <td width="150px">
              <input type="text" name="areidcodigo" id="areidcodigo" maxlength="2" value="<?php if (isset($areidcodigo)) {echo "$areidcodigo";} ?>" class="inp-form" placeholder="EJ: 01 (CODIGO)" onkeypress="return permite(event,'num')" onblur="revisar(this)" required/>
            </td>              
              <?php
                if (isset($id)) 
                {
                    echo "<td id='Info' colspan='3'></td>";//En esta seccion se carga el Icon de "Disponible o Ya Existe" (Para Actualizar)
                }
                else
                {
                    echo "<td id='Info' colspan='3'></td>";//En esta seccion se carga el Icon de "Disponible o Ya Existe" (Para Registrar)
                }
              ?>
          </tr>
          <tr>
            <td>NOMBRE:</td>
            <td>
              <input type="text" name="arenombre" id="arenombre" class="inp-form" value="<?php if (isset($arenombre)) {echo "$arenombre";} ?>" placeholder="EJ: GESTION" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
              <?php
                if (isset($id)) 
                {
                  echo "<td id='Info1' colspan='3'></td>";
                }
                else
                {
                  echo "<td id='Info1' colspan='3'></td>";//En esta seccion se carga el Icon de "Disponible o Ya Existe"
                }
              ?>
          </tr>
          <tr>   
            <td>RESPONSABLE:</td>
            <td>
              <input type="text" name="arecoordinad" id="arecoordinad" class="inp-form" value="<?php if (isset($arecoordinad)) {echo "$arecoordinad";} ?>" placeholder="EJ:JHAYRON" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            </td>
            <td width="10px"></td><!--Este <td> es para separar la extención del Responsable-->
            <td>EXTENSION:</td>
            <td> 
              <input type="text"  name="areextension" id="areextension" class="inp-ent" maxlength="4" value="<?php if (isset($areextension)) {echo "$areextension";} ?>" placeholder="EJ: 1.50" onkeypress="return extencionArea(event);" onblur="revisarn(this)" required/>
              
              <select name="areunimedida" id="areunimedida" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($areidcodigo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$areunimedida' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$areunimedida' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
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
            <td>DESCRIPCION:</td>
            <td colspan="4">
              <textarea type="text" name="aredescripci" id="aredescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL AREA" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($aredescripci)) {echo "$aredescripci";} ?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td>LATITUD:</td>
            <td>
              <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($arelatitud)) {echo "$arelatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($areorientlat)) {echo "$areorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado--> 
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td>LONGITUD:</td>
            <td>
              <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($arelongitud)) {echo "$arelongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($areorientlon)) {echo "$areorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly"><!--Readonly, especifica un dato de SOLO LECTURA; lo cual no permite que el dato en el imput sea modificado-->
            </td> 
          </tr>      
          <tr>
            <td colspan="5" align="center"><br>
              <!--<input class="img-form" type="image" src="img/Guardar.png" title="Guardar Registro" onclick="replace(thi.form.name)">-->
              <?php 
                if (isset($arreglo))//Si el arreglo existe, mostramos dos botones: ActualizarReg y NuevoRegi
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_area.php'>
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
              <a href="descarga_pdf/pdf_area.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_area.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_area/gri_area.php'; ?>
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