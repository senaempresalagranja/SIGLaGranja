<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['conidcodigo'];
	$nombre=$_REQUEST['connombre'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s", time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM construccion WHERE conidcodigo='".strtoupper($codigo)."'"));
	$NomReg=pg_num_rows( pg_query("SELECT * FROM construccion WHERE connombre='".strtoupper($nombre)."'"));

	if ($CodReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Codigo de la Construccion Ya Existe'); 
		location='../frm_construccion.php'</script>";
	}
	else
	{
		if ($NomReg > 0) 
		{
			echo "<script type='text/javascript'>alert('El Nombre de la Construccion Ya Existe'); 
			location='../frm_construccion.php'</script>";
		}
		else
		{
			if ($nombre==" ") 
			{
				echo "<script type='text/javascript'>alert('El Nombre de la Construccion esta Vacio');
				location='../frm_construccion.php'</script>";
			}
			else
			{
				if ($codigo == " ") 
				{
					echo "<script type='text/javascript'>alert('El Codigo de la Construccion esta Vacio');
					location='../frm_construccion.php'</script>";
				}
				else
				{
					pg_query("INSERT INTO construccion (conidcodigo,conunidad,connombre,conextension,conunimedcon,contipambien, contipconstr,conestado,contipcubiert,contippiso,contipmuro,confecconstr,confecremode,conlatitud,conorientlat,conlongitud,conorientlon,confecha)	
					VALUES ('$_REQUEST[conidcodigo]',
							'$_REQUEST[conunidad]',
							'$_REQUEST[connombre]',
							'$_REQUEST[conextension]',
							'$_REQUEST[conunimedcon]',
							'$_REQUEST[contipambien]',
							'$_REQUEST[contipconstr]',
							'$_REQUEST[conestado]',
							'$_REQUEST[contipcubiert]',
							'$_REQUEST[contippiso]',
							'$_REQUEST[contipmuro]',
							'$_REQUEST[confecconstr]',
							'$_REQUEST[confecremode]',
							'$_REQUEST[coorlatitud]',
							'$_REQUEST[orilatitud]',
							'$_REQUEST[coorlongitud]',
							'$_REQUEST[orilongitud]',
							'$fecha')") 
					or die ("Problemas en el select ".pg_last_error());
					echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_construccion.php'</script>";
					$usuario=($_SESSION['ADMINISTRADOR']);
					$actividad="REGISTRAR CONSTRUCCION";
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