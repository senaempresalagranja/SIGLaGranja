<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$placodigo=$_REQUEST['plaidcodigo'];
	$nomcomun=$_REQUEST['planomcomun'];
	$nomcientifico=$_REQUEST['planomcienti']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$PlaCod=pg_num_rows( pg_query("SELECT * FROM plaga WHERE plaidcodigo='".strtoupper($placodigo)."'"));
	$NomComun=pg_num_rows( pg_query("SELECT * FROM plaga WHERE planomcomun='".strtoupper($nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM plaga WHERE planomcienti='".strtoupper($nomcientifico)."'"));

	if ($PlaCod > 0) 
	{
		echo "<script type='text/javascript'>alert('El Codigo de la plaga Ya Existe'); 
		location='../frm_plaga.php'</script>";
	}
	elseif ($NomComun > 0)
	{
		echo "<script type='text/javascript'>alert('El nombre comun de la plaga Ya Existe'); 
		location='../frm_plaga.php'</script>";
	}
	else
	{
		if ($NomCient > 0) 
		{
			echo "<script type='text/javascript'>alert('El nombre cientifico de la plaga Ya Existe'); 
			location='../frm_plaga.php'</script>";
		}
		else
		{
			if ($placodigo == " ") 
			{
				echo "<script type='text/javascript'>alert('El Codigo de la plaga esta vacio');
				location='../frm_plaga.php'</script>";
			}
			elseif ($nomcomun==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre comun de la plaga esta vacio');
				location='../frm_plaga.php'</script>";
			}
			else
			{
				if ($nomcientifico==" ") 
				{
					echo "<script type='text/javascript'>alert('El nombre cientifico de la plaga esta vacio');
					location='../frm_plaga.php'</script>";
				}
				else
				{
					$pla=$_REQUEST['plaorigen'];
					  $origen="EXOTICO";
					  	if ($pla==1) 
					  	{
					  		$origen="NATIVO";
					  	}

					pg_query("INSERT INTO plaga (plaidcodigo,planomcomun,planomcienti,plaorigen,plalugarorig,platipagecau,platratamien,plafecha)
								VALUES (
								'$_REQUEST[plaidcodigo]',
								'$_REQUEST[planomcomun]',
								'$_REQUEST[planomcienti]',
								'$origen',
								'$_REQUEST[plalugarorig]',
								'$_REQUEST[platipagecau]',
								'$_REQUEST[platratamien]',
								'$fecha')")
					or die ("Problemas en el select ".mysql_error());
					echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_plaga.php'</script>";
					//-----SE GUARDA LA ACTIVIDAD REALIZADA------
					$usuario=($_SESSION['ADMINISTRADOR']);
					$actividad="REGISTRAR PLAGA";
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