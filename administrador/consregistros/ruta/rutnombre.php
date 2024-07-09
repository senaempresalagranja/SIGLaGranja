<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nombre=$_REQUEST['rutnombre'];
	$query="SELECT * FROM ruta where rutnombre='".strtoupper($nombre)."'";
	$results=pg_query($query)or die('ok');

	if ($nombre == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomRuta">No Valido</div>';
	}
	elseif ($nombre == " ")
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VernomRuta">No Valido</div>';
	}
	else
	{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VernomRuta">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VernomRuta">Disponible</div>';
		}
	}
}
?>
