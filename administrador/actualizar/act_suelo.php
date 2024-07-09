<?php
session_start();
include 'conexion.php';
/* ActuLizar registros en la base de datos postgres */
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s", time());
	
	pg_query("UPDATE suelo SET

	suefhumedad='$_REQUEST[suefhumedad]',
   	sueunimedhu='$_REQUEST[sueunimedhu]',
   	sueftextura='$_REQUEST[sueftextura]',		   		
	suefporocida='$_REQUEST[suefporocida]',
	sueunimedpo='$_REQUEST[sueunimedpo]',
	suefconsiste='$_REQUEST[suefconsiste]',		   		
	sueunimedco='$_REQUEST[sueunimedco]',
	suefcolorter='$_REQUEST[suefcolorter]',
	suefcondelet='$_REQUEST[suefcondelet]',		   		
	sueunimedel='$_REQUEST[sueunimedel]',
	sueqnitrogen='$_REQUEST[sueqnitrogen]',
	sueunimedni='$_REQUEST[sueunimedni]',		   		
	sueqfosforo='$_REQUEST[sueqfosforo]',
	sueunimedfo='$_REQUEST[sueunimedfo]',
	sueqpotacio='$_REQUEST[sueqpotacio]',
	sueunimedpt='$_REQUEST[sueunimedpt]',
	sueqelemmeno='$_REQUEST[sueqelemmeno]',
	sueqeleminte='$_REQUEST[sueqeleminte]',
	sueqph='$_REQUEST[sueqph]',
	sueunimedph='$_REQUEST[sueunimedph]',
	suebmateorga='$_REQUEST[suebmateorga]',
	sueunimedma='$_REQUEST[sueunimedma]',
	suebactimicr='$_REQUEST[suebactimicr]',
	sueunimedam='$_REQUEST[sueunimedam]',
	suebmasmicro='$_REQUEST[suebmasmicro]',
	sueunimedmm='$_REQUEST[sueunimedmm]',		   		
	suefecha='$fecha'	

	WHERE sueid='$_REQUEST[sueid]' ")  
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_suelo.php'</script>";
?>