<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$ConstRedSanit=$_REQUEST['rsaconstrucc'];
	$query="SELECT * FROM redsanitaria where rsaconstrucc='".strtoupper($ConstRedSanit)."'";
	$results=pg_query($query)or die('');

	if ($ConstRedSanit == "")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedSani">No Valido</div>';
	}
	elseif ($ConstRedSanit == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedSani">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedSani">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerConstRedSani">Disponible</div>';
		}
	}
}
?>
