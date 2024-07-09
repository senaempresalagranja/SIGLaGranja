<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$codigo=$_REQUEST['canidcodigo'];
$nombre=$_REQUEST['cannombre']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$CodReg=pg_num_rows( pg_query("SELECT * FROM canal WHERE canidcodigo='".strtoupper($codigo)."'"));
$NomReg=pg_num_rows( pg_query("SELECT * FROM canal WHERE cannombre='".strtoupper($nombre)."'"));

if ($nombre == " ") 
{
	echo "<script type='text/javascript'>alert('El Nombre de canal esta vacio'); 
	location='../frm_canal.php'</script>";
}
elseif ($codigo == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo de canal esta vacio'); 
	location='../frm_canal.php'</script>";
}
else
{
	pg_query($con, "UPDATE canal SET
		canidcodigo= '$_REQUEST[canidcodigo]',
		cannombre= '$_REQUEST[cannombre]',
		canclase= '$_REQUEST[canclase]',
		canuso= '$_REQUEST[canuso]',
		cantipo= '$_REQUEST[cantipo]', 
		canprofundid= '$_REQUEST[canprofundid]',
		canunimedpro= '$_REQUEST[canunimedpro]',
		canancho= '$_REQUEST[canancho]',
		canunimedanc= '$_REQUEST[canunimedanc]', 
		canpendiente= '$_REQUEST[canpendiente]',
		canunimedpen= '$_REQUEST[canunimedpen]',
		candistancia= '$_REQUEST[candistancia]',
		canunimedist= '$_REQUEST[canunimedist]', 
		canlatitudi= '$_REQUEST[coorlatitud]',
		canorienlati= '$_REQUEST[orilatitud]',
		canlongitudi= '$_REQUEST[coorlongitud]',
		canorienloni= '$_REQUEST[orilongitud]',
		canlatitudf= '$_REQUEST[coorlatitudf]',
		canorienlatf= '$_REQUEST[orilatitudf]',
		canlongitudf= '$_REQUEST[coorlongitudf]',
		canorienlonf= '$_REQUEST[orilongitudf]',
		canfecha= '$fecha'
		WHERE canid='$_REQUEST[canid]' ")
	or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_canal.php'</script>";
}
?>