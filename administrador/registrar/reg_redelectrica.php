<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	error_reporting(E_ALL ^ E_NOTICE);
	$ConstRedElec=$_REQUEST['eleconstrucc']; 
	$elecantidad=$_REQUEST['elecantidad'];
	$elecantidad1=$_REQUEST['elecantidad1'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$ConstRedElectrica=pg_num_rows( pg_query("SELECT * FROM redelectrica WHERE eleconstrucc='".strtoupper($ConstRedElec)."'"));

	if ($elecantidad == 0)
	{
		$elecantidad= $elecantidad1;
	}

	if ($ConstRedElectrica > 0) 
	{
		echo "<script type='text/javascript'>alert('La Construccion de la Red Electrica Ya Existe'); 
		location='../frm_redelectrica.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO redelectrica(eleconstrucc, elenumlampar, elenumtomaco, elenuminterr, eletipventil, elecantidad, elefecha, tomar, tomanr) 
		VALUES (
			'$_REQUEST[eleconstrucc]',
			'$_REQUEST[elenumlampar]',
			'$_REQUEST[elenumtomaco]',
			'$_REQUEST[elenuminterr]',
			'$_REQUEST[eletipventil]',
			'$elecantidad',
			'$fecha',
			'$_REQUEST[tomar]',
			'$_REQUEST[tomanr]')") 

		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_redelectrica.php'</script>";
		
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR RED ELECTRICA";
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



