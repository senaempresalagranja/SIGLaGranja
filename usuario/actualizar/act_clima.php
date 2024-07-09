<?php
 include 'conexion.php';
 	
pg_query($con, "UPDATE clima SET
						clihora='$_REQUEST[clihora]',
						clifecha='$_REQUEST[clifecha]',
						cliradisolar='$_REQUEST[cliradisolar]',
						cliunimedrad='$_REQUEST[cliunimedrad]',
						clitempeaire='$_REQUEST[clitempeaire]',
						cliunimedtem='$_REQUEST[cliunimedtem]',
						clihumeralat='$_REQUEST[clihumeralat]',
						cliunimedhum='$_REQUEST[cliunimedhum]',
						cliprecipita='$_REQUEST[cliprecipita]',
						cliunimedpre='$_REQUEST[cliunimedpre]',
						clivelovient='$_REQUEST[clivelovient]',
						cliunimedvel='$_REQUEST[cliunimedvel]',
						clidireccion='$_REQUEST[clidireccion]'
				WHERE cliid='$_REQUEST[cliid]' ")
				or die("Problemas en la Actualizacion".mysql_error());
      echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_clima.php'</script>";
 
 	
?>