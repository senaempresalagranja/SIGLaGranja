<?php
session_start();
include '../conexion.php';
$estanque=$_REQUEST["eeaestanque"];
$espacua=$_REQUEST["eeaespacua"];
$comp=("$estanque$espacua");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM estanque_especieacuatica WHERE eeapkcodigo='.$comp));
if ($regComp > 0) 
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir el mismo ESTANQUE con la misma ESPECIE ACUATICA');location='../frm_estanqueespacua.php'</script>";
}
else
{
	pg_query("UPDATE estanque_especieacuatica SET 
	eeapkcodigo='$comp', 
	eeaestanque='$_REQUEST[eeaestanque]', 
	eeaespacua='$_REQUEST[eeaespacua]', 
	eearesponsab='$_REQUEST[eearesponsab]',
	eeafecsiembr='$_REQUEST[eeafecsiembr]', 
	eeafeccosech='$_REQUEST[eeafeccosech]', 
	eeadescripci='$_REQUEST[eeadescripci]',  
	eeafecha='$fecha' 
	WHERE eeaid='$_REQUEST[eeaid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_estanqueespacua.php'</script>";
}    
?>
