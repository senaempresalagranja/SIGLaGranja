<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$simbolo=$_REQUEST['umerepreset'];
$nombre=$_REQUEST['umenombre']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

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
	pg_query("	UPDATE unidad_medida SET 
		umerepreset='$_REQUEST[umerepreset]',
		umenombre='$_REQUEST[umenombre]',				
		umefecha='$fecha',
		umetipunimed='$_REQUEST[umetipunimed]'
		WHERE umeid= '$_REQUEST[umeid]' ")
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_unidadmedida.php'</script>";
}
?>