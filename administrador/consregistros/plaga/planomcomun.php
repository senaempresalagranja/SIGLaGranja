<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcomun=$_REQUEST['planomcomun'];
	$query="SELECT * FROM plaga where planomcomun='".strtoupper($nomcomun)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcomun == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomComPlaga">No Valido</div>';
	}
	elseif ($nomcomun == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomComPlaga">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomComPlaga">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomComPlaga">Disponible</div>';
		}
	}
}
?>
