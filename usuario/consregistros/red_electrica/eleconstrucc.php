<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$ConstRedElec=$_REQUEST['eleconstrucc'];
	$query="SELECT * FROM redelectrica where eleconstrucc='".strtoupper($ConstRedElec)."'";
	$results=pg_query($query)or die('');

	if ($ConstRedElec == "")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedElec">No Valido</div>';
	}
	elseif ($ConstRedElec == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedElec">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedElec">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerConstRedElec">Disponible</div>';
		}
	}
}
?>
