<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nombre=$_REQUEST['uninombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomReg=pg_num_rows( pg_query("SELECT * FROM unidad WHERE uninombre='".strtoupper($nombre)."'"));

	if ($NomReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Unidad Ya Existe'); 
		location='../frm_unidad.php'</script>";
	}
	elseif ($nombre == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Unidad está Vacío'); 
		location='../frm_unidad.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO unidad (uniarea,uninombre,uniextension,uniunimedida,uniresponsab,unilatitud,uniorientlat,unilongitud,uniorientlon,unidescripci,unifecha)
			VALUES (
			'$_REQUEST[uniarea]',
			'$_REQUEST[uninombre]',
			'$_REQUEST[uniextension]',
			$_REQUEST[uniunimedida],
			'$_REQUEST[uniresponsab]',
			'$_REQUEST[coorlatitud]',
			'$_REQUEST[orilatitud]',
			'$_REQUEST[coorlongitud]',
			'$_REQUEST[orilongitud]',
			'$_REQUEST[unidescripci]',
			'$fecha')")

		or die ("Problemas en el INSERT ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_unidad.php'</script>";

		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR UNIDAD";
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