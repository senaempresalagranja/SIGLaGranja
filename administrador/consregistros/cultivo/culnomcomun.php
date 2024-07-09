<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$culnomcomun= $_REQUEST["culnomcomun"];
	$query = "SELECT * from cultivo where culnomcomun = '".($culnomcomun)."'";
	$results = pg_query( $query) or die('ok');
	
	if ($culnomcomun == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerComunCultivo">No Valido</div>';
	}
	elseif ($culnomcomun == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerComunCultivo">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerComunCultivo">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerComunCultivo">Disponible</div>';
		}
	}
}?>