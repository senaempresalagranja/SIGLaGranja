<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nomcomun=$_REQUEST['espnomcomun'];
	$nomcient=$_REQUEST['espnomcienti'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomComReg=pg_num_rows( pg_query("SELECT * FROM especie WHERE espnomcomun='".strtoupper($nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM especie WHERE espnomcienti='".strtoupper($nomcient)."'"));

	if ($NomComReg > 0)
	{
		echo "<script type='text/javascript'>alert('El nombre comun de la especie Ya Existe'); 
		location='../frm_especie.php'</script>";
	}
	else
	{
		if ($NomCient > 0) 
		{
			echo "<script type='text/javascript'>alert('El nombre cientifico de la especie Ya Existe'); 
			location='../frm_especie.php'</script>";
		}
		else
		{
			if ($nomcomun==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre comun de la especie esta Vacio');
				location='../frm_especie.php'</script>";
			}
			elseif ($nomcient==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre cientifico de la especie esta Vacio');
				location='../frm_especie.php'</script>";
			}
			else
			{
				$sql=pg_query("INSERT INTO especie (espunidad,esptipespeci,espnomcomun,espnomcienti,espfecha)
					VALUES (
					'$_REQUEST[espunidad]',
					'$_REQUEST[esptipespeci]',
					'$_REQUEST[espnomcomun]',
					'$_REQUEST[espnomcienti]',
					'$fecha')") 

				or die("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_especie.php'</script>";

				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR ESPECIE";
				pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());				    
			}
		}
	}
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>

