<?php
include 'conexion.php';
/* Actualizar registros en la base de datos postgres */
$act_nombre=$_REQUEST['estnombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

	$NomAct=pg_num_rows( pg_query("SELECT * FROM estanque WHERE estnombre='".strtoupper($act_nombre)."'"));

	if ($act_nombre == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre del estanque esta Vacio');
		location='../frm_estanque.php'</script>";
	}
	else
	{
		pg_query("UPDATE estanque SET 
			estnombre='$_REQUEST[estnombre]',
			esttipestanq='$_REQUEST[esttipestanq]',
			estprofundid='$_REQUEST[estprofundid]',
			estunimedpro='$_REQUEST[estunimedpro]',
			estespejagua='$_REQUEST[estespejagua]',
			estunimedesp='$_REQUEST[estunimedesp]',
			estvolumagua='$_REQUEST[estvolumagua]',
			estunimedvol='$_REQUEST[estunimedvol]',
			estfecha='$fecha'
			WHERE estid='$_REQUEST[estid]' ")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_estanque.php'</script>";
	}
?>