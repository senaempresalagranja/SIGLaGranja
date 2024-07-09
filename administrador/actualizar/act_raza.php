<?php
session_start();
include 'conexion.php';
$origenRaza=$_REQUEST['razorigen'];
$NombreRaza=$_REQUEST['raznombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$origen="EXOTICO";
if ($origenRaza == 1) 
{
	$origen="NATIVO";
}

if ($NombreRaza == " ") 
{
	echo "<script type='text/javascript'>alert('El Nombre de la Raza esta vacio');
			location='../frm_raza.php'</script>";
}
else
{
	pg_query("UPDATE raza SET 	
		raznombre='$_REQUEST[raznombre]', 
		razorigen='$origen',
		razlugorigen='$_REQUEST[razlugorigen]',
		razproposito='$_REQUEST[razproposito]', 
		razproducion='$_REQUEST[razproducion]',
		razunimedpro='$_REQUEST[razunimedpro]',
		razcarfenoti='$_REQUEST[razcarfenoti]' 
		WHERE razid='$_REQUEST[razid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_raza.php'</script>";
}
?>
