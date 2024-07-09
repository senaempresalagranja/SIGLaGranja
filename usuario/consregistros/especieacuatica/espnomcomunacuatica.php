<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcomun=$_REQUEST['eacnomcomun'];
	$query="SELECT * FROM especieacuatica where eacnomcomun='".strtoupper($nomcomun)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcomun == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomComEspAcu">No Valido</div>';
	}
	elseif ($nomcomun == " ")
	{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomComEspAcu">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomComEspAcu">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomComEspAcu">Disponible</div>';
		}
	}
}
?>


