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
          error_reporting(E_ALL ^ E_NOTICE);
          if($_REQUEST['condicion']==1)
          {
            include 'conexion.php';
            $res=pg_query($con, "SELECT * FROM raza WHERE raznombre='$_REQUEST[conraznombre]'");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['raza']=array('rezid'=>$reg[0]);
              $razid=$reg [0];
              $raznombre=$reg [1];
              $razorigen=$reg [2];
              $razlugorigen=$reg [3];
              $razproposito=$reg [4];
              $razproducion=$reg [5];
              $razunimedpro=$reg [6];
              $razcarfenoti=$reg [7];
              $razfecha=$reg [8];
            }
          }
        ?>
        <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR RAZA<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR RAZA<b><br><p><br>";
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
                          <td colspan='2'> 
                           <input type='text' name='conraznombre' id='conraznombre' class='inp-form' placeholder='EJ: HOLLISTEN' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)' onblur='revisar(this)' required/> 
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Actualizar*/
                }
                else
                {
                  echo " <tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='2'> 
                           <input type='text' name='conraznombre' id='conraznombre' class='inp-form' placeholder='EJ: HOLLISTEN' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)' onblur='revisar(this)' required/>
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
                 echo "<form name='formulario' action='actualizar/act_raza.php' onsubmit='return ValidarFormRaza();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_raza.php' onsubmit='return ValidarFormRaza();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($razid)) {echo "$razid";} ?>" name="razid" id="razid">
            </td>
          </tr> 
			<tr>
				<td>NOMBRE:</td>
        		<td width="5px">
          			<input type="text" name="raznombre" id="raznombre" maxlength="15" value="<?php if (isset($raznombre)) {echo "$raznombre";} ?>" class="inp-form" placeholder="EJ: HOLLISTEN" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
				</td> 
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
				<td>ORIGEN:</td>
                <td>
                    <select name="razorigen" id="origenraza" onblur="SelectVacio(this)" class="select-form" required/>
                        <?php 
                            if (isset($arreglo) && $razorigen == 'NATIVO')
                            {
                                echo "<option value='1'>NATIVO</option>";
                                echo "<option value='2'>EXOTICO</option>";
                            }
                            elseif (isset($arreglo) && $razorigen == 'EXOTICO')
                            {
                                echo "<option value='2'>EXOTICO</option>";
                                echo "<option value='1'>NATIVO</option>";
                            }
                            else 
                            {
                                echo "<option Selected disabled value=''></option>";
                                echo "<option value='1'>NATIVO</option>";
                                echo "<option value='2'>EXOTICO</option>";
                              }
                        ?>
                      </select><span id="esperaRaza"></span>
                </td>
                <td>LUGAR ORIGEN:</td>
                <td colspan="3">
                    <select name="razlugorigen" id="lugarorigenraza" onblur="SelectVacio(this)" class="select-form" required/>
                      <?php 
                          if (isset($arreglo))
                          {
                            echo "<option>$razlugorigen</option>";
                          }
                          else
                          {
                            echo "<option disabled></option>";
                          }
                      ?>                               
                    </select>
                </td>
			</tr>
			<tr>
				<td>PROPOSITO:</td>
				<td>
					<select name="razproposito" id="razproposito" class="select-form" onblur="SelectVacio(this)" required/>
                	<?php
                      if (isset($arreglo) && $razproposito == 'CARNE') 
                      {
                        echo "<option value='CARNE' selected>CARNE</option>";
                        echo "<option value='DOBLE PROPOSITO'>DOBLE PROPOSITO</option>";
                        echo "<option value='LECHE'>LECHE</option>";
                        echo "<option value='REPRODUCCION'>REPRODUCCION</option>";
                      }
                      elseif (isset($arreglo) && $razproposito == 'DOBLE PROPOSITO') 
                      {
                        echo "<option value='DOBLE PROPOSITO' selected>DOBLE PROPOSITO</option>";
                        echo "<option value='CARNE'>CARNE</option>";
                        echo "<option value='LECHE'>LECHE</option>";
                        echo "<option value='REPRODUCCION'>REPRODUCCION</option>";
                      }
                      elseif (isset($arreglo) && $razproposito == 'LECHE') 
                      {
                        echo "<option value='LECHE' selected>LECHE</option>";
                        echo "<option value='CARNE'>CARNE</option>";
                        echo "<option value='DOBLE PROPOSITO'>DOBLE PROPOSITO</option>";
                        echo "<option value='REPRODUCCION'>REPRODUCCION</option>";
                      }
                      elseif (isset($arreglo) && $razproposito == 'REPRODUCCION') 
                      {
                        echo "<option value='REPRODUCCION' selected>REPRODUCCION</option>";
                        echo "<option value='CARNE'>CARNE</option>";
                        echo "<option value='DOBLE PROPOSITO'>DOBLE PROPOSITO</option>";
                        echo "<option value='LECHE'>LECHE</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo"<option value='CARNE'>CARNE</option>";
                        echo"<option value='DOBLE PROPOSITO'>DOBLE PROPOSITO</option>";
                        echo"<option value='LECHE'>LECHE</option>";
                        echo"<option value='REPRODUCCION'>REPRODUCCION</option>";
                      }
                    ?>
                </select>
				</td>
				<td>PRODUCCION:</td>
            	<td colspan="3"> 
              		<input type="text"  name="razproducion" id="razproducion" class="inp-ent" maxlength="4" value="<?php if (isset($razproducion)) {echo "$razproducion";} ?>" placeholder="EJ: 1.50" onkeypress="return ProdRaza(event);" onblur="revisarn(this)" required/>
              
              		<select name="razunimedpro" id="razunimedpro" class="uni-form" onblur="SelectVaciouni(this)" required/>
            			<?php
          				  include 'conexion.php';
		                  if (isset($arreglo)) 
		                  {
		                    $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro' ");
		                    while ($row=pg_fetch_array($res1))
		                    {
		                      $repunimed=utf8_decode($row[1]);
		                    } 
		                    echo "<option value='$razunimedpro' selected>$repunimed</option>";
		                  }
		                  else
		                  {
		                    echo "<option selected disabled></option>";
		                  }
		                  $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umetipunimed = 'MASA' OR umetipunimed = 'CAPACIDAD'");
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
				<td>FENOTIPO:</td>
            	<td colspan="5">
              		<textarea type="text" name="razcarfenoti" id="razcarfenoti" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL FENOTIPO" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($razcarfenoti)) {echo "$razcarfenoti";} ?></textarea>
            	</td>	
			</tr>
		<tr>
            <td colspan="6" align="center"><br>
              <?php 
                if (isset($arreglo))
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_raza.php'>
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
              <a href="descarga_pdf/pdf_raza.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_raza.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_raza/gri_raza.php'; ?>
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