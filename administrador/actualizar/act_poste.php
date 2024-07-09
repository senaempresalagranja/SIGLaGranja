<?php
session_start();
include 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
/* Guardar registros en la base de datos postgres */
$codigo=$_REQUEST['posidcodigo'];
$posalumbrado=$_REQUEST['posalumbrado']; 
$posestalumbr=$_REQUEST['posestalumbr']; 
$postransform=$_REQUEST['postransform']; 
$posesttransf=$_REQUEST['posesttransf']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($codigo == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo del Poste está vacio'); location='../frm_poste.php'</script>";
}
elseif ($posalumbrado == "") 
{
	echo "<script type='text/javascript'>alert('Verifique la Iluminacion, ¡Seleccione una opcion!'); location='../frm_poste.php'</script>";
}
elseif ($posestalumbr == "") 
{
	echo "<script type='text/javascript'>alert('Verifique el Estado de la Iluminacion, ¡Seleccione una opcion Válida!'); location='../frm_poste.php'</script>";
}
elseif ($postransform == "")
{
	echo "<script type='text/javascript'>alert('Verifique el Trasformador, ¡Seleccione una opcion!'); location='../frm_poste.php'</script>";
}
elseif ($posesttransf == "") 
{
	echo "<script type='text/javascript'>alert('Verifique el Estado del Trasformador, ¡Seleccione una opcion Válida!'); location='../frm_poste.php'</script>";
}
else
{
 /* Actualizar en Postgres*/
	pg_query("UPDATE poste SET
		posidcodigo='$_REQUEST[posidcodigo]', 
		posunidad='$_REQUEST[posunidad]',
		postipmateri='$_REQUEST[postipmateri]',
		posestado='$_REQUEST[posestado]',
		posaltura='$_REQUEST[posaltura]',
		posunimedi='$_REQUEST[posunimedi]',
		postiptensio='$_REQUEST[postiptensio]',
		posalumbrado='$_REQUEST[posalumbrado]',
		posestalumbr='$_REQUEST[posestalumbr]',
		postransform='$_REQUEST[postransform]',
		posesttransf='$_REQUEST[posesttransf]',
		posruta='$_REQUEST[posruta]',
		poslatitud='$_REQUEST[coorlatitud]',
		posorientlat='$_REQUEST[orilatitud]',
		poslongitud='$_REQUEST[coorlongitud]',
		posorientlon='$_REQUEST[orilongitud]',
		posfecha='$fecha'  
		WHERE posid='$_REQUEST[posid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_poste.php'</script>";
}
 ?>