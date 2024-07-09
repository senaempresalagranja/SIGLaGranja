<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$rutcodigo=$_REQUEST['rutidcodigo'];
	$rutnombre=$_REQUEST['rutnombre'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$Cod=pg_num_rows( pg_query("SELECT * FROM ruta WHERE rutidcodigo='".strtoupper($rutcodigo)."'"));
	$rutaNom=pg_num_rows( pg_query("SELECT * FROM ruta WHERE rutnombre='".strtoupper($rutnombre)."'"));

	if ($Cod > 0)
	{
		echo "<script type='text/javascript'>alert('El Codigo de la Ruta Ya Existe'); 
		location='../frm_ruta.php'</script>";
	}
	elseif ($rutaNom > 0)
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Ruta Ya Existe'); 
		location='../frm_ruta.php'</script>";
	}
	else
	{
		if ($rutcodigo == " ") 
		{
			echo "<script type='text/javascript'>alert('El Codigo de la Ruta esta vacio');
			location='../frm_ruta.php'</script>";
		}
		elseif ($rutnombre==" ") 
		{
			echo "<script type='text/javascript'>alert('El Nombre de la Ruta esta vacio');
			location='../frm_ruta.php'</script>";
		}
		else
		{
			pg_query("INSERT INTO  ruta (rutidcodigo,rutnombre,rutestado,rutdistancia,rununimeddis,ruttierecorr,rununimedtie,rutlatitudi,rutorienlati,rutlongitudi,rutorienloni,rutlatitudf,rutorienlatf,rutlongitudf,rutorienlonf,rutdescripci,rutfecha)
				VALUES (
				'$_REQUEST[rutidcodigo]',
				'$_REQUEST[rutnombre]',
				'$_REQUEST[rutestado]',
				'$_REQUEST[rutdistancia]',
				'$_REQUEST[rununimeddis]',
				'$_REQUEST[ruttierecorr]',
				'$_REQUEST[rununimedtie]',
				'$_REQUEST[coorlatitud]',
				'$_REQUEST[orilatitud]',
				'$_REQUEST[coorlongitud]',
				'$_REQUEST[orilongitud]',
				'$_REQUEST[coorlatitudf]',
				'$_REQUEST[orilatitudf]',
				'$_REQUEST[coorlongitudf]',
				'$_REQUEST[orilongitudf]',
				'$_REQUEST[rutdescripci]',
				'$fecha')")
			or die ("Problemas en el select ".mysql_error());

			echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_ruta.php'</script>";
			$usuario=($_SESSION['ADMINISTRADOR']);
			$actividad="REGISTRAR RUTA";
			pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
				'$usuario',
				'$actividad',
				'$fecha')") 
			or die(pg_result_error());
		}
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>