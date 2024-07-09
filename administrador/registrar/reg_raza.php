<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	/* Guardar registros en la base de datos postgres */
	include 'conexion.php';
	$origenRaza=$_REQUEST['razorigen'];
	$NombreRaza=$_REQUEST['raznombre'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomRaza=pg_num_rows( pg_query("SELECT * FROM raza WHERE raznombre='".strtoupper($NombreRaza)."'"));

	$origen="EXOTICO";
	if ($origenRaza == 1) 
	{
		$origen="NATIVO";
	}


	if ($NomRaza > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Raza Ya Existe');
				location='../frm_raza.php'</script>";
	}
	elseif ($NombreRaza == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Raza esta vacio');
				location='../frm_raza.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO raza (raznombre,razorigen,razlugorigen,razproposito,razproducion,razunimedpro,razcarfenoti,razfecha)
			   VALUES ( 
			   '$_REQUEST[raznombre]',
			   '$origen',
			   '$_REQUEST[razlugorigen]',
			   '$_REQUEST[razproposito]',
			   '$_REQUEST[razproducion]',
			   '$_REQUEST[razunimedpro]',
			   '$_REQUEST[razcarfenoti]',
			   '$fecha')") 

		or die("Problemas en el select ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_raza.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR RAZA";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
			'$usuario',
			'$actividad',
			'$fecha')") 
		or die(pg_result_error());
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>

