<?php
session_start();
/* Guardar registros en la base de datos postgres */
include 'conexion.php';
$dano=$_REQUEST['pentipdano'];
$Nomcomun=$_REQUEST['pennomcomun'];
$NomCientifico=$_REQUEST['pennomcienti'];
$Radio_Boton=$_REQUEST['pentipmanejo'];
$Tip_Afec_Fru=$_REQUEST['pentipzaffru'];
$Tip_Afec_Tal=$_REQUEST['pentipzaftal'];
$Tip_Afec_Flo=$_REQUEST['pentipzafflo'];
$Tip_Afec_Rai=$_REQUEST['pentipzafrai'];
$Tip_Afec_Hoj=$_REQUEST['pentipzafhoj'];
//$fecha=date("d-m-Y/H:i:s",time()-25200);
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($dano == 1) 
{
	$tipo='ENFERMEDAD';
} 
elseif ($dano == 2) 
{
	$tipo='PLAGA';
}

if ($Nomcomun == " ") 
{
	echo "<script type='text/javascript'>alert('El Nombre Comun esta vacio');
	location='../frm_plagaenfermedad.php'</script>";
}
elseif ($NomCientifico == " ") 
{
	echo "<script type='text/javascript'>alert('El Nombre Cientifico esta vacio');
	location='../frm_plagaenfermedad.php'</script>";
}
elseif ($Radio_Boton == "") 
{
	echo "<script type='text/javascript'>alert('Verifique el Tipo de Manejo, ¡Seleccione una opcion!');location='../frm_plagaenfermedad.php'</script>";
}
elseif ($Tip_Afec_Fru && $Tip_Afec_Tal && $Tip_Afec_Flo && $Tip_Afec_Rai && $Tip_Afec_Hoj == "") 
{
	echo "<script type='text/javascript'>alert('Verifique la Zona Afectada, seleccione por lo menos una casilla de verificacion');location='../frm_plagaenfermedad.php'</script>";
}
else
{ 	
	
	pg_query("UPDATE plagaenfermedad SET

		pentipdano='$tipo', 
		pennomcomun='$_REQUEST[pennomcomun]', 
		pennomcienti='$_REQUEST[pennomcienti]', 
		pentipagecau='$_REQUEST[pentipagecau]', 
		pentipmanejo='$_REQUEST[pentipmanejo]', 
		pentipzaffru='$_REQUEST[pentipzaffru]', 
		pentipzaftal='$_REQUEST[pentipzaftal]', 
		pentipzafflo='$_REQUEST[pentipzafflo]', 
		pentipzafrai='$_REQUEST[pentipzafrai]', 
		pentipzafhoj='$_REQUEST[pentipzafhoj]', 
		pendescripci='$_REQUEST[pendescripci]'
		WHERE penid='$_REQUEST[penid]' ")  or die ("Problemas en el select ".pg_last_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_plagaenfermedad.php'</script>";
}
?>