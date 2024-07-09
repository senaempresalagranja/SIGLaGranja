<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$codigo=$_REQUEST['canidcodigo'];
	$query="SELECT * FROM canal where canidcodigo='".strtoupper($codigo)."'";
	$results=pg_query($query)or die('');

	if ($codigo == "") {
		echo '<div id="Error"><input type="hidden" value="0" id="Vercodcanal">No Valido</div>';
	}
	elseif ($codigo == " "){
			echo '<div id="Error"><input type="hidden" value="0" id="Vercodcanal">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="Vercodcanal">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="Vercodcanal">Disponible</div>';
		}
	}
}?>
