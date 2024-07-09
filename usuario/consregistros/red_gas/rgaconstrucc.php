<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$ConstRedGas=$_REQUEST['rgaconstrucc'];
	$query="SELECT * FROM redgas where rgaconstrucc='".strtoupper($ConstRedGas)."'";
	$results=pg_query($query)or die('');

	if ($ConstRedGas == "")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedGas">No Valido</div>';
	}
	elseif ($ConstRedGas == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedGas">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedGas">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerConstRedGas">Disponible</div>';
		}
	}
}
?>
