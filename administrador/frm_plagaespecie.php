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
              $res=pg_query($con, "SELECT * FROM plaga_especie WHERE peskidcodigo='$_REQUEST[consplaesp]'");
              while($reg=pg_fetch_array($res))
              {
                $arreglo['plagaespecie']=array('pesid'=>$reg[0]);
                $pesid= utf8_decode($reg [0]);
                $peskidcodigo=utf8_decode($reg[1]);
                $pesespecie=utf8_decode($reg[2]);
                $pesplaga=utf8_decode($reg[3]);
                $pesdescripci=mb_convert_encoding($reg[4], "UTF-8");
                $pesfecha=utf8_decode($reg[5]);
              }
            }
          ?>
          <tr>
            <td colspan="5"><br>
              <?php
                if (isset($arreglo))
                {
                  echo "<p class='tit-form'><b>ACTUALIZAR PLAGA ESPECIE<br><br><p>";
                }
                else
                {
                  echo "<p class='tit-form'><b>REGISTRAR PLAGA ESPECIE<br><br><p>";
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
                            <input type='text' name='consplaesp' id='consplaesp' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
                          </td>
                        </tr>";/*Actualizar*/
                }
                else
                {
                  echo "<tr id='consultar'>
                          <td>CONSULTAR:</td>
                          <td colspan='4'>
                            <input type='text' name='consplaesp' id='consplaesp' class='inp-form' placeholder='EJ: 1 (CODIGO)' maxlength='4' onkeypress='return ValNumero(this)' onkeyup='this.value=this.value.toUpperCase()' onkeydown='espacios(this)'>
                            <input type='hidden' name='condicion' value='1'>
                            <input type='image' src='img/Consultar.png' width='4%' onclick='replace(this.form.name)' title='consultar'>
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
              echo "<form name='formulario' action='actualizar/act_plagaespecie.php' onsubmit='return ValidarFormPlagaEspecie();'>";
            }
          else
            {
              echo "<form name='formulario' action='registrar/reg_plagaespecie.php' onsubmit='return ValidarFormPlagaEspecie();'>";
            }
        ?>
        <tr>
          <td>
            <input type="hidden" value="<?php if (isset($pesid)) {echo"$pesid";} ?>" name="pesid" id="pesid"/>
          </td>
        </tr>
            <tr>
              <td>ESPECIE:</td>
  						<td>
  							<select name="pesespecie" id="pesespecie" class="select-form" onblur="SelectVacio(this)" required/>
              <?php
                if (isset($arreglo)) 
                {
                  $res3=pg_query($con, "SELECT * FROM especie WHERE espid='$pesespecie'");
                  while ($row3=pg_fetch_array($res3)) 
                  {
                    $NomEsp=$row3[3];
                    echo "<option value='$pesespecie' selected>$NomEsp</option>";
                  }
                }
                else
                {
                  echo "<option selected disabled></option>";
                }
                include 'conexion.php';
                $res1=pg_query($con, "SELECT * FROM especie order by espnomcomun ASC");
                while ($row1=pg_fetch_array($res1))
                {
                  $CodEsp=$row1[0];
                  $NomEsp=$row1[3];
                  echo "<option value='$CodEsp'>$NomEsp</option>";
                }
              ?>
            </select>
  						<td>PLAGA:</td>
  						<td colspan="2">
                <select name="pesplaga" id="pesplaga" class="select-form" onblur="SelectVacio(this)" required/>
                  <?php
                    if (isset($arreglo)) 
                    {
                      $res3=pg_query($con, "SELECT * FROM plaga WHERE plaid='$pesplaga'");
                      while ($row3=pg_fetch_array($res3)) 
                      {
                        $NomPla=$row3[2];
                        echo "<option value='$pesplaga' selected>$NomPla</option>";
                      }
                    }
                    else
                    {
                      echo "<option selected disabled></option>";
                    }
                    include 'conexion.php';
                    $res1=pg_query($con, "SELECT * FROM plaga order by planomcomun ASC");
                    while ($row1=pg_fetch_array($res1))
                    {
                      $CodPl=$row1[0];
                      $NomPla=$row1[2];
                      echo "<option value='$CodPl'>$NomPla</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>DESCRIPCION:</td>
              <td colspan="4">
                <textarea type="text" name="pesdescripci" id="pesdescripci" class="des-form" placeholder="ESCRIBA LAS CARACTERISTICAS DE LA ESPECIE Y LA PLAGA" onblur="revisard(this)" onkeyup="this.value=this.value.toUpperCase()" onkeypress="espacios(this)" required/><?php if (isset($pesdescripci)) {echo "$pesdescripci ";} ?></textarea>
              </td>
            </tr>
  					<tr>
					  <tr>
              <td colspan="5"><br>
                <center>
                <?php 
                  if (isset($arreglo)) 
                    {
                      echo "<input type='image' src='img/Guardar.png' class='img-form' onclick='replace(this.form.name)' title='Actualizar Registro'>
                      <a href='frm_plagaespecie.php'>
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
              <a href="descarga_pdf/pdf_plagaespecie.php" target="_blank">
<!--BOTON PARA EL (PDF)-->
                <img src="img/Pdf.png" class="img-form" title="ExportarPDF">
              </a> 
<!--BOTON PARA EL (EXCEL)-->
              <a href="descarga_excel/exc_plagaespecie.php" target="_blank">
                <img src="img/Excel.png" class="img-form" title="ExportarExcel">
              </a>
            </center>
          </td>
        </tr>
      </table>
    </form>
      </div>
      <div id="grilla">
        <?php include 'grillas/gri_plagaespecie/gri_plagaespecie.php'; ?>
      </div>
<!-- Descripcion para el pie de pagina-->
      <div id="foot">
        <?php include 'include/piepagina.php' ?>
      </div>
      <div class="fin">
        Luis Fernando Chamorro Rodríguez
      </div>
    </div>
  </body>
</html>