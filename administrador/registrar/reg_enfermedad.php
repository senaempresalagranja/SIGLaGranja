<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nomcomun=$_REQUEST['enfnomcomun'];
	$nomcientifico=$_REQUEST['enfnomcinti']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomComun=pg_num_rows( pg_query("SELECT * FROM enfermedad WHERE enfnomcomun='".strtoupper($nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM enfermedad WHERE enfnomcinti='".strtoupper($nomcientifico)."'"));

	if ($NomComun > 0)
	{
		echo "<script type='text/javascript'>alert('El nombre comun de la enfermedad Ya Existe'); 
		location='../frm_enfermedad.php'</script>";
	}
	else
	{
		if ($NomCient > 0) 
		{
			echo "<script type='text/javascript'>alert('El nombre cientifico de la enfermedad Ya Existe'); 
			location='../frm_enfermedad.php'</script>";
		}
		else
		{
			if ($nomcomun==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre comun de la enfermedad esta vacio');
				location='../frm_enfermedad.php'</script>";
			}
			else
			{
				if ($nomcientifico==" ") 
				{
					echo "<script type='text/javascript'>alert('El nombre cientifico de la enfermedad esta vacio');
					location='../frm_enfermedad.php'</script>";
				}
				else
				{
					pg_query("INSERT INTO enfermedad (enfnomcomun, enfnomcinti, enftipagecau, enfmorvimort, 
						enfsintomas, enftratamien, enffecha )
						VALUES (
						'$_REQUEST[enfnomcomun]', 
						'$_REQUEST[enfnomcinti]', 
						'$_REQUEST[enftipagecau]',
						'$_REQUEST[enfmorvimort]',
						'$_REQUEST[enfsintomas]', 
						'$_REQUEST[enftratamien]', 
						'$fecha')")

					or die ("Problemas en el select ".pg_last_error());
					echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_enfermedad.php'</script>";
							//-----SE GUARDA LA ACTIVIDAD REALIZADA------
					$usuario=($_SESSION['ADMINISTRADOR']);
					$actividad="REGISTRAR ENFERMEDAD";
					pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
						'$usuario',
						'$actividad',
						'$fecha')") 
					or die(pg_result_error());	
				}
			}		
		}
	}
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>

