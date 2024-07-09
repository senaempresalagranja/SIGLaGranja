<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nombre=$_REQUEST['pesnombre']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($nombre==" ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre del Punto Especial esta Vacio');
		location='../frm_puntoespecial.php'</script>";
	}
	else
	{
		pg_query("	UPDATE puntoespecial SET 
						pesunidad='$_REQUEST[pesunidad]',
						pesnombre='$_REQUEST[pesnombre]', 
						pestippunto='$_REQUEST[pestippunto]', 
						peslatitud='$_REQUEST[coorlatitud]',
						pesorientlat='$_REQUEST[orilatitud]', 
						peslongitud='$_REQUEST[coorlongitud]', 
						pesorientlog='$_REQUEST[orilongitud]',
						pesdescripci='$_REQUEST[pesdescripci]',  
						pesfecha= '$fecha'
					WHERE pesid= '$_REQUEST[pesid]' ")  
					or die ("Problemas en el select ".mysql_error());
					echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_puntoespecial.php'</script>";
	}
 ?>