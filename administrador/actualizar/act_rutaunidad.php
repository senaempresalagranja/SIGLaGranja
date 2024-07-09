<?php
session_start();
include 'conexion.php';
$ruta=$_REQUEST["runruta"];
$unidad=$_REQUEST["rununidad"];
$comp=("$ruta$unidad");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM ruta_unidad WHERE runkidcodigo='.$comp));

if ($regComp > 0)
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma RUTA en la misma UNIDAD');location='../frm_rutaunidad.php'</script>";
}
else
{
	pg_query("UPDATE ruta_unidad SET 
	runkidcodigo='$comp', 
	rununidad='$_REQUEST[rununidad]', 
	runruta='$_REQUEST[runruta]', 
	rundistancia='$_REQUEST[rundistancia]',
	rununimeddis='$_REQUEST[rununimeddis]',
	runtierecorr='$_REQUEST[runtierecorr]',
	rununimedrec='$_REQUEST[rununimedrec]',
	runtipruta='$_REQUEST[runtipruta]', 
	runfecha='$fecha' 
	WHERE runid='$_REQUEST[runid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_rutaunidad.php'</script>";
}    
?>
