<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nomcomun=$_REQUEST['eacnomcomun'];
	$nomcient=$_REQUEST['eacnomcienti'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomComReg=pg_num_rows( pg_query("SELECT * FROM especieacuatica WHERE eacnomcomun='".strtoupper($nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM especieacuatica WHERE eacnomcienti='".strtoupper($nomcient)."'"));

	if ($NomComReg > 0)
	{
		echo "<script type='text/javascript'>alert('El nombre comun de la especie acuatica Ya Existe'); 
		location='../frm_especieacuatica.php'</script>";
	}
	else
	{
		if ($NomCient > 0) 
		{
			echo "<script type='text/javascript'>alert('El nombre cientifico de la especie acuatica Ya Existe'); 
			location='../frm_especieacuatica.php'</script>";
		}
		else
		{
			if ($nomcomun==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre comun de la especie acuatica esta Vacio');
				location='../frm_especieacuatica.php'</script>";
			}
			elseif ($nomcient==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre cientifico de la especie acuatica esta Vacio');
				location='../frm_especieacuatica.php'</script>";
			}
			else
			{
				$sql=pg_query("INSERT INTO especieacuatica (eacunidad,eactipespeci,eacnomcomun,eacnomcienti,eacfecha)
					VALUES (
					'$_REQUEST[eacunidad]',
					'$_REQUEST[eactipespeci]',
					'$_REQUEST[eacnomcomun]',
					'$_REQUEST[eacnomcienti]',
					'$fecha')") 

				or die("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_especieacuatica.php'</script>";

				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR ESPECIE ACUATICA";
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

