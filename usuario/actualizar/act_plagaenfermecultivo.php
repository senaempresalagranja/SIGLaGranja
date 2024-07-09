<?php
session_start();
include 'conexion.php';
$plagaenfe=$_REQUEST["pcuplagaenfe"];
$cultivo=$_REQUEST["pcucultivo"];
$comp=("$plagaenfe$cultivo");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM plagaenferme_cultivo WHERE pcukidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
if ($regComp > 0)
{
	echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma PLAGA-ENFERMEDAD en el mismo CULTIVO');location='../frm_plagaenfermecultivo.php'</script>";
}
else
{
	pg_query("UPDATE plagaenferme_cultivo SET 
		pcukidcodigo='$comp', 
		pcuplagaenfe='$_REQUEST[pcuplagaenfe]', 
		pcucultivo='$_REQUEST[pcucultivo]',
		pcudescripci='$_REQUEST[pcudescripci]', 
		pcufecha='$fecha' 
		WHERE pcuid='$_REQUEST[pcuid]'");
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_plagaenfermecultivo.php'</script>";
}
?>
