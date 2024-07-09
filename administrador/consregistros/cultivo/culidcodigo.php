<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$culidcodigo= $_REQUEST["culidcodigo"];
	$query = "SELECT * from cultivo where culidcodigo = '".($culidcodigo)."'";
	$results = pg_query( $query) or die('ok');
	
	if ($culidcodigo == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerCodigoCultivo">No Valido</div>';
	}
	elseif ($culidcodigo == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerCodigoCultivo">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerCodigoCultivo">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerCodigoCultivo">Disponible</div>';
		}
	}
}
?>