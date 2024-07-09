<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$codigo=$_REQUEST['posidcodigo'];
	$query="SELECT * FROM poste where posidcodigo='".strtoupper($codigo)."'";
	$results=pg_query($query)or die('ok');

	if ($codigo == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VercodPoste">No Valido</div>';
	}
	elseif ($codigo == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VercodPoste">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodPoste">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VercodPoste">Disponible</div>';
		}
	}
}
?>
