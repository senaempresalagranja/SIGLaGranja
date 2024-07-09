<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcienti=$_REQUEST['enfnomcinti'];
	$query="SELECT * FROM enfermedad where enfnomcinti='".strtoupper($nomcienti)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcienti == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomCient">No Valido</div>';
	}
	elseif ($nomcienti == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomCient">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VernomCient">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VernomCient">Disponible</div>';
		}
	}
}
?>