<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nomcomun=$_REQUEST['vegnomcomun'];
$nomcientifico=$_REQUEST['vegnomcienti']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$NomComun=pg_num_rows( pg_query("SELECT * FROM vegetal WHERE vegnomcomun='".strtoupper($nomcomun)."'"));
$NomCient=pg_num_rows( pg_query("SELECT * FROM vegetal WHERE vegnomcienti='".strtoupper($nomcientifico)."'"));

if ($nomcomun==" ") 
{
	echo "<script type='text/javascript'>alert('El nombre comun del Vegetal esta vacio');
	location='../frm_vegetal.php'</script>";
}
else
{
	if ($nomcientifico==" ") 
	{
		echo "<script type='text/javascript'>alert('El nombre cientifico del Vegetal esta vacio');
		location='../frm_vegetal.php'</script>";
	}
	else
	{
		$veg=$_REQUEST['vegorigen'];
		$origen="EXOTICO";
		if ($veg==1) 
		{
			$origen="NATIVO";
		}
		pg_query($con,"UPDATE vegetal SET
			vegnomcomun='$_REQUEST[vegnomcomun]',
			vegnomcienti='$_REQUEST[vegnomcienti]',
			vegorigen='$origen',
			veglugorigen='$_REQUEST[veglugorigen]',
			vegclima='$_REQUEST[vegclima]',
			vegtipo='$_REQUEST[vegtipo]', 
			vegdescripci='$_REQUEST[vegdescripci]',
			vegfecha='$fecha'
			WHERE vegid='$_REQUEST[vegid]'") or die ("Problemas en el select ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_vegetal.php'</script> ";
	}
}
?>