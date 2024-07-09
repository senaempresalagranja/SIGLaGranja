<?php
include 'conexion.php';
/* Actualizar registros en la base de datos postgres */
$act_nombre=$_REQUEST['uninombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($act_nombre == " ") 
{
	echo "<script type='text/javascript'>alert('El Nombre de la Unidad está Vacío');
	location='../frm_area.php'</script>";
}
else
{
	pg_query("UPDATE unidad SET
		uniarea='$_REQUEST[uniarea]', 
		uninombre='$_REQUEST[uninombre]', 
		uniextension='$_REQUEST[uniextension]', 
		uniunimedida='$_REQUEST[uniunimedida]', 
		uniresponsab='$_REQUEST[uniresponsab]', 
		unilatitud='$_REQUEST[coorlatitud]', 
		uniorientlat='$_REQUEST[orilatitud]',
		unilongitud='$_REQUEST[coorlongitud]',
		uniorientlon='$_REQUEST[orilongitud]', 
		unidescripci='$_REQUEST[unidescripci]',
		unifecha='$fecha'

		WHERE uniid='$_REQUEST[uniid]' ")  
	or die ("Problemas en el select ".pg_last_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_unidad.php'</script>";
}
?>