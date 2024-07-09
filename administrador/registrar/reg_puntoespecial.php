<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nombre=$_REQUEST['pesnombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomReg=pg_num_rows( pg_query("SELECT * FROM puntoespecial WHERE pesnombre='".strtoupper($nombre)."'"));

	if ($NomReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre del Punto Especial Ya Existe'); 
		location='../frm_puntoespecial.php'</script>";
	}
	else
	{
		if ($nombre==" ") 
		{
			echo "<script type='text/javascript'>alert('El Nombre del Punto Especial esta Vacio');
			location='../frm_puntoespecial.php'</script>";
		}
		else
		{
			pg_query("INSERT INTO puntoespecial (pesunidad,pesnombre,pestippunto,pesdescripci,peslatitud,pesorientlat,peslongitud,pesorientlog,pesfecha)
				VALUES (	
				'$_REQUEST[pesunidad]',
				'$_REQUEST[pesnombre]',
				'$_REQUEST[pestippunto]',
				'$_REQUEST[pesdescripci]',
				'$_REQUEST[coorlatitud]',
				'$_REQUEST[orilatitud]',
				'$_REQUEST[coorlongitud]',
				'$_REQUEST[orilongitud]',
				'$fecha')")or die ("Problemas en el select ".mysql_error());
			echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_puntoespecial.php'</script>";
			$usuario=($_SESSION['ADMINISTRADOR']);
			$actividad="REGISTRAR PUNTO_ESPECIAL";
			pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
				'$usuario',
				'$actividad',
				'$fecha')") or die(pg_result_error());
		}
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>