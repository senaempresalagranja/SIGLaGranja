<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
		include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['areidcodigo'];
	$nombre=$_REQUEST['arenombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM area WHERE areidcodigo='".strtoupper($codigo)."'"));
	$NomReg=pg_num_rows( pg_query("SELECT * FROM area WHERE arenombre='".strtoupper($nombre)."'"));

	if ($CodReg > 0)
	{
		echo "<script type='text/javascript'>alert('El Codigo del Area Ya Existe'); 
		location='../frm_area.php'</script>";
	}
	else
	{
		if ($NomReg > 0) 
		{
			echo "<script type='text/javascript'>alert('El Nombre del Area Ya Existe'); 
			location='../frm_area.php'</script>";
		}
		else
		{
			if ($nombre==" ") 
			{
				echo "<script type='text/javascript'>alert('El Nombre del Area esta Vacio');
				location='../frm_area.php'</script>";
			}
			else
			{
				pg_query("INSERT INTO area (areidcodigo, arenombre, areextension, areunimedida, 
					arecoordinad, arelatitud, areorientlat, arelongitud, 
					areorientlon, aredescripci, arefecha )
					VALUES (
					'$_REQUEST[areidcodigo]', 
					'$_REQUEST[arenombre]', 
					'$_REQUEST[areextension]',
					'$_REQUEST[areunimedida]',
					'$_REQUEST[arecoordinad]', 
					'$_REQUEST[coorlatitud]',
					'$_REQUEST[orilatitud]', 
					'$_REQUEST[coorlongitud]', 
					'$_REQUEST[orilongitud]', 
					'$_REQUEST[aredescripci]', 
					'$fecha')")

				or die ("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_area.php'</script>";
						//-----SE GUARDA LA ACTIVIDAD REALIZADA------
				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR AREA";
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

