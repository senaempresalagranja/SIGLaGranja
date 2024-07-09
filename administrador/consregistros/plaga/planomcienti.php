<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcienti=$_REQUEST['planomcienti'];
	$query="SELECT * FROM plaga where planomcienti='".strtoupper($nomcienti)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcienti == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientPlaga">No Valido</div>';
	}
	elseif ($nomcienti == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientPlaga">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientPlaga">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomCientPlaga">Disponible</div>';
		}
	}
}
?>
