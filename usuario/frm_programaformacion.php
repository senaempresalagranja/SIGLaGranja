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
if (isset($_SESSION['USUARIO ADMIN'])){}
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
              $res=pg_query($con, "SELECT * FROM programaformacion WHERE pfonombre='$_REQUEST[conspfonombre]'");       
              while ($reg=pg_fetch_array($res))
              {
                $arreglo['programaformacion']=array('pfoid'=>$reg[0]);
                $pfoid= utf8_decode($reg [0]);
                $pfoarea= utf8_decode($reg [1]);
                $pfonombre= utf8_decode($reg [2]);
                $pfotipformac= utf8_decode($reg [3]);
                $pfotieelecti= utf8_decode($reg [4]);
                $pfounimedel= mb_convert_encoding($reg [5], "UTF-8");
                $pfotieproduc= utf8_decode($reg [6]);
                $pfounimedep= mb_convert_encoding($reg [7], "UTF-8");
                $pfodescripci= $reg [8];
                $pfoimagen= utf8_decode($reg [9]);
                $profecha= utf8_decode($reg [10]);
              }
            }
          ?>
          <tr>
            <td colspan="7"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR PROGRAMA FORMACION<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR PROGRAMA FORMACION<b><br><p><br>";
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
                          <td colspan='6'> 
                           <input type='text'  name='conspfonombre' id='conspfonombre' class='inp-form' placeholder='EJ:GESTION DE EMPRESAS' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                           <input type='hidden' name='condicion' value='1'>
                           <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                         </tr>";/*Actualizar*/
                }
                else
                {
                  echo " <tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='6'> 
                           <input type='text'  name='conspfonombre' id='conspfonombre' class='inp-form'  placeholder='EJ:GESTION DE EMPRESAS' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
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
                 echo "<form name='formulario' action='actualizar/act_programaformacion.php' method='post' enctype='multipart/form-data' onsubmit='return ValidarFormProgrForma();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_programaformacion.php' method='post' enctype='multipart/form-data' onsubmit='return ValidarFormProgrForma();'>";
               }
              ?>
          	<tr>
      	  		<td>
      	  		  <input type="hidden" value="<?php if (isset($pfoid)) {echo "$pfoid";} ?>" name="pfoid">
      	  		</td>
          	</tr>
			<tr>
				<td>NOMBRE:</td>
            	<td>
            	  <input type="text" name="pfonombre" id="pfonombre" class="inp-form" value="<?php if (isset($pfonombre)) {echo "$pfonombre";} ?>" 	placeholder="EJ: GESTION DE EMPRESAS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)	" onblur="revisar(this)" required/>
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
				<td>AREA:</td>
				<td width="170px">
					<select name="pfoarea" id="pfoarea" class="select-form" onblur="SelectVacio(this)" required/>
                		<?php
                		  if (isset($arreglo))
                		  {
                		    $res1=pg_query($con, "SELECT * FROM area WHERE areid='$pfoarea' ");
                		    while($reg1=pg_fetch_array($res1))
                		    {
                		      $NomArea=$reg1[2];
                		      echo "<option value='$pfoarea' selected>$NomArea</option>";
                		    }
                		  }
                		  else
                		  {
                		    echo "<option selected disabled></option>";
                		  }
                		  include 'conexion.php';
                		  $res=pg_query($con, "SELECT * FROM area order by arenombre ASC");
                		  while ($reg=pg_fetch_array($res))
                		  {
                		    $areid=$reg[0];
                		    $NomArea=$reg[2];
                		    echo "<option value='$areid'>$NomArea</option>";
                		  }
                		?>
          			</select>
				</td>
				<td width="20px"></td>
			    <td colspan="2">TIPO FORMACION:</td>
				<td colspan="2">
                  <select name="pfotipformac" id="pfotipformac" class="select-form" onblur="SelectVacio(this)" required/>
                    <?php
                      if (isset($arreglo) && $pfotipformac == 'TECNICO') 
                      {
                        echo "<option value='TECNICO' selected>TECNICO</option>";
                        echo "<option value='TECNOLOGO'>TECNOLOGO</option>";
                      }
                      elseif (isset($arreglo) && $pfotipformac == 'TECNOLOGO') 
                      {
                        echo "<option value='TECNOLOGO' selected>TECNOLOGO</option>";
                        echo "<option value='TECNICO'>TECNICO</option>";
                      }
                      else
                      {
                        echo "<option selected disabled></option>";
                        echo "<option value='TECNICO'>TECNICO</option>";
                        echo "<option value='TECNOLOGO'>TECNOLOGO</option>";
                      }
                    ?>
                  </select>
                </td>
   			</tr>
			<tr>
				<td>ETAPA LECTIVA:</td>
            	<td> 
            	  <input type="text" name="pfotieelecti" id="pfotieelecti" maxlength="2" value="<?php if (isset($pfotieelecti)) {echo "$pfotieelecti";} ?>" class="inp-ent" placeholder="EJ: 18" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            	  
            	  <select name="pfounimedel" id="pfounimedel" class="uni-form" onblur="SelectVaciouni(this)" required/>
            	    <?php
            	      include 'conexion.php';
            	      if (isset($arreglo)) 
            	      {
            	        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedel' ");
            	        while ($row=pg_fetch_array($res1))
            	        {
            	          $repunimed=$row[2];
            	        } 
            	        echo "<option value='$pfounimedel' selected>$repunimed</option>";
            	      }
            	      else
            	      {
            	        echo "<option selected disabled></option>";
            	      }
            	      $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umenombre = 'DIAS' or umenombre = 'MESES' or umenombre = 'AÑOS' ORDER BY 	umenombre ASC");
            	      while($reg=pg_fetch_array($res))
            	      {
            	        $umeid=$reg[0];
            	        $umenombre= $reg[2];
            	        echo "<option value='$umeid'>$umenombre</option>";
            	      }
            	    ?>
            	  </select>
            	</td>
		<td></td>
				<td colspan="2">ETAPA PRODUCTIVA:</td>
            	<td colspan="2"> 
            	  <input type="text" name="pfotieproduc" id="pfotieproduc" maxlength="2" value="<?php if (isset($pfotieproduc)) {echo "$pfotieproduc";} ?>" class="inp-ent" placeholder="EJ: 06" onkeypress="return permite(event,'num')" onblur="revisarn(this)" required/>
            	  
            	  <select name="pfounimedep" id="pfounimedep" class="uni-form" onblur="SelectVaciouni(this)" required/>
            	    <?php
            	      include 'conexion.php';
            	      if (isset($arreglo)) 
            	      {
            	        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$pfounimedep' ");
            	        while ($row=pg_fetch_array($res1))
            	        {
            	          $repunimed=$row[2];
            	        } 
            	        echo "<option value='$pfounimedep' selected>$repunimed</option>";
            	      }
            	      else
            	      {
            	        echo "<option selected disabled></option>";
            	      }
            	      $res=pg_query($con, "SELECT * FROM unidad_medida WHERE umenombre = 'DIAS' or umenombre = 'MESES' or umenombre = 'AÑOS' ORDER BY 	umenombre ASC");
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
				<td>IMAGEN:</td>
				<td colspan="4">
					<?php if (isset($pfoimagen)) {echo "$pfoimagen <br>";} ?>
					<input type="hidden" value="<?php if(isset($pfoimagen)){echo "$pfoimagen";}?>" name="pfoimagen" id="pfoimagen">
					<?php 
						if (isset($arreglo)) 
						{
							echo "<input type='file' name='file'/>";
						}
						else
						{
							echo "<input type='file' name='file' required/>";
						}

					 ?>
					
				</td>
			</tr>		
			<tr>
				<td>DESCRIPCION:</td>
            	<td colspan="4">
            	  <textarea type="text" name="pfodescripci" id="pfodescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DEL PROGRAMA DE FORMACION" onblur="	revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($pfodescripci)) {echo "$pfodescripci ";} ?></textarea>
            	</td>
			</tr>
	<!--<tr>
		<td><?php 
				//if (isset($arreglo)) 
				{
					//echo "<img src='galeria/$pfoimagen'";
				}
		 ?></td>
	</tr>-->
	<tr>
		<td colspan="7" align="center"><br>
              <?php 
                if (isset($arreglo))//Si el arreglo existe, mostramos dos botones: ActualizarReg y NuevoRegi
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_programaformacion.php'>
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
              <a href="descarga_pdf/pdf_programaformacion.php" target="_blank">
                <img src="img/pdf.png" title="Exportar PDF" class="img-form">
              </a>
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_programaformacion.php" target="_blank">
                <img src="img/Excel.png" title="Exportar Excel" class="img-form">
              </a>        
            </td>         
          </tr>
     </table>          
    </form>
    </div>
      <div id="grilla">
        <?php include 'grillas/gri_programaformacion/gri_programaformacion.php'; ?>
      </div>
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php'; ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodriguez
      </div>
  </div><!--Cierra <div> del SECTION-->
</body>
</html>