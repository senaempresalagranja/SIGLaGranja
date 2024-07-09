<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$ConstRedLogica=$_REQUEST['rloconstrucc'];
	$query="SELECT * FROM redlogica where rloconstrucc='".strtoupper($ConstRedLogica)."'";
	$results=pg_query($query)or die('');

	if ($ConstRedLogica == "")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedLogica">No Valido</div>';
	}
	elseif ($ConstRedLogica == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedLogica">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0)
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerConstRedLogica">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerConstRedLogica">Disponible</div>';
		}
	}
}
?>
