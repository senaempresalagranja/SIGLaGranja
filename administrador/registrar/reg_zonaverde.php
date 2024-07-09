<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['zveidcodigo'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM zonaverde WHERE zveidcodigo='".strtoupper($codigo)."'"));

	if ($CodReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Codigo de la Zona Verde Ya Existe'); 
		location='../frm_zonaverde.php'</script>";
	}
	else
	{
		if ($codigo == " ") 
		{
			echo "<script type='text/javascript'>alert('El Codigo de la Zona Verde esta vacio'); 
			location='../frm_zonaverde.php'</script>";
		}
		else
		{
			pg_query("INSERT INTO zonaverde (zveidcodigo,zveunidad,zvetipriego,zveextension,zveunimedi,zvelatitud,zveorientlat,zvelongitud,zveorientlon,zvefecha)
				VALUES (
				'$_REQUEST[zveidcodigo]',
				'$_REQUEST[zveunidad]',
				'$_REQUEST[zvetipriego]',
				'$_REQUEST[zveextension]',
				'$_REQUEST[zveunimedi]',
				'$_REQUEST[coorlatitud]',
				'$_REQUEST[orilatitud]',
				'$_REQUEST[coorlongitud]',
				'$_REQUEST[orilongitud]',
				'$fecha')")
			or die ("Problemas en el select ".pg_last_error());
			echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_zonaverde.php'</script>";

			$usuario=($_SESSION['ADMINISTRADOR']);
			$actividad="REGISTRAR ZONA VERDE";
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