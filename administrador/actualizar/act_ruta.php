<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$rutcodigo=$_REQUEST['rutidcodigo'];
$rutnombre=$_REQUEST['rutnombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($rutcodigo == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo de la Ruta esta vacio');
	location='../frm_ruta.php'</script>";
}
elseif ($rutnombre==" ") 
{
	echo "<script type='text/javascript'>alert('El Nombre de la Ruta esta vacio');
	location='../frm_ruta.php'</script>";
}
else
{
	pg_query("UPDATE ruta SET 
		rutidcodigo='$_REQUEST[rutidcodigo]',
		rutnombre='$_REQUEST[rutnombre]',
		rutestado='$_REQUEST[rutestado]', 
		rutdistancia='$_REQUEST[rutdistancia]', 
		rununimeddis='$_REQUEST[rununimeddis]',
		ruttierecorr='$_REQUEST[ruttierecorr]',
		rununimedtie='$_REQUEST[rununimedtie]',
		rutlatitudi='$_REQUEST[coorlatitud]',
		rutorienlati='$_REQUEST[orilatitud]',
		rutlongitudi='$_REQUEST[coorlongitud]',
		rutorienloni='$_REQUEST[orilongitud]',
		rutlatitudf='$_REQUEST[coorlatitudf]',
		rutorienlatf='$_REQUEST[orilatitudf]',
		rutlongitudf='$_REQUEST[coorlongitudf]',
		rutorienlonf='$_REQUEST[orilongitudf]',
		rutdescripci='$_REQUEST[rutdescripci]',
		rutfecha='$fecha'
		WHERE rutid='$_REQUEST[rutid]'")  or die ("Problemas en el select ".mysql_error());

	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_ruta.php'</script>";
}
?>