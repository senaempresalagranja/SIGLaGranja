<?php
session_start();
include '../conexion.php';
$enfermedad=$_REQUEST["eesenfermeda"];
$especie=$_REQUEST["eesespecie"];
$comp=("$enfermedad$especie");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM enfermedad_especie WHERE eeskidcodigo='.$comp));
if ($regComp > 0) 
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma ENFERMEDAD con la misma ESPECIE');location='../frm_enfermedadespecie.php'</script>";
}
else
{
	pg_query("UPDATE enfermedad_especie SET 
	eeskidcodigo='$comp', 
	eesenfermeda='$_REQUEST[eesenfermeda]', 
	eesespecie='$_REQUEST[eesespecie]', 
	eesdescripci='$_REQUEST[eesdescripci]', 
	eesfecha='$fecha' 
	WHERE eesid='$_REQUEST[eesid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_enfermedadespecie.php'</script>";
}    
?>
