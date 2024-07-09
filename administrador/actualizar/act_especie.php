<?php
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nomcomun=$_REQUEST['espnomcomun'];
$nomcient=$_REQUEST['espnomcienti'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($nomcomun==" ") 
{
	echo "<script type='text/javascript'>alert('El nombre comun de la especie esta Vacio');
	location='../frm_especie.php'</script>";
}
elseif ($nomcient==" ") 
{
	echo "<script type='text/javascript'>alert('El nombre cientifico de la especie esta Vacio');
	location='../frm_especie.php'</script>";
}
else
{
	/* Actualizar en Postgres*/
	pg_query("UPDATE especie SET 
		espunidad='$_REQUEST[espunidad]', 
		esptipespeci='$_REQUEST[esptipespeci]', 
		espnomcomun='$_REQUEST[espnomcomun]', 
		espnomcienti='$_REQUEST[espnomcienti]' 
		WHERE espid=$_REQUEST[espid] ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_especie.php'</script>";
}
?>