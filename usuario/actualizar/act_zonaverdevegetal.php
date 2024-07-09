<?php
session_start();
include 'conexion.php';
$zonaverde=$_REQUEST["zovzonaverde"];
$vegetal=$_REQUEST["zovvegetal"];
$comp=("$zonaverde$vegetal");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM zonaverde_vegetal WHERE zovkidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
if ($regComp > 0)
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir el mismo VEGETAL a la misma ZONA VERDE');location='../frm_zonaverdevegetal.php'</script>";
}
else
{
	pg_query("UPDATE zonaverde_vegetal SET 
	zovkidcodigo='$comp', 
	zovzonaverde='$_REQUEST[zovzonaverde]', 
	zovvegetal='$_REQUEST[zovvegetal]', 
	zovdescripci='$_REQUEST[zovdescripci]', 
	zovfecha='$fecha' 
	WHERE zovid='$_REQUEST[zovid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_zonaverdevegetal.php'</script>";
}    
?>
