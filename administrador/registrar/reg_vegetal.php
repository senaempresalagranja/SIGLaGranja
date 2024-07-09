<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nomcomun=$_REQUEST['vegnomcomun'];
	$nomcientifico=$_REQUEST['vegnomcienti']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomComun=pg_num_rows( pg_query("SELECT * FROM vegetal WHERE vegnomcomun='".strtoupper($nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM vegetal WHERE vegnomcienti='".strtoupper($nomcientifico)."'"));

	if ($NomComun > 0)
	{
		echo "<script type='text/javascript'>alert('El nombre comun del Vegetal Ya Existe'); 
		location='../frm_vegetal.php'</script>";
	}
	else
	{
		if ($NomCient > 0) 
		{
			echo "<script type='text/javascript'>alert('El nombre cientifico del Vegetal Ya Existe'); 
			location='../frm_vegetal.php'</script>";
		}
		else
		{
			if ($nomcomun==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre comun del Vegetal esta vacio');
				location='../frm_vegetal.php'</script>";
			}
			else
			{
				if ($nomcientifico==" ") 
				{
					echo "<script type='text/javascript'>alert('El nombre cientifico del Vegetal esta vacio');
					location='../frm_vegetal.php'</script>";
				}
				else
				{
					$veg=$_REQUEST['vegorigen'];
					$origen="EXOTICO";
					if ($veg==1) 
					{
						$origen="NATIVO";
					}

					pg_query("INSERT INTO vegetal(vegnomcomun,vegnomcienti,vegorigen,veglugorigen,vegclima,vegtipo,vegdescripci,vegfecha)
						VALUES  (
						'$_REQUEST[vegnomcomun]',
						'$_REQUEST[vegnomcienti]',
						'$origen',
						'$_REQUEST[veglugorigen]',
						'$_REQUEST[vegclima]',
						'$_REQUEST[vegtipo]', 
						'$_REQUEST[vegdescripci]',
						'$fecha')") 
					or die ("<script type='text/javascript'>alert('Error del Sistema');location='../frm_vegetal.php'</script>");
					echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_vegetal.php'</script>";
					$usuario=($_SESSION['ADMINISTRADOR']);
					$actividad="REGISTRAR VEGETAL";
					pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
						'$usuario',
						'$actividad',
						'$fecha')") or die(pg_result_error());
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