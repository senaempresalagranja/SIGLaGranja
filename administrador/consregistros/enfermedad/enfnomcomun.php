<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcomun=$_REQUEST['enfnomcomun'];
	$query="SELECT * FROM enfermedad where enfnomcomun='".strtoupper($nomcomun)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcomun == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomComun">No Valido</div>';
	}
	elseif ($nomcomun == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomComun">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VernomComun">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VernomComun">Disponible</div>';
		}
	}
}
?>