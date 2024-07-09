<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$codigo=$_REQUEST['plaidcodigo'];
	$query="SELECT * FROM plaga where plaidcodigo='".strtoupper($codigo)."'";
	$results=pg_query($query)or die('ok');

	if ($codigo == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VercodPlaga">No Valido</div>';
	}
	elseif ($codigo == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VercodPlaga">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodPlaga">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VercodPlaga">Disponible</div>';
		}
	}
}
?>
