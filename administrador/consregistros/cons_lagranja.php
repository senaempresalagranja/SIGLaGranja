
<!-- 
Proyecto: Sistema de Informacion del Centro Agropecuario La Granja. 
Nombre del proyecto:  SIG LA GRANJA. 
Desarrolladores: Tecnologos en Analisis y desarrollo de sistemas de informacion "ADSI".	
Numero de Ficha: 798585. 
Descripcion del Proyecto: Software que permita la Georeferenciación de Centro agropecuario la granja Sena Espinal - Tolima. 
Año de Desarrollo: 2014-2015. -->

<!-- Descripcion de la pagina en formato de HTML5. 
-->
<!DOCTYPE html>
<html lang="es">
<?php
include 'include/header.php';
?>
<!-- Descripcion para el cuerpo de la pagina  -->
<body>
<!-- Descripcion para el contenedor principal, campo de trabajo-->
<div id="section">
	<!-- Descripcion para el Banner-->
	<div id="banner">
		<?php
		include 'include/banner.php';
		?>
		<!-- Descripcion para el Menu-->
		<div id="nav">
			<?php
			include 'include/menu.php';
			?>
		</div>
		<!-- Descripcion para el cuerpo de la pagina-->
		<p class="tit-form">La Granja</p>
		<div id="consulta">
		<center>
			<?php
			include 'consultar/cons_lagranja.php';
			?>
			</center>
		</div>
		<br>
		<center>
              <a href="descarga_pdf/pdf_lagranja.php" target="_blank">
              <img src="img/pdf.png" title="Exportar PDF" class="img-form"></a>
             <!--BOTON PARA EL (EXCEL)-->
             <a href="descarga_excel/exc_lagranja.php" target="_blank">
               <img src="img/Excel.png" title="Exportar Excel" class="img-form">
             </a> 		
		</center>
</div>
<div id="grilla">
<?php
include 'grillas/gri_especie/index.php';
?>
</div>
<!-- Descripcion para el pie de pagina-->
<div id="foot">
<?php
include 'include/piepagina.php'
?>
</div>
<div class="fin">
Jose Roman Galindo R.
</div>
</div>
</body>
</html>
