<?php
session_start();
include 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
/* Guardar registros en la base de datos postgres */
$ConstRedSani=$_REQUEST['rsaconstrucc'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

 /* Actualizar en Postgres*/
  	pg_query(" 	UPDATE redsanitaria SET 
  		rsaconstrucc='$_REQUEST[rsaconstrucc]',  
		rsannumbater='$_REQUEST[rsannumbater]',
		rsanumducha='$_REQUEST[rsanumducha]', 
		rsanumlavama='$_REQUEST[rsanumlavama]', 
		sannumgrifos='$_REQUEST[sannumgrifos]', 
		sannumsifon='$_REQUEST[sannumsifon]'
		WHERE rsaid=$_REQUEST[rsaid] ")

	or die ("Problemas en el select ".pg_last_error());
	echo "<script type='text/javascript'> alert('Registro Actualizado'); location='../frm_redsanitaria.php'</script>";	

  ?>