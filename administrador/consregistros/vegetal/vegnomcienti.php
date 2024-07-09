<?php
sleep(1);

include('conexion.php');
if($_REQUEST)
{
	$nomCienti= $_REQUEST["vegnomcienti"];
	$query = "SELECT * from vegetal where vegnomcienti = '".strtoupper($nomCienti)."'";
	$results = pg_query( $query) or die('ok');
	
	if ($nomCienti == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCienVegetal"> No Valido</div>';
	}
	elseif ($nomCienti == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCienVegetal"> Ocupado</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomCienVegetal">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomCienVegetal">Disponible</div>';
		}
	}
}
?>

