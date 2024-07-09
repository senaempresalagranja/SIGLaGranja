<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['lotidcodigo'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM lote WHERE lotidcodigo='".strtoupper($codigo)."'"));

	if ($CodReg > 0)
	{
		echo "<script type='text/javascript'>alert('El Codigo del lote Ya Existe'); 
		location='../frm_lote.php'</script>";
	}
	else
	{
		if ($codigo==" ") 
		{
			echo "<script type='text/javascript'>alert('El codigo del lote esta vacio');
			location='../frm_lote.php'</script>";
		}
		else
		{
			pg_query("INSERT INTO lote (lotidcodigo, lotsuelo, lotextension, lotunimedlot, 
				lotlatitud, lotorientlat, lotlongitud, lotorientlon, 
				lotfecha )
				VALUES (
				'$_REQUEST[lotidcodigo]', 
				'$_REQUEST[lotsuelo]', 
				'$_REQUEST[lotextension]',
				'$_REQUEST[lotunimedlot]', 
				'$_REQUEST[coorlatitud]',
				'$_REQUEST[orilatitud]', 
				'$_REQUEST[coorlongitud]', 
				'$_REQUEST[orilongitud]',
				'$fecha')")

				or die ("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_lote.php'</script>";
						//-----SE GUARDA LA ACTIVIDAD REALIZADA------
				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR LOTE";
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

