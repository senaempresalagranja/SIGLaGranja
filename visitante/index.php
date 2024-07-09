<!-- 
	Proyecto: Sistema de Informacion del Centro Agropecuario La Granja. 
	Nombre del proyecto:  SIG LA GRANJA. 
	Desarrolladores: Tecnologos en Analisis y desarrollo de sistemas de informacion "ADSI".	
	Numero de Ficha: 798585. 
	Descripcion del Proyecto: Software que permita la Georeferenciación de Centro agropecuario la granja Sena Espinal - Tolima. 
	Año de Desarrollo: 2014-2015. -->

<!-- Descripcion de la pagina en formato de HTML5. -->
<!DOCTYPE html>
<html lang="es">
	<?php
		include 'include/header.php';
	?>
<!-- Descripcion para el cuerpo de la pagina  -->
	<body>
<!-- Descripcion para el contenedor principal, campo de trabajo-->
	<div id="section">
<!-- Descripcion para el ingreso como Administrador o Como Usuario-->
		<div id="login">
			<?php
				include 'include/ingresar.php';
			?>
		</div>
<!-- Descripcion para el Banner-->
		<div id="banner">
			<?php
				include 'include/banner.php';
			?>
		</div>
<!-- Descripcion para el Menu-->
		<div id="nav">
			<?php
				include 'include/menu.php';
			?>
		</div>
<!-- Descripcion para el cuerpo de la pagina-->
		<div id="article">
			<div id="formulario">
				<center><img src="img/ADSI798585.png" class="img-ini-index"></center>
			</div>
		</div>
<!-- Descripcion para el pie de pagina-->
		<div id="foot">
			<?php
				include 'include/piepagina.php'
			?>
		</div>
		<div class="fin">
			Jerffen Mendoza Regino
		</div>
	</div>
	</body>
</html>