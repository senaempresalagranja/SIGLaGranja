<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s", time());

		 pg_query("INSERT INTO suelo (suefhumedad,sueunimedhu,sueftextura,suefporocida,sueunimedpo,suefconsiste,sueunimedco,suefcolorter,suefcondelet,sueunimedel,sueqnitrogen,sueunimedni,sueqfosforo,sueunimedfo,sueqpotacio,sueunimedpt,sueqelemmeno,sueqeleminte,sueqph,sueunimedph,suebmateorga,sueunimedma,suebactimicr,sueunimedam,suebmasmicro,sueunimedmm,suefecha)
		   		VALUES (
			   	'$_REQUEST[suefhumedad]',
			   	'$_REQUEST[sueunimedhu]',
			   	'$_REQUEST[sueftextura]',		   		
		   		'$_REQUEST[suefporocida]',
		   		'$_REQUEST[sueunimedpo]',
		   		'$_REQUEST[suefconsiste]',		   		
		   		'$_REQUEST[sueunimedco]',
		   		'$_REQUEST[suefcolorter]',
		   		'$_REQUEST[suefcondelet]',		   		
		   		'$_REQUEST[sueunimedel]',
		   		'$_REQUEST[sueqnitrogen]',
		   		'$_REQUEST[sueunimedni]',		   		
		   		'$_REQUEST[sueqfosforo]',
		   		'$_REQUEST[sueunimedfo]',
		   		'$_REQUEST[sueqpotacio]',
		   		'$_REQUEST[sueunimedpt]',
		   		'$_REQUEST[sueqelemmeno]',
		   		'$_REQUEST[sueqeleminte]',
		   		'$_REQUEST[sueqph]',
		   		'$_REQUEST[sueunimedph]',
		   		'$_REQUEST[suebmateorga]',
		   		'$_REQUEST[sueunimedma]',
		   		'$_REQUEST[suebactimicr]',
		   		'$_REQUEST[sueunimedam]',
		   		'$_REQUEST[suebmasmicro]',
		   		'$_REQUEST[sueunimedmm]',		   		
		   		'$fecha')") 

		 or die("Problemas en el INSERT ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_suelo.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);

		$actividad="REGISTRAR SUELO";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) 
			VALUES (
		'$usuario',
		'$actividad',
		'$fecha')") 

		or die(pg_result_error());
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>