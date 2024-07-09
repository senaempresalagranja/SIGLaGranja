<?php
/* conexion con postgres */ 
error_reporting(E_ALL^E_NOTICE);//NO DEJA MOSTRAR EL ERROR (NOTTICE)
	$con=pg_connect("host=localhost user=postgres password='siglagranja' dbname=siglagranja  port=5432");
?>