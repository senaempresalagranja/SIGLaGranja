<?php
sleep(1);
include '../conexion.php';
if($_REQUEST)
{
	$nombre=$_REQUEST['connombre'];
	$query="SELECT * FROM construccion where connombre='".strtoupper($nombre)."'";
	$results=pg_query($query)or die('');

	if ($nombre == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomConstru">No Valido</div>';
	}
	elseif ($nombre == " ")
	{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomConstru">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomConstru">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomConstru">Disponible</div>';
		}
	}
}
?>