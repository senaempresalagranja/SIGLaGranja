<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$culnomcienti= $_REQUEST["culnomcienti"];
	$query = "SELECT * from cultivo where culnomcienti = '".($culnomcienti)."'";
	$results = pg_query( $query) or die('ok');
	
	if ($culnomcienti == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientCultivo">No Valido</div>';
	}
	elseif ($culnomcienti == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientCultivo">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerNomCientCultivo">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerNomCientCultivo">Disponible</div>';
		}
	}
}?>