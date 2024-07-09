<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	$unidad=$_REQUEST["cununidad"];
	$canal=$_REQUEST["cuncanal"];
	$comp=("$unidad$canal");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM unidad_canal WHERE cunkidcodigo='.$comp));

	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede asignar la misma CANAL a la misma UNIDAD');location='../frm_unidadcanal.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO unidad_canal (cunkidcodigo,cununidad,cuncanal,cundistancia,cununimedist,cundescripci,cunfecha)
				VALUES (
				'$comp',
				'$_REQUEST[cununidad]',
				'$_REQUEST[cuncanal]',
				'$_REQUEST[cundistancia]',
				'$_REQUEST[cununimedist]',
				'$_REQUEST[cundescripci]',
				'$fecha')");
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_unidadcanal.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR UNIDAD CANAL";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha)
		VALUES (
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