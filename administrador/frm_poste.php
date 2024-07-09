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
  <?php include 'include/header.php';	?>
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
        <form name="form1" id="formulario">
          <table width="100%" class="table">
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   SE CREA UN ARREGLO PARA TENER CONTROL DEL CODIGO(PK) DE LA TABLA   *****-->
<!--*****   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
            <?php
              error_reporting(E_ALL ^ E_NOTICE);
              if($_REQUEST['condicion']==1)
              {
                include 'conexion.php';
                $res=pg_query($con, "SELECT * FROM poste WHERE posidcodigo='$_REQUEST[consposte]'");
                while($reg=pg_fetch_array($res))
                {
                  $arreglo['poste']=array('posid'=>$reg[0]);
                  $posid= utf8_decode($reg [0]);
                  $posidcodigo= mb_convert_encoding($reg[1], "UTF-8");
                  $posunidad= utf8_decode($reg[2]);
                  $postipmateri= utf8_decode($reg[3]);
                  $posestado= utf8_decode($reg[4]);
                  $posaltura= utf8_decode($reg[5]);
                  $posunimedi= utf8_decode($reg[6]); 
                  $postiptensio= utf8_decode($reg[7]);
                  $posalumbrado= utf8_decode($reg[8]); 
                  $posestalumbr= utf8_decode($reg[9]);
                  $postransform= utf8_decode($reg[10]);
                  $posesttransf= utf8_decode($reg[11]);
                  $posruta= utf8_decode($reg[12]);
                  $poslatitud= utf8_decode($reg[13]);
                  $posorientlat= utf8_decode($reg[14]);
                  $poslongitud= utf8_decode($reg[15]);
                  $posorientlon= utf8_decode($reg[16]);
                  $posfecha= utf8_decode($reg[17]);
                }
              }
            ?>
            <tr>
              <td colspan="5"><br>
                <?php
                  if (isset($arreglo))
                  {
                    echo "<p class='tit-form'><b>ACTUALIZAR POSTE<b><br><p><br>";
                  }
                  else
                  {
                    echo "<p class='tit-form'><b>REGISTRAR POSTE<b><br><p><br>";
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
                            <td colspan='3'>
                              <input type='text' name='consposte' id='consposte' class='inp-form' placeholder='EJ: POS01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td width='22%'>CONSULTAR:</td>
                            <td colspan='3'>
                              <input type='text' name='consposte' id='consposte' class='inp-form' placeholder='EJ: POS01-CITR' maxlength='10' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='3%' onclick='replace(this.form.name)' title='consultar'>
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
              echo "<form name='formulario' action='actualizar/act_poste.php' onsubmit='return ValidarFormPoste();'>";
            }
            else
            {
              echo "<form name='formulario' action='registrar/reg_poste.php' onsubmit='return ValidarFormPoste();'>";
            }
          ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($posid)) {echo "$posid";} ?>" name="posid" id="posid"/>
            </td>
          </tr>
			<tr>
				<td>CODIGO:</td>
				<td>
              		<input type="text" name="posidcodigo" id="posidcodigo" maxlength="10" value="<?php if (isset($posidcodigo)) {echo "$posidcodigo";} ?>" class="inp-form" placeholder="EJ: POS01-CITR" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
            	</td>
            	<?php
            	  if (isset($posidcodigo)) 
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
				<td>UNIDAD:</td>
				<td>
					<select name="posunidad" id="posunidad" class="select-form" onblur="SelectVacio(this)" required/>
                	<?php
                	  if (isset($arreglo))
                	  {
                	    $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$posunidad' ");
                	    while($reg1=pg_fetch_array($res1))
                	    {
                	      $NomUnidad=$reg1[2];
                	      echo "<option value='$posunidad' selected>$NomUnidad</option>";
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
				<td>TIPO MATERIAL:</td> 
				<td>
					<select name="postipmateri" id="postipmateri" class="select-form" onblur="SelectVacio(this)" required/>
                    	<?php
                    	  if (isset($arreglo) && $postipmateri == 'CEMENTO') 
                    	  {
                    	    echo "<option value='CEMENTO' selected>CEMENTO</option>";
                    	    echo "<option value='MADERA'>MADERA</option>";
                    	  }
                    	  elseif (isset($arreglo) && $postipmateri == 'MADERA') 
                    	  {
                    	    echo "<option value='MADERA' selected>MADERA</option>";
                    	    echo "<option value='CEMENTO'>CEMENTO</option>";
                    	  }
                    	  else
                    	  {
                    	    echo "<option selected disabled></option>";
                    	    echo "<option value='CEMENTO'>CEMENTO</option>";
                    	    echo "<option value='MADERA'>MADERA</option>";
                    	  }
                    	?>
                  	</select>
				</td>
				<td width="15px"></td>
				<td>ESTADO:</td> 
				<td>
					<select name="posestado" id="posestado" class="select-form" onblur="SelectVacio(this)" required/>
              			<?php 
              			  if (isset($arreglo) && $posestado == 'BUENO') 
              			  {
              			    echo "<option value='BUENO' selected>BUENO</option>";
              			    echo "<option value='MALO'>MALO</option>";
              			    echo "<option value='REGULAR'>REGULAR</option>";
              			  }
              			  elseif (isset($arreglo) && $posestado == 'MALO') 
              			  {
              			    echo "<option value='MALO' selected>MALO</option>";
              			    echo "<option value='BUENO'>BUENO</option>";
              			    echo "<option value='REGULAR'>REGULAR</option>";
              			  }
              			  elseif (isset($arreglo) && $posestado == 'REGULAR') 
              			  {
            				  echo "<option value='REGULAR' selected>REGULAR</option>";
              			    echo "<option value='BUENO'>BUENO</option>";
              			    echo "<option value='MALO'>MALO</option>";
              			  }
              			  else
              			  {
              			    echo "<option selected disabled></option>";
              			    echo "<option value='BUENO'>BUENO</option>";
              			    echo "<option value='MALO'>MALO</option>";
              			    echo "<option value='REGULAR'>REGULAR</option>";
              			  }
              			?>             
            		</select>
				</td>
			</tr>
			<tr>
				<td>ALTURA:</td>
				<td>
					<input type="text" name="posaltura" id="posaltura" maxlength="4" value="<?php if (isset($posaltura)) {echo "$posaltura";} ?>" class="inp-ent" placeholder="EJ: 1.50" onkeypress="return posteAltura(event);" onblur="revisarn(this)" required/>           
              		<select name="posunimedi" id="posunimedi" class="uni-form" onblur="SelectVaciouni(this)" required/>
              		  <?php                              
              		    include 'conexion.php';
              		    if (isset($arreglo))
              		    {
	          		       $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$posunimedi ");
	          		       while($reg1=pg_fetch_array($res1))
	          		       {
	          		           $umenombre=$reg1[1];
	          		           echo "<option value='$posunimedi' selected>$umenombre</option>";
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
				<td></td>
				<td>TIPO TENSION:</td> 
				<td>
					<select name="postiptensio" id="postiptensio" class="select-form" onblur="SelectVacio(this)" required/>
              			<?php 
              			  if (isset($arreglo) && $postiptensio == 'ALTA') 
              			  {
              			    echo "<option value='ALTA' selected>ALTA</option>";
              			    echo "<option value='BAJA'>BAJA</option>";
              			    echo "<option value='MEDIA'>MEDIA</option>";
              			  }
              			  elseif (isset($arreglo) && $postiptensio == 'BAJA') 
              			  {
              			    echo "<option value='BAJA' selected>BAJA</option>";
              			    echo "<option value='ALTA'>ALTA</option>";
              			    echo "<option value='MEDIA'>MEDIA</option>";
              			  }
              			  elseif (isset($arreglo) && $postiptensio == 'MEDIA') 
              			  {
            				  echo "<option value='MEDIA' selected>MEDIA</option>";
              			    echo "<option value='ALTA'>ALTA</option>";
              			    echo "<option value='BAJA'>BAJA</option>";
              			  }
              			  else
              			  {
              			    echo "<option selected disabled></option>";
              			    echo "<option value='ALTA'>ALTA</option>";
              			    echo "<option value='BAJA'>BAJA</option>";
              			    echo "<option value='MEDIA'>MEDIA</option>";
              			  }
              			?>             
            		</select>
				</td>
			</tr>
			<tr>
				<td>ILUMINACION:</td> 
				<td id="Iluminacion">
				   	<?php if (isset($arreglo) && $posalumbrado == 'SI')
            		{          	
            			echo "<input type='radio' name='posalumbrado' id='posalumbrado' value='SI' onclick='habilitaEstIluminacion(this.form)' checked='checked'> SI</input>";            		
			      	}
              else
              {
                echo "<input type='radio' name='posalumbrado' id='posalumbrado' value='SI' onclick='habilitaEstIluminacion(this.form)'> SI</input>";
              }
				    ?><br>
            <?php 
                if (isset($arreglo) && $posalumbrado == 'NO')
                {           
                  echo "<input type='radio' name='posalumbrado' id='posalumbrado' value='NO' onclick='deshabilitaEstIluminacion(this.form)' checked='checked'> NO</input>";                
                }
                else
                {
                  echo "<input type='radio' name='posalumbrado' id='posalumbrado' value='NO' onclick='deshabilitaEstIluminacion(this.form)'> NO</input>";
                }
            ?>
				</td>
				<td></td>
				<td>ESTADO ILUMINACION:</td> 
				<td id="EstIluminacion">
          <?php 
            if (isset($arreglo) && $posestalumbr == 'BUENO') 
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' value='BUENO' checked='checked'> BUENO</input>";
            }
            else
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' disabled value='BUENO'> BUENO</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posestalumbr == 'MALO') 
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' value='MALO' checked='checked'> MALO</input>";
            }
            else
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' disabled value='MALO'> MALO</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posestalumbr == 'REGULAR') 
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' value='REGULAR' checked='checked'> REGULAR</input>";
            }
            else
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' disabled value='REGULAR'> REGULAR</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posestalumbr == 'N/A') 
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' value='N/A' checked='checked'> NO APLICA</input>";
            }
            else
            {
              echo "<input type='radio' name='posestalumbr' id='posestalumbr' disabled value='N/A'> NO APLICA</input>";
            }
          ?><br>
				</td>
			</tr>
			<tr height="10px"></tr>
			<tr>
				<td>TRANSFORMADOR:</td> 
				<td id="Transformador">
				   	<?php if (isset($arreglo) && $postransform == 'SI')
                {           
                  echo "<input type='radio' name='postransform' id='postransform' value='SI' onclick='habilitaEstTransf(this.form)' checked='checked'> SI</input>";                
              }
              else
              {
                echo "<input type='radio' name='postransform' id='postransform' value='SI' onclick='habilitaEstTransf(this.form)'> SI</input>";
              }
            ?><br>
            <?php 
                if (isset($arreglo) && $postransform == 'NO')
                {           
                  echo "<input type='radio' name='postransform' id='postransform' value='NO' onclick='deshabilitaEstTransf(this.form)' checked='checked'> NO</input>";                
                }
                else
                {
                  echo "<input type='radio' name='postransform' id='postransform' value='NO' onclick='deshabilitaEstTransf(this.form)'> NO</input>";
                }
            ?>
				</td>
			    <td></td>
			    <td>ESTADO TRANSFORMADOR:</td> 
				<td id="EstTransf">
			    	<?php 
            if (isset($arreglo) && $posesttransf == 'BUENO') 
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' value='BUENO' checked='checked'> BUENO</input>";
            }
            else
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' disabled value='BUENO'> BUENO</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posesttransf == 'MALO') 
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' value='MALO' checked='checked'> MALO</input>";
            }
            else
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' disabled value='MALO'> MALO</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posesttransf == 'REGULAR') 
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' value='REGULAR' checked='checked'> REGULAR</input>";
            }
            else
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' disabled value='REGULAR'> REGULAR</input>";
            }
          ?><br>
          <?php 
            if (isset($arreglo) && $posesttransf == 'N/A') 
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' value='N/A' checked='checked'> NO APLICA</input>";
            }
            else
            {
              echo "<input type='radio' name='posesttransf' id='posesttransf' disabled value='N/A'> NO APLICA</input>";
            }
          ?><br>
			    </td>
			</tr>
			<tr>
			<td>RUTA:</td>
			<td>
				<select name="posruta" id="posruta" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM ruta WHERE rutid='$posruta' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $NomRuta=$reg1[2];
                      echo "<option value='$posruta' selected>$NomRuta</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM ruta order by rutnombre ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $rutid=$reg[0];
                    $rutnombre=$reg[2];
                    echo "<option value='$rutid'>$rutnombre</option>";
                  }
                ?>
              </select>
			</td>
		</tr>
		<tr>
          <td colspan="3"></td>
          <td>LATITUD:</td>
          <td>
            <input type="text" name="coorlatitud" id="coorlatitud" class="inp-coor" value="<?php if (isset($poslatitud)) {echo "$poslatitud";} ?>" placeholder="EJ:123456.78" maxlength="10" onkeypress="return Coorla(event);" onkeyup='Orilatitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilatitud" id= "orilatitud" class="inp-ent" value="<?php if (isset($posorientlat)) {echo "$posorientlat";} ?>" placeholder=" N / S" onblur="revisarn(this)"  readonly="readonly">  
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>LONGITUD:</td>
          <td>
            <input type="text" name="coorlongitud" id="coorlongitud" class="inp-coor" value="<?php if (isset($poslongitud)) {echo "$poslongitud";} ?>" maxlength="10" placeholder="EJ:-123456.78" onkeypress="return Coorlo(event);" onkeyup='Orilongitud(this);' onblur="revisarc(this)" required/>
              <input type="text" name="orilongitud" id="orilongitud" class="inp-ent" value="<?php if (isset($posorientlon)) {echo "$posorientlon";} ?>" placeholder=" E / O" Onblur="revisarn(this)" readonly="readonly">
          </td> 
        </tr>
        <tr>
          <td colspan="5"><br>
            <center>
              <!-- Descripcion para enviarlo a Guardarlo o Actualizar-->
              <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_poste.php'><img src='img/Nuevo.png' class='img-form' title='Nuevo Registro'>
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
              <img src="img/Grilla.png" title="Ver Grilla" class="img-form" id="boton">
<!--BOTON PARA EL (PDF)-->
              <a href="descarga_pdf/pdf_poste.php" target="_blank">
               <img src="img/pdf.png" title="Expotar PDf" class="img-form">
             </a>
<!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_poste.php" target="_blank">
              <img src="img/Excel.png"  title="Exportar Excel" class="img-form">
            </a>
          </td>
        </tr>
      </table>
    </form>
  </div>
<!-- Cuerpo de la grilla-->
    <div id="grilla">
      <?php include 'grillas/gri_poste/gri_poste.php'; ?>
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