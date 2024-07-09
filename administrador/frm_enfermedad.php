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
	<?php	include 'include/header.php';	?>
<!-- Descripcion para el cuerpo de la pagina  -->
	<body>
<!-- Descripcion para el contenedor principal, campo de trabajo-->
	<div id="section">
<!-- Descripcion para el Banner-->
		<div id="banner">
			<?php	include 'include/banner.php';	?>
		</div>
<!-- Descripcion para el Menu-->
		<div id="nav">
			<?php	include 'include/menu.php';	?>
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
              $res=pg_query($con, "SELECT * FROM enfermedad WHERE enfnomcomun='$_REQUEST[consenfnomcomun]'");
  		          while($reg=pg_fetch_array($res))
  		            {
  		              $arreglo['enfermedad']=array('enfnomcomun'=>$reg[1]);
                    $enfid=utf8_decode($reg [0]);
  		              $enfnomcomun= utf8_decode($reg [1]);
  		              $enfnomcinti= utf8_decode($reg [2]);
  		              $enftipagecau= utf8_decode($reg [3]);
  		              $enfmorvimort= utf8_decode($reg [4]);
  		              $enfsintomas= utf8_decode($reg [5]);
  		              $enftratamien= utf8_decode($reg [6]);
  		            }
		        }
        ?>
      <tr>
        <td colspan="5"><br>
          <?php
            if (isset($arreglo))
            {
            	echo "<p class='tit-form'><b>ACTUALIZAR ENFERMEDAD<b><p><br>";
            }
            else
            {
            	echo "<p class='tit-form'><b>REGISTRAR ENFERMEDAD<b><p><br>";
            }
          ?>
        </td>
      </tr>
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
<!--*****   CARGA EN EL FORMULARIO EL CAMPO PARA CONSULTAR CUANDO SE PULSA EL ICONO DE "LUPA"   *****-->
<!--*****   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   *****-->
          <?php
            if (isset ($arreglo)) 
            {
             echo "
             <tr id='consultarr'>
               <td width='22%'>CONSULTAR:</td>
               <td colspan='3'> 
                 <input type='text' name='consenfnomcomun' id='consenfnomcomun' class='inp-form' placeholder='EJ:FIEBRE AFTOSA' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                 <input type='hidden' name='condicion' value='1'>
                 <input type='image' src='img/Consultar.png' width='4%' onclick='replace( this.form.name)' title='consultar'>
               </td>
             </tr>";/*Actualizar*/
            }
            else
            {
              echo "
             <tr id='consultar'>
               <td width='22%'>CONSULTAR:</td>
               <td colspan='3'> 
                 <input type='text'  name='consenfnomcomun' id='consenfnomcomun' class='inp-form' placeholder='EJ:FIEBRE AFTOSA' onkeypress='return validar_texto(event);' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'> 
                 <input type='hidden' name='condicion' value='1'>
                 <input type='image' src='img/Consultar.png' width='4%' onclick='replace( this.form.name)' title='consultar'>
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
      	echo "<form name='actualizar' action='actualizar/act_enfermedad.php' onsubmit='return ValidarFormEnfermedad();'>";
      }
      else
      {
      	echo "<form name='registrar' action='registrar/reg_enfermedad.php' onsubmit='return ValidarFormEnfermedad();'>";
      }
    ?>
    <tr>
      <td>
        <input type="hidden" value="<?php if (isset($enfid)) {echo "$enfid";} ?>" name="idenfermedad" id="idenfermedad">
      </td>
    </tr>
    <tr>
			<td>NOMBRE COMUN:</td> 
			<td width="150px">
				<input type="text" name="enfnomcomun" id="enfnomcomun" class="inp-form" value="<?php if (isset($enfnomcomun)) {echo "$enfnomcomun";} ?>" placeholder="EJ: FIEBRE DE MALTA" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
				<input type="text" name="enfnomcinti" id="enfnomcinti" class="inp-form" value="<?php if (isset($enfnomcinti)) {echo "$enfnomcinti";} ?>" placeholder="EJ: BRUCELOSIS" onkeypress="return validar_texto(event);" onkeyup="this.value=this.value.toUpperCase()" onkeydown="espacios(this)" onblur="revisar(this)" required/>
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
			<td>AGENTE CAUSAL:</td>
			<td>
        <select name="enftipagecau" id="enftipagecau" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $enftipagecau == 'BACTERIAS') 
                {
                  echo "<option value='BACTERIAS' selected>BACTERIAS</option>";
                  echo "<option value='PARASITOS'>PARASITOS</option>";
                  echo "<option value='VIRUS'>VIRUS</option>";
                }
                elseif (isset($arreglo) && $enftipagecau == 'PARASITOS') 
                {
                  echo "<option value='PARASITOS' selected>PARASITOS</option>";
                  echo "<option value='BACTERIAS'>BACTERIAS</option>";
                  echo "<option value='VIRUS'>VIRUS</option>";
                }
                elseif (isset($arreglo) && $enftipagecau == 'VIRUS') 
                {
                echo "<option value='VIRUS' selected>VIRUS</option>";
                  echo "<option value='BACTERIAS'>BACTERIAS</option>";
                  echo "<option value='PARASITOS'>PARASITOS</option>";
                }
                else
                {
                  echo "<option selected disabled></option>";
                  echo "<option value='BACTERIAS'>BACTERIAS</option>";
                  echo "<option value='PARASITOS'>PARASITOS</option>";
                  echo "<option value='VIRUS'>VIRUS</option>";
                }
              ?>             
        </select>
			</td>
      <td width="20px"></td>
			<td>TASA MORTALIDAD:</td>
			<td>
				<select name="enfmorvimort" id="enfmorvimort" class="select-form" onblur="SelectVacio(this)" required/>
              <?php 
                if (isset($arreglo) && $enfmorvimort == 'ALTA') 
                {
                  echo "<option value='ALTA' selected>ALTA</option>";
                  echo "<option value='BAJA'>BAJA</option>";
                  echo "<option value='MEDIA'>MEDIA</option>";
                }
                elseif (isset($arreglo) && $enfmorvimort == 'BAJA') 
                {
                  echo "<option value='BAJA' selected>BAJA</option>";
                  echo "<option value='ALTA'>ALTA</option>";
                  echo "<option value='MEDIA'>MEDIA</option>";
                }
                elseif (isset($arreglo) && $enfmorvimort == 'MEDIA') 
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
			<td>SINTOMAS:</td>
			<td colspan="4">
				<textarea type="text" name="enfsintomas" id="enfsintomas" class="des-form" placeholder="ESCRIBA LOS SINTOMAS DE LA ENFERMEDAD" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($enfsintomas)) {echo "$enfsintomas ";} ?></textarea>
			</td>
		</tr>
		<tr>
      <td>TRATAMIENTO:</td>
      <td colspan="4">
         <textarea type="text" name="enftratamien" id="enftratamien" class="des-form" placeholder="ESCRIBA EL TRATAMIENTO DE LA ENFERMEDAD" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($enftratamien)) {echo "$enftratamien ";} ?></textarea>
      </td>
    </tr>
			<tr>
				<td colspan="5">
				<center><br>
					<?php
            if (isset($arreglo)) 
            {
              echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)'' title='Actualizar Registro'>
              <a href='frm_enfermedad.php'>
                <img src='img/Nuevo.png' class='img-form' title'nuevo Registro'>
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
                <a href="descarga_pdf/pdf_enfermedad.php" target="_blank">
                  <img src="img/Pdf.png" title="ExpotarPDf" class="img-form">
                </a>
<!--BOTON PARA EL (EXCEL)-->
                <a href="descarga_excel/exc_enfermedad.php" target="_blank">
                  <img src="img/Excel.png"  title="ExportarExcel" class="img-form">
                </a>
        </center>
      </td>
    </tr>
  </table>
</form>
      </div>
      <!-- Cuerpo de la grilla-->
      <div id="grilla">
        <?php
          include 'grillas/gri_enfermedad/gri_enfermedad.php';
        ?>
      </div>
      <!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php
          include 'include/piepagina.php'
        ?>
      </div>
      <div class="fin">
        Cristina  Garcia
      </div>
    </div>
  </body>
</html>