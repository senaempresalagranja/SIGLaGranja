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
          <table width="100%" class="table" border="0">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php
            error_reporting(E_ALL ^ E_NOTICE);
            if($_REQUEST['condicion']==1)
            {
              include 'conexion.php';

              $res=pg_query($con, "SELECT * FROM usuario WHERE usuusuario='$_REQUEST[conusuusuario]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['usuario']=array('usuid'=>$reg[0]);
                $usuid= utf8_decode($reg [0]);
                $usunombre=utf8_decode($reg [1]);
                $usuapellidos=utf8_decode($reg[2]);
                $ususexo=utf8_decode($reg[3]);
                $usuemail=utf8_decode($reg[4]);
                $usutelefono=utf8_decode($reg[5]);                                    
                $usuusuario=utf8_decode($reg[6]);
                $usupassword=utf8_decode($reg[7]);
                $usurol=utf8_decode($reg[8]);
                $usufecha=utf8_decode($reg[9]);
              }
            }
          ?>
            <tr>
              <td colspan="4">
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR USUARIO<b><br><br><p>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR USUARIO<b><br><br><p>";
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
			                            <td>
			                               CONSULTAR:
			                            </td>
			                            <td colspan='2'>
				                            <input type='text' id='consnombre' name='consnombre' placeholder='NOMBRE USUARIO' class='inp-form' onkeyup='this.value=this.value.toUpperCase()' onkeypress='return validar_texto(event)' Onblur='revisar(this)'>
				                            <input type='hidden' name='condicion' value='1'><!--Input de la condicion-->
				                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)'  title='Consultar Usuario'>
			                            </td>
			                        </tr>";/*Actualiza*/
				            }
				        else
				            {
				                echo "<tr id='consultar'>
			                            <td>
			                               CONSULTAR:
			                            </td>
			                            <td colspan='2'>
				                            <input type='text' id='conusuusuario' name='conusuusuario' placeholder='NOMBRE USUARIO' class='inp-form' onkeyup='this.value=this.value.toUpperCase()' onkeypress='return validar_texto(event)' Onblur='revisar(this)'>
				                            <input type='hidden' name='condicion' value='1'><!--Input de la condicion-->
				                            <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)'  title='Consultar Usuario'>
			                            </td>
			                        </tr>";/*Guardar*/
				            }
			         ?>
				    </form>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN NUEVO FORM QUE DIRECCIONARÁ A LAS PÁGINAS (REGISTRAR O ACTUALIZAR)   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--funcion que nos permitira saber a donde nos va a enviar la informacion del formulario
	si no se a realizado una consulta lo envia a guardar por primera ves,
	si ya se realizo una consulta y fue existosa lo enviara a Actualizar
	-->
              <?php 
               if (isset($arreglo))
               {
                 echo "<form name='actualizar' action='actualizar/act_usuario.php' onsubmit='return ValidarFormUsuario();'>";
               }
               else
               {
                 echo "<form name='registrar' action='registrar/reg_usuario.php' onsubmit='return ValidarFormUsuario();'>";
               }
              ?>
<!--Input oculta que me permitira capturar el  registro que se va a actualizar. -->
			         <tr>
			         	<td>
			         		<br><input type="hidden" value="<?php if (isset($usuid)) {echo "$usuid";} ?>" name="usuid" id="usuid">
			         	</td>
			         </tr>
<!--Formulario a llenar, todos los campos empiesan con un value vacio, en caso de haber una consulta recoje el valor de dicha consulta para ser actualizada-->
					<tr>
						<td>
							NOMBRE:
						</td>
						<td width="253px">
							<input onblur="revisarusu(this);" type="text" id="usunombre" name="usunombre" value="<?php if (isset($nombre)) {echo "$nombre";} ?>" placeholder="NOMBRE DEL USUARIO" class="inp-usuario" onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" onkeypress="return validar_texto(event);" required/>
						</td>
						<td id='Info' width="300px"></td>
					</tr>
					<tr>
						<td>
							APELLIDOS:
						</td>
						<td>
							<input type="text" id="usuapellidos" name="usuapellidos" value="<?php if (isset($apellidos)) {echo "$apellidos";} ?>" placeholder="APELLIDOS DEL USUARIO" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" Onblur="revisarusu(this)" onkeydown="espacios(this);" onkeypress="return validar_texto(event);" required/>
						</td>
						<td id='Info1' width="300px"></td>
					</tr>
					<tr>
						<td>
							SEXO:
						</td>
						<td>
							<?php
								if (isset($arreglo)) 
								{
									if ($sexo=='FEMENINO') 
									{
										echo '
										<select name="ususexo" id="ususexo" class="select-form" onblur="SelectVacio(this)" required/>
											<option value="FEMENINO">FEMENINO</option>
											<option value="MASCULINO">MASCULINO</option>
										</select>';
									}
									else
									{
										echo '
										<select name="ususexo" id="ususexo" class="select-form" onblur="SelectVacio(this)" required/>
											<option value="MASCULINO">MASCULINO</option>
											<option value="FEMENINO">FEMENINO</option>
										</select>';
									}
								}
								else
								{
									echo '
										<select name="ususexo" id="ususexo" class="select-form" onblur="SelectVacio(this)" required/>
											<option selected disabled value=""></option>
											<option value="FEMENINO">FEMENINO</option>
											<option value="MASCULINO">MASCULINO</option>
										</select>';
								} 
							?>
							
						</td>
					</tr>
					<tr>
						<td>
							CORREO:
						</td>
						<td>
							<input type="Email" name="usucorreo" id="usucorreo" value="<?php if (isset($correo)) {echo "$correo";} ?>" placeholder="EJ: SIGLAGRANJA@GMAIL.COM" class="inp-usuario" onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this), validarEmail();" required/>
						</td>
						<td>
							<input type="hidden" id="Email" value="">
						</td>
					</tr>
					<tr>
						<td>
							CELULAR:
						</td>
						<td>
							<input type="text" onkeypress="return solonumeros()" id="usutelefono" name="usutelefono" value="<?php if (isset($celular)) {echo "$celular";} ?>" placeholder="EJ: 3000000000" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this);" required/>
						</td>
						<td id='Info5' width="300px"></td>
					</tr>
					<tr>
						<td>
							ROL:
						</td>
						<td>
							<?php
								if (isset($arreglo)) 
								{
									if ($rol == 'USUARIO ADMIN') 
									{
										echo '
										<select name="usurol" id="usurol" class="select-form" onblur="SelectVacio(this)" required/>
											<option value="USUARIO ADMIN">USUARIO ADMIN</option>
											<option value="ADMINISTRADOR">ADMINISTRADOR</option>
											<option value="USUARIO CONSULTA">USUARIO CONSULTA</option>
										</select>
										';
									}
									elseif ($rol == 'USUARIO CONSULTA') 
									{
										echo '
										<select name="usurol" id="usurol" class="select-form" onblur="SelectVacio(this)" required/>
											<option value="USUARIO CONSULTA">USUARIO CONSULTA</option>
											<option value="ADMINISTRADOR">ADMINISTRADOR</option>
											<option value="USUARIO ADMIN">USUARIO ADMIN</option>
										</select>
										';
									}
									else
									{
										echo '
										<select name="usurol" id="usurol" class="select-form" onblur="SelectVacio(this)" required/>
											<option value="ADMINISTRADOR">ADMINISTRADOR</option>
											<option value="USUARIO ADMIN">USUARIO ADMIN</option>
											<option value="USUARIO CONSULTA">USUARIO CONSULTA</option>
										</select>
										';
									}
								}
								else
								{
									echo '
									<select name="usurol" id="usurol" class="select-form" onblur="SelectVacio(this)" required/>
										<option selected disabled value=""></option>
										<option value="ADMINISTRADOR">ADMINISTRADOR</option>
										<option value="USUARIO ADMIN">USUARIO ADMIN</option>
										<option value="USUARIO CONSULTA">USUARIO CONSULTA</option>
									</select>
									';
								}
							?>
							
						</td>
					</tr>
					<tr>
						<td>
							NOMBRE USUARIO:
						</td>
						<td>
							<input type="text" id="usuusuario" name="usuusuario" value="<?php if (isset($usuario)) {echo "$usuario";} ?>" placeholder="EJ: ADMINISTR" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this)" required/>
						</td>
						<?php
							if (isset($arreglo)) {}
							else{
								echo "<td id='Info2' width='300px'></td>";
							}

						?>
					</tr>
					<tr>
						<?php
							if (isset($arreglo)) 
							{
								echo '
									<td>
										CONTRASEÑA  ACTUAL:
									</td>
									<td>
										<input type="password" id="usupasswordactual" name="usupasswordactual" placeholder="CONTRASEÑA ACTUAL" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this)" required/>
									</td>
									';
							}
							else
							{
								echo '
									<td>
										CONTRASEÑA  (7-14)
									</td>
									<td>
										<input type="password" id="usupassword" name="usupassword" placeholder="CONTRASEÑA" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this)" required/>
									</td>
									<td id="Info4" width="300px"></td>
									';
							}
						?>
					</tr>
					<tr>
						<?php
							if (isset($arreglo)) 
							{ ?>
								<td>
									CONTRASEÑA NUEVA:
								</td>
								<td>
									<input type="password" id="usupassword" name="usupassword" placeholder="CONTRASEÑA NUEVA" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" onkeydown="espacios(this);" Onblur="revisarusu(this)" required/>
								</td>
								<td id="Info4" width="300px"></td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="password" id="usupassword1" name="usupassword1" placeholder="CONFIRMAR CANTRASEÑA " class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" 
									Onblur="revisarusu(this), realizaProceso($('#usupassword').val(), $('#usupassword1').val());return false;" onkeydown="espacios(this);" required/>
								</td>
								<td id="Info3" width="300px"></td>
							</tr>
							<?php }
							else
							{ ?>
								<td>
								</td>
								<td>
									<input type="password" id="usupassword1" name="usupassword1" placeholder="CONFIRMAR CANTRASEÑA" class="inp-usuario"  onkeyup="this.value=this.value.toUpperCase();" 
									Onblur="revisarusu(this), realizaProceso($('#usupassword').val(), $('#usupassword1').val());return false;" onkeydown="espacios(this);" required/>
								</td>
								<td id="Info3" width="300px"></td>
							</tr>
							<?php }
						?>
						
					<tr>
						<td colspan="4"><br>
							<center>
<!-- Descripcion para enviarlo a Guardarlo o Actualizar-->
							<?php 
								if (isset($arreglo)) 
						            {
						                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
						                		<a href='frm_usuario.php'>
												<img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
											</a>";
						            }
						        else
						            {
						                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'  title='Guardar Registro'>";
						            }
					         ?>
<!--Boton para poder hacer consulta-->
									<img src="img/Consultar.png" class="img-form" title="Consultar" id="botonconsulta">
<!--Boton para ver la grilla del formulario-->
									<img src="img/Grilla.png" class="img-form" title="Ver Grilla" id="boton">
									<!-- Boton para descargarlo en Pdf-->
								<a href="descarga_pdf/pdf_usuario.php" target="_blank">
									<img src="img/Pdf.png" class="img-form" title="Exportar PDF">
								</a> 
<!-- Boton para descargarlo en Excel-->
								<a href="descarga_excel/exc_usuario.php" target="_blank">
									<img src="img/Excel.png" class="img-form" title="Exportar Excel">
								</a>
							</center>
						</td>	
					</tr>
				</table>
			</form>
		</div>
<!-- Cuerpo de la grilla -->		
		<div id="grilla">
		    <?php
		        include 'grillas/usuario/gri_usuario.php';
		    ?>
		</div>
<!-- Descripcion para el pie de pagina-->
		<div id="foot">
			<?php
				include 'include/piepagina.php';
			?>
		</div>
<!-- Nombre del que realizo el formulario-->
		<div class="fin">
			Jerffen Mendoza Regino
		</div>
	</div>
	</body>
</html>