<!-- 
	Proyecto: Sistema de Informacion del Centro Agropecuario La Granja. 
	Nombre del proyecto:  SIG LA GRANJA. 
	Desarrolladores: Tecnologos en Analisis y desarrollo de sistemas de informacion "ADSI".	
	Numero de Ficha: 798585. 
	Descripcion del Proyecto: Software que permita la Georeferenciación de Centro agropecuario la granja Sena Espinal - Tolima. 
	Año de Desarrollo: 2014-2015. -->
<?php
session_start();
if (isset($_SESSION['USUARIO CONSULTA']))
{	
	include 'conexion.php';
	$usuario=($_SESSION['USUARIO CONSULTA']);

	$res=pg_query($con, "SELECT * FROM usuario WHERE usuid=$usuario");
        while ($reg=pg_fetch_array($res)) 
        {
          $nombre=$reg[1];
          $apellidos=$reg[2];
          $sexo=utf8_decode($reg[3]);
         }
    if ($sexo=='MASCULINO') 
    {
    	$saludo="Bienvenido Señor "; 
    }
    else
    {
    	$saludo="Bienvenida Señora ";
    }
    echo "<script type='text/javascript'>alert('$saludo $nombre $apellidos, Al Modulo del Usuario Consulta')</script>";
}
else
{
	echo "<script type='text/javascript'>alert('Acceso Denegado');location='../visitante/index.php?Acceso Denegado'</script>";
}
?>
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
		<div id="article"><br>
			<center><b><h2>Bienvenidos al modulo del Usuario Consulta</h2></b></center><br>
			<div class="text-admi">
				Aquí usted cuenta con un único Modulo de Consulta, en él dispone de una información estructurada en la cual podrá conocer a fondo la información general del Sistema de Informacion Geográfico (<b>SIGLaGranja</b>). Además puede exportar sus consultas a un archivo de Excel.<br><br>
				Si tiene alguna duda con respecto al manejo y funcionamiento de este módulo, diríjase a la opción <i>Ayuda</i> para consultar el Manual de Usuario o el Manual Técnico.
			</div>
		</div>
<!-- Descripcion para el pie de pagina-->
		<div id="foot">
			<?php
				include 'include/piepagina.php'
			?>
		</div>
		<div class="fin">
			Luis Fernando Chamorro Rodríguez
		</div>
	</div>
	</body>
</html>