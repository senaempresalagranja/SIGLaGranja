<?php
session_start();
include 'conexion.php';
$especie=$_REQUEST["eraespecie"];
$raza=$_REQUEST["eraraza"];
$comp=("$especie$raza");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM especie_raza WHERE erakidcodigo='.$comp));
if ($regComp > 0) 
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma ESPECIE con la misma RAZA');location='../frm_especieraza.php'</script>";
}
else
{
	pg_query("UPDATE especie_raza SET 
	erakidcodigo='$comp', 
	eraespecie='$_REQUEST[eraespecie]', 
	eraraza='$_REQUEST[eraraza]', 
	eradescripci='$_REQUEST[eradescripci]', 
	erafecha='$fecha' 
	WHERE eraid='$_REQUEST[eraid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_especieraza.php'</script>";
}    
?>
