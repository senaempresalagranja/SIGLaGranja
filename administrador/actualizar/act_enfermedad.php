<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nomcomun=$_REQUEST['enfnomcomun'];
$nomcientifico=$_REQUEST['enfnomcinti']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$NomComun=pg_num_rows( pg_query("SELECT * FROM enfermedad WHERE enfnomcomun='".strtoupper($nomcomun)."'"));
$NomCient=pg_num_rows( pg_query("SELECT * FROM enfermedad WHERE enfnomcinti='".strtoupper($nomcientifico)."'"));

	if ($nomcomun==" ") 
		{
			echo "<script type='text/javascript'>alert('El nombre comun de la enfermedad esta vacio');
			location='../frm_enfermedad.php'</script>";
		}
		else
		{
			if ($nomcientifico==" ") 
			{
				echo "<script type='text/javascript'>alert('El nombre cientifico de la enfermedad esta vacio');
				location='../frm_enfermedad.php'</script>";
			}
			else
			{
				pg_query("UPDATE enfermedad SET 
					enfnomcomun='$_REQUEST[enfnomcomun]',
					enfnomcinti='$_REQUEST[enfnomcinti]',
					enftipagecau='$_REQUEST[enftipagecau]',
					enfmorvimort='$_REQUEST[enfmorvimort]',
					enfsintomas='$_REQUEST[enfsintomas]',
					enftratamien='$_REQUEST[enftratamien]',
					enffecha='$fecha'
					WHERE enfid='$_REQUEST[idenfermedad]'")
				or die ("Problemas en el select ".mysql_error());
				echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_enfermedad.php'</script>";
			}
		}
?>