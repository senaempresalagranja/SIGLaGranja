<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$codigo=$_REQUEST['zveidcodigo'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($codigo == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo de la Zona Verde esta vacio'); 
	location='../frm_zonaverde.php'</script>";
}
else
{
	pg_query("UPDATE zonaverde SET 
		zveunidad='$_REQUEST[zveunidad]',
		zveidcodigo='$_REQUEST[zveidcodigo]',  
		zvetipriego='$_REQUEST[zvetipriego]',
		zveextension='$_REQUEST[zveextension]',
		zveunimedi='$_REQUEST[zveunimedi]',
		zvelatitud='$_REQUEST[coorlatitud]',
		zveorientlat='$_REQUEST[orilatitud]',
		zvelongitud='$_REQUEST[coorlongitud]',
		zveorientlon='$_REQUEST[orilongitud]' ,
		zvefecha='$fecha'  
		WHERE zveid='$_REQUEST[zveid]' ")  or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_zonaverde.php'</script>";
}
?>