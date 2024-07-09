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
							$res=pg_query($con, "SELECT * FROM especie WHERE espnomcomun='$_REQUEST[consespnomcomun]'");
							while ($reg=pg_fetch_array($res)) 
							{
								$arreglo['especie']=array('espid'=>$reg[0]);
								$espid=utf8_decode($reg[0]);
								$espunidad= utf8_decode($reg[1]);
								$esptipespeci= utf8_decode($reg[2]);
								$espnomcomun= utf8_decode($reg[3]);
								$espnomcienti= utf8_decode($reg[4]);
							}
						}
						?>
						<tr>
							<td colspan="5"><br>
								<?php
								if (isset($arreglo)) 
								{
									echo "<p class='tit-form'><b>ACTUALIZAR ESPECIE<b><br><p><br>";/*Actualizar*/
								}
								else
								{
									echo "<p class='tit-form'><b>REGISTRAR ESPECIE<b><br><p><br>";/*Guardar*/
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
                           <input type='text'  name='consespnomcomun' id='consespnomcomun' class='inp-form' placeholder='EJ:VACA' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
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
                           <input type='text'  name='consespnomcomun' id='consespnomcomun' class='inp-form'  placeholder='EJ:VACA' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
				echo "<form name='formulario' action='actualizar/act_especie.php' onsubmit='return ValidarFormEspecie();'>";
			} 
			else
			{
				echo "<form name='formulario' action='registrar/reg_especie.php' onsubmit='return ValidarFormEspecie();'>";
			}
			?>
			<tr>
				<td>
					<br><input type="hidden" value="<?php if (isset($espid)) {echo "$espid";} ?>" name="espid" id="espid">
				</td>
			</tr>
			<tr>
				<td width="180px">UNIDAD:</td>
				<td width="110px">
					<select name="espunidad" id="espunidad" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  include 'conexion.php';
                  if (isset($arreglo)) 
                  {
                    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$espunidad' ");
                    while ($row=pg_fetch_array($res1))
                    {
                      $nomUnidad=utf8_decode($row[2]);
                    } 
                    echo "<option value='$espunidad' selected>$nomUnidad</option>";//Carga la primera opcion que fue escogida
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }                    
                  // Consultar la base de datos para traer las demás opciones del select
                  $Cons_Area=pg_query($con, "SELECT * from area where arenombre= 'PECUARIA'");
					while ($Reg_Area=pg_fetch_array($Cons_Area)) 
					{
						$Cod_AreaPec=$Reg_Area[0];
					}
                  	$res=pg_query($con, "SELECT * FROM unidad where uniarea = '$Cod_AreaPec' order by uninombre");
                  while($reg=pg_fetch_array($res))
                  {
                    $CodUnidad=$reg[0];
                    $NomUnidad= $reg[2];
                    echo "<option value='$CodUnidad'>$NomUnidad</option>";
                  }
                ?>
              </select>							
			</td>
			<td width="15px"></td>
			<td>TIPO ESPECIE:</td>
			<td>
				<select name="esptipespeci"  class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $esptipespeci == 'ACUICOLAS') 
                {
                  echo "<option value='ACUICOLAS' selected>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";
                }
                elseif (isset($arreglo) && $esptipespeci == 'APICOLAS') 
                {
                  echo "<option value='APICOLAS' selected>APICOLAS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";
                }
                elseif (isset($arreglo) && $esptipespeci == 'AVICOLAS') 
                {
                  echo "<option value='AVICOLAS' selected>AVICOLAS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";
                }
                elseif (isset($arreglo) && $esptipespeci == 'BOVINOS') 
                {
                  echo "<option value='BOVINOS' selected>BOVINOS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";              
                }
                elseif (isset($arreglo) && $esptipespeci == 'CAPRINOS') 
                {
                  echo "<option value='CAPRINOS' selected>CAPRINOS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";              
                }
                elseif (isset($arreglo) && $esptipespeci == 'CUNICOLAS') 
                {
                  echo "<option value='CUNICOLAS' selected>CUNICOLAS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";              
                }
                elseif (isset($arreglo) && $esptipespeci == 'EQUINOS') 
                {
                  echo "<option value='EQUINOS' selected>EQUINOS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";              
                }
                elseif (isset($arreglo) && $esptipespeci == 'OVINOS') 
                {
                  echo "<option value='OVINOS' selected>OVINOS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";              
                }
                elseif (isset($arreglo) && $esptipespeci == 'PORCINOS') 
                {
                  echo "<option value='PORCINOS' selected>PORCINOS</option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";              
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='ACUICOLAS'>ACUICOLAS</option>";
                  echo "<option value='APICOLAS'>APICOLAS</option>";
                  echo "<option value='AVICOLAS'>AVICOLAS</option>";
                  echo "<option value='BOVINOS'>BOVINOS</option>";
                  echo "<option value='CAPRINOS'>CAPRINOS</option>";
                  echo "<option value='CUNICOLAS'>CUNICOLAS</option>";
                  echo "<option value='EQUINOS'>EQUINOS</option>";
                  echo "<option value='OVINOS'>OVINOS</option>";
                  echo "<option value='PORCINOS'>PORCINOS</option>";
                }
              ?>
            </select>	
			</td>
		</tr>  
		<tr>
			<td>NOMBRE COMUN:</td>
			<td>
			 	<input type="text" name="espnomcomun" id="espnomcomun" class="inp-form" value="<?php if (isset($espnomcomun)) {echo "$espnomcomun";} ?>" placeholder="EJ: VACA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
			<td>NOMBRE CIENTIFICO:</td>
			<td>
				<input type="text" name="espnomcienti" id="espnomcienti" class="inp-form" value="<?php if (isset($espnomcienti)) {echo "$espnomcienti";} ?>" placeholder="EJ: BOS TIRASIUS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
		<td colspan="5">
		<center><br>
			<?php
			if (isset($arreglo)) 
			{
				echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_especie.php'>
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
              <a href="descarga_pdf/pdf_especie.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_especie.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
       </center>
     </table>          
    </form>
	</div>
		<div id="grilla">
			<?php include 'grillas/gri_especie/gri_especie.php'; ?>
		</div>
<!-- Descripcion para el pie de pagina-->
		<div id="foot">
			<?php include 'include/piepagina.php' ?>
		</div>
		<div class="fin">
			Jose Roman Galindo R.
		</div>
	</div>
</body>
</html>