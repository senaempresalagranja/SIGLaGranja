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
              $res=pg_query($con, "SELECT * FROM zonaverde WHERE zveidcodigo='$_REQUEST[conzveidcodigo]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['zonaverde']=array('canid'=>$reg[0]);
                $zveid= $reg [0];
                $zveidcodigo=$reg[1];
                $zveunidad=$reg[2];
                $zvetipriego=$reg[3];
                $zveextension=$reg[4];
                $zveunimedi=$reg[5];
                $zvelatitud=$reg[6];
                $zveorientlat=$reg[7];
                $zvelongitud=$reg[8];
                $zveorientlon=$reg[9];
                $zvefecha=$reg[10];
              }
            }
          ?>
          <tr>
            <td colspan="5"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR ZONA VERDE<br><br><p>";
                }
                else
                {
                  echo "<p class='tit-form'><b>REGISTRAR ZONA VERDE<br><br><p>";
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
                            <input type='text' name='conzveidcodigo' id='conzveidcodigo' class='inp-form' placeholder='EJ: ZVER01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                            <input type='text' name='conzveidcodigo' id='conzveidcodigo' class='inp-form' placeholder='EJ: ZVER01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
              echo "<form name='formulario' action='actualizar/act_zonaverde.php' onsubmit='return ValidarFormZonaVerde();'>";
            }
          else
            {
              echo "<form name='formulario' action='registrar/reg_zonaverde.php' onsubmit='return ValidarFormZonaVerde();'>";
            }
        ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($zveid)) {echo"$zveid";} ?>" name="zveid" id="zveid"/>
          </td>
        </tr>
    	<tr>
            <td>UNIDAD:</td>
            <td>
              <select name="zveunidad" id="zveunidad" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$zveunidad' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $NomUnidad=$reg1[2];
                      echo "<option value='$zveunidad' selected>$NomUnidad</option>";
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
    			<td width="160px">
    			  <input type="text" name="zveidcodigo" id="zveidcodigo" maxlength="10" value="<?php if (isset($zveidcodigo)) {echo "$zveidcodigo";} ?>" class="inp-form" placeholder="EJ: ZVER01-CITR" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
			<td>EXTENSION:</td>
            <td> 
              <input type="text"  name="zveextension" id="zveextension" class="inp-ent" maxlength="4" value="<?php if (isset($zveextension)) {echo "$zveextension";} ?>" placeholder="EJ: 1.50" onkeypress="return PuntoExtZonVer(event);" onblur="revisarn(this)" required/>
              
              <select name="zveunimedi" id="zveunimedi" class="uni-form" onblur="SelectVaciouni(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$zveunimedi' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $repunimed=$row[1];
                    } 
                    echo "<option value='$zveunimedi' selected>$repunimed</option>";//Carga la primera opcion que fue escogida
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
            <td width="15px"></td>
			<td>TIPO RIEGO:</td> 
          <td>
            <select name="zvetipriego" id="zvetipriego" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $zvetipriego == 'ASPERSION') 
                {
                  echo "<option value='ASPERSION' selected>ASPERSION</option>";
                  echo "<option value='GRAVEDAD'>GRAVEDAD</option>";
                  echo "<option value='MANUAL'>MANUAL</option>";
                }
                elseif (isset($arreglo) && $zvetipriego == 'GRAVEDAD') 
                {
                  echo "<option value='GRAVEDAD' selected>GRAVEDAD</option>";
                  echo "<option value='ASPERSION'>ASPERSION</option>";
                  echo "<option value='MANUAL'>MANUAL</option>";
                }
                elseif (isset($arreglo) && $zvetipriego == 'MANUAL') 
                {
            	  echo "<option value='MANUAL' selected>MANUAL</option>";
                  echo "<option value='ASPERSION'>ASPERSION</option>";
                  echo "<option value='GRAVEDAD'>GRAVEDAD</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='ASPERSION'>ASPERSION</option>";
                  echo "<option value='GRAVEDAD'>GRAVEDAD</option>";
                  echo "<option value='MANUAL'>MANUAL</option>";
                }
              ?>             
            </select>
          </td>
				        </tr>
						<tr>
            <td colspan="3"></td>
            <td>LATITUD:</td>
            <td>
              <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($zvelatitud)) {echo "$zvelatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($zveorientlat)) {echo "$zveorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly"> 
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td>LONGITUD:</td>
            <td>
              <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($zvelongitud)) {echo "$zvelongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($zveorientlon)) {echo "$zveorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly">
            </td> 
          </tr>      
          <tr>
            <td colspan="5" align="center"><br>
              <?php 
                if (isset($arreglo))
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_zonaverde.php'>
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
              <a href="descarga_pdf/pdf_zonaverde.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_zonaverde.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_zonaverde/gri_zonaverde.php'; ?>
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