<?php
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nomcomun=$_REQUEST['eacnomcomun'];
$nomcient=$_REQUEST['eacnomcienti'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($nomcomun==" ") 
{
	echo "<script type='text/javascript'>alert('El nombre comun de la especie acuatica esta Vacio');
	location='../frm_especieacuatica.php'</script>";
}
elseif ($nomcient==" ") 
{
	echo "<script type='text/javascript'>alert('El nombre cientifico de la especie acuatica esta Vacio');
	location='../frm_especieacuatica.php'</script>";
}
else
{
	/* Actualizar en Postgres*/
	pg_query("UPDATE especieacuatica SET 
		eacunidad='$_REQUEST[eacunidad]',
		eactipespeci='$_REQUEST[eactipespeci]', 
		eacnomcomun='$_REQUEST[eacnomcomun]', 
		eacnomcienti='$_REQUEST[eacnomcienti]' 
		WHERE eacid=$_REQUEST[eacid] ")
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_especieacuatica.php'</script>";
}
?>