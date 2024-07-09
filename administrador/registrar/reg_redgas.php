<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	error_reporting(E_ALL ^ E_NOTICE);
	/* Guardar registros en la base de datos postgres */
	$ConstRedGas=$_REQUEST['rgaconstrucc'];;
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$ConstRedGas=pg_num_rows( pg_query("SELECT * FROM redgas WHERE rgaconstrucc='".strtoupper($ConstRedGas)."'"));

	if ($ConstRedGas > 0) 
	{
		echo "<script type='text/javascript'>alert('La Construccion de la Red Gas Ya Existe'); 
		location='../frm_redgas.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO redgas (rgaconstrucc,rgatipmateri,rganumvalvul,rganumconexi,rganumcontad,rganumsoport,rgafecha)
					VALUES (
					'$_REQUEST[rgaconstrucc]',
					'$_REQUEST[rgatipmateri]',
					'$_REQUEST[rganumvalvul]',
					'$_REQUEST[rganumconexi]',
					'$_REQUEST[rganumcontad]',
					'$_REQUEST[rganumsoport]',
					'$fecha')")

		or die ("Problemas en el INSERT ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_redgas.php'</script>";

		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR RED GAS";
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