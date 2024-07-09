<?php
session_start();
include 'conexion.php';
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());
 /* Actualizar en Postgres*/
	pg_query("UPDATE lagranja SET 
		lagnit='$_REQUEST[lagnit]',
	  	lagnombre='$_REQUEST[lagnombre]',
	   	lagdireccio='$_REQUEST[lagdireccio]',
	    lagdepartam='$_REQUEST[lagdepartam]',
	    lagmunicipi='$_REQUEST[lagmunicipi]', 
	    lagvereda='$_REQUEST[lagvereda]', 
	    lagcodprenu='$_REQUEST[lagcodprenu]', 
	    lagcodprean='$_REQUEST[lagcodprean]', 
	    lagmatriinm='$_REQUEST[lagmatriinm]',
	    lagactiecon='$_REQUEST[lagactiecon]',
	    lagfecfunda='$_REQUEST[lagfecfunda]',
	    lagareaterr='$_REQUEST[lagareaterr]',	    
	    lagunimedat='$_REQUEST[lagunimedat]',--
	    lagareconst='$_REQUEST[lagareconst]',
	    lagunimedac='$_REQUEST[lagunimedac]',--
	    lagcanconst='$_REQUEST[lagcanconst]',
	    lagaltitud='$_REQUEST[lagaltitud]',
	    lagunimedam='$_REQUEST[lagunimedam]',--
	    lagplancha='$_REQUEST[lagplancha]',
	    lagescala='$_REQUEST[lagescala]',
	    laglatitud='$_REQUEST[coorlatitud]',
	    lagorientlat='$_REQUEST[orilatitud]',
	    laglongitud='$_REQUEST[coorlongitud]',
	    lagorientlon='$_REQUEST[orilongitud]',
	    lagfecha= '$fecha'
	WHERE lagid= '$_REQUEST[lagid]' ")  
	or die ("Problemas en el select ".pg_last_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_lagranja.php'</script>";
 ?>