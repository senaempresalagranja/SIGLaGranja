<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$simbolo=$_REQUEST['umerepreset'];
	$nombre=$_REQUEST['umenombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$RepreReg=pg_num_rows( pg_query("SELECT * FROM unidad_medida WHERE umerepreset='".$simbolo."'"));
	$NomReg=pg_num_rows( pg_query("SELECT * FROM unidad_medida WHERE umenombre='".strtoupper($nombre)."'"));

	if ($RepreReg > 0)
	{
		echo "<script type='text/javascript'>alert('El Simbolo Ya Existe'); 
		location='../frm_unidadmedida.php'</script>";
	}
	else
	{
		if ($NomReg > 0) 
		{
			echo "<script type='text/javascript'>alert('El Nombre Ya Existe'); 
			location='../frm_unidadmedida.php'</script>";
		}
		else
		{
			if ($nombre==" ") 
			{
				echo "<script type='text/javascript'>alert('El Nombre está Vacío');
				location='../frm_unidadmedida.php'</script>";
			}
			elseif ($simbolo == "") 
			{
				echo "<script type='text/javascript'>alert('El Símbolo está Vacío');
				location='../frm_unidadmedida.php'</script>";
			}
			else
			{
				pg_query("INSERT INTO unidad_medida (umerepreset, umenombre, umefecha, umetipunimed)
					VALUES ( 	
					'$_REQUEST[umerepreset]',
					'$_REQUEST[umenombre]',				
					'$fecha',
					'$_REQUEST[umetipunimed]')")
				or die ("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_unidadmedida.php'</script>";
				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR UNIDAD MEDIDA";
				pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
					'$usuario',
					'$actividad',
					'$fecha')") 
				or die(pg_result_error());
			}
		}
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>