<?php
session_start();
include 'conexion.php';
$plagaenfe=$_REQUEST["pveplagaenfe"];
$vegetal=$_REQUEST["pvevegetal"];
$comp=("$plagaenfe$vegetal");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM plagaenferme_vegetal WHERE pvekidcogigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
if ($regComp > 0)
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma PLAGA-ENFERMEDAD en el mismo VEGETAL');location='../frm_plagaenfermevegetal.php'</script>";
}
else
{
	pg_query("UPDATE plagaenferme_vegetal SET 
		pvekidcogigo='$comp', 
		pveplagaenfe='$_REQUEST[pveplagaenfe]', 
		pvevegetal='$_REQUEST[pvevegetal]',
		pvedescripci='$_REQUEST[pvedescripci]', 
		pvefecha='$fecha' 
		WHERE pveid='$_REQUEST[pveid]'");
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_plagaenfermevegetal.php'</script>";
}
?>
