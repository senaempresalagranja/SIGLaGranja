<!-- 
  Proyecto: Sistema de Informacion Georeferenciado del Centro Agropecuario "La Granja". 
  Nombre del proyecto:  SIGLaGranja. 
  Desarrolladores: Tecnologo en Análisis y Desarrollo de Sistemas de Información "ADSI". 
  Numero de Ficha: 798585. 
  Descripcion del Proyecto: Software que permita la Georeferenciación de Centro Agropecuario "La Granja" SENA Espinal - Tolima. 
  Año de Desarrollo: 2014-2015.-->
<!-- Descripcion de la pagina en formato de HTML5. a
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
            $res=pg_query($con, "SELECT * FROM redlogica WHERE rloid='$_REQUEST[conrloid]'");
            while($reg=pg_fetch_array($res))
            {
              $arreglo['redlogica']=array('rloid'=>$reg[0]);
              $rloid=utf8_decode($reg [0]);
              $rloconstrucc=utf8_decode($reg [1]);
              $rlozonawifi=utf8_decode($reg [2]);
              $rlocantacces=utf8_decode($reg [3]);
              $rloredalambr=utf8_decode($reg [4]);
              $rlocantanale=utf8_decode($reg [5]);
              $rlounimedcca=utf8_decode($reg [6]);
              $rlocantrj=utf8_decode($reg [7]);
              $rlocantfibop=utf8_decode($reg [8]);
              $rlocategoutp=utf8_decode($reg [9]);
              $rlotopologia=utf8_decode($reg [10]);
              $rlodistribuc=utf8_decode($reg [11]);
              $rlorack=utf8_decode($reg [12]);
              $rlocantswitc=utf8_decode($reg [13]);
              $rlocantregle=utf8_decode($reg [14]);
              $rlocantups=utf8_decode($reg [15]);
              $rlofecha=utf8_decode($reg [16]);
            }
          }
        ?>
        <tr>
            <td colspan="6"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR RED LOGICA<b><br><p><br>";
                }
                else
                {
                   echo "<p class='tit-form'><b>REGISTRAR RED LOGICA<b><br><p><br>";
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
                            <td colspan='3'>
                              <input type='text' name='conrloid' id='conrloid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress=\"return permite(event,'num')\">
                              <input type='hidden' name='condicion' value='1'>
                              <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                            </td>
                          </tr>";/*Actualizar*/
                  }
                  else
                  {
                    echo "<tr id='consultar'>
                            <td>CONSULTAR:</td>
                            <td colspan='3'>
                              <input type='text' name='conrloid' id='conrloid' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='3' onkeypress=\"return permite(event,'num')\">
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
                 echo "<form name='formulario' action='actualizar/act_redlogica.php' onsubmit='return ValidarFormRedLogica();'>";
               }
               else
               {
                 echo "<form name='formulario' action='registrar/reg_redlogica.php' onsubmit='return ValidarFormRedLogica();'>";
               }
              ?>
          <tr>
            <td>
              <input type="hidden" value="<?php if (isset($rloid)) {echo "$rloid";} ?>" name="rloid" id="rloid">
            </td>
          </tr>
          <tr>
            <td>CONSTRUCCION:</td>
            <td width="10px">
              <select name="rloconstrucc" id="rloconstrucc" class="select-form" onblur="SelectVacio(this)" required/>
                <?php
                  if (isset($arreglo))
                  {
                    $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rloconstrucc' ");
                    while($reg1=pg_fetch_array($res1))
                    {
                      $Nomconstruccion=$reg1[3];
                      echo "<option value='$rloconstrucc' selected>$Nomconstruccion</option>";
                    }
                  }
                  else
                  {
                    echo "<option selected disabled></option>";
                  }
                  include 'conexion.php';
                  $res=pg_query($con, "SELECT * FROM construccion order by connombre ASC");
                  while ($reg=pg_fetch_array($res))
                  {
                    $conidcodigo=$reg[0];
                    $connombre=$reg[3];
                    echo "<option value='$conidcodigo'>$connombre</option>";
                  }
                ?>
              </select>
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
            </td>
          </tr>
          <tr>
           <td>ZONA WIFI:</td> 
				<td id="ZonaWiFi">
          <?php 
            if (isset($arreglo) && $rlozonawifi == 'SI') 
            {
              echo "<input type='radio' name='rlozonawifi' id='rlozonawifi' value='SI' onclick='habilitaCantAccesPoint(this.form)' checked='checked'> SI</input>";
            }
            else
            {
              echo "<input type='radio' name='rlozonawifi' id='rlozonawifi' value='SI' onclick='habilitaCantAccesPoint(this.form)'> SI</input>";
            }
           ?><br>
           <?php 
            if (isset($arreglo) && $rlozonawifi == 'NO') 
            {
              echo "<input type='radio' name='rlozonawifi' id='rlozonawifi' value='NO' onclick='deshabilitaCantAccesPoint(this.form)' checked='checked'> NO</input>";
            }
            else
            {
              echo "<input type='radio' name='rlozonawifi' id='rlozonawifi' value='NO' onclick='deshabilitaCantAccesPoint(this.form)'> NO</input>";
            }
           ?>
   	    </td>
			    <td>CANTIDAD ACCES POINT:</td>
          		<td>
          		  <input type="hidden" name="rlocantacces1" value="0">
          		  <?php 
          		    if (isset($arreglo)) 
          		    {
          		      echo "<input type='text' name='rlocantacces' id='rlocantacces' maxlength='2' value='$rlocantacces' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
          		    }
          		    else
          		    {
          		      echo "<input type='text' style='background-color: #EDE9E9' name='rlocantacces' id='rlocantacces' maxlength='2' value='$rlocantacces' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
          		    }
		
          		   ?>            
          		</td>
       		</tr>
       		<tr height="50px"></tr>
       		<tr>
		       	<td>RED ALAMBRICA:</td> 
				<td id="RedAlambrica">
          <?php 
            if (isset($arreglo) && $rloredalambr == 'SI') 
            {
              echo "<input type='radio' name='rloredalambr' id='rloredalambr' value='SI' onclick='habilitaTodosCampos(this.form)' checked='checked'> SI</input>";
            }
            else
            {
              echo "<input type='radio' name='rloredalambr' id='rloredalambr' value='SI' onclick='habilitaTodosCampos(this.form)'> SI</input>";
            }
           ?><br>
           <?php 
            if (isset($arreglo) && $rloredalambr == 'NO') 
            {
              echo "<input type='radio' name='rloredalambr' id='rloredalambr' value='NO' onclick='deshabilitaTodosCampos(this.form)' checked='checked'> NO</input>";
            }
            else
            {
              echo "<input type='radio' name='rloredalambr' id='rloredalambr' value='NO' onclick='deshabilitaTodosCampos(this.form)'> NO</input>";
            }
           ?>
				</td>
			    
			    <td>LONGITUD CANALETAS:</td>
          		<td>
            	<input type="hidden" name="rlocantanale1" value="0">
            		<?php 
        		  	if (isset($arreglo)) 
        		  	{
        	    		echo "<input type='text' name='rlocantanale' id='rlocantanale' maxlength='2' value='$rlocantanale' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
	  				}
            	  	else
            	  	{
            	    	echo "<input type='text' style='background-color: #EDE9E9' name='rlocantanale' id='rlocantanale' maxlength='2' value='$rlocantanale' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
            	  	}	
            	 	?>
			       	
			       	<input type="hidden" name="rlounimedcca1" value="-1"><!--Campo oculto que me permitirá validar los valores por defecto que llegan vacios al archivo de registrar.php y actualizar.php; para las listas desplegables-->
              		  <?php                              
              		    include 'conexion.php';
              		    if (isset($arreglo))
              		    {
	          		       echo '<select name="rlounimedcca" id="rlounimedcca" class="uni-form" onblur="SelectVaciouni(this)" required/>';
                       $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid=$rlounimedcca ");
	          		       while($reg1=pg_fetch_array($res1))
	          		       {
	          		           $umenombre=$reg1[1];
	          		           echo "<option value='$rlounimedcca' selected>$umenombre</option>";
	          		       }
                       echo '</select>';
	          		      }
              		    else
              		    {
              		      echo '<select name="rlounimedcca" id="rlounimedcca" style="background-color: #EDE9E9" class="uni-form" onblur="SelectVaciouni(this)" disabled required/>';
                        echo "<option selected disabled></option>";
                        $res=pg_query($con, "SELECT * FROM unidad_medida where umetipunimed = 'LONGITUD'");
                        while($reg=pg_fetch_array($res))
                          {
                            $umeid=$reg[0];
                            $umenombre= $reg[1];
                            echo "<option value='$umeid'>$umenombre</option>";
                          }
                          echo "</select>";
              		    }              		    
              		  ?>
              		</select>
		           	</td>
	           	</tr>
	           	<tr height="20px"></tr>
	           	<tr>
	           		
	           	</tr>
					<td>CANTIDAD RJ-45:</td>
		          	<td>
		          	  <input type="hidden" name="rlocantrj1" value="0">
		          	  <?php 
		          	    if (isset($arreglo)) 
		          	    {
		          	      echo "<input type='text' name='rlocantrj' id='rlocantrj' maxlength='2' value='$rlocantrj' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
		          	    }
		          	    else
		          	    {
		          	      echo "<input type='text' style='background-color: #EDE9E9' name='rlocantrj' id='rlocantrj' maxlength='2' value='$rlocantrj' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
		          	    }
			
		          	   ?>            
		          	</td>
			        <td>CANTIDAD FIBRA OPTICA:</td>
		          	<td>
		          	  <input type="hidden" name="rlocantfibop1" value="0">
		          	  <?php 
		          	    if (isset($arreglo)) 
		          	    {
		          	      echo "<input type='text' name='rlocantfibop' id='rlocantfibop' maxlength='2' value='$rlocantfibop' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
		          	    }
		          	    else
		          	    {
		          	      echo "<input type='text' style='background-color: #EDE9E9' name='rlocantfibop' id='rlocantfibop' maxlength='2' value='$rlocantfibop' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
		          	    }
			
		          	   ?>            
		          	</td>
			       </tr>
			       <tr height="20px"></tr>
			       <tr>
			       <td>CATEGORIA CABLE UTP:</td>
                  <td>
                    <input type="hidden" name="rlocategoutp1" value="N/A"><!--Campo oculto que me permitirá validar los valores por defecto que llegan vacios al archivo de registrar.php y actualizar.php; para las listas desplegables-->                    
                    <?php
                      if (isset($arreglo) && $rlocategoutp == 'CATEGORIA 1') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 1' selected>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 2') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 2' selected>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 3') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 3' selected>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 4') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 4' selected>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 5') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 5' selected>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 6') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 6' selected>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'CATEGORIA 7') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CATEGORIA 7' selected>CATEGORIA 7</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo '</select>';
                      }
                      elseif (isset($arreglo) && $rlocategoutp == 'N/A') 
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" onblur="SelectVacio(this)" disabled style="background-color: #EDE9E9" required/>';
                        echo "<option disabled selected>N/A</option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                      else
                      {
                        echo '<select name="rlocategoutp" id="rlocategoutp" class="select-form" style="background-color: #EDE9E9" onblur="SelectVacio(this)" disabled required/>';
                        echo "<option selected disabled></option>";
                        echo "<option value='CATEGORIA 1'>CATEGORIA 1</option>";
                        echo "<option value='CATEGORIA 2'>CATEGORIA 2</option>";
                        echo "<option value='CATEGORIA 3'>CATEGORIA 3</option>";
                        echo "<option value='CATEGORIA 4'>CATEGORIA 4</option>";
                        echo "<option value='CATEGORIA 5'>CATEGORIA 5</option>";
                        echo "<option value='CATEGORIA 6'>CATEGORIA 6</option>";
                        echo "<option value='CATEGORIA 7'>CATEGORIA 7</option>";
                        echo '</select>';
                      }
                    ?>
                </td>			       
			    <td>TOPOLOGIA:</td>
                  <td>
                    <input type="hidden" name="rlotopologia1" value="N/A"><!--Campo oculto que me permitirá validar los valores por defecto que llegan vacios al archivo de registrar.php y actualizar.php; para las listas desplegables-->
                    <?php
                      if (isset($arreglo) && $rlotopologia == 'ANILLO') 
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='ANILLO' selected>ANILLO</option>";
                        echo "<option value='BUS'>BUS</option>";
                        echo "<option value='ESTRELLA'>ESTRELLA</option>";
                        echo "<option value='MALLA'>MALLA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlotopologia == 'BUS') 
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='BUS' selected>BUS</option>";
                        echo "<option value='ANILLO'>ANILLO</option>";
                        echo "<option value='ESTRELLA'>ESTRELLA</option>";
                        echo "<option value='MALLA'>MALLA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlotopologia == 'ESTRELLA') 
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='ESTRELLA' selected>ESTRELLA</option>";
                        echo "<option value='ANILLO'>ANILLO</option>";
                        echo "<option value='BUS'>BUS</option>";
                        echo "<option value='MALLA'>MALLA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlotopologia == 'MALLA') 
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='MALLA' selected>MALLA</option>";
                        echo "<option value='ANILLO'>ANILLO</option>";
                        echo "<option value='BUS'>BUS</option>";
                        echo "<option value='ESTRELLA'>ESTRELLA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlotopologia == 'N/A') 
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" disabled style="background-color: #EDE9E9" required/>';
                        echo "<option disabled selected>N/A</option>";
                        echo "<option value='ANILLO'>ANILLO</option>";
                        echo "<option value='BUS'>BUS</option>";
                        echo "<option value='ESTRELLA'>ESTRELLA</option>";
                        echo "<option value='MALLA'>MALLA</option>";
                        echo '</select>';
                      }
                      else
                      {
                        echo '<select name="rlotopologia" id="rlotopologia" class="select-form" onblur="SelectVacio(this)" style="background-color: #EDE9E9" disabled required/>';
                        echo "<option selected disabled></option>";
                        echo "<option value='ANILLO'>ANILLO</option>";
                        echo "<option value='BUS'>BUS</option>";
                        echo "<option value='ESTRELLA'>ESTRELLA</option>";
                        echo "<option value='MALLA'>MALLA</option>";
                        echo "</select>";
                      }
                    ?>
                </td>
			   </tr>
			   <tr>
   			   <td>DISTRIBUCION:</td>
                  <td>
                  	<input type="hidden" name="rlodistribuc1" value="N/A"><!--Campo oculto que me permitirá validar los valores por defecto que llegan vacios al archivo de registrar.php y actualizar.php; para las listas desplegables-->
                    <?php
                      if (isset($arreglo) && $rlodistribuc == 'AEREA') 
                      {
                        echo '<select name="rlodistribuc" id="rlodistribuc" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='AEREA' selected>AEREA</option>";
                        echo "<option value='CANALETA'>CANALETA</option>";
                        echo "<option value='NINGUNA'>NINGUNA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlodistribuc == 'CANALETA') 
                      {
                        echo '<select name="rlodistribuc" id="rlodistribuc" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='CANALETA' selected>CANALETA</option>";
                        echo "<option value='AEREA'>AEREA</option>";
                        echo "<option value='NINGUNA'>NINGUNA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlodistribuc == 'NINGUNA') 
                      {
                        echo '<select name="rlodistribuc" id="rlodistribuc" class="select-form" onblur="SelectVacio(this)" required/>';
                        echo "<option value='NINGUNA' selected>NINGUNA</option>";
                        echo "<option value='AEREA'>AEREA</option>";
                        echo "<option value='CANALETA'>CANALETA</option>";
                        echo "</select>";
                      }
                      elseif (isset($arreglo) && $rlodistribuc == 'N/A') 
                      {
                        echo '<select name="rlodistribuc" id="rlodistribuc" class="select-form" onblur="SelectVacio(this)" disabled style="background-color: #EDE9E9" required/>';
                        echo "<option disabled selected>N/A</option>";
                        echo "<option value='AEREA'>AEREA</option>";
                        echo "<option value='CANALETA'>CANALETA</option>";
                        echo "<option value='NINGUNA'>NINGUNA</option>";
                        echo '</select>';
                      }
                      else
                      {
                        echo '<select name="rlodistribuc" id="rlodistribuc" class="select-form" onblur="SelectVacio(this)" style="background-color: #EDE9E9" disabled required/>';
                        echo "<option selected disabled></option>";
                        echo "<option value='AEREA'>AEREA</option>";
                        echo "<option value='CANALETA'>CANALETA</option>";
                        echo "<option value='NINGUNA'>NINGUNA</option>";
                        echo "</select>";
                      }
                    ?>
                </td>			   
			   <td>RACK:</td> 
				<td id="Rack">
            <input type="hidden" name="rlorack1" value="N/A">
            <?php 
              if (isset($arreglo) && $rlorack == 'SI') 
              {
                echo "<input type='radio' name='rlorack' id='rlorack' value='SI' checked='checked'> SI</input>";
              }
              else
              {
                echo "<input type='radio' name='rlorack' id='rlorack' disabled value='SI'> SI</input>";
              }

             ?><br>
            <?php 
              if (isset($arreglo) && $rlorack == 'NO') 
              {
                echo "<input type='radio' name='rlorack' id='rlorack' value='NO' checked='checked'> NO</input>";
              }
              else
              {
                echo "<input type='radio' name='rlorack' id='rlorack' disabled value='NO'> NO</input>";
              }

             ?>
				</td>
			</tr>
		</tr>
		<td>CANTIDAD SWITCH:</td>
          <td>
            <input type="hidden" name="rlocantswitc1" value="0">
            <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='text' name='rlocantswitc' id='rlocantswitc' maxlength='2' value='$rlocantswitc' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
              }
              else
              {
                echo "<input type='text' style='background-color: #EDE9E9' name='rlocantswitc' id='rlocantswitc' maxlength='2' value='$rlocantswitc' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
              }

             ?>            
          </td>
		<td>CANTIDAD REGLETAS:</td>
          <td>
            <input type="hidden" name="rlocantregle1" value="0">
            <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='text' name='rlocantregle' id='rlocantregle' maxlength='2' value='$rlocantregle' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
              }
              else
              {
                echo "<input type='text' style='background-color: #EDE9E9' name='rlocantregle' id='rlocantregle' maxlength='2' value='$rlocantregle' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
              }

             ?>            
          </td>
	</tr>
	<tr>
		<td>CANTIDAD UPS:</td>
          <td>
            <input type="hidden" name="rlocantups1" value="0">
            <?php 
              if (isset($arreglo)) 
              {
                echo "<input type='text' name='rlocantups' id='rlocantups' maxlength='2' value='$rlocantups' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' required/>";
              }
              else
              {
                echo "<input type='text' style='background-color: #EDE9E9' name='rlocantups' id='rlocantups' maxlength='2' value='$rlocantups' class='inp-ent' placeholder='EJ: 18' onkeypress=\"return permite(event,'num')\" onblur='revisarn(this)' disabled required/>";
              }

             ?>            
          </td>
	</tr>
<tr>
       <td colspan="6"><br>
              <center>
                <?php
                if (isset($arreglo)) 
                {
                  echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
                        <a href='frm_redlogica.php'>
                          <img src='img/Nuevo.png' class='img-form' title'Nuevo Registro'>
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
                <a href="descarga_pdf/pdf_redlogica.php" target="_blank">
                  <img src="img/pdf.png" title="Exportar PDF" class="img-form">
                </a> 
<!--BOTON PARA EL (EXCEL)-->          
                <a href="descarga_excel/exc_redlogica.php" target="_blank">
                  <img src="img/Excel.png" title="Exportar Excel" class="img-form">
                </a>              
            </td>
              </center>
          </tr>
        </table>
        </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_redlogica/gri_redlogica.php';?>
      </div>
      <div id="foot">
        <?php include 'include/piepagina.php';?>
      </div>
      <div class="fin">Luis Fernando Chamorro Rodriguez</div>
    </div><!--Cierra <div> del SECTION-->
  </body>
</html>