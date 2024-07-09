<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
	include 'conexion.php';
	$ruta=$_REQUEST["runruta"];
	$unidad=$_REQUEST["rununidad"];
	$comp=("$ruta$unidad");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM ruta_unidad WHERE runkidcodigo='.$comp));

	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma RUTA en la misma UNIDAD');location='../frm_rutaunidad.php'</script>";
	}
	else
	{
			pg_query("INSERT INTO ruta_unidad (
			runkidcodigo,
			rununidad,
			runruta,
			rundistancia,
			rununimeddis,
			runtierecorr,
			rununimedrec,
			runtipruta,
			runfecha )
			VALUES (
			'$comp',
			'$_REQUEST[rununidad]',
			'$_REQUEST[runruta]',
			'$_REQUEST[rundistancia]',
			'$_REQUEST[rununimeddis]',
			'$_REQUEST[runtierecorr]',
			'$_REQUEST[rununimedrec]',
			'$_REQUEST[runtipruta]',
			'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_rutaunidad.php'</script>";
		$usuario=($_SESSION['USUARIO ADMIN']);
		$actividad="REGISTRAR RUTA_UNIDAD";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
		'$usuario',
		'$actividad',
		'$fecha')") or die(pg_result_error());
	}
}
?>