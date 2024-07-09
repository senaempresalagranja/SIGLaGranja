<?php
session_start();
error_reporting(E_ALL^E_NOTICE);
include 'conexion.php';
//cerrar la session del USUARIO CONSULTA//
if (session_start('USUARIO CONSULTA')) 
{
	echo "<script type='text/javascript'>alert('Parece que su sesion ya ha sido cerrada, por favor vuelva a Iniciar Sesion');location='../visitante/index.php?Acceso Denegado'</script>";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='2'>";
	$usuario=($_SESSION['USUARIO CONSULTA']);
	$fecha=date("d-m-Y / H:i:s",time()-25200);
	$actividad="CERRAR SESION";
	pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
	header("Location: ../visitante/index.php");
	unset($_SESSION['USUARIO CONSULTA']);
}
?>