<?php
session_start();
include 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
$ConstRedElec=$_REQUEST['eleconstrucc']; 
$elecantidad=$_REQUEST['elecantidad'];
$elecantidad1=$_REQUEST['elecantidad1'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($elecantidad == 0)
{
	$elecantidad= $elecantidad1;
}

	pg_query("UPDATE redelectrica SET 
		eleconstrucc='$_REQUEST[eleconstrucc]',
	 	elenumlampar='$_REQUEST[elenumlampar]',
	 	elenumtomaco='$_REQUEST[elenumtomaco]',
	 	elenuminterr='$_REQUEST[elenuminterr]',
		eletipventil='$_REQUEST[eletipventil]',
		tomar='$_REQUEST[tomar]',
		tomanr='$_REQUEST[tomanr]',
		elecantidad='$elecantidad'
		WHERE eleid='$_REQUEST[eleid]' ")  
	
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_redelectrica.php'</script>";
 ?>
