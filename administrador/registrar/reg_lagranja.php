<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

				pg_query("INSERT INTO lagranja (lagnit, lagnombre, lagdireccio, lagdepartam, 
					lagmunicipi, lagvereda, lagcodprenu, lagcodprean, 
					lagmatriinm, lagactiecon, lagfecfunda, lagareaterr, lagunimedat, lagareconst, lagunimedac, lagcanconst, lagaltitud, lagunimedam, lagplancha, lagescala, laglatitud, lagorientlat, laglongitud, lagorientlon, lagfecha )
					VALUES (
					'$_REQUEST[lagnit]', 
					'$_REQUEST[lagnombre]', 
					'$_REQUEST[lagdireccio]',
					'$_REQUEST[lagdepartam]',
					'$_REQUEST[lagmunicipi]', 
					'$_REQUEST[lagvereda]',
					'$_REQUEST[lagcodprenu]', 
					'$_REQUEST[lagcodprean]', 
					'$_REQUEST[lagmatriinm]', 
					'$_REQUEST[lagactiecon]',
					'$_REQUEST[lagfecfunda]',
					'$_REQUEST[lagareaterr]',
					'$_REQUEST[lagunimedat]',
					'$_REQUEST[lagareconst]',
					'$_REQUEST[lagunimedac]',
					'$_REQUEST[lagcanconst]',
					'$_REQUEST[lagaltitud]',
					'$_REQUEST[lagunimedam]',
					'$_REQUEST[lagplancha]',
					'$_REQUEST[lagescala]',
					'$_REQUEST[coorlatitud]',
					'$_REQUEST[orilatitud]',
					'$_REQUEST[coorlongitud]', 
					'$_REQUEST[orilongitud]', 
					'$fecha')")

				or die ("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_lagranja.php'</script>";
						//-----SE GUARDA LA ACTIVIDAD REALIZADA------
				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR LA GRANJA";
				pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
					'$usuario',
					'$actividad',
					'$fecha')") 
				or die(pg_result_error());
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>

