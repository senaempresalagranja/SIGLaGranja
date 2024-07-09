<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$codconstru=$_REQUEST['rsaconstrucc'];
	$query="SELECT * FROM redsanitaria where rsaconstrucc='".strtoupper($codconstru)."'";
	$results=pg_query($query)or die('ok');
	if(pg_num_rows(@$results) > 0) 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="Varconstrucci">Ya Existe</div>';
	}
	else
	{
		echo '<div id="Success"><input type="hidden" value="1" id="Varconstrucci">Disponible</div>';
	}
}?>
