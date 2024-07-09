<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$nombre=$_REQUEST['arenombre'];
	$query="SELECT * FROM area where arenombre='".strtoupper($nombre)."'";
	$results=pg_query($query)or die('');

	if ($nombre == "") {
		echo '<div id="Error"><input type="hidden" value="" id="vernomarea">No Valido</div>';
	}
	elseif ($nombre == " "){
			echo '<div id="Error"><input type="hidden" value="" id="vernomarea">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="" id="vernomarea">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="vernomarea">Disponible</div>';
		}
	}
}
?>
