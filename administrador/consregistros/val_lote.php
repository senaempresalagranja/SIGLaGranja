<?php

/* Guardar registros en la base de datos postgres */
 include 'conexion.php'; 
  	$fecha=date("d-m-Y");
  	
  	if($_REQUEST)
{
	$lotidcodigo= $_REQUEST["lotidcodigo"];	
	$query = "select * from lote where lotidcodigo = '".$lotidcodigo."'";
	error_reporting();
	$results = pg_query($query) or die('ok');
	
	if(pg_num_rows(@$results) > 0) // not available
	{
		echo '<td id="Error">Codigo Ya Existe</td>';
	}
	else
	{
		echo '<td id="Success">Codigo Disponible</td>';
	}
}		
	 
?>