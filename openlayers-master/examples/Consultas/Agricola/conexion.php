<?php
/* conexion con postgres */ 
error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
	$con=pg_connect("host=localhost  port=5432 dbname=siglagranja user=postgres password='siglagranja'");
?>