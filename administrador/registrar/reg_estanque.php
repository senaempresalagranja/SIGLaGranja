<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nombre=$_REQUEST['estnombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomReg=pg_num_rows( pg_query("SELECT * FROM estanque WHERE estnombre='".strtoupper($nombre)."'"));

	if ($NomReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre del estanque Ya Existe'); 
		location='../frm_estanque.php'</script>";
	}
	else
	{
		if ($nombre==" ") 
		{
			echo "<script type='text/javascript'>alert('El Nombre del estanque esta Vacio');
			location='../frm_estanque.php'</script>";
		}
		else
		{
			pg_query("INSERT INTO estanque (estnombre, esttipestanq, estprofundid, 
				estunimedpro, estespejagua, estunimedesp, estvolumagua, 
				estunimedvol, estfecha )
				VALUES ( 
				'$_REQUEST[estnombre]', 
				'$_REQUEST[esttipestanq]',
				'$_REQUEST[estprofundid]',
				'$_REQUEST[estunimedpro]', 
				'$_REQUEST[estespejagua]',
				'$_REQUEST[estunimedesp]', 
				'$_REQUEST[estvolumagua]', 
				'$_REQUEST[estunimedvol]',
				'$fecha')")

			or die ("Problemas en el select ".pg_last_error());
			echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_estanque.php'</script>";
						//-----SE GUARDA LA ACTIVIDAD REALIZADA------
			$usuario=($_SESSION['ADMINISTRADOR']);
			$actividad="REGISTRAR ESTANQUE";
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

