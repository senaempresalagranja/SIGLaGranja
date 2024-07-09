<?php
session_start();
include 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
/* Guardar registros en la base de datos postgres */
$ConstRedElec=$_REQUEST['eleconstrucc'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

 /* Actualizar en Postgres*/
  $rgafecha=date("d-m-Y / H:i:s",time()-25200);
	pg_query("UPDATE redgas SET
		rgaconstrucc='$_REQUEST[rgaconstrucc]',
		rgatipmateri='$_REQUEST[rgatipmateri]',
		rganumvalvul='$_REQUEST[rganumvalvul]',
		rganumconexi='$_REQUEST[rganumconexi]',
		rganumcontad='$_REQUEST[rganumcontad]',
		rganumsoport='$_REQUEST[rganumsoport]'
		WHERE rgaid='$_REQUEST[rgaid]' ")  

	or die ("Problemas en el select ".pg_last_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_redgas.php'</script>";
 ?>